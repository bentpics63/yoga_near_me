<?php
/**
 * Yoga Near Me - Studio Schema Markup
 * 
 * Adds YogaStudio structured data to all single studio pages
 * This enables rich snippets in Google search results
 * 
 * WHAT THIS DOES:
 * - Adds our custom YogaStudio schema with correct GeoDirectory data ✅
 * - Safety net: Removes any LocalBusiness schema Rank Math might still generate ❌
 * - Keeps Rank Math's ImageObject schema (from your custom template) ✅
 * - Keeps Rank Math's BreadcrumbList schema ✅
 * 
 * NOTE: You've disabled Local SEO/Schema in Rank Math settings (perfect!).
 * The filter below is just a safety net in case Rank Math still tries to output LocalBusiness.
 * 
 * INSTRUCTIONS:
 * 1. Copy everything below the comment line
 * 2. Paste at the END of your theme's functions.php file
 * 3. Save the file
 * 4. Clear all caches (LiteSpeed Cache, WordPress, browser)
 * 5. Test by visiting a studio page and viewing page source (search for "ld+json")
 * 6. Validate at: https://search.google.com/test/rich-results
 * 
 * EXPECTED RESULT:
 * You should see 3 schema blocks:
 * 1. BreadcrumbList (from Rank Math) ✅
 * 2. ImageObject (from Rank Math custom template) ✅
 * 3. YogaStudio (from this code) ✅
 * 
 * No LocalBusiness schema should appear ❌
 */

// ============================================
// COPY EVERYTHING BELOW THIS LINE
// ============================================

/**
 * Safety Net: Remove Any LocalBusiness Schema Rank Math Might Generate
 * 
 * NOTE: You've disabled Local SEO/Schema in Rank Math settings, so this filter
 * may not be necessary, but we keep it as a safety net.
 * 
 * If Rank Math still tries to output LocalBusiness schema, this will remove it.
 * We keep ImageObject and BreadcrumbList schemas from Rank Math.
 */
function ynm_disable_rankmath_localbusiness_schema($schemas) {
    // Only on single GeoDirectory listing pages
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        // Remove LocalBusiness schema from Rank Math's output
        if (isset($schemas['LocalBusiness'])) {
            unset($schemas['LocalBusiness']);
        }
        
        // Also check in @graph array (Rank Math uses this format)
        if (isset($schemas['@graph']) && is_array($schemas['@graph'])) {
            foreach ($schemas['@graph'] as $key => $schema_item) {
                // Remove LocalBusiness, but keep ImageObject and BreadcrumbList
                if (isset($schema_item['@type']) && $schema_item['@type'] === 'LocalBusiness') {
                    unset($schemas['@graph'][$key]);
                }
            }
            // Re-index array after removal
            $schemas['@graph'] = array_values($schemas['@graph']);
        }
    }
    return $schemas;
}
add_filter('rank_math/schema/validated_data', 'ynm_disable_rankmath_localbusiness_schema', 20, 1);

/**
 * Note: You've Already Disabled Local SEO/Schema in Rank Math ✅
 * 
 * Since you've disabled Local SEO/Schema in Rank Math settings, Rank Math
 * should no longer auto-generate LocalBusiness schema. This is the preferred
 * method - cleaner than using code filters.
 * 
 * Rank Math will still output:
 * - Your custom ImageObject template ✅
 * - BreadcrumbList schema ✅
 * 
 * And our custom YogaStudio schema handles all business data ✅
 */

/**
 * Alternative Code: Remove Rank Math schema output entirely for GeoDirectory posts
 * Uncomment this ONLY if the above filter doesn't work AND you want to remove ALL Rank Math schema
 * (This will also remove ImageObject and BreadcrumbList, so use with caution)
 */
/*
function ynm_remove_rankmath_schema_for_geodir($schema) {
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        // Return empty to prevent Rank Math from outputting schema
        return array();
    }
    return $schema;
}
add_filter('rank_math/json_ld', 'ynm_remove_rankmath_schema_for_geodir', 20, 1);
*/

/**
 * Add LocalBusiness/YogaStudio Schema to Single Studio Pages
 */
function ynm_add_studio_schema() {
    // Only on single GeoDirectory listing pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    // Get GeoDirectory post data
    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    $studio_url = get_permalink($post_id);
    
    // Get description - use post excerpt or description field, fallback to auto-generated
    $studio_description = get_the_excerpt($post_id);
    if (empty($studio_description)) {
        $studio_description = geodir_get_post_meta($post_id, 'post_desc', true);
    }
    // Clean up description - remove any wrong studio names that might be in there
    if (!empty($studio_description)) {
        // Remove common wrong patterns (like "CorePower Yoga - La Jolla" when it should be current studio)
        $studio_description = trim($studio_description);
        // If description doesn't contain the studio name, it might be wrong - use fallback
        if (stripos($studio_description, $studio_name) === false && strlen($studio_description) > 200) {
            $studio_description = ''; // Reset if it seems wrong
        }
    }
    
    // Get address data
    $address = geodir_get_post_meta($post_id, 'street', true);
    $city = geodir_get_post_meta($post_id, 'city', true);
    $region = geodir_get_post_meta($post_id, 'region', true);
    $zip = geodir_get_post_meta($post_id, 'zip', true);
    $country = geodir_get_post_meta($post_id, 'country', true);
    
    // Get coordinates
    $latitude = geodir_get_post_meta($post_id, 'latitude', true);
    $longitude = geodir_get_post_meta($post_id, 'longitude', true);
    
    // Get contact info
    $phone = geodir_get_post_meta($post_id, 'phone', true);
    $website = geodir_get_post_meta($post_id, 'website', true);
    $email = geodir_get_post_meta($post_id, 'email', true);
    
    // Get rating
    $rating = geodir_get_post_rating($post_id);
    $review_count = geodir_get_review_count($post_id);
    
    // Get categories/styles
    $categories = wp_get_post_terms($post_id, 'gd_placecategory', array('fields' => 'names'));
    
    // Build schema array
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'YogaStudio', // More specific than LocalBusiness
        'name' => $studio_name,
        'url' => $studio_url,
        'description' => $studio_description ?: $studio_name . ' - Yoga studio in ' . $city,
    );
    
    // Add address if available
    if ($address || $city) {
        $schema['address'] = array(
            '@type' => 'PostalAddress',
            'streetAddress' => $address ?: '',
            'addressLocality' => $city ?: '',
            'addressRegion' => $region ?: '',
            'postalCode' => $zip ?: '',
            'addressCountry' => $country ?: ''
        );
    }
    
    // Add coordinates if available
    if ($latitude && $longitude) {
        $schema['geo'] = array(
            '@type' => 'GeoCoordinates',
            'latitude' => $latitude,
            'longitude' => $longitude
        );
    }
    
    // Add contact info
    if ($phone) {
        $schema['telephone'] = $phone;
    }
    
    if ($email) {
        $schema['email'] = $email;
    }
    
    // Add website (prefer website field over permalink)
    if ($website) {
        $schema['url'] = $website;
        $schema['sameAs'] = array($website);
    } else {
        $schema['url'] = $studio_url;
    }
    
    // Add rating if available
    if ($rating && $review_count > 0) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $rating,
            'reviewCount' => $review_count
        );
    }
    
    // Add categories as keywords
    if (!empty($categories)) {
        $schema['keywords'] = implode(', ', $categories);
    }
    
    // Add image if available
    $image = get_the_post_thumbnail_url($post_id, 'large');
    if ($image) {
        // Use ImageObject for better schema
        $schema['image'] = array(
            '@type' => 'ImageObject',
            'url' => $image,
            'contentUrl' => $image
        );
    }
    
    // Add opening hours if available (GeoDirectory stores this in business_hours field)
    // Note: Opening hours format varies - uncomment and adjust if needed
    /*
    $business_hours = geodir_get_post_meta($post_id, 'business_hours', true);
    if (!empty($business_hours)) {
        // Format opening hours based on your GeoDirectory setup
        // Example: $schema['openingHours'] = array('Mo-Fr 09:00-17:00');
    }
    */
    
    // Output schema as JSON-LD
    // Use priority 1 to output before Rank Math (which uses default priority 10)
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'ynm_add_studio_schema', 1);

// ============================================
// COPY EVERYTHING ABOVE THIS LINE
// ============================================



