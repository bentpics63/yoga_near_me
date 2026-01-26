// ============================================
// YOGA NEAR ME - STUDIO SCHEMA MARKUP
// Add this code at the VERY END of functions.php
// DO NOT include <?php tag - the file already has one
// ============================================

// ============================================
// METHOD 1: Filter Rank Math's JSON-LD output
// ============================================

/**
 * Remove LocalBusiness schema from Rank Math's JSON-LD output
 */
function ynm_remove_rankmath_localbusiness_jsonld($json_ld_array) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $json_ld_array;
    }
    
    if (!is_array($json_ld_array)) {
        return $json_ld_array;
    }
    
    // Remove from top-level array
    if (isset($json_ld_array['LocalBusiness'])) {
        unset($json_ld_array['LocalBusiness']);
    }
    
    // Remove from @graph array
    if (isset($json_ld_array['@graph']) && is_array($json_ld_array['@graph'])) {
        foreach ($json_ld_array['@graph'] as $key => $item) {
            if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                unset($json_ld_array['@graph'][$key]);
            }
        }
        $json_ld_array['@graph'] = array_values($json_ld_array['@graph']);
    }
    
    // If it's a single schema object
    if (isset($json_ld_array['@type']) && $json_ld_array['@type'] === 'LocalBusiness') {
        return array();
    }
    
    return $json_ld_array;
}
add_filter('rank_math/json_ld', 'ynm_remove_rankmath_localbusiness_jsonld', 999, 1);

/**
 * Additional filter to catch Rank Math schema before it's encoded
 * This runs at a very high priority to catch it early
 */
function ynm_remove_rankmath_localbusiness_early($json_ld_array) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $json_ld_array;
    }
    
    if (!is_array($json_ld_array)) {
        return $json_ld_array;
    }
    
    // Remove LocalBusiness completely
    if (isset($json_ld_array['LocalBusiness'])) {
        unset($json_ld_array['LocalBusiness']);
    }
    
    // Remove from @graph
    if (isset($json_ld_array['@graph']) && is_array($json_ld_array['@graph'])) {
        foreach ($json_ld_array['@graph'] as $key => $item) {
            if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                unset($json_ld_array['@graph'][$key]);
            }
        }
        $json_ld_array['@graph'] = array_values($json_ld_array['@graph']);
    }
    
    // If entire array is LocalBusiness, return empty
    if (isset($json_ld_array['@type']) && $json_ld_array['@type'] === 'LocalBusiness') {
        return array();
    }
    
    return $json_ld_array;
}
add_filter('rank_math/json_ld', 'ynm_remove_rankmath_localbusiness_early', 1, 1);

/**
 * Also filter validated_data (backup method)
 */
function ynm_remove_rankmath_localbusiness_validated($data) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $data;
    }
    
    if (!is_array($data)) {
        return $data;
    }
    
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
    
    return $data;
}
add_filter('rank_math/schema/validated_data', 'ynm_remove_rankmath_localbusiness_validated', 999, 1);

/**
 * Completely disable Rank Math's LocalBusiness schema generation for GeoDirectory posts
 * This is the most aggressive approach - prevents Rank Math from even creating it
 */
function ynm_disable_rankmath_localbusiness_completely($schemas) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $schemas;
    }
    
    // Remove LocalBusiness from schemas array completely
    if (isset($schemas['LocalBusiness'])) {
        unset($schemas['LocalBusiness']);
    }
    
    // Also check @graph format
    if (isset($schemas['@graph']) && is_array($schemas['@graph'])) {
        foreach ($schemas['@graph'] as $key => $item) {
            if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                unset($schemas['@graph'][$key]);
            }
        }
        $schemas['@graph'] = array_values($schemas['@graph']);
    }
    
    return $schemas;
}
add_filter('rank_math/schema/schemas', 'ynm_disable_rankmath_localbusiness_completely', 999, 1);


/**
 * Filter Rank Math's description to prevent wrong data
 */
function ynm_fix_rankmath_description($description) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $description;
    }
    
    global $post;
    
    // If description contains wrong studio names, clear it
    if (!empty($description) && isset($post) && isset($post->ID)) {
        $studio_name = get_the_title($post->ID);
        // If description doesn't contain the current studio name, it's probably wrong
        if (!empty($studio_name) && stripos($description, $studio_name) === false && strlen($description) > 200) {
            return ''; // Return empty so Rank Math doesn't use wrong data
        }
    }
    
    return $description;
}
add_filter('rank_math/frontend/description', 'ynm_fix_rankmath_description', 999, 1);

// ============================================
// METHOD 2: Output Buffering (Nuclear Option)
// ============================================

/**
 * Remove LocalBusiness schema from final HTML output
 * This uses a very aggressive approach to catch everything
 */
function ynm_remove_localbusiness_from_output($buffer) {
    if (!is_string($buffer)) {
        return $buffer;
    }
    
    // FIRST: Use simple, direct regex to remove minified single-line LocalBusiness schemas
    // This handles the exact format we're seeing: <script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"LocalBusiness",...}</script>
    $buffer = preg_replace('/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>\s*\{[^<]*"@type"\s*:\s*"LocalBusiness"[^<]*\}\s*<\/script>/i', '', $buffer);
    
    // SECOND: Handle escaped quotes in minified JSON (\\"@type\\":\\"LocalBusiness\\")
    $buffer = preg_replace('/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>\s*\{[^<]*\\\\"@type\\\\"\s*:\s*\\\\"LocalBusiness\\\\"[^<]*\}\s*<\/script>/i', '', $buffer);
    
    // THIRD: Split buffer into lines to find script tags more reliably
    $lines = explode("\n", $buffer);
    $new_lines = array();
    $in_script = false;
    $script_content = '';
    $script_tag = '';
    
    foreach ($lines as $line) {
        // Check if this line starts a script tag
        if (preg_match('/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>/i', $line, $matches)) {
            $script_tag = $line;
            $script_content = '';
            $in_script = true;
            
            // Check if script tag is self-closing or on same line
            if (preg_match('/<\/script>/i', $line)) {
                // Complete script tag on one line - check for LocalBusiness
                if ((stripos($line, '"@type"') !== false || stripos($line, '\\"@type\\"') !== false) && 
                    stripos($line, 'LocalBusiness') !== false) {
                    // Skip this line (don't add it to output)
                    continue;
                } else {
                    $new_lines[] = $line;
                }
                $in_script = false;
            }
            continue;
        }
        
        // If we're inside a script tag
        if ($in_script) {
            $script_content .= $line . "\n";
            
            // Check if this line closes the script tag
            if (preg_match('/<\/script>/i', $line)) {
                // Check if this script contains LocalBusiness
                $full_script = $script_tag . $script_content;
                if ((stripos($full_script, '"@type"') !== false || stripos($full_script, '\\"@type\\"') !== false) && 
                    stripos($full_script, 'LocalBusiness') !== false) {
                    // Skip this entire script block
                    $in_script = false;
                    $script_content = '';
                    $script_tag = '';
                    continue;
                } else {
                    // Keep this script block
                    $new_lines[] = $script_tag;
                    $new_lines[] = $script_content;
                }
                $in_script = false;
                $script_content = '';
                $script_tag = '';
            }
            continue;
        }
        
        // Regular line - add it
        $new_lines[] = $line;
    }
    
    // FOURTH: Also try regex as backup (more aggressive)
    $buffer = implode("\n", $new_lines);
    
    // Multiple regex patterns to catch all variations (try multiple times to catch nested cases)
    // These patterns handle minified JSON, escaped characters, and various formats
    $patterns = array(
        // Pattern 1: Standard format - matches "@type":"LocalBusiness" (with or without escaped quotes)
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>[\s\S]*?["\']@type["\']\s*:\s*["\']LocalBusiness["\'][\s\S]*?<\/script>/i',
        // Pattern 2: Handles escaped slashes in URLs (https:\/\/)
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>[\s\S]*?@type[\s\S]*?LocalBusiness[\s\S]*?<\/script>/i',
        // Pattern 3: Any script tag containing LocalBusiness anywhere (most aggressive)
        '/<script[^>]*>[\s\S]*?LocalBusiness[\s\S]*?<\/script>/i',
        // Pattern 4: Very aggressive - match any script with LocalBusiness (dotall mode)
        '/<script[^>]*>.*?LocalBusiness.*?<\/script>/is',
        // Pattern 5: Match minified JSON with escaped characters (\\"@type\\":\\"LocalBusiness\\")
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>[\s\S]*?\\\\"@type\\\\"\s*:\s*\\\\"LocalBusiness\\\\"[\s\S]*?<\/script>/i',
        // Pattern 6: Match with any quote style
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>[\s\S]*?["\']@type["\']\s*:\s*["\']LocalBusiness["\'][\s\S]*?<\/script>/i',
        // Pattern 7: Ultra-aggressive - any script tag with LocalBusiness (no restrictions)
        '/<script[^>]*>[\s\S]{0,100000}LocalBusiness[\s\S]{0,100000}<\/script>/i',
        // Pattern 8: Single-line minified with escaped quotes (the exact format we're seeing)
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>\s*\{[^<]*"@type"\s*:\s*"LocalBusiness"[^<]*\}\s*<\/script>/i',
        // Pattern 9: Single-line minified with double-escaped quotes
        '/<script[^>]*type\s*=\s*["\']application\/ld\+json["\'][^>]*>\s*\{[^<]*\\\\"@type\\\\"\s*:\s*\\\\"LocalBusiness\\\\"[^<]*\}\s*<\/script>/i',
    );
    
    // Run patterns multiple times to catch nested or multiple instances
    for ($i = 0; $i < 7; $i++) {
        foreach ($patterns as $pattern) {
            $buffer = preg_replace($pattern, '', $buffer);
        }
    }
    
    // Final ultra-aggressive pass: Remove ANY script tag containing LocalBusiness
    // This is a catch-all for anything we might have missed
    $max_iterations = 10;
    $iteration = 0;
    while (preg_match('/<script[^>]*>[\s\S]*?LocalBusiness[\s\S]*?<\/script>/i', $buffer) && $iteration < $max_iterations) {
        $buffer = preg_replace('/<script[^>]*>[\s\S]*?LocalBusiness[\s\S]*?<\/script>/i', '', $buffer);
        $iteration++;
    }
    
    return $buffer;
}

// Track if we started output buffering
$ynm_output_buffer_started = false;

// Start output buffering on template_redirect (very early priority)
add_action('template_redirect', function() {
    global $ynm_output_buffer_started;
    
    if (!function_exists('geodir_is_page')) {
        return;
    }
    
    if (geodir_is_page('detail')) {
        // Start output buffering if no buffer exists
        if (ob_get_level() === 0) {
            ob_start('ynm_remove_localbusiness_from_output');
            $ynm_output_buffer_started = true;
        }
    }
}, 1);

// Flush output buffer on shutdown
add_action('shutdown', function() {
    global $ynm_output_buffer_started;
    
    if ($ynm_output_buffer_started && ob_get_level() > 0) {
        ob_end_flush();
    }
}, 999);

// ============================================
// ADD OUR CUSTOM YOGASTUDIO SCHEMA
// ============================================

/**
 * Add YogaStudio Schema to Single Studio Pages
 */
function ynm_add_studio_schema() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID) || empty($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    
    if (empty($studio_name)) {
        return;
    }
    
    $studio_url = get_permalink($post_id);
    
    // Get description
    $studio_description = get_the_excerpt($post_id);
    if (empty($studio_description)) {
        $studio_description = geodir_get_post_meta($post_id, 'post_desc', true);
    }
    
    // Clean up description
    if (!empty($studio_description)) {
        $studio_description = trim($studio_description);
        if (stripos($studio_description, $studio_name) === false && strlen($studio_description) > 200) {
            $studio_description = '';
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
    $rating = 0;
    $review_count = 0;
    if (function_exists('geodir_get_post_rating')) {
        $rating = geodir_get_post_rating($post_id);
    }
    if (function_exists('geodir_get_review_count')) {
        $review_count = geodir_get_review_count($post_id);
    }
    
    // Get categories
    $categories = array();
    if (function_exists('wp_get_post_terms')) {
        $categories = wp_get_post_terms($post_id, 'gd_placecategory', array('fields' => 'names'));
        if (is_wp_error($categories)) {
            $categories = array();
        }
    }
    
    // Build schema array
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'YogaStudio',
        'name' => $studio_name,
        'url' => $studio_url,
        'description' => $studio_description ?: $studio_name . ' - Yoga studio in ' . ($city ?: ''),
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
    
    // Add website
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
    if (!empty($categories) && is_array($categories)) {
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
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'ynm_add_studio_schema', 1);



