<?php
/**
 * ==========================================================================
 * YOGANEARME.INFO - Video Section Conditional Display
 * ==========================================================================
 *
 * Displays the video section only for Visibility tier studios.
 * Shows an upgrade prompt to Community tier studios (when logged in as owner).
 *
 * INSTALLATION:
 * Add this code to your theme's functions.php or a site-specific plugin.
 *
 * USAGE:
 * Use the shortcode [ynm_video_section] in your single listing template,
 * or call ynm_render_video_section() directly in template files.
 *
 * PLACEMENT: Below intro offer section, above About section
 *
 * ==========================================================================
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuration - Update these IDs after creating packages in GeoDirectory
 */
define('YNM_COMMUNITY_PACKAGE_ID', 1);  // Free tier
define('YNM_VISIBILITY_PACKAGE_ID', 2); // $29/mo tier

/**
 * Render the video section based on tier
 *
 * @param int|null $post_id Optional post ID, defaults to current post
 * @return string HTML output
 */
function ynm_render_video_section($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }

    // Get listing data
    $package_id = geodir_get_post_meta($post_id, 'package_id', true);
    $video_url = geodir_get_post_meta($post_id, 'video_url', true);
    $studio_name = get_the_title($post_id);

    // Check if this is a Visibility tier listing
    $is_visibility = ($package_id == YNM_VISIBILITY_PACKAGE_ID);

    // Check if current user is the listing owner
    $is_owner = is_user_logged_in() && (get_current_user_id() == get_post_field('post_author', $post_id));

    // Scenario 1: Visibility tier with video URL
    if ($is_visibility && !empty($video_url)) {
        return ynm_video_embed_html($video_url, $studio_name);
    }

    // Scenario 2: Visibility tier without video URL (owner sees prompt to add)
    if ($is_visibility && empty($video_url) && $is_owner) {
        return ynm_video_add_prompt_html();
    }

    // Scenario 3: Community tier owner sees upgrade prompt
    if (!$is_visibility && $is_owner) {
        return ynm_video_upgrade_prompt_html();
    }

    // Scenario 4: Community tier visitor or not owner - show nothing
    return '';
}

/**
 * Generate video embed HTML
 *
 * @param string $video_url YouTube or Vimeo URL
 * @param string $studio_name For accessibility
 * @return string HTML
 */
function ynm_video_embed_html($video_url, $studio_name) {
    $embed_url = ynm_get_embed_url($video_url);
    $provider = ynm_detect_video_provider($video_url);
    $thumbnail_url = ynm_get_video_thumbnail($video_url);

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Studio Video">
        <div class="ynm-video-section__header">
            <div class="ynm-video-section__icon">🎥</div>
            <div>
                <h3 class="ynm-video-section__title">Take a Virtual Tour</h3>
                <p class="ynm-video-section__subtitle">See what <?php echo esc_html($studio_name); ?> is all about</p>
            </div>
            <span class="ynm-visibility-badge">Featured Studio</span>
        </div>

        <div class="ynm-video-embed" data-provider="<?php echo esc_attr($provider); ?>">
            <?php if ($thumbnail_url && $embed_url): ?>
                <!-- Lazy load: Show thumbnail, load iframe on click -->
                <div class="ynm-video-thumbnail"
                     style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"
                     data-embed-url="<?php echo esc_url($embed_url); ?>"
                     onclick="ynmLoadVideo(this)"
                     role="button"
                     tabindex="0"
                     aria-label="Play video tour of <?php echo esc_attr($studio_name); ?>">
                    <div class="ynm-video-play-btn" aria-hidden="true"></div>
                </div>
            <?php elseif ($embed_url): ?>
                <!-- Direct embed if no thumbnail -->
                <iframe
                    src="<?php echo esc_url($embed_url); ?>"
                    title="Video tour of <?php echo esc_attr($studio_name); ?>"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            <?php endif; ?>
        </div>
    </section>

    <script>
    function ynmLoadVideo(thumbnail) {
        const embedUrl = thumbnail.dataset.embedUrl + '?autoplay=1';
        const container = thumbnail.parentElement;
        const iframe = document.createElement('iframe');
        iframe.src = embedUrl;
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
        iframe.setAttribute('allowfullscreen', '');
        iframe.setAttribute('title', 'Studio video');
        container.innerHTML = '';
        container.appendChild(iframe);

        // Track video play event
        if (typeof gtag !== 'undefined') {
            gtag('event', 'video_play', {
                'event_category': 'engagement',
                'event_label': '<?php echo esc_js($studio_name); ?>',
                'listing_id': <?php echo intval($post_id); ?>
            });
        }
    }
    </script>
    <?php
    return ob_get_clean();
}

/**
 * Generate "add video" prompt for Visibility owners without video
 *
 * @return string HTML
 */
function ynm_video_add_prompt_html() {
    $edit_url = geodir_edit_post_link(get_the_ID());

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Add Video">
        <div class="ynm-upgrade-prompt">
            <div class="ynm-upgrade-prompt__icon">🎬</div>
            <h3 class="ynm-upgrade-prompt__title">Add Your Studio Video</h3>
            <p class="ynm-upgrade-prompt__text">
                As a Visibility member, you can showcase a YouTube or Vimeo video on your listing.
                Give students a virtual tour of your space!
            </p>
            <a href="<?php echo esc_url($edit_url); ?>" class="ynm-upgrade-prompt__btn">
                Edit Listing
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Generate upgrade prompt for Community tier owners
 *
 * @return string HTML
 */
function ynm_video_upgrade_prompt_html() {
    $upgrade_url = home_url('/upgrade/'); // Update with actual upgrade page URL

    ob_start();
    ?>
    <section class="ynm-video-section" aria-label="Upgrade Prompt">
        <div class="ynm-upgrade-prompt">
            <div class="ynm-upgrade-prompt__icon">🎥</div>
            <h3 class="ynm-upgrade-prompt__title">Want to Add a Video?</h3>
            <p class="ynm-upgrade-prompt__text">
                Visibility members can embed a YouTube or Vimeo video to give students
                a virtual tour of their studio space.
            </p>
            <a href="<?php echo esc_url($upgrade_url); ?>" class="ynm-upgrade-prompt__btn">
                Upgrade to Visibility
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Convert video URL to embed URL
 *
 * @param string $url YouTube or Vimeo URL
 * @return string Embed URL
 */
function ynm_get_embed_url($url) {
    // YouTube
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return $url; // Already an embed URL
    }

    // Vimeo
    if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
        return 'https://player.vimeo.com/video/' . $matches[1];
    }
    if (preg_match('/player\.vimeo\.com\/video\/([0-9]+)/', $url, $matches)) {
        return $url; // Already an embed URL
    }

    return ''; // Unsupported URL
}

/**
 * Detect video provider
 *
 * @param string $url Video URL
 * @return string Provider name
 */
function ynm_detect_video_provider($url) {
    if (strpos($url, 'youtube') !== false || strpos($url, 'youtu.be') !== false) {
        return 'youtube';
    }
    if (strpos($url, 'vimeo') !== false) {
        return 'vimeo';
    }
    return 'unknown';
}

/**
 * Get video thumbnail URL
 *
 * @param string $url Video URL
 * @return string Thumbnail URL
 */
function ynm_get_video_thumbnail($url) {
    // YouTube
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches) ||
        preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches) ||
        preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        // Use maxresdefault for high quality, fall back to hqdefault
        return 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
    }

    // Vimeo - would need API call for thumbnail, return empty for now
    // You could implement this with Vimeo's oEmbed API if needed

    return '';
}

/**
 * Register shortcode
 */
function ynm_video_section_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => null
    ), $atts);

    return ynm_render_video_section($atts['id']);
}
add_shortcode('ynm_video_section', 'ynm_video_section_shortcode');

/**
 * Add video section to single listing template via hook
 * Uncomment and adjust priority based on your theme's structure
 */
// add_action('geodir_details_main_content', 'ynm_auto_insert_video_section', 45);
function ynm_auto_insert_video_section() {
    if (is_singular('gd_place')) {
        echo ynm_render_video_section();
    }
}

/**
 * Enqueue video section CSS
 */
function ynm_enqueue_video_section_styles() {
    if (is_singular('gd_place')) {
        // If CSS is in theme
        // wp_enqueue_style('ynm-video-section', get_stylesheet_directory_uri() . '/css/VIDEO-SECTION.css', array(), '1.0.0');

        // Or add inline styles if not using separate file
        // Styles are in VIDEO-SECTION.css - add to Additional CSS in Customizer
    }
}
add_action('wp_enqueue_scripts', 'ynm_enqueue_video_section_styles');

/**
 * Example: How to use in a template file
 *
 * <?php
 * // In your single listing template (e.g., single-gd_place.php)
 *
 * // After intro offer section...
 * echo ynm_render_video_section();
 * // Before about section...
 *
 * ?>
 *
 * OR use the shortcode in Elementor/page builder:
 * [ynm_video_section]
 */
