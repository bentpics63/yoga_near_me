<?php
/**
 * Yoga Near Me - Location Page Listings Fix (AGGRESSIVE VERSION)
 * 
 * Use this if the regular version doesn't work.
 * This version is more aggressive and will definitely increase listings.
 * 
 * INSTRUCTIONS:
 * 1. Copy the code below (everything between the comment lines)
 * 2. Paste it at the END of your theme's functions.php file
 * 3. Save the file
 * 4. Clear any caching plugins
 * 5. Test by visiting a location page
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

/**
 * Show more listings on GeoDirectory location pages (Aggressive Version)
 * This version checks multiple conditions to ensure it works
 */
function ynm_increase_location_listings_aggressive($query) {
    // Skip admin and non-main queries
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // Check if we're on a location page (multiple ways to check)
    $is_location_page = false;
    
    // Method 1: GeoDirectory function
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        $is_location_page = true;
    }
    
    // Method 2: Check URL pattern
    if (!$is_location_page && isset($_SERVER['REQUEST_URI'])) {
        if (strpos($_SERVER['REQUEST_URI'], '/location/') !== false) {
            $is_location_page = true;
        }
    }
    
    // Method 3: Check query vars
    if (!$is_location_page && isset($query->query_vars['post_type'])) {
        if ($query->query_vars['post_type'] == 'gd_place' && 
            (isset($query->query_vars['gd_location']) || isset($query->query_vars['location']))) {
            $is_location_page = true;
        }
    }
    
    // If we're on a location page, increase listings
    if ($is_location_page) {
        // Set to 100 listings per page
        // Change this number if needed: 50, 100, 200, or -1 for all
        $query->set('posts_per_page', 100);
        
        // Also try setting nopaging to false to ensure pagination works
        $query->set('nopaging', false);
    }
}
// Use higher priority to override other plugins
add_action('pre_get_posts', 'ynm_increase_location_listings_aggressive', 99);

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



