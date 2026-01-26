<?php
/**
 * Yoga Near Me - Location Page Listings Fix (DIRECT VERSION)
 * 
 * This version uses multiple methods to ensure it works.
 * Try this if nothing else works.
 * 
 * INSTRUCTIONS:
 * 1. REMOVE any other location page code from functions.php first
 * 2. Copy ALL the code below
 * 3. Paste at the END of your theme's functions.php
 * 4. Save and clear cache
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

/**
 * Method 1: Direct query modification with multiple checks
 */
function ynm_location_listings_method1($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // Check multiple ways if we're on a location page
    $is_location = false;
    
    // Check 1: GeoDirectory function
    if (function_exists('geodir_is_page')) {
        if (geodir_is_page('location')) {
            $is_location = true;
        }
    }
    
    // Check 2: URL contains /location/
    if (!$is_location && isset($_SERVER['REQUEST_URI'])) {
        if (strpos($_SERVER['REQUEST_URI'], '/location/') !== false) {
            $is_location = true;
        }
    }
    
    // Check 3: Query vars
    if (!$is_location && isset($query->query_vars)) {
        if (isset($query->query_vars['gd_location']) || 
            isset($query->query_vars['location']) ||
            (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'gd_place' && 
             (is_tax() || is_archive()))) {
            $is_location = true;
        }
    }
    
    if ($is_location) {
        $query->set('posts_per_page', 100);
    }
}
add_action('pre_get_posts', 'ynm_location_listings_method1', 99);

/**
 * Method 2: Use GeoDirectory specific filter if it exists
 */
function ynm_location_listings_method2($posts_per_page) {
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        return 100;
    }
    return $posts_per_page;
}
// Try GeoDirectory specific filters
add_filter('geodir_posts_per_page', 'ynm_location_listings_method2', 10, 1);
add_filter('geodir_location_posts_per_page', 'ynm_location_listings_method2', 10, 1);

/**
 * Method 3: Override after query is set (last resort)
 */
function ynm_location_listings_method3($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // Force check on location pages
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/location/') !== false) {
        $query->set('posts_per_page', 100);
        $query->set('nopaging', false);
    }
}
add_action('pre_get_posts', 'ynm_location_listings_method3', 999);

/**
 * Method 4: Direct WordPress reading settings override for location pages
 */
function ynm_location_listings_method4() {
    if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/location/') !== false) {
        add_filter('option_posts_per_page', function($value) {
            return 100;
        }, 999);
    }
}
add_action('template_redirect', 'ynm_location_listings_method4', 1);

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



