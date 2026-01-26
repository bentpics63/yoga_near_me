<?php
/**
 * YogaNearMe.info - Yoga Styles Section Shortcode
 *
 * Creates a shortcode [ynm_yoga_styles] that displays yoga styles
 * from the GeoDirectory database as styled pill badges.
 *
 * INSTALLATION:
 * Paste this code into your child theme's functions.php
 *
 * USAGE IN ELEMENTOR:
 * Add a Shortcode widget with: [ynm_yoga_styles]
 *
 * OPTIONS:
 * [ynm_yoga_styles show_links="true"]  - Link badges to style pages (default: true)
 * [ynm_yoga_styles show_icons="true"]  - Show star icons (default: true)
 * [ynm_yoga_styles show_heading="true"] - Show section heading (default: false)
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Yoga Styles Section Shortcode
 * Displays yoga styles from GeoDirectory listing as styled pill badges
 */
function ynm_yoga_styles_shortcode($atts) {
    // Only works on GeoDirectory detail pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'show_links'   => 'true',
        'show_icons'   => 'true',
        'show_heading' => 'false',
        'heading_text' => 'Yoga Styles Offered',
        'class'        => 'ynm-yoga-styles-section'
    ), $atts);

    $post_id = $post->ID;

    // Get yoga styles from GeoDirectory - try multiple field names
    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);

    // Fallback field names
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'styles', true);
    }
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yoga_style', true);
    }

    // Also check gd_post object
    if (empty($yoga_styles) && isset($gd_post)) {
        if (isset($gd_post->yoga_styles)) {
            $yoga_styles = $gd_post->yoga_styles;
        } elseif (isset($gd_post->yogastyles)) {
            $yoga_styles = $gd_post->yogastyles;
        }
    }

    // Return empty if no styles found
    if (empty($yoga_styles)) {
        return '';
    }

    // Parse yoga styles into array
    $styles_array = ynm_parse_yoga_styles($yoga_styles);

    if (empty($styles_array)) {
        return '';
    }

    // Get style page URL mappings and display names
    $style_urls = ynm_get_yoga_style_urls();
    $style_labels = ynm_get_yoga_style_labels();

    // Build output
    ob_start();

    // Include inline styles (can be removed if CSS is loaded separately)
    ynm_yoga_styles_inline_css();

    ?>
    <div class="<?php echo esc_attr($atts['class']); ?>">
        <?php if ($atts['show_heading'] === 'true'): ?>
        <h3 class="ynm-yoga-styles-heading"><?php echo esc_html($atts['heading_text']); ?></h3>
        <?php endif; ?>

        <div class="ynm-yoga-styles-container">
            <?php foreach ($styles_array as $style):
                $style_clean = trim($style);
                $style_slug = sanitize_title($style_clean);
                $style_url = isset($style_urls[$style_clean]) ? $style_urls[$style_clean] : (isset($style_urls[$style_slug]) ? $style_urls[$style_slug] : '');
                $display_name = isset($style_labels[$style_clean]) ? $style_labels[$style_clean] : ucwords(str_replace(array('-', '_', '/'), ' ', $style_clean));
                $show_link = ($atts['show_links'] === 'true' && !empty($style_url));
                $show_icon = ($atts['show_icons'] === 'true');
            ?>
                <?php if ($show_link): ?>
                <a href="<?php echo esc_url($style_url); ?>" class="ynm-yoga-style-badge<?php echo $show_icon ? ' with-icon' : ''; ?>">
                    <?php if ($show_icon): ?><span class="style-icon">&#9733;</span><?php endif; ?>
                    <span class="style-name"><?php echo esc_html($display_name); ?></span>
                </a>
                <?php else: ?>
                <span class="ynm-yoga-style-badge<?php echo $show_icon ? ' with-icon' : ''; ?>">
                    <?php if ($show_icon): ?><span class="style-icon">&#9733;</span><?php endif; ?>
                    <span class="style-name"><?php echo esc_html($display_name); ?></span>
                </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('ynm_yoga_styles', 'ynm_yoga_styles_shortcode');


/**
 * Parse yoga styles from various formats into array
 */
function ynm_parse_yoga_styles($yoga_styles) {
    // Already an array
    if (is_array($yoga_styles)) {
        return array_filter(array_map('trim', $yoga_styles));
    }

    // Try JSON decode (GeoDirectory sometimes stores as JSON)
    $decoded = json_decode($yoga_styles, true);
    if (is_array($decoded)) {
        return array_filter(array_map('trim', $decoded));
    }

    // Try unserialize (WordPress serialized array)
    $unserialized = @unserialize($yoga_styles);
    if (is_array($unserialized)) {
        return array_filter(array_map('trim', $unserialized));
    }

    // Comma-separated string
    if (strpos($yoga_styles, ',') !== false) {
        return array_filter(array_map('trim', explode(',', $yoga_styles)));
    }

    // Pipe-separated string (some GeoDirectory fields use this)
    if (strpos($yoga_styles, '|') !== false) {
        return array_filter(array_map('trim', explode('|', $yoga_styles)));
    }

    // Semicolon-separated string
    if (strpos($yoga_styles, ';') !== false) {
        return array_filter(array_map('trim', explode(';', $yoga_styles)));
    }

    // Single value
    if (!empty(trim($yoga_styles))) {
        return array(trim($yoga_styles));
    }

    return array();
}


/**
 * Get yoga style page URL mappings
 * Maps style names to their corresponding style pages on the site
 */
function ynm_get_yoga_style_urls() {
    $base_url = home_url('/yoga-styles/');

    return array(
        // GeoDirectory field slugs (exact matches from database)
        'hot-yoga/26+2'     => $base_url . 'hot-yoga/',
        'vinyassa-yoga'     => $base_url . 'vinyasa/',
        'hatha-yoga'        => $base_url . 'hatha/',
        'yin-yoga'          => $base_url . 'yin/',
        'prenatal_yoga'     => $base_url . 'prenatal/',
        'ashtanga-yoga'     => $base_url . 'ashtanga/',
        'restorative-yoga'  => $base_url . 'restorative/',
        'kundalini'         => $base_url . 'kundalini/',
        'rocket_yoga'       => $base_url . 'rocket/',
        'aerial_yoga'       => $base_url . 'aerial/',
        'iyengar_yoga'      => $base_url . 'iyengar/',
        'power_yoga'        => $base_url . 'power-yoga/',
        'kriya_yoga'        => $base_url . 'kriya/',
        'dharma_yoga'       => $base_url . 'dharma/',
        // Additional styles
        'yoga_nidra'        => $base_url . 'yoga-nidra/',
        'chair_yoga'        => $base_url . 'chair-yoga/',
        'kids_yoga'         => $base_url . 'kids-yoga/',
        'jivamukti'         => $base_url . 'jivamukti/',
        'anusara'           => $base_url . 'anusara/',
        'forrest_yoga'      => $base_url . 'forrest/',
        'sivananda'         => $base_url . 'sivananda/',
        'viniyoga'          => $base_url . 'viniyoga/',
        'kripalu'           => $base_url . 'kripalu/',
        'acro_yoga'         => $base_url . 'acro-yoga/',
        'Baptiste'          => $base_url . 'baptiste/',
        'core_power'        => $base_url . 'corepower/',
        'sculpt'            => $base_url . 'sculpt/',
        'gentle_yoga'       => $base_url . 'gentle/',
        'slow_flow'         => $base_url . 'slow-flow/',
        'flow'              => $base_url . 'vinyasa/',
        'mysore'            => $base_url . 'ashtanga/',
        'therapeutic'       => $base_url . 'therapeutic/',
        'trauma_informed'   => $base_url . 'trauma-informed/',
    );
}


/**
 * Get yoga style display labels
 * Maps slugs to their proper display names
 */
function ynm_get_yoga_style_labels() {
    return array(
        // Current GeoDirectory options (exact slug => display name)
        'hot-yoga/26+2'     => 'Hot Yoga (26+2)',
        'vinyassa-yoga'     => 'Vinyasa',
        'hatha-yoga'        => 'Hatha',
        'yin-yoga'          => 'Yin',
        'prenatal_yoga'     => 'Prenatal',
        'ashtanga-yoga'     => 'Ashtanga',
        'restorative-yoga'  => 'Restorative',
        'kundalini'         => 'Kundalini',
        'rocket_yoga'       => 'Rocket',
        'aerial_yoga'       => 'Aerial',
        'iyengar_yoga'      => 'Iyengar',
        'power_yoga'        => 'Power Yoga',
        'kriya_yoga'        => 'Kriya',
        'dharma_yoga'       => 'Dharma',
        // Additional styles
        'yoga_nidra'        => 'Yoga Nidra',
        'chair_yoga'        => 'Chair Yoga',
        'kids_yoga'         => 'Kids Yoga',
        'jivamukti'         => 'Jivamukti',
        'anusara'           => 'Anusara',
        'forrest_yoga'      => 'Forrest Yoga',
        'sivananda'         => 'Sivananda',
        'viniyoga'          => 'Viniyoga',
        'kripalu'           => 'Kripalu',
        'acro_yoga'         => 'AcroYoga',
        'baptiste'          => 'Baptiste',
        'core_power'        => 'CorePower',
        'sculpt'            => 'Yoga Sculpt',
        'gentle_yoga'       => 'Gentle Yoga',
        'slow_flow'         => 'Slow Flow',
        'flow'              => 'Flow',
        'mysore'            => 'Mysore',
        'therapeutic'       => 'Therapeutic Yoga',
        'trauma_informed'   => 'Trauma-Informed',
    );
}


/**
 * Inline CSS for yoga styles badges
 * Matches the design system from CONTENT-SECTIONS-CSS-TO-COPY.txt
 */
function ynm_yoga_styles_inline_css() {
    static $css_output = false;

    // Only output CSS once per page
    if ($css_output) {
        return;
    }
    $css_output = true;
    ?>
    <style>
    /* Yoga Styles Section */
    .ynm-yoga-styles-section {
        margin-bottom: 24px;
    }

    .ynm-yoga-styles-heading {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: #2C3E3A;
        margin: 0 0 16px 0;
        padding-left: 20px;
        position: relative;
    }

    .ynm-yoga-styles-heading::before {
        content: "\25CF";
        color: #FF5733;
        font-size: 10px;
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Yoga Styles Container */
    .ynm-yoga-styles-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    /* Individual Yoga Style Badge */
    .ynm-yoga-style-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        border-radius: 24px;
        border: 2px solid #61948B;
        background: #FFFFFF;
        color: #61948B;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: default;
    }

    /* Clickable badge (link) */
    a.ynm-yoga-style-badge {
        cursor: pointer;
    }

    a.ynm-yoga-style-badge:hover {
        background: #61948B;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(97, 148, 139, 0.25);
    }

    a.ynm-yoga-style-badge:hover .style-icon {
        color: #FFFFFF;
    }

    /* Star icon */
    .ynm-yoga-style-badge .style-icon {
        font-size: 12px;
        color: #61948B;
        line-height: 1;
        transition: color 0.2s ease;
    }

    /* Style name */
    .ynm-yoga-style-badge .style-name {
        line-height: 1.2;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ynm-yoga-styles-container {
            gap: 8px;
        }

        .ynm-yoga-style-badge {
            padding: 8px 14px;
            font-size: 13px;
        }

        .ynm-yoga-style-badge .style-icon {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .ynm-yoga-style-badge {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 20px;
        }
    }
    </style>
    <?php
}


/**
 * Yoga Styles Card Shortcode (with heading and card styling)
 * Use: [ynm_yoga_styles_card]
 */
function ynm_yoga_styles_card_shortcode($atts) {
    // Only works on GeoDirectory detail pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;

    // Get yoga styles
    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }
    if (empty($yoga_styles) && isset($gd_post) && isset($gd_post->yoga_styles)) {
        $yoga_styles = $gd_post->yoga_styles;
    }

    // Return empty if no styles
    if (empty($yoga_styles)) {
        return '';
    }

    $styles_array = ynm_parse_yoga_styles($yoga_styles);

    if (empty($styles_array)) {
        return '';
    }

    $style_urls = ynm_get_yoga_style_urls();

    ob_start();
    ynm_yoga_styles_inline_css();
    ?>
    <style>
    .ynm-yoga-styles-card {
        background: #FFFFFF;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: 1px solid #E0E0E0;
    }
    .ynm-yoga-styles-card-title {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #222;
        margin: 0 0 16px;
        padding: 0 0 12px;
        border-bottom: 1px solid #E0E0E0;
    }
    </style>
    <div class="ynm-yoga-styles-card">
        <h3 class="ynm-yoga-styles-card-title">Yoga Styles Offered</h3>
        <div class="ynm-yoga-styles-container">
            <?php foreach ($styles_array as $style):
                $style_clean = trim($style);
                $style_slug = sanitize_title($style_clean);
                $style_url = isset($style_urls[$style_slug]) ? $style_urls[$style_slug] : '';
            ?>
                <?php if (!empty($style_url)): ?>
                <a href="<?php echo esc_url($style_url); ?>" class="ynm-yoga-style-badge with-icon">
                    <span class="style-icon">&#9733;</span>
                    <span class="style-name"><?php echo esc_html($style_clean); ?></span>
                </a>
                <?php else: ?>
                <span class="ynm-yoga-style-badge with-icon">
                    <span class="style-icon">&#9733;</span>
                    <span class="style-name"><?php echo esc_html($style_clean); ?></span>
                </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('ynm_yoga_styles_card', 'ynm_yoga_styles_card_shortcode');


/**
 * Helper function to check if a studio has yoga styles
 * Can be used in templates: if (ynm_studio_has_yoga_styles()) { ... }
 */
function ynm_studio_has_yoga_styles($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
    }

    if (!$post_id) {
        return false;
    }

    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }

    return !empty($yoga_styles);
}


/**
 * Get yoga styles for a studio as array
 * Can be used in templates: $styles = ynm_get_studio_yoga_styles();
 */
function ynm_get_studio_yoga_styles($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
    }

    if (!$post_id) {
        return array();
    }

    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }

    return ynm_parse_yoga_styles($yoga_styles);
}
