<?php
/**
 * YogaNearMe - Fix Rating/Review Mismatch
 *
 * PURPOSE: Prevents confusing display of "127 reviews" (Google) alongside
 * "No reviews yet" (GeoDirectory native). This creates a unified, clear
 * rating display strategy.
 *
 * STRATEGY:
 * 1. Hide GeoDirectory native rating widget when it has 0 reviews
 * 2. Show Google/Yelp ratings clearly labeled as external sources
 * 3. Only show "No reviews yet" if there are NO ratings from any source
 *
 * INSTALLATION: Add to your child theme's functions.php
 *
 * @package YogaNearMe
 * @since 1.0.0
 */

// ============================================
// OPTION 1: HIDE GEODIR RATING WHEN EMPTY
// ============================================

/**
 * Add body class when listing has no native reviews
 * but has Google/Yelp ratings
 */
function ynm_add_rating_body_classes($classes) {
    // Only on single listing pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $classes;
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return $classes;
    }

    $post_id = $post->ID;

    // Get GeoDirectory native review count
    $native_reviews = 0;
    if (function_exists('geodir_get_review_count')) {
        $native_reviews = geodir_get_review_count($post_id);
    }

    // Get Google rating
    $google_rating = geodir_get_post_meta($post_id, 'google_rating', true);
    if (empty($google_rating)) {
        $google_rating = geodir_get_post_meta($post_id, 'googlerating', true);
    }

    // Get Yelp rating
    $yelp_rating = geodir_get_post_meta($post_id, 'yelp_rating', true);
    if (empty($yelp_rating)) {
        $yelp_rating = geodir_get_post_meta($post_id, 'yelprating', true);
    }

    // Add appropriate classes
    if ($native_reviews == 0) {
        $classes[] = 'ynm-no-native-reviews';
    } else {
        $classes[] = 'ynm-has-native-reviews';
    }

    if (!empty($google_rating) || !empty($yelp_rating)) {
        $classes[] = 'ynm-has-external-ratings';
    }

    // Special case: has external but no native (the conflict scenario)
    if ($native_reviews == 0 && (!empty($google_rating) || !empty($yelp_rating))) {
        $classes[] = 'ynm-hide-empty-native-rating';
    }

    return $classes;
}
add_filter('body_class', 'ynm_add_rating_body_classes');


// ============================================
// OPTION 2: UNIFIED RATING SHORTCODE
// Use [ynm_unified_rating] in your template
// ============================================

/**
 * Display a unified rating that prioritizes available sources
 * Shows: Google/Yelp if available, native if available, or "No reviews" if none
 */
function ynm_unified_rating_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show_source' => 'true',  // Show "via Google" label
        'hide_if_empty' => 'false', // Hide completely if no ratings
    ), $atts);

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;

    // Gather all rating sources
    $ratings = array();

    // Google
    $google_rating = geodir_get_post_meta($post_id, 'google_rating', true);
    if (empty($google_rating)) {
        $google_rating = geodir_get_post_meta($post_id, 'googlerating', true);
    }
    $google_reviews = geodir_get_post_meta($post_id, 'google_reviews', true);
    if (empty($google_reviews)) {
        $google_reviews = geodir_get_post_meta($post_id, 'googlereviews', true);
    }
    if (!empty($google_rating)) {
        $ratings['google'] = array(
            'rating' => $google_rating,
            'count' => $google_reviews,
            'source' => 'Google',
            'icon' => 'fab fa-google',
            'color' => '#4285F4'
        );
    }

    // Yelp
    $yelp_rating = geodir_get_post_meta($post_id, 'yelp_rating', true);
    if (empty($yelp_rating)) {
        $yelp_rating = geodir_get_post_meta($post_id, 'yelprating', true);
    }
    $yelp_reviews = geodir_get_post_meta($post_id, 'yelp_reviews', true);
    if (empty($yelp_reviews)) {
        $yelp_reviews = geodir_get_post_meta($post_id, 'yelpreviews', true);
    }
    if (!empty($yelp_rating)) {
        $ratings['yelp'] = array(
            'rating' => $yelp_rating,
            'count' => $yelp_reviews,
            'source' => 'Yelp',
            'icon' => 'fab fa-yelp',
            'color' => '#D32323'
        );
    }

    // GeoDirectory native
    if (function_exists('geodir_get_post_rating') && function_exists('geodir_get_review_count')) {
        $native_rating = geodir_get_post_rating($post_id);
        $native_count = geodir_get_review_count($post_id);
        if ($native_rating > 0 && $native_count > 0) {
            $ratings['native'] = array(
                'rating' => number_format($native_rating, 1),
                'count' => $native_count,
                'source' => 'Community',
                'icon' => 'fas fa-users',
                'color' => '#5F7470'
            );
        }
    }

    // If no ratings and hide_if_empty, return nothing
    if (empty($ratings) && $atts['hide_if_empty'] === 'true') {
        return '';
    }

    // If no ratings, show placeholder
    if (empty($ratings)) {
        return '<span class="ynm-rating-empty">No reviews yet</span>';
    }

    // Build output - prioritize: Google > Yelp > Native
    $primary = isset($ratings['google']) ? $ratings['google'] :
               (isset($ratings['yelp']) ? $ratings['yelp'] :
               (isset($ratings['native']) ? $ratings['native'] : null));

    if (!$primary) {
        return '';
    }

    ob_start();
    ?>
    <div class="ynm-unified-rating">
        <span class="ynm-rating-stars">
            <?php echo ynm_render_stars($primary['rating']); ?>
        </span>
        <span class="ynm-rating-value"><?php echo esc_html($primary['rating']); ?></span>
        <?php if (!empty($primary['count'])): ?>
            <span class="ynm-rating-count">(<?php echo esc_html($primary['count']); ?> reviews)</span>
        <?php endif; ?>
        <?php if ($atts['show_source'] === 'true'): ?>
            <span class="ynm-rating-source" style="color: <?php echo esc_attr($primary['color']); ?>">
                <i class="<?php echo esc_attr($primary['icon']); ?>"></i>
                <?php echo esc_html($primary['source']); ?>
            </span>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_unified_rating', 'ynm_unified_rating_shortcode');


/**
 * Helper function to render star icons
 */
function ynm_render_stars($rating) {
    $rating = floatval($rating);
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5;
    $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

    $output = '';
    for ($i = 0; $i < $full_stars; $i++) {
        $output .= '<i class="fas fa-star" style="color:#F59E0B;"></i>';
    }
    if ($half_star) {
        $output .= '<i class="fas fa-star-half-alt" style="color:#F59E0B;"></i>';
    }
    for ($i = 0; $i < $empty_stars; $i++) {
        $output .= '<i class="far fa-star" style="color:#D1D5DB;"></i>';
    }
    return $output;
}


// ============================================
// OPTION 3: FILTER GEODIRECTORY OUTPUT
// Modify the native rating widget output
// ============================================

/**
 * Filter to hide "No reviews yet" when external ratings exist
 */
function ynm_filter_geodir_rating_output($output, $post_id) {
    // Check if we have external ratings
    $google_rating = geodir_get_post_meta($post_id, 'google_rating', true);
    if (empty($google_rating)) {
        $google_rating = geodir_get_post_meta($post_id, 'googlerating', true);
    }

    $yelp_rating = geodir_get_post_meta($post_id, 'yelp_rating', true);
    if (empty($yelp_rating)) {
        $yelp_rating = geodir_get_post_meta($post_id, 'yelprating', true);
    }

    // Get native review count
    $native_count = 0;
    if (function_exists('geodir_get_review_count')) {
        $native_count = geodir_get_review_count($post_id);
    }

    // If no native reviews but has external ratings, hide the widget output
    if ($native_count == 0 && (!empty($google_rating) || !empty($yelp_rating))) {
        return ''; // Return empty to hide
    }

    return $output;
}
// Note: This filter may need adjustment based on your GeoDirectory version
// Try one of these:
// add_filter('geodir_post_rating_html', 'ynm_filter_geodir_rating_output', 10, 2);
// add_filter('geodir_reviews_rating_output', 'ynm_filter_geodir_rating_output', 10, 2);


// ============================================
// ADD CSS FOR UNIFIED RATING DISPLAY
// ============================================

function ynm_rating_fix_styles() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    ?>
    <style>
    /* Hide GeoDirectory native rating when no native reviews but has external */
    body.ynm-hide-empty-native-rating .geodir-post-rating,
    body.ynm-hide-empty-native-rating .elementor-widget-geodir-post-rating,
    body.ynm-hide-empty-native-rating .geodir-rating-wrap,
    body.ynm-hide-empty-native-rating [class*="review-count"]:empty,
    body.ynm-hide-empty-native-rating .geodir-post-meta-rating {
        display: none !important;
    }

    /* Unified rating styles */
    .ynm-unified-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Inter', -apple-system, sans-serif;
    }

    .ynm-rating-stars {
        display: flex;
        gap: 2px;
    }

    .ynm-rating-stars i {
        font-size: 14px;
    }

    .ynm-rating-value {
        font-weight: 600;
        color: #2C3E3A;
    }

    .ynm-rating-count {
        color: #6B7C78;
        font-size: 0.9em;
    }

    .ynm-rating-source {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 0.85em;
        margin-left: 4px;
    }

    .ynm-rating-source i {
        font-size: 12px;
    }

    .ynm-rating-empty {
        color: #9CA3AF;
        font-style: italic;
    }
    </style>
    <?php
}
add_action('wp_head', 'ynm_rating_fix_styles');
