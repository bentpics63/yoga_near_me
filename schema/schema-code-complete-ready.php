<?php
/**
 * Yoga Near Me - Studio Schema Markup (COMPLETE CODE)
 * 
 * Copy this ENTIRE code block into your theme's functions.php file
 * Remove any existing schema code first
 * 
 * INSTRUCTIONS:
 * 1. Copy ALL code below (starting from line 12) into your theme's functions.php
 * 2. Remove any existing schema code first
 * 3. Save the file
 * 4. Clear ALL caches (LiteSpeed Cache, WordPress, browser)
 * 5. Test on: https://yoganearme.info/studios/stretch-chi/
 */

// ============================================
// METHOD 1: Filter Rank Math's JSON-LD output (most reliable)
// ============================================

/**
 * Remove LocalBusiness schema from Rank Math's JSON-LD output
 * This runs BEFORE Rank Math outputs schema to the page
 */
function ynm_remove_rankmath_localbusiness_jsonld($json_ld_array) {
    // Only on single GeoDirectory listing pages
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        
        // Remove from top-level array
        if (isset($json_ld_array['LocalBusiness'])) {
            unset($json_ld_array['LocalBusiness']);
        }
        
        // Remove from @graph array (Rank Math's graph format)
        if (isset($json_ld_array['@graph']) && is_array($json_ld_array['@graph'])) {
            foreach ($json_ld_array['@graph'] as $key => $item) {
                if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                    unset($json_ld_array['@graph'][$key]);
                }
            }
            // Re-index the array
            $json_ld_array['@graph'] = array_values($json_ld_array['@graph']);
        }
        
        // If it's a single schema object (not array)
        if (isset($json_ld_array['@type']) && $json_ld_array['@type'] === 'LocalBusiness') {
            // Return empty array to remove it
            return array();
        }
    }
    
    return $json_ld_array;
}
add_filter('rank_math/json_ld', 'ynm_remove_rankmath_localbusiness_jsonld', 999, 1);

/**
 * Also filter validated_data (backup method)
 */
function ynm_remove_rankmath_localbusiness_validated($data) {
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        if (isset($data['LocalBusiness'])) {
            unset($data['LocalBusiness']);
        }
        if (isset($data['@graph']) && is_array($data['@graph'])) {
            foreach ($data['@graph'] as $key => $item) {
                if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                    unset($data['@graph'][$key]);
                }
            }
            $data['@graph'] = array_values($data['@graph']);
        }
    }
    return $data;
}
add_filter('rank_math/schema/validated_data', 'ynm_remove_rankmath_localbusiness_validated', 999, 1);

// ============================================
// ADD OUR CUSTOM YOGASTUDIO SCHEMA
// ============================================

/**
 * Add YogaStudio Schema to Single Studio Pages
 * Output with priority 1 to ensure it appears early in <head>
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
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude
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
            'ratingValue' => (float) $rating,
            'reviewCount' => (int) $review_count
        );
    }
    
    // Add categories as keywords
    if (!empty($categories)) {
        $schema['keywords'] = implode(', ', $categories);
    }
    
    // Add image if available
    $image = get_the_post_thumbnail_url($post_id, 'large');
    if ($image) {
        $schema['image'] = array(
            '@type' => 'ImageObject',
            'url' => $image,
            'contentUrl' => $image
        );
    }
    
    // Output schema as JSON-LD
    // Use priority 1 to output early, but after Rank Math filters run
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'ynm_add_studio_schema', 1);



