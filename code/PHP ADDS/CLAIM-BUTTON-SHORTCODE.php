<?php
/**
 * YogaNearMe.info - Claim Button Shortcode
 * 
 * Displays a "Claim Your Studio" button for unclaimed listings
 * Shows "Verified Studio" badge for claimed listings
 * 
 * INSTALLATION:
 * Paste this code into your child theme's functions.php
 * 
 * USAGE IN ELEMENTOR:
 * Add a Shortcode widget with: [ynm_claim_button]
 * 
 * Or use the HTML directly in a button widget with the claim URL
 */

// ============================================
// CLAIM BUTTON SHORTCODE
// ============================================

/**
 * Shortcode: [ynm_claim_button]
 * Shows claim button for unclaimed studios, verified badge for claimed
 * 
 * Attributes:
 * - text: Button text (default: "Claim Your Studio")
 * - claimed_text: Text for claimed studios (default: "Verified Studio")
 * - show_verified: Whether to show badge for claimed studios (default: true)
 */
function ynm_claim_button_shortcode($atts) {
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
        'text' => 'Claim Your Studio',
        'claimed_text' => 'Verified Studio',
        'show_verified' => 'true',
        'class' => ''
    ), $atts);
    
    // Check if studio is claimed
    $is_claimed = ynm_is_studio_claimed($post->ID);
    
    if ($is_claimed) {
        // Studio is claimed - show verified badge or nothing
        if ($atts['show_verified'] === 'true') {
            return '<span class="ynm-verified-badge ' . esc_attr($atts['class']) . '">' . esc_html($atts['claimed_text']) . '</span>';
        }
        return '';
    }
    
    // Studio is not claimed - show claim button
    $claim_url = ynm_get_claim_url($post->ID);
    
    $output = '<a href="' . esc_url($claim_url) . '" class="btn-claim-studio ynm-btn-claim ' . esc_attr($atts['class']) . '">';
    $output .= '<span class="btn-icon">✓</span> ';
    $output .= '<span class="btn-text">' . esc_html($atts['text']) . '</span>';
    $output .= '</a>';
    
    return $output;
}
add_shortcode('ynm_claim_button', 'ynm_claim_button_shortcode');


/**
 * Check if a studio/listing is claimed
 * 
 * @param int $post_id The post ID
 * @return bool True if claimed, false otherwise
 */
function ynm_is_studio_claimed($post_id) {
    // Method 1: Check GeoDirectory claim status
    if (function_exists('geodir_get_post_meta')) {
        $claimed = geodir_get_post_meta($post_id, 'claimed', true);
        if ($claimed == 1 || $claimed === true || $claimed === 'yes') {
            return true;
        }
    }
    
    // Method 2: Check if post author is not the default/admin
    $post = get_post($post_id);
    if ($post) {
        $author_id = $post->post_author;
        // If author is not admin (ID 1) and not the import user, consider it claimed
        // Adjust these IDs based on your setup
        $unclaimed_author_ids = array(1, 0); // Admin and system
        if (!in_array($author_id, $unclaimed_author_ids)) {
            return true;
        }
    }
    
    // Method 3: Check for claim custom field (if using a different system)
    $is_claimed_meta = get_post_meta($post_id, '_ynm_claimed', true);
    if ($is_claimed_meta) {
        return true;
    }
    
    // Not claimed
    return false;
}


/**
 * Get the claim URL for a studio
 * 
 * @param int $post_id The post ID
 * @return string The claim URL
 */
function ynm_get_claim_url($post_id) {
    // Method 1: GeoDirectory claim URL
    if (function_exists('geodir_claim_url')) {
        return geodir_claim_url($post_id);
    }
    
    // Method 2: GeoDirectory claim page with post ID
    $claim_page_id = geodir_get_option('claim_page');
    if ($claim_page_id) {
        return add_query_arg('listing_id', $post_id, get_permalink($claim_page_id));
    }
    
    // Method 3: Default claim page URL
    // Adjust this URL based on your claim page location
    return home_url('/claim-listing/?listing_id=' . $post_id);
}


// ============================================
// HERO BUTTONS SHORTCODE (BOTH BUTTONS)
// ============================================

/**
 * Shortcode: [ynm_hero_buttons]
 * Outputs both Book a Class and Claim buttons together
 */
function ynm_hero_buttons_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    // Parse attributes
    $atts = shortcode_atts(array(
        'book_text' => 'Book a Class',
        'claim_text' => 'Claim Your Studio',
        'verified_text' => 'Verified Studio'
    ), $atts);
    
    // Get booking URL
    $booking_url = ynm_get_booking_url($post->ID);
    
    // Check claim status
    $is_claimed = ynm_is_studio_claimed($post->ID);
    
    $output = '<div class="ynm-hero-buttons">';
    
    // Book a Class button (always shown)
    $output .= '<a href="' . esc_url($booking_url) . '" class="btn-book-class ynm-btn-book" target="_blank" rel="noopener">';
    $output .= '<span class="btn-icon">📅</span> ';
    $output .= '<span class="btn-text">' . esc_html($atts['book_text']) . '</span>';
    $output .= '</a>';
    
    // Claim button or Verified badge
    if ($is_claimed) {
        $output .= '<span class="ynm-verified-badge">' . esc_html($atts['verified_text']) . '</span>';
    } else {
        $claim_url = ynm_get_claim_url($post->ID);
        $output .= '<a href="' . esc_url($claim_url) . '" class="btn-claim-studio ynm-btn-claim">';
        $output .= '<span class="btn-icon">✓</span> ';
        $output .= '<span class="btn-text">' . esc_html($atts['claim_text']) . '</span>';
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('ynm_hero_buttons', 'ynm_hero_buttons_shortcode');


/**
 * Get booking URL for a studio
 * 
 * @param int $post_id The post ID
 * @return string The booking URL
 */
function ynm_get_booking_url($post_id) {
    // Try GeoDirectory custom field for booking URL
    if (function_exists('geodir_get_post_meta')) {
        $booking_url = geodir_get_post_meta($post_id, 'booking_url', true);
        if (!empty($booking_url)) {
            return $booking_url;
        }
        
        // Try website URL as fallback
        $website = geodir_get_post_meta($post_id, 'website', true);
        if (!empty($website)) {
            return $website;
        }
    }
    
    // Fallback to external site field
    $external_url = get_post_meta($post_id, '_external_url', true);
    if (!empty($external_url)) {
        return $external_url;
    }
    
    // Last resort: link to the listing itself
    return get_permalink($post_id) . '#contact';
}


// ============================================
// INLINE STYLES (Optional - if CSS not loaded)
// ============================================

/**
 * Add inline styles for buttons if needed
 */
function ynm_hero_buttons_inline_styles() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    ?>
    <style>
    .ynm-hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin: 16px 0;
    }
    
    .btn-book-class, .ynm-btn-book {
        background-color: #FF5733;
        color: #FFFFFF;
        border: 2px solid #FF5733;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-book-class:hover, .ynm-btn-book:hover {
        background-color: #E64A2E;
        border-color: #E64A2E;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 51, 0.3);
    }
    
    .btn-claim-studio, .ynm-btn-claim {
        background-color: #FFD966;
        color: #2C3E3A;
        border: 2px solid #FFD966;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-claim-studio:hover, .ynm-btn-claim:hover {
        background-color: #F5C842;
        border-color: #F5C842;
        color: #2C3E3A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 217, 102, 0.4);
    }
    
    .ynm-verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #61948B;
        color: #FFFFFF;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .ynm-verified-badge::before {
        content: "✓";
    }
    
    @media (max-width: 768px) {
        .ynm-hero-buttons {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-book-class, .btn-claim-studio, 
        .ynm-btn-book, .ynm-btn-claim {
            width: 100%;
            justify-content: center;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'ynm_hero_buttons_inline_styles', 100);

?>
