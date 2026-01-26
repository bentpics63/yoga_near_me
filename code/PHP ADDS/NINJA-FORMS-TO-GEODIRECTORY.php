<?php
/**
 * Ninja Forms to GeoDirectory Connector
 *
 * Saves studio onboarding wizard submissions directly to GeoDirectory listing fields.
 *
 * REQUIREMENTS:
 * 1. GeoDirectory plugin active
 * 2. Ninja Forms plugin active
 * 3. Custom fields created in GD (see GEODIRECTORY-FIELD-SETUP-GUIDE.md)
 * 4. Ninja Forms fields with matching keys
 *
 * INSTALLATION:
 * Add to child theme functions.php:
 * require_once get_stylesheet_directory() . '/includes/NINJA-FORMS-TO-GEODIRECTORY.php';
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
 * MAIN CONNECTOR: Save Ninja Forms submission to GeoDirectory
 * =============================================================================
 */
add_action('ninja_forms_after_submission', 'ynm_save_onboarding_to_geodirectory');

function ynm_save_onboarding_to_geodirectory($form_data) {

    // Get form ID - only process our onboarding form
    // UPDATE THIS with your actual form ID
    $onboarding_form_id = 2; // Change to your form ID

    if ($form_data['form_id'] != $onboarding_form_id) {
        return;
    }

    // Extract fields into associative array
    $fields = array();
    foreach ($form_data['fields'] as $field) {
        $key = isset($field['key']) ? $field['key'] : '';
        $value = isset($field['value']) ? $field['value'] : '';
        if ($key) {
            $fields[$key] = $value;
        }
    }

    // Get listing ID (required - should be hidden field in form)
    $listing_id = isset($fields['listing_id']) ? intval($fields['listing_id']) : 0;

    if (!$listing_id) {
        error_log('YNM Onboarding: No listing_id provided');
        return;
    }

    // Verify listing exists and is gd_place
    $post = get_post($listing_id);
    if (!$post || $post->post_type !== 'gd_place') {
        error_log('YNM Onboarding: Invalid listing_id: ' . $listing_id);
        return;
    }

    // =============================================================================
    // FIELD MAPPING: Ninja Forms Key => GeoDirectory Field Key
    // =============================================================================

    $field_mapping = array(
        // Section 1: Basics (these may update existing GD fields)
        'studio_name'           => 'post_title', // Special handling below
        'phone'                 => 'phone',
        'email'                 => 'email',
        'website'               => 'website',

        // Section 2: Vibe & Identity
        'vibe_tags'             => 'vibe_tags',
        'best_for'              => 'best_for',
        'primary_style'         => 'primary_style',
        'languages'             => 'languages',

        // Section 3: Practical Info
        'dropin_policy'         => 'dropin_policy',
        'class_size'            => 'class_size',
        'new_student_info'      => 'new_student_info',
        'parking_transit'       => 'parking_transit',

        // Section 4: Intro Offer
        'intro_offer'           => 'intro_offer',
        'intro_offer_subtitle'  => 'intro_offer_subtitle',
        'why_students_love'     => 'why_students_love',
        'signature_offering'    => 'signature_offering',

        // Section 5: Booking & Schedule
        'booking_platform'      => 'booking_platform',
        'booking_url'           => 'booking_url',
        'schedule_url'          => 'schedule_url',

        // Section 6: Virtual & Retreats
        'offers_virtual'        => 'offers_virtual',
        'virtual_platform'      => 'virtual_platform',
        'virtual_class_url'     => 'virtual_class_url',
        'offers_retreats'       => 'offers_retreats',

        // Section 7: Studio Details
        'established_year'      => 'established_year',
        'yoga_alliance'         => 'yoga_alliance',
        'instagram'             => 'instagram',
        'facebook'              => 'facebook',
        'tiktok'                => 'tiktok',
        'google_reviews_url'    => 'google_reviews_url',
        'student_sources'       => 'student_sources',
    );

    // =============================================================================
    // SAVE FIELDS TO GEODIRECTORY
    // =============================================================================

    foreach ($field_mapping as $form_key => $gd_key) {
        if (!isset($fields[$form_key]) || $fields[$form_key] === '') {
            continue; // Skip empty fields
        }

        $value = $fields[$form_key];

        // Handle post_title specially (update post, not meta)
        if ($gd_key === 'post_title') {
            wp_update_post(array(
                'ID'         => $listing_id,
                'post_title' => sanitize_text_field($value),
            ));
            continue;
        }

        // Handle arrays (multiselect fields)
        if (is_array($value)) {
            $value = array_map('sanitize_text_field', $value);
            $value = implode(',', $value); // GD stores multiselect as comma-separated
        } else {
            // Sanitize based on field type
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $value = esc_url_raw($value);
            } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $value = sanitize_email($value);
            } else {
                $value = sanitize_text_field($value);
            }
        }

        // Save to GeoDirectory
        geodir_save_post_meta($listing_id, $gd_key, $value);
    }

    // =============================================================================
    // SPECIAL HANDLING
    // =============================================================================

    // Mark listing as "enriched" (studio completed onboarding)
    geodir_save_post_meta($listing_id, 'onboarding_complete', '1');
    geodir_save_post_meta($listing_id, 'onboarding_date', current_time('mysql'));

    // Calculate profile completion percentage
    $completion = ynm_calculate_profile_completion($listing_id);
    geodir_save_post_meta($listing_id, 'profile_completion', $completion);

    // If retreats offered, trigger notification for manual follow-up
    if (!empty($fields['offers_retreats']) && $fields['offers_retreats'] === '1') {
        ynm_notify_retreat_interest($listing_id, $fields);
    }

    // Log success
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('YNM Onboarding: Successfully saved data for listing ' . $listing_id);
    }
}


/**
 * =============================================================================
 * HELPER: Calculate profile completion percentage
 * =============================================================================
 */
function ynm_calculate_profile_completion($listing_id) {

    // Define which fields count toward completion
    $completion_fields = array(
        // Required weight: 2 points each
        'phone'             => 2,
        'website'           => 2,
        'vibe_tags'         => 2,
        'dropin_policy'     => 2,
        'intro_offer'       => 2,

        // Important weight: 1.5 points each
        'best_for'          => 1.5,
        'booking_url'       => 1.5,
        'why_students_love' => 1.5,

        // Nice to have: 1 point each
        'primary_style'         => 1,
        'class_size'            => 1,
        'new_student_info'      => 1,
        'parking_transit'       => 1,
        'intro_offer_subtitle'  => 1,
        'established_year'      => 1,
        'instagram'             => 1,
        'schedule_url'          => 1,
    );

    $total_points = array_sum($completion_fields);
    $earned_points = 0;

    foreach ($completion_fields as $field => $points) {
        $value = geodir_get_post_meta($listing_id, $field, true);
        if (!empty($value)) {
            $earned_points += $points;
        }
    }

    // Check for featured image (important)
    if (has_post_thumbnail($listing_id)) {
        $earned_points += 2;
        $total_points += 2;
    } else {
        $total_points += 2; // Still count toward total
    }

    $percentage = round(($earned_points / $total_points) * 100);

    return min(100, $percentage); // Cap at 100%
}


/**
 * =============================================================================
 * HELPER: Notify admin when studio indicates retreat interest
 * =============================================================================
 */
function ynm_notify_retreat_interest($listing_id, $fields) {

    $studio_name = get_the_title($listing_id);
    $studio_url = get_permalink($listing_id);
    $edit_url = admin_url('post.php?post=' . $listing_id . '&action=edit');

    $subject = 'Retreat Lead: ' . $studio_name;

    $message = "A studio has indicated they offer retreats.\n\n";
    $message .= "Studio: {$studio_name}\n";
    $message .= "Listing: {$studio_url}\n";
    $message .= "Edit: {$edit_url}\n\n";
    $message .= "Contact: " . (isset($fields['email']) ? $fields['email'] : 'See listing') . "\n";
    $message .= "Phone: " . (isset($fields['phone']) ? $fields['phone'] : 'See listing') . "\n\n";
    $message .= "Follow up to discuss retreat promotion for lead gen fee.";

    wp_mail(get_option('admin_email'), $subject, $message);
}


/**
 * =============================================================================
 * SHORTCODE: Display profile completion on frontend
 * =============================================================================
 * Usage: [ynm_profile_completion]
 */
add_shortcode('ynm_profile_completion', 'ynm_profile_completion_shortcode');

function ynm_profile_completion_shortcode($atts) {
    if (!is_singular('gd_place')) {
        return '';
    }

    global $post;
    $completion = geodir_get_post_meta($post->ID, 'profile_completion', true);

    if (!$completion) {
        $completion = ynm_calculate_profile_completion($post->ID);
    }

    $color = '#5F7470'; // Sage
    if ($completion >= 90) {
        $color = '#22c55e'; // Green
    } elseif ($completion >= 70) {
        $color = '#61948B'; // Teal
    } elseif ($completion < 50) {
        $color = '#bd371a'; // Rust
    }

    ob_start();
    ?>
    <div class="ynm-profile-completion" style="margin: 16px 0;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
            <span style="font-size: 14px; color: #6B7C78;">Profile Completion</span>
            <span style="font-size: 14px; font-weight: 600; color: <?php echo $color; ?>;"><?php echo $completion; ?>%</span>
        </div>
        <div style="height: 8px; background: #E5E7EB; border-radius: 4px; overflow: hidden;">
            <div style="height: 100%; width: <?php echo $completion; ?>%; background: <?php echo $color; ?>; border-radius: 4px; transition: width 0.3s ease;"></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


/**
 * =============================================================================
 * AJAX: Update profile completion when fields change
 * =============================================================================
 */
add_action('wp_ajax_ynm_recalc_completion', 'ynm_ajax_recalculate_completion');

function ynm_ajax_recalculate_completion() {
    $listing_id = isset($_POST['listing_id']) ? intval($_POST['listing_id']) : 0;

    if (!$listing_id) {
        wp_send_json_error('No listing ID');
    }

    $completion = ynm_calculate_profile_completion($listing_id);
    geodir_save_post_meta($listing_id, 'profile_completion', $completion);

    wp_send_json_success(array('completion' => $completion));
}


/**
 * =============================================================================
 * ADMIN: Show completion in listings table
 * =============================================================================
 */
add_filter('manage_gd_place_posts_columns', 'ynm_add_completion_column');
add_action('manage_gd_place_posts_custom_column', 'ynm_completion_column_content', 10, 2);

function ynm_add_completion_column($columns) {
    $columns['profile_completion'] = 'Profile %';
    return $columns;
}

function ynm_completion_column_content($column, $post_id) {
    if ($column === 'profile_completion') {
        $completion = geodir_get_post_meta($post_id, 'profile_completion', true);
        if (!$completion) {
            $completion = ynm_calculate_profile_completion($post_id);
        }

        $color = $completion >= 70 ? '#22c55e' : ($completion >= 50 ? '#f59e0b' : '#ef4444');
        echo '<span style="color: ' . $color . '; font-weight: 600;">' . $completion . '%</span>';
    }
}
