<?php
/**
 * Lead Capture Form Integration for YogaNearMe.info
 *
 * Fixes the issue where hidden fields (studio_name, studio_url, offer)
 * are not being populated in form submissions.
 *
 * SETUP INSTRUCTIONS:
 * 1. Add this code to your child theme's functions.php
 * 2. In Fluent Forms, add these hidden fields to your "Lead Capture - Intro Offer" form:
 *    - studio_name (Hidden Field)
 *    - studio_url (Hidden Field)
 *    - offer (Hidden Field)
 *    - listing_id (Hidden Field)
 * 3. Set each hidden field's "Default Value" to: "Dynamic Value" → "GET Parameter"
 *    - studio_name → GET param: studio_name
 *    - studio_url → GET param: studio_url
 *    - offer → GET param: offer
 *    - listing_id → GET param: listing_id
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
 * METHOD 1: JAVASCRIPT - Populate form fields from page data
 * =============================================================================
 * This injects the listing data into the form via JavaScript when the modal opens.
 * Works with Fluent Forms, WPForms, Ninja Forms, etc.
 */
function ynm_populate_lead_form_script() {
    // Only run on single GeoDirectory listing pages
    if (!is_singular('gd_place')) {
        return;
    }

    global $post;

    // Get listing data
    $studio_name = get_the_title($post->ID);
    $studio_url = get_permalink($post->ID);
    $listing_id = $post->ID;

    // Get the intro offer from custom fields
    $intro_offer_type = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
    $intro_offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
    $intro_offer_terms = geodir_get_post_meta($post->ID, 'intro_offer_terms', true);

    // Build offer string
    $offer_parts = array();
    if (!empty($intro_offer_type)) {
        $offer_parts[] = $intro_offer_type;
    }
    if (!empty($intro_offer_price)) {
        $offer_parts[] = $intro_offer_price;
    }
    $offer = !empty($offer_parts) ? implode(' - ', $offer_parts) : 'Intro Offer';

    // Escape for JavaScript
    $js_data = array(
        'studio_name' => esc_js($studio_name),
        'studio_url'  => esc_js($studio_url),
        'listing_id'  => intval($listing_id),
        'offer'       => esc_js($offer),
        'offer_terms' => esc_js($intro_offer_terms),
    );
    ?>
    <script type="text/javascript">
    (function() {
        // Store listing data globally for form population
        window.ynmListingData = <?php echo json_encode($js_data); ?>;

        /**
         * Populate form fields with listing data
         * Supports multiple form plugins by targeting common field patterns
         */
        function populateLeadFormFields() {
            var data = window.ynmListingData;
            if (!data) return;

            // Common field selectors for various form plugins
            var fieldMappings = {
                'studio_name': [
                    'input[name="studio_name"]',
                    'input[name*="studio_name"]',
                    'input[data-name="studio_name"]',
                    '#studio_name',
                    '.ff-el-input[name*="studio_name"]'
                ],
                'studio_url': [
                    'input[name="studio_url"]',
                    'input[name*="studio_url"]',
                    'input[data-name="studio_url"]',
                    '#studio_url',
                    '.ff-el-input[name*="studio_url"]'
                ],
                'listing_id': [
                    'input[name="listing_id"]',
                    'input[name*="listing_id"]',
                    'input[data-name="listing_id"]',
                    '#listing_id',
                    '.ff-el-input[name*="listing_id"]'
                ],
                'offer': [
                    'input[name="offer"]',
                    'input[name*="offer"]',
                    'input[data-name="offer"]',
                    '#offer',
                    '.ff-el-input[name*="offer"]'
                ]
            };

            // Try to set each field
            for (var fieldName in fieldMappings) {
                var value = data[fieldName];
                if (!value) continue;

                var selectors = fieldMappings[fieldName];
                for (var i = 0; i < selectors.length; i++) {
                    var elements = document.querySelectorAll(selectors[i]);
                    elements.forEach(function(el) {
                        if (el && el.tagName === 'INPUT') {
                            el.value = value;
                            // Trigger change event for reactive forms
                            el.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                }
            }

            console.log('YNM Lead Form: Fields populated', data);
        }

        // Run on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initial population
            setTimeout(populateLeadFormFields, 500);

            // Re-populate when modal opens (for Elementor popups, etc.)
            document.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-elementor-open-lightbox], .elementor-popup-trigger, .claim-offer-btn, .ynm-claim-btn');
                if (trigger) {
                    // Wait for modal to render
                    setTimeout(populateLeadFormFields, 300);
                    setTimeout(populateLeadFormFields, 600);
                    setTimeout(populateLeadFormFields, 1000);
                }
            });

            // Watch for dynamically added forms
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length) {
                        setTimeout(populateLeadFormFields, 100);
                    }
                });
            });

            observer.observe(document.body, { childList: true, subtree: true });
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'ynm_populate_lead_form_script', 99);


/**
 * =============================================================================
 * METHOD 2: FLUENT FORMS SPECIFIC - Server-side population
 * =============================================================================
 * Hooks into Fluent Forms to pre-populate hidden fields before render
 */
function ynm_fluentform_prefill_hidden_fields($form) {
    if (!is_singular('gd_place')) {
        return $form;
    }

    global $post;

    // This filter modifies the form's default values
    add_filter('fluentform/rendering_field_data_hidden', function($data, $form_data) use ($post) {
        $field_name = isset($data['attributes']['name']) ? $data['attributes']['name'] : '';

        switch ($field_name) {
            case 'studio_name':
                $data['attributes']['value'] = get_the_title($post->ID);
                break;
            case 'studio_url':
                $data['attributes']['value'] = get_permalink($post->ID);
                break;
            case 'listing_id':
                $data['attributes']['value'] = $post->ID;
                break;
            case 'offer':
                $offer_type = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
                $offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
                $offer = $offer_type . (!empty($offer_price) ? ' - ' . $offer_price : '');
                $data['attributes']['value'] = $offer ?: 'Intro Offer';
                break;
        }

        return $data;
    }, 10, 2);

    return $form;
}
add_filter('fluentform/rendering_form', 'ynm_fluentform_prefill_hidden_fields', 10, 1);


/**
 * =============================================================================
 * ALTERNATIVE: Shortcode for claim button that passes URL parameters
 * =============================================================================
 * Use this shortcode if the above methods don't work with your popup setup.
 * The button opens the form page/popup with URL parameters.
 */
function ynm_claim_offer_button_with_params($atts) {
    if (!is_singular('gd_place')) {
        return '';
    }

    global $post;

    $atts = shortcode_atts(array(
        'text'       => 'Claim This Offer',
        'class'      => 'ynm-claim-offer-btn',
        'popup_id'   => '', // Elementor popup ID
        'form_page'  => '', // Alternative: link to form page
    ), $atts);

    // Gather listing data
    $studio_name = get_the_title($post->ID);
    $studio_url = get_permalink($post->ID);
    $listing_id = $post->ID;

    $offer_type = geodir_get_post_meta($post->ID, 'intro_offer_type', true);
    $offer_price = geodir_get_post_meta($post->ID, 'intro_offer_price', true);
    $offer = $offer_type . (!empty($offer_price) ? ' - ' . $offer_price : '');

    // Build URL parameters
    $params = array(
        'studio_name' => urlencode($studio_name),
        'studio_url'  => urlencode($studio_url),
        'listing_id'  => $listing_id,
        'offer'       => urlencode($offer ?: 'Intro Offer'),
    );

    // If using Elementor popup
    if (!empty($atts['popup_id'])) {
        $param_string = http_build_query($params);
        return sprintf(
            '<button class="%s" data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="%s" onclick="window.ynmListingData = %s;">%s</button>',
            esc_attr($atts['class']),
            esc_attr($atts['popup_id']),
            json_encode(array(
                'studio_name' => $studio_name,
                'studio_url'  => $studio_url,
                'listing_id'  => $listing_id,
                'offer'       => $offer ?: 'Intro Offer',
            )),
            esc_html($atts['text'])
        );
    }

    // If linking to a separate form page
    if (!empty($atts['form_page'])) {
        $url = add_query_arg($params, $atts['form_page']);
        return sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url($url),
            esc_attr($atts['class']),
            esc_html($atts['text'])
        );
    }

    // Default: just set the data for JS to use
    return sprintf(
        '<button class="%s ynm-trigger-claim-modal" data-listing-id="%d" data-studio-name="%s" data-studio-url="%s" data-offer="%s">%s</button>',
        esc_attr($atts['class']),
        $listing_id,
        esc_attr($studio_name),
        esc_attr($studio_url),
        esc_attr($offer ?: 'Intro Offer'),
        esc_html($atts['text'])
    );
}
add_shortcode('ynm_claim_offer_button', 'ynm_claim_offer_button_with_params');


/**
 * =============================================================================
 * DEBUG: Log form submissions to verify data is passing
 * =============================================================================
 * Remove in production after confirming the fix works
 */
function ynm_debug_fluentform_submission($insertId, $formData, $form) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('YNM Lead Form Submission Debug:');
        error_log('Form ID: ' . $form->id);
        error_log('Data: ' . print_r($formData, true));
    }
}
add_action('fluentform/submission_inserted', 'ynm_debug_fluentform_submission', 10, 3);


/**
 * =============================================================================
 * ADMIN NOTICE: Setup instructions
 * =============================================================================
 */
function ynm_lead_form_admin_notice() {
    $screen = get_current_screen();
    if ($screen && strpos($screen->id, 'fluent') !== false) {
        ?>
        <div class="notice notice-info">
            <p><strong>YogaNearMe Lead Form Setup:</strong> Make sure your form has hidden fields named exactly: <code>studio_name</code>, <code>studio_url</code>, <code>offer</code>, <code>listing_id</code>. Set their default values to "Dynamic Value" → "GET Parameter" with matching parameter names.</p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'ynm_lead_form_admin_notice');
