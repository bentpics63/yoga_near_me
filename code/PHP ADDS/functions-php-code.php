<?php
/**
 * Yoga Near Me - Location Page Listings Fix
 * 
 * This code increases the number of listings shown on GeoDirectory location pages.
 * Both the map and list will show more studios.
 * 
 * INSTRUCTIONS:
 * 1. Copy the code below (everything between the comment lines)
 * 2. Paste it at the END of your theme's functions.php file
 * 3. Save the file
 * 4. Clear any caching plugins
 * 5. Test by visiting a location page
 * 
 * WHAT THIS DOES:
 * - Increases listings from 10 to 100 per page
 * - Both map and list show 100 studios
 * - Pagination still works if there are more than 100
 * 
 * TO ADJUST THE NUMBER:
 * Change '100' in the code to your preferred number:
 * - 50 = Good for most cities
 * - 100 = Recommended for large cities (shows most studios)
 * - 200 = For very large cities (may be slower)
 * - -1 = Show ALL listings (may be slow for 200+ studios)
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

/**
 * Use GeoDirectory's built-in filter (THIS IS THE CORRECT WAY)
 * 
 * GeoDirectory has a specific filter for this - use it instead of pre_get_posts
 */
function ynm_geodir_posts_per_page($posts_per_page) {
    // Set to 100 listings per page for all GeoDirectory pages
    // Change 100 to your preferred number: 50, 100, 200, etc.
    return 100;
}
add_filter('geodir_posts_per_page', 'ynm_geodir_posts_per_page', 10, 1);

/**
 * Backup method: Also modify the query directly (in case filter doesn't work)
 */
function ynm_increase_location_page_listings($query) {
    // Only affect front-end queries, not admin
    if (is_admin()) {
        return;
    }
    
    // Only affect the main query
    if (!$query->is_main_query()) {
        return;
    }
    
    // Check if we're on a GeoDirectory location page
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        // Set to show 100 listings per page
        // This affects both the map and the list view
        $query->set('posts_per_page', 100);
    }
}
add_action('pre_get_posts', 'ynm_increase_location_page_listings', 20);

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



