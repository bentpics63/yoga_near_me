<?php
/**
 * YogaNearMe - Fix "No Records Found" False Empty State
 *
 * PURPOSE: Prevents the search results page from showing "No Records Found"
 * when results actually exist. This is a common GeoDirectory issue where:
 * - AJAX loads cause a flash of "no results" before content appears
 * - Multiple widgets show conflicting states
 * - Empty state text appears alongside actual results
 *
 * INSTALLATION:
 * 1. Add the PHP filters to your child theme's functions.php
 * 2. Add the CSS to your Elementor Custom CSS or child theme
 * 3. Add the JavaScript to your site's custom JS
 *
 * @package YogaNearMe
 * @since 1.0.0
 */

// ============================================
// OPTION 1: PHP FILTER - Modify GeoDirectory Output
// Add to functions.php
// ============================================

/**
 * Filter GeoDirectory "no listings found" message
 * Makes it smarter - only shows when truly no results
 */
function ynm_filter_no_listings_message($message, $post_type) {
    // Only modify for our places post type
    if ($post_type !== 'gd_place') {
        return $message;
    }

    // Return a wrapper div that JavaScript can control
    return '<div class="ynm-no-results-message" style="display:none;" data-check-results="true">' .
           '<div class="ynm-no-results-inner">' .
           '<svg class="ynm-no-results-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48" height="48">' .
           '<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>' .
           '</svg>' .
           '<h3>No studios found</h3>' .
           '<p>Try adjusting your search or exploring a different area.</p>' .
           '</div></div>';
}
add_filter('geodir_loop_no_listings_found_message', 'ynm_filter_no_listings_message', 10, 2);


/**
 * Alternative: Completely remove the no results message
 * Use this if you prefer to handle empty states entirely in Elementor
 */
function ynm_remove_no_listings_message($message, $post_type) {
    if ($post_type === 'gd_place') {
        return ''; // Return empty to hide completely
    }
    return $message;
}
// Uncomment to use this instead:
// add_filter('geodir_loop_no_listings_found_message', 'ynm_remove_no_listings_message', 10, 2);


/**
 * Add body class when on search page with results
 * Helps CSS target the correct state
 */
function ynm_add_search_body_class($classes) {
    if (function_exists('geodir_is_page') && geodir_is_page('search')) {
        $classes[] = 'ynm-search-page';

        // Check if we have results
        global $wp_query;
        if (isset($wp_query->found_posts) && $wp_query->found_posts > 0) {
            $classes[] = 'ynm-has-results';
        } else {
            $classes[] = 'ynm-no-results';
        }
    }
    return $classes;
}
add_filter('body_class', 'ynm_add_search_body_class');


/**
 * Enqueue the fix script on search pages
 */
function ynm_enqueue_search_fix_scripts() {
    if (function_exists('geodir_is_page') && geodir_is_page('search')) {
        wp_add_inline_script('jquery', ynm_get_search_fix_js());
    }
}
add_action('wp_enqueue_scripts', 'ynm_enqueue_search_fix_scripts', 100);


/**
 * Get the JavaScript for fixing no results flash
 */
function ynm_get_search_fix_js() {
    return "
    (function($) {
        'use strict';

        function checkAndFixNoResults() {
            // Count actual listing cards
            var listingCards = $('.geodir-loop-container .geodir-category-list-view, ' +
                               '.geodir-loop-container .geodir-gridview, ' +
                               '.geodir-loop-container article, ' +
                               '.gd-loop-container .gd-post-item, ' +
                               '[class*=\"geodir\"] .gd-article').length;

            // Find no results messages
            var noResultsMessages = $('.geodir-loop-no-found, ' +
                                     '.geodir-no-results, ' +
                                     '.ynm-no-results-message, ' +
                                     '[class*=\"no-listings\"], ' +
                                     '[class*=\"no-records\"], ' +
                                     '[class*=\"no-results\"]');

            if (listingCards > 0) {
                // We have results - hide any no results messages
                noResultsMessages.hide();
                $('body').removeClass('ynm-no-results').addClass('ynm-has-results');
            } else {
                // No results - show the message
                noResultsMessages.show();
                $('body').removeClass('ynm-has-results').addClass('ynm-no-results');
            }
        }

        // Run on page load
        $(document).ready(function() {
            // Initial check
            checkAndFixNoResults();

            // Check again after AJAX completes (GeoDirectory uses AJAX for search)
            $(document).ajaxComplete(function() {
                setTimeout(checkAndFixNoResults, 100);
            });

            // Also observe DOM changes for dynamic loading
            if (typeof MutationObserver !== 'undefined') {
                var observer = new MutationObserver(function(mutations) {
                    checkAndFixNoResults();
                });

                var targetNode = document.querySelector('.geodir-loop-container, .gd-loop-container, .elementor-widget-geodirectory');
                if (targetNode) {
                    observer.observe(targetNode, { childList: true, subtree: true });
                }
            }
        });
    })(jQuery);
    ";
}


// ============================================
// SHORTCODE: Custom No Results Message
// Use [ynm_no_results_message] in Elementor
// ============================================

/**
 * Custom no results message shortcode
 * Only displays when there are actually no results
 */
function ynm_no_results_message_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'No studios found in this area',
        'message' => 'Try expanding your search radius or searching for a different location.',
        'show_search' => 'true',
    ), $atts);

    // Check if we're on a search page with no results
    if (!function_exists('geodir_is_page') || !geodir_is_page('search')) {
        return '';
    }

    global $wp_query;
    if (isset($wp_query->found_posts) && $wp_query->found_posts > 0) {
        return ''; // Don't show if we have results
    }

    ob_start();
    ?>
    <div class="ynm-empty-state ynm-no-results-custom">
        <div class="ynm-empty-state-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="64" height="64">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
        </div>
        <h3 class="ynm-empty-state-title"><?php echo esc_html($atts['title']); ?></h3>
        <p class="ynm-empty-state-text"><?php echo esc_html($atts['message']); ?></p>
        <?php if ($atts['show_search'] === 'true'): ?>
        <div class="ynm-empty-state-actions">
            <a href="<?php echo home_url('/'); ?>" class="ynm-btn ynm-btn-primary">Search Again</a>
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_no_results_message', 'ynm_no_results_message_shortcode');
