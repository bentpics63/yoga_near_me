<?php
/**
 * YogaNearMe.info - Hero Gallery Shortcode
 *
 * Displays the small gallery thumbnail with "+X Photos" overlay
 * Used in the 70/30 hero layout alongside the main GD Post Images widget
 *
 * INSTALLATION:
 * Paste this code into your child theme's functions.php
 *
 * USAGE IN ELEMENTOR:
 * Add a Shortcode widget with: [ynm_hero_gallery]
 */

// ============================================
// HERO GALLERY SHORTCODE
// ============================================

/**
 * Shortcode: [ynm_hero_gallery]
 * Displays gallery thumbnail with photo count overlay
 *
 * Attributes:
 * - fallback_image: URL of fallback image if no photos (default: placeholder)
 * - min_photos: Minimum photos to show the overlay count (default: 2)
 */
function ynm_hero_gallery_shortcode($atts) {
    // Only works on GeoDirectory detail pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    // Parse attributes
    $atts = shortcode_atts(array(
        'fallback_image' => '',
        'min_photos' => 2
    ), $atts);

    // Get listing images
    $images = ynm_get_listing_images($post->ID);
    $image_count = count($images);

    // If no images, show placeholder or nothing
    if ($image_count === 0) {
        if (!empty($atts['fallback_image'])) {
            return ynm_render_gallery_thumbnail($atts['fallback_image'], 0, $post->ID);
        }
        return ynm_render_gallery_placeholder();
    }

    // Get the second image for thumbnail (or first if only one)
    $thumbnail_index = ($image_count > 1) ? 1 : 0;
    $thumbnail_url = $images[$thumbnail_index];

    return ynm_render_gallery_thumbnail($thumbnail_url, $image_count, $post->ID);
}
add_shortcode('ynm_hero_gallery', 'ynm_hero_gallery_shortcode');


/**
 * Get all images for a GeoDirectory listing
 *
 * @param int $post_id The post ID
 * @return array Array of image URLs
 */
function ynm_get_listing_images($post_id) {
    $images = array();

    // Method 1: GeoDirectory post images
    if (function_exists('geodir_get_images')) {
        $gd_images = geodir_get_images($post_id);
        if (!empty($gd_images)) {
            foreach ($gd_images as $img) {
                if (isset($img->src)) {
                    $images[] = $img->src;
                }
            }
        }
    }

    // Method 2: Try geodir_get_post_meta for featured image
    if (empty($images) && function_exists('geodir_get_post_meta')) {
        $featured = geodir_get_post_meta($post_id, 'featured_image', true);
        if (!empty($featured)) {
            $images[] = $featured;
        }
    }

    // Method 3: WordPress featured image fallback
    if (empty($images)) {
        $thumbnail_id = get_post_thumbnail_id($post_id);
        if ($thumbnail_id) {
            $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'large');
            if ($thumbnail_url) {
                $images[] = $thumbnail_url;
            }
        }
    }

    return $images;
}


/**
 * Render the gallery thumbnail HTML
 *
 * @param string $image_url The thumbnail image URL
 * @param int $count Total image count
 * @param int $post_id The post ID for gallery link
 * @return string HTML output
 */
function ynm_render_gallery_thumbnail($image_url, $count, $post_id) {
    // Build gallery trigger - uses GeoDirectory's lightbox or custom
    $gallery_link = '#gallery-' . $post_id;

    $output = '<div class="ynm-hero-gallery-thumbnail">';
    $output .= '<a href="' . esc_url($gallery_link) . '" class="gallery-trigger" data-post-id="' . esc_attr($post_id) . '" data-lightbox="gallery">';
    $output .= '<img src="' . esc_url($image_url) . '" alt="View gallery" loading="lazy">';

    // Show count overlay if more than 1 photo
    if ($count > 1) {
        $output .= '<div class="gallery-more">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zM4 10h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 16h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/></svg>';
        $output .= '<span>+' . ($count - 1) . ' Photos</span>';
        $output .= '</div>';
    }

    $output .= '</a>';
    $output .= '</div>';

    return $output;
}


/**
 * Render placeholder when no images available
 *
 * @return string HTML output
 */
function ynm_render_gallery_placeholder() {
    $output = '<div class="ynm-hero-gallery-thumbnail placeholder">';
    $output .= '<div class="placeholder-content">';
    $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48" height="48"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>';
    $output .= '<span>No photos yet</span>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}


// ============================================
// INLINE STYLES
// ============================================

/**
 * Add inline styles for hero gallery thumbnail
 */
function ynm_hero_gallery_inline_styles() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    ?>
    <style>
    /* Hero Gallery Thumbnail - 30% column */
    .ynm-hero-gallery-thumbnail {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 250px;
        border-radius: 12px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .ynm-hero-gallery-thumbnail a {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
    }

    .ynm-hero-gallery-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .ynm-hero-gallery-thumbnail:hover img {
        transform: scale(1.05);
    }

    /* "+X Photos" overlay */
    .ynm-hero-gallery-thumbnail .gallery-more {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        gap: 8px;
        transition: background 0.3s ease;
    }

    .ynm-hero-gallery-thumbnail:hover .gallery-more {
        background: rgba(0, 0, 0, 0.65);
    }

    .ynm-hero-gallery-thumbnail .gallery-more svg {
        width: 32px;
        height: 32px;
        fill: currentColor;
    }

    /* Placeholder state */
    .ynm-hero-gallery-thumbnail.placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8e8e8;
    }

    .ynm-hero-gallery-thumbnail .placeholder-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: #999;
    }

    .ynm-hero-gallery-thumbnail .placeholder-content svg {
        fill: #ccc;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ynm-hero-gallery-thumbnail {
            min-height: 150px;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'ynm_hero_gallery_inline_styles', 100);


// ============================================
// JAVASCRIPT FOR GALLERY TRIGGER
// ============================================

/**
 * Add JavaScript to trigger GeoDirectory's lightbox gallery
 */
function ynm_hero_gallery_scripts() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find gallery triggers
        var galleryTriggers = document.querySelectorAll('.ynm-hero-gallery-thumbnail .gallery-trigger');

        galleryTriggers.forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();

                // Try to find and click GeoDirectory's gallery trigger
                var gdGalleryLink = document.querySelector('.geodir-post-slider a, .geodir-images a, [data-lity], .gd-image-gallery a');
                if (gdGalleryLink) {
                    gdGalleryLink.click();
                    return;
                }

                // Fallback: Try to trigger lightbox directly
                var postId = this.getAttribute('data-post-id');
                if (typeof lity !== 'undefined') {
                    // If Lity lightbox is available
                    var firstImage = document.querySelector('.geodir-post-slider img, .geodir-images img');
                    if (firstImage && firstImage.src) {
                        lity(firstImage.src);
                    }
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'ynm_hero_gallery_scripts', 100);