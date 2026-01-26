<?php
/**
 * Address Formatting Helper
 * Formats GeoDirectory addresses so State & USA line up with city name
 * 
 * Usage: Add this to functions.php or include it
 */

/**
 * Format address for display
 * Ensures State and Country line up with city name
 */
function ynm_format_address($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
    }
    
    if (!$post_id) {
        return '';
    }
    
    // Get address components from GeoDirectory
    $street = geodir_get_post_meta($post_id, 'geodir_street', true);
    $street2 = geodir_get_post_meta($post_id, 'geodir_street2', true);
    $city = geodir_get_post_meta($post_id, 'geodir_city', true);
    $region = geodir_get_post_meta($post_id, 'geodir_region', true);
    $zip = geodir_get_post_meta($post_id, 'geodir_postal_code', true);
    $country = geodir_get_post_meta($post_id, 'geodir_country', true);
    
    // Fallback to standard post meta if GeoDirectory fields empty
    if (empty($street)) {
        $street = get_post_meta($post_id, 'geodir_street', true);
    }
    if (empty($city)) {
        $city = get_post_meta($post_id, 'geodir_city', true);
    }
    if (empty($region)) {
        $region = get_post_meta($post_id, 'geodir_region', true);
    }
    if (empty($zip)) {
        $zip = get_post_meta($post_id, 'geodir_postal_code', true);
    }
    if (empty($country)) {
        $country = get_post_meta($post_id, 'geodir_country', true);
    }
    
    // Build formatted address
    $address_parts = array();
    
    // Street address (line 1)
    if (!empty($street)) {
        $address_parts[] = esc_html($street);
    }
    
    // Street address line 2 (if exists)
    if (!empty($street2)) {
        $address_parts[] = esc_html($street2);
    }
    
    // City, State ZIP (line 2 - formatted so state lines up)
    $city_state_line = '';
    if (!empty($city)) {
        $city_state_line = esc_html($city);
    }
    
    // Add state and zip
    $state_zip = '';
    if (!empty($region)) {
        $state_zip = esc_html($region);
    }
    if (!empty($zip)) {
        $state_zip .= (!empty($state_zip) ? ' ' : '') . esc_html($zip);
    }
    
    // Combine city and state/zip on same line
    if (!empty($city_state_line) && !empty($state_zip)) {
        $address_parts[] = $city_state_line . ', ' . $state_zip;
    } elseif (!empty($city_state_line)) {
        $address_parts[] = $city_state_line;
    } elseif (!empty($state_zip)) {
        $address_parts[] = $state_zip;
    }
    
    // Country (if not USA or empty)
    if (!empty($country) && strtoupper($country) !== 'USA' && strtoupper($country) !== 'US' && strtoupper($country) !== 'UNITED STATES') {
        $address_parts[] = esc_html($country);
    }
    
    // Return formatted address with proper line breaks
    return implode('<br>', $address_parts);
}

/**
 * Shortcode to display formatted address
 * Usage: [ynm_formatted_address]
 */
function ynm_formatted_address_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    return ynm_format_address($post->ID);
}
add_shortcode('ynm_formatted_address', 'ynm_formatted_address_shortcode');

/**
 * Filter GeoDirectory address output to use formatted version
 */
add_filter('geodir_post_address', function($address, $post_id) {
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        $formatted = ynm_format_address($post_id);
        if (!empty($formatted)) {
            return $formatted;
        }
    }
    return $address;
}, 10, 2);

