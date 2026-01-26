/**
 * Badges Shortcode for Elementor HTML Widget
 * 
 * This creates a shortcode that checks WordPress/GeoDirectory fields
 * and conditionally displays Verified/Featured Studio badges.
 * 
 * Usage in Elementor HTML widget: [ynm_studio_badges]
 * 
 * This shortcode checks:
 * - studio_verified custom field
 * - studio_featured custom field  
 * - GeoDirectory's featured system
 * 
 * When you approve a studio claim in WordPress/GeoDirectory, 
 * the badges will automatically appear.
 */

/**
 * Shortcode to display studio badges
 * Checks post meta and GeoDirectory fields to conditionally show badges
 */
function ynm_studio_badges_shortcode($atts) {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    $post_id = $post->ID;
    
    // Check if studio is verified (using custom field or post meta)
    $is_verified = get_post_meta($post_id, 'studio_verified', true);
    $is_featured = get_post_meta($post_id, 'studio_featured', true);
    
    // Also check GeoDirectory custom fields
    if (empty($is_verified)) {
        $is_verified = geodir_get_post_meta($post_id, 'studio_verified', true);
    }
    if (empty($is_featured)) {
        $is_featured = geodir_get_post_meta($post_id, 'studio_featured', true);
    }
    
    // Check if featured via GeoDirectory's featured system
    if (function_exists('geodir_is_featured') && geodir_is_featured($post_id)) {
        $is_featured = true;
    }
    
    // Only display if at least one badge should be shown
    if (empty($is_verified) && empty($is_featured)) {
        return '';
    }
    
    // Output badges HTML
    ob_start();
    echo '<div class="studio-badges">';
    
    if (!empty($is_verified)) {
        echo '<span class="badge badge-verified">✓ VERIFIED</span>';
    }
    
    if (!empty($is_featured)) {
        echo '<span class="badge badge-featured">FEATURED STUDIO</span>';
    }
    
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('ynm_studio_badges', 'ynm_studio_badges_shortcode');

/**
 * Breadcrumb Shortcode for Elementor HTML Widget
 * 
 * Usage: [ynm_breadcrumbs]
 * 
 * Dynamically generates breadcrumbs based on current page structure
 */
function ynm_breadcrumbs_shortcode($atts) {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    
    // Get location data from GeoDirectory
    $city = geodir_get_post_meta($post_id, 'geodir_city', true);
    if (empty($city)) {
        $city = get_post_meta($post_id, 'geodir_city', true);
    }
    
    // Build breadcrumb links
    $home_url = home_url('/');
    $studios_url = home_url('/studios/');
    
    // City URL (if city exists)
    $city_slug = '';
    if (!empty($city)) {
        $city_slug = sanitize_title($city);
        $city_url = home_url('/studios/' . $city_slug . '/');
    } else {
        $city_url = $studios_url;
    }
    
    ob_start();
    echo '<nav class="breadcrumb-section">';
    echo '<div class="breadcrumb">';
    
    // Home
    echo '<a href="' . esc_url($home_url) . '">Home</a>';
    echo '<span class="separator">/</span>';
    
    // Studios
    echo '<a href="' . esc_url($studios_url) . '">Studios</a>';
    
    // City (if exists)
    if (!empty($city)) {
        echo '<span class="separator">/</span>';
        echo '<a href="' . esc_url($city_url) . '">' . esc_html($city) . '</a>';
    }
    
    // Current page (studio name)
    echo '<span class="separator">/</span>';
    echo '<span class="current">' . esc_html($studio_name) . '</span>';
    
    echo '</div>';
    echo '</nav>';
    
    return ob_get_clean();
}
add_shortcode('ynm_breadcrumbs', 'ynm_breadcrumbs_shortcode');

