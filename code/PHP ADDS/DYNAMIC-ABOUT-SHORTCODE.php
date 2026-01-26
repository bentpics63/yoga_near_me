<?php
/**
 * YogaNearMe.info - Dynamic About Section
 * 
 * Creates a shortcode [ynm_studio_about] that displays:
 * 1. The actual studio description (if available)
 * 2. A dynamic fallback with correct studio name, city, state
 * 
 * INSTALLATION:
 * Paste this code into your child theme's functions.php
 * 
 * USAGE IN ELEMENTOR:
 * Add a Shortcode widget with: [ynm_studio_about]
 */

/**
 * Dynamic About Section Shortcode
 * Shows real description or generates location-accurate fallback
 */
function ynm_studio_about_shortcode($atts) {
    // Only works on GeoDirectory detail pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    // Parse attributes
    $atts = shortcode_atts(array(
        'fallback' => 'true',  // Show fallback if no description
        'class' => 'ynm-about-content'
    ), $atts);
    
    // Get studio data from GeoDirectory
    $studio_name = get_the_title($post->ID);
    $city = geodir_get_post_meta($post->ID, 'city', true);
    $region = geodir_get_post_meta($post->ID, 'region', true);
    $country = geodir_get_post_meta($post->ID, 'country', true);
    
    // Try to get the actual description
    $description = '';
    
    // Method 1: Check post content
    if (!empty($post->post_content)) {
        $content = wp_strip_all_tags($post->post_content);
        // Only use if it's substantial and not placeholder
        if (strlen($content) > 100 && 
            stripos($content, 'Kai Yoga') === false && 
            stripos($content, 'San Diego, California') === false &&
            stripos($content, 'will be updated when this listing is claimed') === false) {
            $description = $post->post_content;
        }
    }
    
    // Method 2: Check GeoDirectory description field
    if (empty($description)) {
        $gd_desc = geodir_get_post_meta($post->ID, 'post_content', true);
        if (!empty($gd_desc) && strlen($gd_desc) > 100 &&
            stripos($gd_desc, 'Kai Yoga') === false) {
            $description = $gd_desc;
        }
    }
    
    // Method 3: Check excerpt
    if (empty($description)) {
        $excerpt = get_the_excerpt($post->ID);
        if (!empty($excerpt) && strlen($excerpt) > 50 &&
            stripos($excerpt, 'Kai Yoga') === false) {
            $description = '<p>' . $excerpt . '</p>';
        }
    }
    
    // If no real description, generate dynamic fallback
    if (empty($description) && $atts['fallback'] === 'true') {
        $description = ynm_generate_about_fallback($studio_name, $city, $region, $country, $post->ID);
    }
    
    // Return empty if still no description
    if (empty($description)) {
        return '';
    }
    
    // Wrap in container
    $output = '<div class="' . esc_attr($atts['class']) . '">';
    $output .= wp_kses_post($description);
    $output .= '</div>';
    
    return $output;
}
add_shortcode('ynm_studio_about', 'ynm_studio_about_shortcode');


/**
 * Generate a dynamic fallback description
 * Uses studio name, city, state to create location-accurate text
 */
function ynm_generate_about_fallback($studio_name, $city, $region, $country, $post_id = null) {
    // Build location string
    $location = '';
    if ($city && $region) {
        $location = $city . ', ' . $region;
    } elseif ($city) {
        $location = $city;
    } elseif ($region) {
        $location = $region;
    }
    
    // Get yoga styles if available
    $yoga_styles = '';
    if ($post_id && function_exists('geodir_get_post_meta')) {
        $styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
        if (!empty($styles)) {
            if (is_array($styles)) {
                $yoga_styles = implode(', ', array_slice($styles, 0, 3));
            } else {
                $yoga_styles = $styles;
            }
        }
    }
    
    // Get amenities summary
    $amenities_text = '';
    if ($post_id && function_exists('geodir_get_post_meta')) {
        $amenities = geodir_get_post_meta($post_id, 'amenities', true);
        if (!empty($amenities) && is_array($amenities)) {
            $amenity_count = count($amenities);
            if ($amenity_count > 0) {
                $amenities_text = " The studio offers " . $amenity_count . " amenities for your comfort.";
            }
        }
    }
    
    // Generate varied descriptions based on studio name hash (for variety)
    $hash = crc32($studio_name);
    $variant = $hash % 5;
    
    $descriptions = array();
    
    // Variant 0 - Welcome focused
    $descriptions[0] = sprintf(
        '<p>Welcome to %s, your neighborhood yoga destination in %s. This studio offers a welcoming space for practitioners of all levels, from curious beginners to experienced yogis seeking to deepen their practice.</p>' .
        '<p>Experience classes designed to build strength, flexibility, and inner peace.%s Join a supportive community dedicated to wellness and personal growth.</p>',
        esc_html($studio_name),
        esc_html($location),
        $amenities_text
    );
    
    // Variant 1 - Community focused
    $descriptions[1] = sprintf(
        '<p>%s serves the %s yoga community with dedication and expertise. Whether you\'re stepping onto the mat for the first time or continuing a lifelong practice, you\'ll find classes suited to your journey.</p>' .
        '<p>The experienced instructors create an inclusive environment where every student can grow, breathe, and transform.%s</p>',
        esc_html($studio_name),
        esc_html($location),
        $amenities_text
    );
    
    // Variant 2 - Practice focused
    $descriptions[2] = sprintf(
        '<p>Located in %s, %s offers authentic yoga instruction in a peaceful setting. The studio provides a sanctuary from daily stress, where you can reconnect with yourself through mindful movement and breath.</p>' .
        '<p>Classes cater to all experience levels, with modifications available to meet you exactly where you are in your practice.%s</p>',
        esc_html($location),
        esc_html($studio_name),
        $amenities_text
    );
    
    // Variant 3 - Journey focused
    $descriptions[3] = sprintf(
        '<p>Begin or continue your yoga journey at %s in %s. This welcoming studio brings together skilled teachers and a diverse community united by a love for yoga and wellness.</p>' .
        '<p>From energizing flow classes to restorative sessions, discover practices that fit your lifestyle and goals.%s</p>',
        esc_html($studio_name),
        esc_html($location),
        $amenities_text
    );
    
    // Variant 4 - Transformation focused
    $descriptions[4] = sprintf(
        '<p>%s invites you to explore the transformative power of yoga in the heart of %s. The studio provides a nurturing space where students of all backgrounds can develop their practice with confidence.</p>' .
        '<p>Expert instructors guide you through classes designed to strengthen body and calm mind.%s</p>',
        esc_html($studio_name),
        esc_html($location),
        $amenities_text
    );
    
    $output = $descriptions[$variant];
    
    // Add yoga styles if available
    if (!empty($yoga_styles)) {
        $output .= sprintf(
            '<p><em>Styles offered include: %s</em></p>',
            esc_html($yoga_styles)
        );
    }
    
    return $output;
}


/**
 * Alternative: Filter to replace placeholder content automatically
 * This catches the old placeholder and replaces it on-the-fly
 */
function ynm_filter_placeholder_content($content) {
    // Only on GeoDirectory detail pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $content;
    }
    
    // Check if content contains the placeholder text
    $placeholder_patterns = array(
        'Kai Yoga, located in San Diego, California',
        'Discover the transformative yoga experience at Kai Yoga',
        'This studio offers a welcoming environment for all levels, helping you find balance'
    );
    
    $has_placeholder = false;
    foreach ($placeholder_patterns as $pattern) {
        if (stripos($content, $pattern) !== false) {
            $has_placeholder = true;
            break;
        }
    }
    
    if (!$has_placeholder) {
        return $content;
    }
    
    // Get studio data
    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return $content;
    }
    
    $studio_name = get_the_title($post->ID);
    $city = geodir_get_post_meta($post->ID, 'city', true);
    $region = geodir_get_post_meta($post->ID, 'region', true);
    
    // Generate replacement
    $replacement = ynm_generate_about_fallback($studio_name, $city, $region, '', $post->ID);
    
    // Replace the entire placeholder paragraph
    $old_placeholder = 'Discover the transformative yoga experience at Kai Yoga, located in San Diego, California. This studio offers a welcoming environment for all levels, helping you find balance, flexibility, and peace of mind. Join a vibrant community and elevate your practice with expert instructors and diverse classes tailored to your needs.';
    
    $content = str_ireplace($old_placeholder, wp_strip_all_tags($replacement), $content);
    
    return $content;
}
// Uncomment to enable automatic replacement:
// add_filter('the_content', 'ynm_filter_placeholder_content', 20);
// add_filter('geodir_detail_page_content', 'ynm_filter_placeholder_content', 20);

?>
