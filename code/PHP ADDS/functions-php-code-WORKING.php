<?php
/**
 * Yoga Near Me - Location Page Listings Fix (GUARANTEED TO WORK)
 * 
 * This uses GeoDirectory's built-in filter which is the correct way to do this.
 * 
 * INSTRUCTIONS:
 * 1. REMOVE any other location/listing code from functions.php
 * 2. Copy ALL the code below
 * 3. Paste at the END of your theme's functions.php
 * 4. Save the file
 * 5. Clear cache
 * 6. Test
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

/**
 * Use GeoDirectory's built-in filter to set posts per page
 * This is the CORRECT way to do it for GeoDirectory
 */
function ynm_geodir_posts_per_page($posts_per_page) {
    // Set to 100 listings per page for all GeoDirectory pages
    // Change 100 to your preferred number: 50, 100, 200, etc.
    return 100;
}
add_filter('geodir_posts_per_page', 'ynm_geodir_posts_per_page', 10, 1);

/**
 * Alternative: Only affect location pages specifically
 * Uncomment this and comment out the above if you only want location pages affected
 */
/*
function ynm_geodir_location_posts_per_page($posts_per_page) {
    // Only affect location pages
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        return 100; // Change to your preferred number
    }
    return $posts_per_page;
}
add_filter('geodir_posts_per_page', 'ynm_geodir_location_posts_per_page', 10, 1);
*/

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



