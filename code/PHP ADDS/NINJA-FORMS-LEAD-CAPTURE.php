<?php
/**
 * Ninja Forms Lead Capture Integration for YogaNearMe.info
 *
 * This code populates hidden fields in your Ninja Forms "Lead Capture - Intro Offer"
 * form with the current listing's data (studio name, URL, offer details).
 *
 * THE PROBLEM:
 * Your form submits but the email shows {field:studio_name} empty because
 * the hidden fields aren't receiving values from the listing page.
 *
 * THE FIX:
 * This code injects JavaScript that populates the hidden fields when the
 * form loads or when the modal opens.
 *
 * =============================================================================
 * SETUP INSTRUCTIONS FOR NINJA FORMS:
 * =============================================================================
 *
 * STEP 1: Open your "Lead Capture - Intro Offer" form in Ninja Forms
 *
 * STEP 2: Add these HIDDEN fields (if not already present):
 *         - Field Type: Hidden
 *         - Field Keys (IMPORTANT - use exactly these):
 *           • studio_name
 *           • studio_url
 *           • listing_id
 *           • offer
 *
 * STEP 3: For each hidden field, configure like this:
 *         - Label: Studio Name (or Studio URL, etc.)
 *         - Field Key: studio_name (must match exactly)
 *         - Default Value: Leave EMPTY (the JavaScript will fill it)
 *
 * STEP 4: In your Email Action, use these merge tags:
 *         {field:studio_name}
 *         {field:studio_url}
 *         {field:offer}
 *         {field:listing_id}
 *
 * STEP 5: Add this file to your child theme's functions.php:
 *         require_once get_stylesheet_directory() . '/includes/NINJA-FORMS-LEAD-CAPTURE.php';
 *         OR copy the code directly into functions.php
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
 * MAIN FUNCTION: Inject JavaScript to populate Ninja Forms hidden fields
 * =============================================================================
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
    // Try multiple possible field names since they might vary
    $intro_offer_type  = '';
    $intro_offer_price = '';
    $intro_offer_terms = '';

    // Check if geodir_get_post_meta function exists (GeoDirectory is active)
    if (function_exists('geodir_get_post_meta')) {
        $intro_offer_type  = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
        $intro_offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
        $intro_offer_terms = geodir_get_post_meta($post->ID, 'intro_offer_terms', true);

        // Also try alternative field names
        if (empty($intro_offer_type)) {
            $intro_offer_type = geodir_get_post_meta($post->ID, 'new_student_offer', true);
        }
    }

    // Build offer string from available data
    $offer_parts = array_filter(array($intro_offer_type, $intro_offer_price));
    $offer = !empty($offer_parts) ? implode(' - ', $offer_parts) : 'Intro Offer';

    // If we still don't have an offer, try to get it from post content or excerpt
    if ($offer === 'Intro Offer') {
        // Check post meta for any offer-related fields
        $all_meta = get_post_meta($post->ID);
        foreach ($all_meta as $key => $value) {
            if (stripos($key, 'offer') !== false && !empty($value[0])) {
                $offer = $value[0];
                break;
            }
        }
    }

    // Prepare data for JavaScript (escape properly)
    $js_data = array(
        'studio_name' => esc_js($studio_name),
        'studio_url'  => esc_url($studio_url),
        'listing_id'  => intval($listing_id),
        'offer'       => esc_js($offer),
        'offer_terms' => esc_js($intro_offer_terms),
    );
    ?>
    <script type="text/javascript">
    /**
     * YogaNearMe - Ninja Forms Hidden Field Population
     * Automatically fills hidden fields with listing data
     */
    (function($) {
        'use strict';

        // Store listing data globally
        window.ynmListingData = <?php echo wp_json_encode($js_data); ?>;

        /**
         * Populate Ninja Forms hidden fields
         * Ninja Forms uses specific field structure we need to target
         */
        function populateNinjaFormFields() {
            var data = window.ynmListingData;
            if (!data) {
                console.log('YNM: No listing data available');
                return;
            }

            console.log('YNM: Populating form with data:', data);

            // Field key to value mapping
            var fieldMap = {
                'studio_name': data.studio_name,
                'studio_url': data.studio_url,
                'listing_id': data.listing_id,
                'offer': data.offer
            };

            // Method 1: Target Ninja Forms fields by key attribute
            // Ninja Forms typically uses: name="nf-field-XX" or data-key="fieldkey"
            for (var fieldKey in fieldMap) {
                var value = fieldMap[fieldKey];
                if (!value) continue;

                // Multiple selector strategies for Ninja Forms
                var selectors = [
                    // Ninja Forms 3.x hidden field selectors
                    'input[data-key="' + fieldKey + '"]',
                    'input.nf-element[data-key="' + fieldKey + '"]',
                    '.nf-field-container[data-key="' + fieldKey + '"] input',
                    // By name containing the key
                    'input[name*="' + fieldKey + '"]',
                    // By ID containing the key
                    'input[id*="' + fieldKey + '"]',
                    // Generic hidden field selectors
                    '.ninja-forms-field[data-key="' + fieldKey + '"]',
                    '#nf-field-' + fieldKey,
                    // Fallback: any input with matching key in various attributes
                    '[data-field-key="' + fieldKey + '"]'
                ];

                var found = false;
                for (var i = 0; i < selectors.length; i++) {
                    var $fields = $(selectors[i]);
                    if ($fields.length > 0) {
                        $fields.each(function() {
                            $(this).val(value).trigger('change');
                            console.log('YNM: Set ' + fieldKey + ' = ' + value + ' (selector: ' + selectors[i] + ')');
                        });
                        found = true;
                        break;
                    }
                }

                if (!found) {
                    console.log('YNM: Could not find field for key: ' + fieldKey);
                }
            }
        }

        /**
         * Method 2: Hook into Ninja Forms model system
         * This is the more reliable method for Ninja Forms 3.x
         */
        function populateViaNinjaFormsModel() {
            if (typeof Marionette === 'undefined' || typeof nfRadio === 'undefined') {
                console.log('YNM: Ninja Forms Marionette not loaded yet');
                return false;
            }

            var data = window.ynmListingData;

            // Listen for form render and populate fields
            var fieldsChannel = nfRadio.channel('fields');

            // Get all fields and update hidden ones
            var fieldCollection = fieldsChannel.request('get:collection');
            if (fieldCollection) {
                fieldCollection.each(function(fieldModel) {
                    var fieldKey = fieldModel.get('key');

                    if (fieldKey === 'studio_name' && data.studio_name) {
                        fieldModel.set('value', data.studio_name);
                        console.log('YNM Model: Set studio_name');
                    }
                    if (fieldKey === 'studio_url' && data.studio_url) {
                        fieldModel.set('value', data.studio_url);
                        console.log('YNM Model: Set studio_url');
                    }
                    if (fieldKey === 'listing_id' && data.listing_id) {
                        fieldModel.set('value', data.listing_id);
                        console.log('YNM Model: Set listing_id');
                    }
                    if (fieldKey === 'offer' && data.offer) {
                        fieldModel.set('value', data.offer);
                        console.log('YNM Model: Set offer');
                    }
                });
                return true;
            }
            return false;
        }

        // Initialize when DOM is ready
        $(document).ready(function() {
            console.log('YNM: Lead form integration initialized');

            // Try DOM method first
            setTimeout(populateNinjaFormFields, 500);
            setTimeout(populateNinjaFormFields, 1000);
            setTimeout(populateNinjaFormFields, 2000);

            // Try model method after Ninja Forms loads
            setTimeout(populateViaNinjaFormsModel, 1000);
            setTimeout(populateViaNinjaFormsModel, 2000);
        });

        // Re-populate when modal/popup opens
        $(document).on('click', '.elementor-popup-trigger, [data-elementor-open-lightbox], .claim-offer-btn, .ynm-claim-btn, [class*="claim"], [class*="offer"]', function() {
            console.log('YNM: Claim button clicked, will populate form');
            setTimeout(populateNinjaFormFields, 300);
            setTimeout(populateNinjaFormFields, 600);
            setTimeout(populateNinjaFormFields, 1000);
            setTimeout(populateViaNinjaFormsModel, 500);
            setTimeout(populateViaNinjaFormsModel, 1000);
        });

        // Watch for Ninja Forms to initialize (for AJAX-loaded forms)
        $(document).on('nfFormReady', function(e, layoutView) {
            console.log('YNM: Ninja Form ready event fired');
            setTimeout(populateNinjaFormFields, 100);
            setTimeout(populateViaNinjaFormsModel, 100);
        });

        // Mutation observer for dynamically added forms
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
                        console.log('YNM: New form detected in DOM');
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
 * =============================================================================
 * ALTERNATIVE: Server-side default values via Ninja Forms filter
 * =============================================================================
 * This sets default values before the form renders
 */
function ynm_ninja_forms_default_value($default_value, $field_type, $field_settings) {
    // Only modify on GeoDirectory listing pages
    if (!is_singular('gd_place')) {
        return $default_value;
    }

    // Only modify hidden fields
    if ($field_type !== 'hidden') {
        return $default_value;
    }

    global $post;

    // Get field key from settings
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
 * =============================================================================
 * DEBUG: Verify form submission data (remove after testing)
 * =============================================================================
 */
function ynm_ninja_forms_debug_submission($form_data) {
    if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
        error_log('=== YNM Ninja Forms Submission Debug ===');
        error_log('Form Data: ' . print_r($form_data, true));

        // Log specific fields we care about
        if (isset($form_data['fields'])) {
            foreach ($form_data['fields'] as $field) {
                if (isset($field['key']) && in_array($field['key'], array('studio_name', 'studio_url', 'offer', 'listing_id'))) {
                    error_log('Field ' . $field['key'] . ' = ' . (isset($field['value']) ? $field['value'] : 'EMPTY'));
                }
            }
        }
    }
    return $form_data;
}
add_filter('ninja_forms_submit_data', 'ynm_ninja_forms_debug_submission', 10, 1);


/**
 * =============================================================================
 * HELPER: Shortcode to display current listing data (for debugging)
 * =============================================================================
 * Usage: [ynm_debug_listing_data]
 */
function ynm_debug_listing_data_shortcode() {
    if (!is_singular('gd_place') || !current_user_can('manage_options')) {
        return '';
    }

    global $post;

    $data = array(
        'Studio Name' => get_the_title($post->ID),
        'Studio URL'  => get_permalink($post->ID),
        'Listing ID'  => $post->ID,
    );

    if (function_exists('geodir_get_post_meta')) {
        $data['Intro Offer Type'] = geodir_get_post_meta($post->ID, 'intro_offer_type', true) ?: '(not set)';
        $data['Intro Offer Price'] = geodir_get_post_meta($post->ID, 'intro_offer_price', true) ?: '(not set)';
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
