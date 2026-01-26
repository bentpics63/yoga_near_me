<?php
/**
 * YogaNearMe Studio Onboarding Form Handler
 *
 * REST API endpoint and processing for custom studio onboarding form.
 * Creates/updates GeoDirectory listings from form submissions.
 *
 * INSTALLATION:
 * Add to child theme functions.php:
 * require_once get_stylesheet_directory() . '/includes/studio-onboarding-handler.php';
 *
 * Or upload to wp-content/plugins/ynm-custom-functions/ and activate.
 *
 * @package YogaNearMe
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * =============================================================================
 * REGISTER REST API ENDPOINT
 * =============================================================================
 */
add_action('rest_api_init', 'ynm_register_onboarding_endpoint');

function ynm_register_onboarding_endpoint() {
    register_rest_route('yoganearme/v1', '/studios', array(
        'methods'             => 'POST',
        'callback'            => 'ynm_handle_onboarding_submission',
        'permission_callback' => '__return_true', // Public endpoint
    ));

    // Also register endpoint for updating existing listings
    register_rest_route('yoganearme/v1', '/studios/(?P<id>\d+)', array(
        'methods'             => 'PUT',
        'callback'            => 'ynm_handle_onboarding_update',
        'permission_callback' => 'ynm_can_edit_listing',
    ));
}

/**
 * Permission check for updating listings
 */
function ynm_can_edit_listing($request) {
    $listing_id = $request->get_param('id');

    // Allow if user is logged in and owns the listing, or is admin
    if (is_user_logged_in()) {
        $post = get_post($listing_id);
        if ($post && ($post->post_author == get_current_user_id() || current_user_can('edit_others_posts'))) {
            return true;
        }
    }

    // Also allow with valid nonce from form
    $nonce = $request->get_header('X-WP-Nonce');
    if ($nonce && wp_verify_nonce($nonce, 'wp_rest')) {
        return true;
    }

    return false;
}

/**
 * =============================================================================
 * MAIN HANDLER: Process new studio submission
 * =============================================================================
 */
function ynm_handle_onboarding_submission($request) {
    $data = $request->get_json_params();

    // Validate required fields
    $validation = ynm_validate_submission($data);
    if (is_wp_error($validation)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => $validation->get_error_message(),
            'errors'  => $validation->get_error_data()
        ), 400);
    }

    // Check for duplicate (same name + address)
    $duplicate = ynm_check_duplicate_listing($data);
    if ($duplicate) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'A listing with this name and address already exists.',
            'existing_id' => $duplicate
        ), 409);
    }

    // Create the GeoDirectory listing
    $listing_id = ynm_create_geodirectory_listing($data);

    if (is_wp_error($listing_id)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Failed to create listing: ' . $listing_id->get_error_message()
        ), 500);
    }

    // Save custom fields
    ynm_save_onboarding_fields($listing_id, $data);

    // Handle photo uploads if any
    if (!empty($data['photos'])) {
        ynm_process_photo_uploads($listing_id, $data['photos']);
    }

    // Send confirmation emails
    ynm_send_onboarding_emails($listing_id, $data);

    // Get the listing URL
    $listing_url = get_permalink($listing_id);

    return new WP_REST_Response(array(
        'success'    => true,
        'message'    => 'Your studio has been listed!',
        'listing_id' => $listing_id,
        'listing_url' => $listing_url,
        'edit_url'   => add_query_arg('edit', '1', $listing_url)
    ), 201);
}

/**
 * =============================================================================
 * HANDLER: Update existing listing
 * =============================================================================
 */
function ynm_handle_onboarding_update($request) {
    $listing_id = $request->get_param('id');
    $data = $request->get_json_params();

    // Verify listing exists
    $post = get_post($listing_id);
    if (!$post || $post->post_type !== 'gd_place') {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Listing not found'
        ), 404);
    }

    // Update the listing
    ynm_save_onboarding_fields($listing_id, $data);

    // Handle photo uploads
    if (!empty($data['photos'])) {
        ynm_process_photo_uploads($listing_id, $data['photos']);
    }

    return new WP_REST_Response(array(
        'success'    => true,
        'message'    => 'Listing updated successfully',
        'listing_id' => $listing_id,
        'listing_url' => get_permalink($listing_id)
    ), 200);
}

/**
 * =============================================================================
 * VALIDATION
 * =============================================================================
 */
function ynm_validate_submission($data) {
    $errors = array();

    // Required fields
    $required = array(
        'studio_name' => 'Studio name is required',
        'address'     => 'Address is required',
        'email'       => 'Email is required',
        'primary_style' => 'Please select your primary yoga style',
        'drop_in_policy' => 'Please select a drop-in policy'
    );

    foreach ($required as $field => $message) {
        if (empty($data[$field])) {
            $errors[$field] = $message;
        }
    }

    // Email format
    if (!empty($data['email']) && !is_email($data['email'])) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Website format (if provided)
    if (!empty($data['website'])) {
        $url = $data['website'];
        if (strpos($url, 'http') !== 0) {
            $url = 'https://' . $url;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $errors['website'] = 'Please enter a valid website URL';
        }
    }

    // Hours validation (at least one day should be set)
    if (empty($data['hours']) || !is_array($data['hours']) || count($data['hours']) === 0) {
        $errors['hours'] = 'Please set business hours for at least one day';
    }

    if (!empty($errors)) {
        return new WP_Error('validation_failed', 'Please fix the errors below', $errors);
    }

    return true;
}

/**
 * =============================================================================
 * CHECK FOR DUPLICATES
 * =============================================================================
 */
function ynm_check_duplicate_listing($data) {
    global $wpdb;

    $studio_name = sanitize_text_field($data['studio_name']);
    $address = sanitize_text_field($data['address']);

    // Look for existing listing with same name
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts}
         WHERE post_type = 'gd_place'
         AND post_title = %s
         AND post_status IN ('publish', 'pending', 'draft')
         LIMIT 1",
        $studio_name
    ));

    if ($existing) {
        // Check if address also matches
        $existing_address = geodir_get_post_meta($existing, 'street', true);
        if ($existing_address && stripos($existing_address, $address) !== false) {
            return $existing;
        }
    }

    return false;
}

/**
 * =============================================================================
 * CREATE GEODIRECTORY LISTING
 * =============================================================================
 */
function ynm_create_geodirectory_listing($data) {
    // Prepare address components
    $address = sanitize_text_field($data['address']);
    $city = !empty($data['city']) ? sanitize_text_field($data['city']) : '';
    $state = !empty($data['state']) ? sanitize_text_field($data['state']) : '';
    $zip = !empty($data['zip']) ? sanitize_text_field($data['zip']) : '';

    // Create the post
    $post_data = array(
        'post_title'   => sanitize_text_field($data['studio_name']),
        'post_content' => '', // Will be set via custom field if provided
        'post_status'  => 'pending', // Review before publishing
        'post_type'    => 'gd_place',
        'post_author'  => get_current_user_id() ?: 1, // Default to admin if not logged in
    );

    $listing_id = wp_insert_post($post_data, true);

    if (is_wp_error($listing_id)) {
        return $listing_id;
    }

    // Save GeoDirectory-specific fields
    geodir_save_post_meta($listing_id, 'street', $address);
    geodir_save_post_meta($listing_id, 'city', $city);
    geodir_save_post_meta($listing_id, 'region', $state);
    geodir_save_post_meta($listing_id, 'zip', $zip);
    geodir_save_post_meta($listing_id, 'country', 'United States');

    // Geocode the address if GD function exists
    if (function_exists('geodir_save_post_info')) {
        $full_address = "$address, $city, $state $zip";
        $location = geodir_get_location_by_address($full_address);
        if ($location && !empty($location['latitude'])) {
            geodir_save_post_meta($listing_id, 'latitude', $location['latitude']);
            geodir_save_post_meta($listing_id, 'longitude', $location['longitude']);
        }
    }

    return $listing_id;
}

/**
 * =============================================================================
 * SAVE ONBOARDING FIELDS TO GEODIRECTORY
 * =============================================================================
 */
function ynm_save_onboarding_fields($listing_id, $data) {

    // Field mapping: form field => GeoDirectory field
    $field_map = array(
        // Contact Info
        'phone'                 => 'phone',
        'email'                 => 'email',
        'website'               => 'website',

        // Identity & Vibe
        'primary_style'         => 'primary_style',
        'vibe_tags'             => 'vibe_tags',
        'best_for'              => 'best_for',
        'languages'             => 'languages',

        // Practical Info
        'drop_in_policy'        => 'dropin_policy',
        'class_size'            => 'class_size',
        'new_student_info'      => 'new_student_info',
        'parking'               => 'parking_transit',

        // What Makes You Different
        'intro_offer'           => 'intro_offer',
        'intro_offer_subtitle'  => 'intro_offer_subtitle',
        'why_students_love'     => 'why_students_love',
        'signature_offering'    => 'signature_offering',

        // Optional Details
        'established_year'      => 'established_year',
        'yoga_alliance'         => 'yoga_alliance',
        'instagram'             => 'instagram',
        'facebook'              => 'facebook',
        'tiktok'                => 'tiktok',
        'google_reviews_url'    => 'google_reviews_url',
        'student_sources'       => 'student_sources',
    );

    foreach ($field_map as $form_key => $gd_key) {
        if (!isset($data[$form_key]) || $data[$form_key] === '') {
            continue;
        }

        $value = $data[$form_key];

        // Handle arrays (convert to comma-separated for GD)
        if (is_array($value)) {
            $value = array_map('sanitize_text_field', $value);
            $value = implode(',', $value);
        } else {
            // Sanitize based on type
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $value = esc_url_raw($value);
            } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $value = sanitize_email($value);
            } else {
                $value = sanitize_text_field($value);
            }
        }

        geodir_save_post_meta($listing_id, $gd_key, $value);
    }

    // Handle business hours
    if (!empty($data['hours']) && is_array($data['hours'])) {
        $hours_string = ynm_format_hours_for_geodirectory($data['hours']);
        geodir_save_post_meta($listing_id, 'business_hours', $hours_string);
    }

    // Mark onboarding as complete
    geodir_save_post_meta($listing_id, 'onboarding_complete', '1');
    geodir_save_post_meta($listing_id, 'onboarding_date', current_time('mysql'));

    // Calculate profile completion
    $completion = ynm_calculate_profile_completion_v2($listing_id, $data);
    geodir_save_post_meta($listing_id, 'profile_completion', $completion);

    // Set default package (Free/Community tier)
    geodir_save_post_meta($listing_id, 'package_id', 1); // Update with actual free package ID
}

/**
 * =============================================================================
 * FORMAT HOURS FOR GEODIRECTORY
 * =============================================================================
 */
function ynm_format_hours_for_geodirectory($hours) {
    $gd_hours = array();
    $day_map = array(
        'mon' => 'Mo',
        'tue' => 'Tu',
        'wed' => 'We',
        'thu' => 'Th',
        'fri' => 'Fr',
        'sat' => 'Sa',
        'sun' => 'Su'
    );

    foreach ($hours as $day => $times) {
        if (isset($day_map[$day]) && !empty($times['open']) && !empty($times['close'])) {
            $gd_hours[] = array(
                'd' => $day_map[$day],
                'o' => $times['open'],
                'c' => $times['close']
            );
        }
    }

    return !empty($gd_hours) ? json_encode($gd_hours) : '';
}

/**
 * =============================================================================
 * CALCULATE PROFILE COMPLETION
 * =============================================================================
 */
function ynm_calculate_profile_completion_v2($listing_id, $data) {
    $weights = array(
        'phone'             => 10,
        'website'           => 10,
        'primary_style'     => 10,
        'vibe_tags'         => 10,
        'drop_in_policy'    => 10,
        'intro_offer'       => 15,
        'best_for'          => 5,
        'why_students_love' => 5,
        'hours'             => 10,
        'established_year'  => 5,
        'instagram'         => 5,
        'photos'            => 10,
    );

    $total = array_sum($weights);
    $earned = 0;

    foreach ($weights as $field => $points) {
        if ($field === 'photos') {
            if (!empty($data['photos']) && count($data['photos']) > 0) {
                $earned += $points;
            }
        } elseif ($field === 'hours') {
            if (!empty($data['hours']) && count($data['hours']) > 0) {
                $earned += $points;
            }
        } elseif ($field === 'vibe_tags' || $field === 'best_for') {
            if (!empty($data[$field]) && (is_array($data[$field]) ? count($data[$field]) > 0 : strlen($data[$field]) > 0)) {
                $earned += $points;
            }
        } else {
            if (!empty($data[$field])) {
                $earned += $points;
            }
        }
    }

    return min(100, round(($earned / $total) * 100));
}

/**
 * =============================================================================
 * PROCESS PHOTO UPLOADS
 * =============================================================================
 */
function ynm_process_photo_uploads($listing_id, $photos) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    $attachment_ids = array();

    foreach ($photos as $index => $photo) {
        // Handle base64 encoded images
        if (isset($photo['data']) && strpos($photo['data'], 'data:image') === 0) {
            $attachment_id = ynm_upload_base64_image($photo['data'], $photo['name'] ?? "studio-photo-{$index}.jpg", $listing_id);
            if ($attachment_id && !is_wp_error($attachment_id)) {
                $attachment_ids[] = $attachment_id;

                // Set first image as featured
                if ($index === 0 && !has_post_thumbnail($listing_id)) {
                    set_post_thumbnail($listing_id, $attachment_id);
                }
            }
        }
    }

    // Save gallery images to GeoDirectory
    if (!empty($attachment_ids)) {
        $gallery = implode(',', $attachment_ids);
        geodir_save_post_meta($listing_id, 'post_images', $gallery);
    }

    return $attachment_ids;
}

/**
 * Upload base64 image to WordPress media library
 */
function ynm_upload_base64_image($base64_string, $filename, $parent_id = 0) {
    // Extract the base64 data
    $data = explode(',', $base64_string);
    if (count($data) !== 2) {
        return new WP_Error('invalid_image', 'Invalid image data');
    }

    $decoded = base64_decode($data[1]);
    if ($decoded === false) {
        return new WP_Error('decode_failed', 'Failed to decode image');
    }

    // Determine file extension from mime type
    preg_match('/data:image\/(\w+);/', $data[0], $matches);
    $ext = isset($matches[1]) ? $matches[1] : 'jpg';

    // Sanitize filename
    $filename = sanitize_file_name($filename);
    if (!pathinfo($filename, PATHINFO_EXTENSION)) {
        $filename .= '.' . $ext;
    }

    // Upload to WordPress
    $upload = wp_upload_bits($filename, null, $decoded);

    if ($upload['error']) {
        return new WP_Error('upload_failed', $upload['error']);
    }

    // Create attachment
    $file_type = wp_check_filetype($upload['file']);
    $attachment = array(
        'post_mime_type' => $file_type['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
        'post_parent'    => $parent_id
    );

    $attachment_id = wp_insert_attachment($attachment, $upload['file'], $parent_id);

    if (is_wp_error($attachment_id)) {
        return $attachment_id;
    }

    // Generate metadata
    $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    wp_update_attachment_metadata($attachment_id, $metadata);

    return $attachment_id;
}

/**
 * =============================================================================
 * EMAIL NOTIFICATIONS
 * =============================================================================
 */
function ynm_send_onboarding_emails($listing_id, $data) {
    $studio_name = sanitize_text_field($data['studio_name']);
    $studio_email = sanitize_email($data['email']);
    $listing_url = get_permalink($listing_id);

    // 1. Send confirmation to studio owner
    ynm_send_studio_confirmation_email($studio_email, $studio_name, $listing_url, $listing_id);

    // 2. Send notification to admin
    ynm_send_admin_notification_email($listing_id, $data);
}

/**
 * Send confirmation email to studio owner
 */
function ynm_send_studio_confirmation_email($email, $studio_name, $listing_url, $listing_id) {
    $subject = "You're listed on Yoga Near Me!";

    $message = "Hi there,\n\n";
    $message .= "Great news — {$studio_name} is now on Yoga Near Me.\n\n";
    $message .= "Your listing is currently under review and will be live within 24 hours.\n\n";
    $message .= "Once approved, students searching for yoga in your area will be able to find you.\n\n";
    $message .= "WHAT'S NEXT:\n";
    $message .= "• Add photos to get 2.3x more clicks\n";
    $message .= "• Make sure your intro offer is compelling\n";
    $message .= "• Share your listing on social media\n\n";
    $message .= "View your listing: {$listing_url}\n\n";
    $message .= "Questions? Just reply to this email.\n\n";
    $message .= "Welcome to the community,\n";
    $message .= "The Yoga Near Me Team\n\n";
    $message .= "---\n";
    $message .= "Yoga Near Me - Helping students find good teaching since 2020\n";
    $message .= "https://yoganearme.info";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Yoga Near Me <hello@yoganearme.info>',
        'Reply-To: hello@yoganearme.info'
    );

    wp_mail($email, $subject, $message, $headers);
}

/**
 * Send notification to admin about new submission
 */
function ynm_send_admin_notification_email($listing_id, $data) {
    $studio_name = sanitize_text_field($data['studio_name']);
    $email = sanitize_email($data['email']);
    $phone = !empty($data['phone']) ? sanitize_text_field($data['phone']) : 'Not provided';
    $listing_url = get_permalink($listing_id);
    $edit_url = admin_url("post.php?post={$listing_id}&action=edit");

    $subject = "New Studio Submission: {$studio_name}";

    $message = "A new studio has submitted their listing.\n\n";
    $message .= "STUDIO DETAILS:\n";
    $message .= "Name: {$studio_name}\n";
    $message .= "Email: {$email}\n";
    $message .= "Phone: {$phone}\n\n";
    $message .= "Location: " . ($data['city'] ?? '') . ", " . ($data['state'] ?? '') . "\n";
    $message .= "Primary Style: " . ($data['primary_style'] ?? 'Not specified') . "\n";
    $message .= "Intro Offer: " . ($data['intro_offer'] ?? 'None') . "\n\n";
    $message .= "ACTIONS:\n";
    $message .= "Review & Approve: {$edit_url}\n";
    $message .= "View Listing: {$listing_url}\n\n";

    // Calculate completion
    $completion = ynm_calculate_profile_completion_v2($listing_id, $data);
    $message .= "Profile Completion: {$completion}%\n";

    wp_mail(get_option('admin_email'), $subject, $message);
}

/**
 * =============================================================================
 * SHORTCODE: Embed onboarding form
 * =============================================================================
 * Usage: [ynm_onboarding_form]
 */
add_shortcode('ynm_onboarding_form', 'ynm_onboarding_form_shortcode');

function ynm_onboarding_form_shortcode($atts) {
    // Enqueue the form assets
    wp_enqueue_style('ynm-onboarding-form', get_stylesheet_directory_uri() . '/assets/css/studio-onboarding-form.css', array(), '1.0.0');
    wp_enqueue_script('ynm-onboarding-form', get_stylesheet_directory_uri() . '/assets/js/studio-onboarding-form.js', array(), '1.0.0', true);

    // Pass REST API URL to JavaScript
    wp_localize_script('ynm-onboarding-form', 'ynmOnboarding', array(
        'apiUrl' => rest_url('yoganearme/v1/studios'),
        'nonce'  => wp_create_nonce('wp_rest'),
        'homeUrl' => home_url(),
    ));

    // Include the form HTML
    ob_start();
    include get_stylesheet_directory() . '/templates/studio-onboarding-form.php';
    return ob_get_clean();
}

/**
 * =============================================================================
 * AJAX FALLBACK (for non-REST API usage)
 * =============================================================================
 */
add_action('wp_ajax_ynm_submit_onboarding', 'ynm_ajax_submit_onboarding');
add_action('wp_ajax_nopriv_ynm_submit_onboarding', 'ynm_ajax_submit_onboarding');

function ynm_ajax_submit_onboarding() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'ynm_onboarding_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed'));
    }

    // Parse the JSON data
    $data = json_decode(stripslashes($_POST['data'] ?? '{}'), true);

    if (empty($data)) {
        wp_send_json_error(array('message' => 'No data received'));
    }

    // Validate
    $validation = ynm_validate_submission($data);
    if (is_wp_error($validation)) {
        wp_send_json_error(array(
            'message' => $validation->get_error_message(),
            'errors'  => $validation->get_error_data()
        ));
    }

    // Check duplicates
    $duplicate = ynm_check_duplicate_listing($data);
    if ($duplicate) {
        wp_send_json_error(array(
            'message' => 'A listing with this name and address already exists.',
            'existing_id' => $duplicate
        ));
    }

    // Create listing
    $listing_id = ynm_create_geodirectory_listing($data);
    if (is_wp_error($listing_id)) {
        wp_send_json_error(array('message' => $listing_id->get_error_message()));
    }

    // Save fields
    ynm_save_onboarding_fields($listing_id, $data);

    // Handle photos
    if (!empty($data['photos'])) {
        ynm_process_photo_uploads($listing_id, $data['photos']);
    }

    // Send emails
    ynm_send_onboarding_emails($listing_id, $data);

    wp_send_json_success(array(
        'message'     => 'Your studio has been listed!',
        'listing_id'  => $listing_id,
        'listing_url' => get_permalink($listing_id)
    ));
}
