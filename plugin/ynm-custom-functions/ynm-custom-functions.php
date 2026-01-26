<?php
/**
 * Plugin Name: YogaNearMe Custom Functions
 * Plugin URI: https://yoganearme.info
 * Description: Custom functionality for YogaNearMe.info - Lead capture, GA4 tracking, GeoDirectory integration, and tier-based features.
 * Version: 1.0.0
 * Author: Eddie
 * Author URI: https://yoganearme.info
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ynm-custom
 *
 * ==========================================================================
 * INSTALLATION:
 * 1. Upload this folder to wp-content/plugins/
 * 2. Activate in WordPress Admin → Plugins
 * 3. Update configuration constants below as needed
 * ==========================================================================
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Plugin version
define('YNM_CUSTOM_VERSION', '1.0.0');

/**
 * ==========================================================================
 * CONFIGURATION - UPDATE THESE VALUES
 * ==========================================================================
 */

// GeoDirectory Package IDs (update after creating packages in GD → Pricing Manager)
if (!defined('YNM_COMMUNITY_PACKAGE_ID')) {
    define('YNM_COMMUNITY_PACKAGE_ID', 1);  // Free tier
}
if (!defined('YNM_VISIBILITY_PACKAGE_ID')) {
    define('YNM_VISIBILITY_PACKAGE_ID', 2); // $29/mo tier
}

// Ninja Forms IDs (update after creating forms)
if (!defined('YNM_ONBOARDING_FORM_ID')) {
    define('YNM_ONBOARDING_FORM_ID', 2);    // Studio onboarding wizard form ID
}


/**
 * ##########################################################################
 * SECTION 1: NINJA FORMS LEAD CAPTURE
 * Populates hidden fields with listing data for lead attribution
 * ##########################################################################
 */

/**
 * Inject JavaScript to populate Ninja Forms hidden fields
 */
function ynm_ninja_forms_populate_hidden_fields() {
    // Only run on single GeoDirectory listing pages
    if (!is_singular('gd_place')) {
        return;
    }

    global $post;

    // Get listing data
    $studio_name = get_the_title($post->ID);
    $studio_url  = get_permalink($post->ID);
    $listing_id  = $post->ID;

    // Get the intro offer from GeoDirectory custom fields
    $intro_offer_type  = '';
    $intro_offer_price = '';
    $intro_offer_terms = '';

    if (function_exists('geodir_get_post_meta')) {
        $intro_offer_type  = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
        $intro_offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
        $intro_offer_terms = geodir_get_post_meta($post->ID, 'intro_offer_terms', true);

        if (empty($intro_offer_type)) {
            $intro_offer_type = geodir_get_post_meta($post->ID, 'new_student_offer', true);
        }
    }

    // Build offer string
    $offer_parts = array_filter(array($intro_offer_type, $intro_offer_price));
    $offer = !empty($offer_parts) ? implode(' - ', $offer_parts) : 'Intro Offer';

    if ($offer === 'Intro Offer') {
        $all_meta = get_post_meta($post->ID);
        foreach ($all_meta as $key => $value) {
            if (stripos($key, 'offer') !== false && !empty($value[0])) {
                $offer = $value[0];
                break;
            }
        }
    }

    $js_data = array(
        'studio_name' => esc_js($studio_name),
        'studio_url'  => esc_url($studio_url),
        'listing_id'  => intval($listing_id),
        'offer'       => esc_js($offer),
        'offer_terms' => esc_js($intro_offer_terms),
    );
    ?>
    <script type="text/javascript">
    (function($) {
        'use strict';

        window.ynmListingData = <?php echo wp_json_encode($js_data); ?>;

        function populateNinjaFormFields() {
            var data = window.ynmListingData;
            if (!data) return;

            var fieldMap = {
                'studio_name': data.studio_name,
                'studio_url': data.studio_url,
                'listing_id': data.listing_id,
                'offer': data.offer
            };

            for (var fieldKey in fieldMap) {
                var value = fieldMap[fieldKey];
                if (!value) continue;

                var selectors = [
                    'input[data-key="' + fieldKey + '"]',
                    'input.nf-element[data-key="' + fieldKey + '"]',
                    '.nf-field-container[data-key="' + fieldKey + '"] input',
                    'input[name*="' + fieldKey + '"]',
                    'input[id*="' + fieldKey + '"]',
                    '.ninja-forms-field[data-key="' + fieldKey + '"]',
                    '#nf-field-' + fieldKey,
                    '[data-field-key="' + fieldKey + '"]'
                ];

                for (var i = 0; i < selectors.length; i++) {
                    var $fields = $(selectors[i]);
                    if ($fields.length > 0) {
                        $fields.each(function() {
                            $(this).val(value).trigger('change');
                        });
                        break;
                    }
                }
            }
        }

        function populateViaNinjaFormsModel() {
            if (typeof Marionette === 'undefined' || typeof nfRadio === 'undefined') {
                return false;
            }

            var data = window.ynmListingData;
            var fieldsChannel = nfRadio.channel('fields');
            var fieldCollection = fieldsChannel.request('get:collection');

            if (fieldCollection) {
                fieldCollection.each(function(fieldModel) {
                    var fieldKey = fieldModel.get('key');
                    if (fieldKey === 'studio_name' && data.studio_name) fieldModel.set('value', data.studio_name);
                    if (fieldKey === 'studio_url' && data.studio_url) fieldModel.set('value', data.studio_url);
                    if (fieldKey === 'listing_id' && data.listing_id) fieldModel.set('value', data.listing_id);
                    if (fieldKey === 'offer' && data.offer) fieldModel.set('value', data.offer);
                });
                return true;
            }
            return false;
        }

        $(document).ready(function() {
            setTimeout(populateNinjaFormFields, 500);
            setTimeout(populateNinjaFormFields, 1000);
            setTimeout(populateNinjaFormFields, 2000);
            setTimeout(populateViaNinjaFormsModel, 1000);
            setTimeout(populateViaNinjaFormsModel, 2000);
        });

        $(document).on('click', '.elementor-popup-trigger, [data-elementor-open-lightbox], .claim-offer-btn, .ynm-claim-btn, [class*="claim"], [class*="offer"]', function() {
            setTimeout(populateNinjaFormFields, 300);
            setTimeout(populateNinjaFormFields, 600);
            setTimeout(populateNinjaFormFields, 1000);
            setTimeout(populateViaNinjaFormsModel, 500);
            setTimeout(populateViaNinjaFormsModel, 1000);
        });

        $(document).on('nfFormReady', function(e, layoutView) {
            setTimeout(populateNinjaFormFields, 100);
            setTimeout(populateViaNinjaFormsModel, 100);
        });

        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    var hasForm = false;
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) {
                            if ($(node).find('.nf-form-cont, .ninja-forms-cont').length > 0 ||
                                $(node).hasClass('nf-form-cont')) {
                                hasForm = true;
                            }
                        }
                    });
                    if (hasForm) {
                        setTimeout(populateNinjaFormFields, 200);
                        setTimeout(populateViaNinjaFormsModel, 300);
                    }
                }
            });
        });

        observer.observe(document.body, { childList: true, subtree: true });

    })(jQuery);
    </script>
    <?php
}
add_action('wp_footer', 'ynm_ninja_forms_populate_hidden_fields', 99);


/**
 * Server-side default values for Ninja Forms hidden fields
 */
function ynm_ninja_forms_default_value($default_value, $field_type, $field_settings) {
    if (!is_singular('gd_place')) {
        return $default_value;
    }

    if ($field_type !== 'hidden') {
        return $default_value;
    }

    global $post;
    $field_key = isset($field_settings['key']) ? $field_settings['key'] : '';

    switch ($field_key) {
        case 'studio_name':
            return get_the_title($post->ID);
        case 'studio_url':
            return get_permalink($post->ID);
        case 'listing_id':
            return $post->ID;
        case 'offer':
            if (function_exists('geodir_get_post_meta')) {
                $offer_type = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
                $offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
                $parts = array_filter(array($offer_type, $offer_price));
                return !empty($parts) ? implode(' - ', $parts) : 'Intro Offer';
            }
            return 'Intro Offer';
    }

    return $default_value;
}
add_filter('ninja_forms_render_default_value', 'ynm_ninja_forms_default_value', 10, 3);


/**
 * ##########################################################################
 * SECTION 2: GA4 EVENT TRACKING
 * Provides page data and enqueues tracking script
 * ##########################################################################
 */

/**
 * Enqueue GA4 tracking script
 */
function ynm_enqueue_ga4_tracking() {
    // Check if JS file exists in theme
    $js_path = get_stylesheet_directory() . '/js/GA4-EVENT-TRACKING.js';

    if (file_exists($js_path)) {
        wp_enqueue_script(
            'ynm-ga4-tracking',
            get_stylesheet_directory_uri() . '/js/GA4-EVENT-TRACKING.js',
            array(),
            YNM_CUSTOM_VERSION,
            true
        );

        $page_data = ynm_get_page_tracking_data();
        wp_localize_script('ynm-ga4-tracking', 'ynmPageData', $page_data);
    }
}
add_action('wp_enqueue_scripts', 'ynm_enqueue_ga4_tracking');


/**
 * Get page-specific tracking data
 */
function ynm_get_page_tracking_data() {
    $data = array(
        'pageType' => 'other',
        'debug'    => defined('WP_DEBUG') && WP_DEBUG,
    );

    if (is_singular('gd_place')) {
        global $post;
        $data['pageType']          = 'single_listing';
        $data['listingId']         = $post->ID;
        $data['studioName']        = get_the_title($post->ID);
        $data['city']              = ynm_get_listing_city($post->ID);
        $data['hasOffer']          = ynm_listing_has_offer($post->ID) ? 'true' : 'false';
        $data['hasPhotos']         = has_post_thumbnail($post->ID) ? 'true' : 'false';
        $data['profileCompletion'] = ynm_get_profile_completion($post->ID);

        if (function_exists('geodir_get_post_meta')) {
            $data['introOffer'] = geodir_get_post_meta($post->ID, 'intro_offer', true);
        }
    }
    elseif (is_post_type_archive('gd_place') || ynm_is_search_page()) {
        global $wp_query;
        $data['pageType']       = 'search_results';
        $data['searchQuery']    = get_search_query();
        $data['resultCount']    = $wp_query->found_posts;
        $data['searchLocation'] = isset($_GET['sgeo_lat']) ? 'geo' : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '');
    }
    elseif (is_tax('gd_placecategory') || is_tax('gd_place_tags')) {
        $data['pageType'] = 'category_archive';
        $term = get_queried_object();
        if ($term) {
            $data['categoryName'] = $term->name;
            $data['categorySlug'] = $term->slug;
        }
    }

    return $data;
}


/**
 * Check if current page is GD search
 */
function ynm_is_search_page() {
    global $post;

    if ($post && has_shortcode($post->post_content, 'gd_search')) {
        return true;
    }
    if (isset($_GET['geodir_search']) || isset($_GET['sgeo_lat'])) {
        return true;
    }
    if ($post && $post->post_name === 'search-page') {
        return true;
    }

    return false;
}


/**
 * Get listing city
 */
function ynm_get_listing_city($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $city = geodir_get_post_meta($post_id, 'city', true);
        if ($city) return $city;
    }

    $locations = wp_get_post_terms($post_id, 'gd_place_location');
    if (!empty($locations) && !is_wp_error($locations)) {
        return $locations[0]->name;
    }

    return '';
}


/**
 * Check if listing has intro offer
 */
function ynm_listing_has_offer($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $offer = geodir_get_post_meta($post_id, 'intro_offer', true);
        return !empty($offer);
    }
    return false;
}


/**
 * Add data attributes to listing cards for tracking
 */
function ynm_add_tracking_attrs_to_cards($attrs, $post) {
    static $position = 0;
    $position++;

    $attrs .= ' data-listing-id="' . esc_attr($post->ID) . '"';
    $attrs .= ' data-studio-name="' . esc_attr(get_the_title($post->ID)) . '"';
    $attrs .= ' data-city="' . esc_attr(ynm_get_listing_city($post->ID)) . '"';
    $attrs .= ' data-has-offer="' . (ynm_listing_has_offer($post->ID) ? 'true' : 'false') . '"';
    $attrs .= ' data-position="' . $position . '"';

    return $attrs;
}
add_filter('geodir_listing_attrs', 'ynm_add_tracking_attrs_to_cards', 10, 2);


/**
 * ##########################################################################
 * SECTION 3: NINJA FORMS TO GEODIRECTORY CONNECTOR
 * Saves onboarding wizard data to GD listing fields
 * ##########################################################################
 */

/**
 * Save Ninja Forms submission to GeoDirectory
 */
function ynm_save_onboarding_to_geodirectory($form_data) {
    if ($form_data['form_id'] != YNM_ONBOARDING_FORM_ID) {
        return;
    }

    // Extract fields
    $fields = array();
    foreach ($form_data['fields'] as $field) {
        $key = isset($field['key']) ? $field['key'] : '';
        $value = isset($field['value']) ? $field['value'] : '';
        if ($key) {
            $fields[$key] = $value;
        }
    }

    $listing_id = isset($fields['listing_id']) ? intval($fields['listing_id']) : 0;

    if (!$listing_id) {
        error_log('YNM Onboarding: No listing_id provided');
        return;
    }

    $post = get_post($listing_id);
    if (!$post || $post->post_type !== 'gd_place') {
        error_log('YNM Onboarding: Invalid listing_id: ' . $listing_id);
        return;
    }

    // Field mapping: Ninja Forms Key => GeoDirectory Field Key
    $field_mapping = array(
        'studio_name'           => 'post_title',
        'phone'                 => 'phone',
        'email'                 => 'email',
        'website'               => 'website',
        'vibe_tags'             => 'vibe_tags',
        'best_for'              => 'best_for',
        'primary_style'         => 'primary_style',
        'languages'             => 'languages',
        'dropin_policy'         => 'dropin_policy',
        'class_size'            => 'class_size',
        'new_student_info'      => 'new_student_info',
        'parking_transit'       => 'parking_transit',
        'intro_offer'           => 'intro_offer',
        'intro_offer_subtitle'  => 'intro_offer_subtitle',
        'why_students_love'     => 'why_students_love',
        'signature_offering'    => 'signature_offering',
        'booking_platform'      => 'booking_platform',
        'booking_url'           => 'booking_url',
        'schedule_url'          => 'schedule_url',
        'offers_virtual'        => 'offers_virtual',
        'virtual_platform'      => 'virtual_platform',
        'virtual_class_url'     => 'virtual_class_url',
        'offers_retreats'       => 'offers_retreats',
        'established_year'      => 'established_year',
        'yoga_alliance'         => 'yoga_alliance',
        'instagram'             => 'instagram',
        'facebook'              => 'facebook',
        'tiktok'                => 'tiktok',
        'google_reviews_url'    => 'google_reviews_url',
        'student_sources'       => 'student_sources',
    );

    foreach ($field_mapping as $form_key => $gd_key) {
        if (!isset($fields[$form_key]) || $fields[$form_key] === '') {
            continue;
        }

        $value = $fields[$form_key];

        if ($gd_key === 'post_title') {
            wp_update_post(array(
                'ID'         => $listing_id,
                'post_title' => sanitize_text_field($value),
            ));
            continue;
        }

        if (is_array($value)) {
            $value = array_map('sanitize_text_field', $value);
            $value = implode(',', $value);
        } else {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $value = esc_url_raw($value);
            } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $value = sanitize_email($value);
            } else {
                $value = sanitize_text_field($value);
            }
        }

        if (function_exists('geodir_save_post_meta')) {
            geodir_save_post_meta($listing_id, $gd_key, $value);
        }
    }

    // Mark as enriched
    if (function_exists('geodir_save_post_meta')) {
        geodir_save_post_meta($listing_id, 'onboarding_complete', '1');
        geodir_save_post_meta($listing_id, 'onboarding_date', current_time('mysql'));

        $completion = ynm_calculate_profile_completion($listing_id);
        geodir_save_post_meta($listing_id, 'profile_completion', $completion);
    }

    // Retreat notification
    if (!empty($fields['offers_retreats']) && $fields['offers_retreats'] === '1') {
        ynm_notify_retreat_interest($listing_id, $fields);
    }
}
add_action('ninja_forms_after_submission', 'ynm_save_onboarding_to_geodirectory');


/**
 * Calculate profile completion percentage
 */
function ynm_calculate_profile_completion($listing_id) {
    if (!function_exists('geodir_get_post_meta')) {
        return 0;
    }

    $completion_fields = array(
        'phone'             => 2,
        'website'           => 2,
        'vibe_tags'         => 2,
        'dropin_policy'     => 2,
        'intro_offer'       => 2,
        'best_for'          => 1.5,
        'booking_url'       => 1.5,
        'why_students_love' => 1.5,
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

    if (has_post_thumbnail($listing_id)) {
        $earned_points += 2;
        $total_points += 2;
    } else {
        $total_points += 2;
    }

    $percentage = round(($earned_points / $total_points) * 100);

    return min(100, $percentage);
}


/**
 * Get profile completion (with fallback calculation)
 */
function ynm_get_profile_completion($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $completion = geodir_get_post_meta($post_id, 'profile_completion', true);
        if ($completion) return intval($completion);
    }

    return ynm_calculate_profile_completion($post_id);
}


/**
 * Notify admin of retreat interest
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
 * Profile completion shortcode
 * Usage: [ynm_profile_completion]
 */
function ynm_profile_completion_shortcode($atts) {
    if (!is_singular('gd_place')) {
        return '';
    }

    global $post;
    $completion = ynm_get_profile_completion($post->ID);

    $color = '#5F7470';
    if ($completion >= 90) {
        $color = '#22c55e';
    } elseif ($completion >= 70) {
        $color = '#61948B';
    } elseif ($completion < 50) {
        $color = '#bd371a';
    }

    ob_start();
    ?>
    <div class="ynm-profile-completion" style="margin: 16px 0;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
            <span style="font-size: 14px; color: #6B7C78;">Profile Completion</span>
            <span style="font-size: 14px; font-weight: 600; color: <?php echo esc_attr($color); ?>;"><?php echo esc_html($completion); ?>%</span>
        </div>
        <div style="height: 8px; background: #E5E7EB; border-radius: 4px; overflow: hidden;">
            <div style="height: 100%; width: <?php echo esc_attr($completion); ?>%; background: <?php echo esc_attr($color); ?>; border-radius: 4px; transition: width 0.3s ease;"></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_profile_completion', 'ynm_profile_completion_shortcode');


/**
 * Admin column for profile completion
 */
function ynm_add_completion_column($columns) {
    $columns['profile_completion'] = 'Profile %';
    return $columns;
}
add_filter('manage_gd_place_posts_columns', 'ynm_add_completion_column');

function ynm_completion_column_content($column, $post_id) {
    if ($column === 'profile_completion') {
        $completion = ynm_get_profile_completion($post_id);
        $color = $completion >= 70 ? '#22c55e' : ($completion >= 50 ? '#f59e0b' : '#ef4444');
        echo '<span style="color: ' . esc_attr($color) . '; font-weight: 600;">' . esc_html($completion) . '%</span>';
    }
}
add_action('manage_gd_place_posts_custom_column', 'ynm_completion_column_content', 10, 2);


/**
 * ##########################################################################
 * SECTION 4: VIDEO SECTION (VISIBILITY TIER FEATURE)
 * Conditional video display based on package tier
 * ##########################################################################
 */

/**
 * Render video section based on tier
 */
function ynm_render_video_section($post_id = null) {
    if (!function_exists('geodir_get_post_meta')) {
        return '';
    }

    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }

    $package_id = geodir_get_post_meta($post_id, 'package_id', true);
    $video_url = geodir_get_post_meta($post_id, 'video_url', true);
    $studio_name = get_the_title($post_id);

    $is_visibility = ($package_id == YNM_VISIBILITY_PACKAGE_ID);
    $is_owner = is_user_logged_in() && (get_current_user_id() == get_post_field('post_author', $post_id));

    // Visibility tier with video
    if ($is_visibility && !empty($video_url)) {
        return ynm_video_embed_html($video_url, $studio_name, $post_id);
    }

    // Visibility tier without video (owner prompt)
    if ($is_visibility && empty($video_url) && $is_owner) {
        return ynm_video_add_prompt_html();
    }

    // Community tier owner (upgrade prompt)
    if (!$is_visibility && $is_owner) {
        return ynm_video_upgrade_prompt_html();
    }

    return '';
}


/**
 * Video embed HTML
 */
function ynm_video_embed_html($video_url, $studio_name, $post_id) {
    $embed_url = ynm_get_embed_url($video_url);
    $provider = ynm_detect_video_provider($video_url);
    $thumbnail_url = ynm_get_video_thumbnail($video_url);

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Studio Video">
        <div class="ynm-video-section__header">
            <div class="ynm-video-section__icon">🎥</div>
            <div>
                <h3 class="ynm-video-section__title">Take a Virtual Tour</h3>
                <p class="ynm-video-section__subtitle">See what <?php echo esc_html($studio_name); ?> is all about</p>
            </div>
            <span class="ynm-visibility-badge">Featured Studio</span>
        </div>

        <div class="ynm-video-embed" data-provider="<?php echo esc_attr($provider); ?>">
            <?php if ($thumbnail_url && $embed_url): ?>
                <div class="ynm-video-thumbnail"
                     style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"
                     data-embed-url="<?php echo esc_url($embed_url); ?>"
                     onclick="ynmLoadVideo(this)"
                     role="button"
                     tabindex="0"
                     aria-label="Play video tour of <?php echo esc_attr($studio_name); ?>">
                    <div class="ynm-video-play-btn" aria-hidden="true"></div>
                </div>
            <?php elseif ($embed_url): ?>
                <iframe
                    src="<?php echo esc_url($embed_url); ?>"
                    title="Video tour of <?php echo esc_attr($studio_name); ?>"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            <?php endif; ?>
        </div>
    </section>

    <script>
    function ynmLoadVideo(thumbnail) {
        const embedUrl = thumbnail.dataset.embedUrl + '?autoplay=1';
        const container = thumbnail.parentElement;
        const iframe = document.createElement('iframe');
        iframe.src = embedUrl;
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
        iframe.setAttribute('allowfullscreen', '');
        iframe.setAttribute('title', 'Studio video');
        container.innerHTML = '';
        container.appendChild(iframe);

        if (typeof gtag !== 'undefined') {
            gtag('event', 'video_play', {
                'event_category': 'engagement',
                'event_label': '<?php echo esc_js($studio_name); ?>',
                'listing_id': <?php echo intval($post_id); ?>
            });
        }
    }
    </script>
    <?php
    return ob_get_clean();
}


/**
 * Add video prompt for Visibility tier owners
 */
function ynm_video_add_prompt_html() {
    $edit_url = function_exists('geodir_edit_post_link') ? geodir_edit_post_link(get_the_ID()) : '#';

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Add Video">
        <div class="ynm-upgrade-prompt">
            <div class="ynm-upgrade-prompt__icon">🎬</div>
            <h3 class="ynm-upgrade-prompt__title">Add Your Studio Video</h3>
            <p class="ynm-upgrade-prompt__text">
                As a Visibility member, you can showcase a YouTube or Vimeo video on your listing.
                Give students a virtual tour of your space!
            </p>
            <a href="<?php echo esc_url($edit_url); ?>" class="ynm-upgrade-prompt__btn">
                Edit Listing
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


/**
 * Upgrade prompt for Community tier owners
 */
function ynm_video_upgrade_prompt_html() {
    $upgrade_url = home_url('/upgrade/');

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Upgrade Prompt">
        <div class="ynm-upgrade-prompt">
            <div class="ynm-upgrade-prompt__icon">🎥</div>
            <h3 class="ynm-upgrade-prompt__title">Want to Add a Video?</h3>
            <p class="ynm-upgrade-prompt__text">
                Visibility members can embed a YouTube or Vimeo video to give students
                a virtual tour of their studio space.
            </p>
            <a href="<?php echo esc_url($upgrade_url); ?>" class="ynm-upgrade-prompt__btn">
                Upgrade to Visibility
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


/**
 * Convert video URL to embed URL
 */
function ynm_get_embed_url($url) {
    // YouTube
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return $url;
    }

    // Vimeo
    if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
        return 'https://player.vimeo.com/video/' . $matches[1];
    }
    if (preg_match('/player\.vimeo\.com\/video\/([0-9]+)/', $url, $matches)) {
        return $url;
    }

    return '';
}


/**
 * Detect video provider
 */
function ynm_detect_video_provider($url) {
    if (strpos($url, 'youtube') !== false || strpos($url, 'youtu.be') !== false) {
        return 'youtube';
    }
    if (strpos($url, 'vimeo') !== false) {
        return 'vimeo';
    }
    return 'unknown';
}


/**
 * Get video thumbnail URL
 */
function ynm_get_video_thumbnail($url) {
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches) ||
        preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches) ||
        preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
    }

    return '';
}


/**
 * Video section shortcode
 * Usage: [ynm_video_section]
 */
function ynm_video_section_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => null
    ), $atts);

    return ynm_render_video_section($atts['id']);
}
add_shortcode('ynm_video_section', 'ynm_video_section_shortcode');


/**
 * Auto-insert video section (uncomment to enable)
 * Adjust priority (45) to control placement
 */
// add_action('geodir_details_main_content', 'ynm_auto_insert_video_section', 45);
function ynm_auto_insert_video_section() {
    if (is_singular('gd_place')) {
        echo ynm_render_video_section();
    }
}


/**
 * ##########################################################################
 * SECTION 5: DEBUG TOOLS (Only active when WP_DEBUG is true)
 * ##########################################################################
 */

/**
 * Debug listing data shortcode
 * Usage: [ynm_debug_listing_data]
 */
function ynm_debug_listing_data_shortcode() {
    if (!is_singular('gd_place') || !current_user_can('manage_options')) {
        return '';
    }

    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        return '';
    }

    global $post;

    $data = array(
        'Studio Name' => get_the_title($post->ID),
        'Studio URL'  => get_permalink($post->ID),
        'Listing ID'  => $post->ID,
    );

    if (function_exists('geodir_get_post_meta')) {
        $data['Package ID'] = geodir_get_post_meta($post->ID, 'package_id', true) ?: '(not set)';
        $data['Intro Offer'] = geodir_get_post_meta($post->ID, 'intro_offer', true) ?: '(not set)';
        $data['Video URL'] = geodir_get_post_meta($post->ID, 'video_url', true) ?: '(not set)';
        $data['Profile Completion'] = ynm_get_profile_completion($post->ID) . '%';
    }

    $output = '<div style="background:#f5f5f5; padding:15px; margin:15px 0; border-left:4px solid #5F7470; font-family:monospace;">';
    $output .= '<strong>YNM Debug - Listing Data:</strong><br><br>';
    foreach ($data as $key => $value) {
        $output .= esc_html($key) . ': <code>' . esc_html($value) . '</code><br>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode('ynm_debug_listing_data', 'ynm_debug_listing_data_shortcode');
