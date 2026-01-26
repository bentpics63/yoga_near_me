<?php
// Enqueue parent theme styles
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles' );
function hello_elementor_child_enqueue_styles() {
    wp_enqueue_style( 'hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', array('hello-elementor-theme-style') );
}add_filter('pmxi_custom_post_types', function($post_types){
    $post_types['gd_place'] = 'Places';
    return $post_types;
});
// Auto-generate Rank Math keywords for Geodirectory listings
function auto_set_geodirectory_keywords($post_id) {
    // Only run for gd_place post type and avoid infinite loops
    if (get_post_type($post_id) != 'gd_place' || wp_is_post_revision($post_id)) {
        return;
    }
    
    // Check if keyword is already set
    $existing_keyword = get_post_meta($post_id, 'rank_math_focus_keyword', true);
    if (!empty($existing_keyword)) {
        return; // Don't overwrite existing keywords
    }
    
    // Get listing details
    $title = get_the_title($post_id);
    $city = get_post_meta($post_id, 'geodir_city', true);
    $state = get_post_meta($post_id, 'geodir_region', true);
    
    // Clean up title (remove common words)
    $clean_title = str_replace(['LLC', 'Inc', 'Studio', 'Center', 'Yoga'], '', $title);
    $clean_title = trim($clean_title);
    
    // Generate keyword based on location
    if (!empty($city)) {
        $keyword = strtolower($clean_title) . " yoga " . strtolower($city);
        
        // Add state if available
        if (!empty($state)) {
            $keyword .= " " . strtolower($state);
        }
        
        // Clean up the keyword
        $keyword = preg_replace('/\s+/', ' ', $keyword); // Remove extra spaces
        $keyword = trim($keyword);
        
        // Set the focus keyword in Rank Math
        update_post_meta($post_id, 'rank_math_focus_keyword', $keyword);
    }
}

// Hook to run when posts are saved
add_action('save_post', 'auto_set_geodirectory_keywords', 10, 1);

// Function to bulk update existing listings (run once)
function bulk_update_geodirectory_keywords() {
    // Only run if specifically called
    if (!isset($_GET['update_keywords']) || $_GET['update_keywords'] != 'run') {
        return;
    }
    
    // Get all gd_place posts without keywords
    $posts = get_posts(array(
        'post_type' => 'gd_place',
        'posts_per_page' => 100, // Process in batches
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'rank_math_focus_keyword',
                'compare' => 'NOT EXISTS'
            ),
            array(
                'key' => 'rank_math_focus_keyword',
                'value' => '',
                'compare' => '='
            )
        )
    ));
    
    foreach ($posts as $post) {
        auto_set_geodirectory_keywords($post->ID);
    }
    
    echo "Updated " . count($posts) . " listings with keywords.";
    wp_die();
}

// Studio Information Customizer Settings
function add_studio_customizer_settings($wp_customize) {
    // Add Studio Information section
    $wp_customize->add_section('studio_info', array(
        'title' => 'Studio Information',
        'priority' => 30,
        'description' => 'Set your studio name and city for global use across your site.'
    ));
    
    // Studio name setting
    $wp_customize->add_setting('studio_name', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('studio_name', array(
        'label' => 'Studio Name',
        'section' => 'studio_info',
        'type' => 'text',
        'description' => 'Enter your yoga studio name'
    ));
    
    // City name setting
    $wp_customize->add_setting('city_name', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('city_name', array(
        'label' => 'City Name',
        'section' => 'studio_info',
        'type' => 'text',
        'description' => 'Enter your city name'
    ));
}
add_action('customize_register', 'add_studio_customizer_settings');

// Create shortcodes for the variables
function studio_name_shortcode() {
    return get_theme_mod('studio_name', 'Your Studio Name');
}
add_shortcode('studio_name', 'studio_name_shortcode');

function city_name_shortcode() {
    return get_theme_mod('city_name', 'Your City');
}
add_shortcode('city_name', 'city_name_shortcode');

// Auto-replace variables in content
function replace_studio_variables($content) {
    $studio_name = get_theme_mod('studio_name', 'Your Studio Name');
    $city_name = get_theme_mod('city_name', 'Your City');
    
    $content = str_replace('{{studio_name}}', $studio_name, $content);
    $content = str_replace('{{city_name}}', $city_name, $content);
    
    return $content;
}
add_filter('the_content', 'replace_studio_variables');
add_filter('the_excerpt', 'replace_studio_variables');
add_filter('widget_text', 'replace_studio_variables');

// Custom shortcode for studio description template
function studio_description_shortcode() {
    global $post;
    
    if (get_post_type($post) == 'gd_place') {
        $studio_name = get_the_title($post->ID);
        $city_name = get_post_meta($post->ID, 'geodir_city', true);
    } else {
        $studio_name = get_theme_mod('studio_name', 'Your Studio Name');
        $city_name = get_theme_mod('city_name', 'Your City');
    }
    
    $description = "Discover the transformative yoga experience at {$studio_name}, your yoga destination in {$city_name}. This studio offers a welcoming environment for all levels, helping you find balance, flexibility, and peace of mind. Join a vibrant community and elevate your practice with expert instructors and diverse classes tailored to your needs. Let the beauty of what you love be what you do.";
    
    return $description;
}
add_shortcode('studio_description', 'studio_description_shortcode');

/**
 * Show more listings on GeoDirectory location pages
 * 
 * @param WP_Query $query The WordPress query object
 */

// ============================================
// REMOVE RANK MATH LOCALBUSINESS SCHEMA
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
 * Nuclear option: Completely disable Rank Math schema output for gd_place posts
 * This returns empty array to prevent ANY schema from Rank Math
 */
function ynm_disable_all_rankmath_schema_for_gd_place($json_ld_array) {
    global $post;
    
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $json_ld_array;
    }
    
    // If this is a gd_place post, check if the schema contains LocalBusiness
    if (isset($post) && isset($post->post_type) && $post->post_type === 'gd_place') {
        if (is_array($json_ld_array)) {
            // Check if it's a LocalBusiness schema
            if (isset($json_ld_array['@type']) && $json_ld_array['@type'] === 'LocalBusiness') {
                return array(); // Return empty to disable it
            }
            if (isset($json_ld_array['LocalBusiness'])) {
                unset($json_ld_array['LocalBusiness']);
            }
            // Check @graph array
            if (isset($json_ld_array['@graph']) && is_array($json_ld_array['@graph'])) {
                foreach ($json_ld_array['@graph'] as $key => $item) {
                    if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                        unset($json_ld_array['@graph'][$key]);
                    }
                }
                $json_ld_array['@graph'] = array_values($json_ld_array['@graph']);
            }
        }
    }
    
    return $json_ld_array;
}
add_filter('rank_math/json_ld', 'ynm_disable_all_rankmath_schema_for_gd_place', 99999, 1);

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

// Start output buffering on template_redirect
add_action('template_redirect', function() {
    global $ynm_output_buffer_started;
    
    if (!function_exists('geodir_is_page')) {
        return;
    }
    
    if (geodir_is_page('detail')) {
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

// ============================================
// SINGLE STUDIO HERO BADGES & TAGLINE CODE
// ============================================

/**
 * Display studio badges (Verified/Featured) above the title
 */
function ynm_display_studio_badges() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    $is_verified = get_post_meta($post_id, 'studio_verified', true);
    $is_featured = get_post_meta($post_id, 'studio_featured', true);
    
    if (empty($is_verified)) {
        $is_verified = geodir_get_post_meta($post_id, 'studio_verified', true);
    }
    if (empty($is_featured)) {
        $is_featured = geodir_get_post_meta($post_id, 'studio_featured', true);
    }
    
    if (function_exists('geodir_is_featured') && geodir_is_featured($post_id)) {
        $is_featured = true;
    }
    
    if (empty($is_verified) && empty($is_featured)) {
        return;
    }
    
    echo '<div class="studio-badges">';
    
    if (!empty($is_verified)) {
        echo '<span class="badge verified">✓ VERIFIED</span>';
    }
    
    if (!empty($is_featured)) {
        echo '<span class="badge featured">FEATURED STUDIO</span>';
    }
    
    echo '</div>';
}
add_action('geodir_before_post_title', 'ynm_display_studio_badges', 10);
add_action('elementor/page_templates/canvas/before_content', 'ynm_display_studio_badges', 10);

/**
 * Display studio tagline below the title
 */
function ynm_display_studio_tagline() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    $tagline = get_post_meta($post_id, 'studio_tagline', true);
    
    if (empty($tagline)) {
        $tagline = geodir_get_post_meta($post_id, 'studio_tagline', true);
    }
    
    if (empty($tagline)) {
        $excerpt = get_the_excerpt($post_id);
        if (!empty($excerpt)) {
            $tagline = wp_trim_words($excerpt, 15);
        }
    }
    
    if (empty($tagline)) {
        return;
    }
    
    echo '<div class="studio-tagline">' . esc_html($tagline) . '</div>';
}
add_action('geodir_after_post_title', 'ynm_display_studio_tagline', 10);

/**
 * Display opening hours status indicator
 */
function ynm_display_studio_status() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    $business_hours = geodir_get_post_meta($post_id, 'business_hours', true);
    
    if (empty($business_hours)) {
        return;
    }
    
    $status = ynm_get_current_business_status($business_hours);
    
    if (empty($status)) {
        return;
    }
    
    $status_class = $status['is_open'] ? 'open' : 'closed';
    $status_text = $status['is_open'] ? 'Open' : 'Closed';
    
    if ($status['is_open'] && !empty($status['closes_at'])) {
        $status_text .= ' · Closes ' . $status['closes_at'];
    }
    
    echo '<div class="studio-hours-status ' . esc_attr($status_class) . '">' . esc_html($status_text) . '</div>';
}
add_action('geodir_after_post_title', 'ynm_display_studio_status', 15);

/**
 * Get current business status from business hours
 */
function ynm_get_current_business_status($business_hours) {
    if (empty($business_hours)) {
        return null;
    }
    
    $current_day = strtolower(date('D'));
    $current_time = date('H:i');
    $current_day_abbr = substr($current_day, 0, 2);
    
    $hours = array();
    if (is_string($business_hours)) {
        preg_match_all('/(Mo|Tu|We|Th|Fr|Sa|Su)\s+(\d{2}):(\d{2})-(\d{2}):(\d{2})/i', $business_hours, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $match) {
                $hours[] = $match;
            }
        }
    }
    
    if (empty($hours)) {
        return null;
    }
    
    $today_hours = null;
    foreach ($hours as $hour) {
        if (stripos($hour, $current_day_abbr) === 0) {
            $today_hours = $hour;
            break;
        }
    }
    
    if (empty($today_hours)) {
        return array('is_open' => false);
    }
    
    if (preg_match('/(\d{2}):(\d{2})-(\d{2}):(\d{2})/', $today_hours, $matches)) {
        $open_time = $matches[1] . ':' . $matches[2];
        $close_time = $matches[3] . ':' . $matches[4];
        $close_time_12h = date('g A', strtotime($close_time));
        $is_open = ($current_time >= $open_time && $current_time <= $close_time);
        
        return array(
            'is_open' => $is_open,
            'closes_at' => $is_open ? $close_time_12h : null,
            'opens_at' => $open_time,
            'closes_at_24h' => $close_time
        );
    }
    
    return null;
}

