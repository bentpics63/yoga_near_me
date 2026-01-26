<?php
// ============================================
// SINGLE STUDIO HERO BADGES & TAGLINE CODE
// Paste this code at the bottom of functions.php
// Make sure all braces are properly closed!
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

