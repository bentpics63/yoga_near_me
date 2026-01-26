<?php
/**
 * DEBUG CODE - Use this to see what's happening
 * 
 * This will log information to help us figure out why it's not working.
 * Check your WordPress debug log after visiting a location page.
 * 
 * To enable debug logging, add this to wp-config.php:
 * define('WP_DEBUG', true);
 * define('WP_DEBUG_LOG', true);
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

function ynm_debug_location_page($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // Log current URL
    if (isset($_SERVER['REQUEST_URI'])) {
        error_log('YNM DEBUG: Current URL: ' . $_SERVER['REQUEST_URI']);
    }
    
    // Check if GeoDirectory function exists
    if (function_exists('geodir_is_page')) {
        error_log('YNM DEBUG: geodir_is_page function exists');
        
        if (geodir_is_page('location')) {
            error_log('YNM DEBUG: geodir_is_page("location") returned TRUE');
        } else {
            error_log('YNM DEBUG: geodir_is_page("location") returned FALSE');
        }
    } else {
        error_log('YNM DEBUG: geodir_is_page function does NOT exist');
    }
    
    // Check query vars
    error_log('YNM DEBUG: Query vars: ' . print_r($query->query_vars, true));
    error_log('YNM DEBUG: Current posts_per_page: ' . $query->get('posts_per_page'));
    
    // Check if URL contains /location/
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/location/') !== false) {
        error_log('YNM DEBUG: URL contains /location/ - Setting posts_per_page to 100');
        $query->set('posts_per_page', 100);
        error_log('YNM DEBUG: New posts_per_page: ' . $query->get('posts_per_page'));
    }
}
add_action('pre_get_posts', 'ynm_debug_location_page', 99);

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



