<?php
/**
 * Single Studio Page - Hero Section Badges & Tagline
 * 
 * Adds verification/featured badges and tagline to single studio pages
 * This hooks into GeoDirectory single listing pages
 */

/**
 * Display studio badges (Verified/Featured) above the title
 * Uses GeoDirectory custom fields or post meta to determine badge display
 */
function ynm_display_studio_badges() {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
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
        return;
    }
    
    // Output badges HTML
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
 * Uses post excerpt or custom field for tagline
 */
function ynm_display_studio_tagline() {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    // Get tagline from custom field first
    $tagline = get_post_meta($post_id, 'studio_tagline', true);
    
    // If no custom tagline, try GeoDirectory custom field
    if (empty($tagline)) {
        $tagline = geodir_get_post_meta($post_id, 'studio_tagline', true);
    }
    
    // If still no tagline, use excerpt (first 150 chars)
    if (empty($tagline)) {
        $excerpt = get_the_excerpt($post_id);
        if (!empty($excerpt)) {
            $tagline = wp_trim_words($excerpt, 15);
        }
    }
    
    // If still empty, don't display anything
    if (empty($tagline)) {
        return;
    }
    
    // Output tagline HTML
    echo '<div class="studio-tagline">' . esc_html($tagline) . '</div>';
}
add_action('geodir_after_post_title', 'ynm_display_studio_tagline', 10);

/**
 * Display opening hours status indicator
 * Shows "Open - Closes X PM" or "Closed" with colored dot
 */
function ynm_display_studio_status() {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    // Get business hours from GeoDirectory
    $business_hours = geodir_get_post_meta($post_id, 'business_hours', true);
    
    if (empty($business_hours)) {
        return;
    }
    
    // Parse business hours to determine current status
    $status = ynm_get_current_business_status($business_hours);
    
    if (empty($status)) {
        return;
    }
    
    // Output status HTML
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
 * Returns array with is_open, closes_at, etc.
 */
function ynm_get_current_business_status($business_hours) {
    if (empty($business_hours)) {
        return null;
    }
    
    $current_day = strtolower(date('D')); // Mon, Tue, Wed, etc.
    $current_time = date('H:i'); // 24-hour format
    
    // Map day names to abbreviations
    $day_map = array(
        'monday' => 'mo',
        'tuesday' => 'tu',
        'wednesday' => 'we',
        'thursday' => 'th',
        'friday' => 'fr',
        'saturday' => 'sa',
        'sunday' => 'su'
    );
    
    $current_day_abbr = substr($current_day, 0, 2);
    
    // Parse business hours
    $hours = ynm_parse_opening_hours($business_hours);
    
    if (empty($hours)) {
        return null;
    }
    
    // Find today's hours
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
    
    // Extract time range (e.g., "Mo 09:00-17:00")
    if (preg_match('/(\d{2}):(\d{2})-(\d{2}):(\d{2})/', $today_hours, $matches)) {
        $open_time = $matches[1] . ':' . $matches[2];
        $close_time = $matches[3] . ':' . $matches[4];
        
        // Convert to 12-hour format for display
        $close_time_12h = date('g A', strtotime($close_time));
        
        // Check if current time is within business hours
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

/**
 * Enqueue hero section CSS
 * Note: CSS should be added to WordPress Customizer → Additional CSS
 * Or via Elementor → Settings → Custom CSS
 * This function is a placeholder in case you want to enqueue it as a file
 */
function ynm_enqueue_hero_css() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    // Try multiple possible paths for the CSS file
    $possible_paths = array(
        get_stylesheet_directory() . '/../code/single-studio-hero-custom/single-studio-hero-custom.css',
        get_template_directory() . '/../code/single-studio-hero-custom/single-studio-hero-custom.css',
        dirname(__FILE__) . '/../single-studio-hero-custom/single-studio-hero-custom.css',
    );
    
    $css_file = null;
    foreach ($possible_paths as $path) {
        if (file_exists($path)) {
            $css_file = $path;
            break;
        }
    }
    
    // If file exists, enqueue it
    if ($css_file) {
        $css_url = str_replace(ABSPATH, home_url('/'), $css_file);
        wp_enqueue_style(
            'ynm-single-studio-hero',
            $css_url,
            array(),
            filemtime($css_file)
        );
    }
}
// Uncomment the line below if you want to enqueue CSS as a file instead of adding to Customizer
// add_action('wp_enqueue_scripts', 'ynm_enqueue_hero_css');

