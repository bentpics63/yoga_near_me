# Hero Image Gallery - WordPress Integration Guide

## Overview

70/30 split hero image gallery for single studio pages with:
- **70%** main hero image (left)
- **30%** thumbnail column (right) - stacked vertically
- Auto-rotating thumbnails (paid tier only)
- Lightbox gallery with keyboard + swipe navigation
- Free tier: 2 images + upgrade CTA
- Paid tier: Up to 12 images

---

## Files

| File | Purpose |
|------|---------|
| `hero-image-gallery.html` | Full working prototype (standalone demo) |
| `hero-image-gallery.css` | CSS for WordPress (add to Additional CSS) |
| `hero-image-gallery.js` | JavaScript for WordPress (add to theme or plugin) |

---

## Installation Steps

### Step 1: Add CSS

**Option A: WordPress Customizer**
1. Go to Appearance > Customize > Additional CSS
2. Paste contents of `hero-image-gallery.css`
3. Publish

**Option B: Child Theme**
Add to your child theme's `style.css` or enqueue separately.

### Step 2: Add JavaScript

**Option A: Code Snippets Plugin**
1. Install "Code Snippets" plugin
2. Create new snippet (JavaScript, Frontend)
3. Paste contents of `hero-image-gallery.js`
4. Activate

**Option B: Child Theme**
```php
// In functions.php
function enqueue_hero_gallery_scripts() {
    if (is_singular('gd_place')) { // Only on single studio pages
        wp_enqueue_script(
            'studio-hero-gallery',
            get_stylesheet_directory_uri() . '/js/hero-image-gallery.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_hero_gallery_scripts');
```

### Step 3: Add Font Awesome (if not already loaded)
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

---

## HTML Structure

### Paid Tier (Full Gallery)

```html
<div class="studio-hero-gallery" data-images='["url1.jpg","url2.jpg","url3.jpg"]'>
    <!-- Main Hero (70%) -->
    <div class="hero-main">
        <img src="hero-image.jpg" alt="Studio Name">
    </div>

    <!-- Thumbnails (30%) -->
    <div class="hero-thumbnails">
        <div class="thumbnail-slot rotating">
            <img src="thumb1.jpg" alt="Studio Interior">
        </div>
        <div class="thumbnail-slot">
            <img src="thumb2.jpg" alt="Yoga Class">
            <span class="image-count"><i class="fas fa-images"></i> +10 more</span>
        </div>
        <div class="view-all-btn">
            <a href="#">
                <i class="fas fa-images"></i> View all 12 photos
            </a>
        </div>
    </div>
</div>
```

### Free Tier (2 Images + Upgrade)

```html
<div class="studio-hero-gallery free-tier">
    <!-- Main Hero (70%) -->
    <div class="hero-main">
        <img src="hero-image.jpg" alt="Studio Name">
    </div>

    <!-- Thumbnails (30%) -->
    <div class="hero-thumbnails">
        <div class="thumbnail-slot">
            <img src="thumb1.jpg" alt="Studio Interior">
        </div>
        <div class="thumbnail-slot upgrade-slot">
            <img src="placeholder.jpg" alt="" style="filter: blur(3px);">
            <a href="/upgrade/" class="upgrade-overlay">
                <i class="fas fa-camera"></i>
                <span class="upgrade-text">Add More Photos</span>
                <span class="upgrade-count">Upgrade for 12 photos</span>
            </a>
        </div>
    </div>
</div>
```

---

## GeoDirectory Integration

### PHP Template Code

```php
<?php
// Get listing images from GeoDirectory
$post_images = geodir_get_images($gd_post->ID, 'full', 12);
$images = array();

if (!empty($post_images)) {
    foreach ($post_images as $img) {
        $images[] = $img->src;
    }
}

$is_paid = geodir_is_paid_listing($gd_post->ID); // Your paid check logic
$image_count = count($images);
?>

<div class="studio-hero-gallery <?php echo !$is_paid ? 'free-tier' : ''; ?>"
     data-images='<?php echo json_encode($images); ?>'>

    <!-- Main Hero -->
    <div class="hero-main">
        <?php if (!empty($images[0])): ?>
            <img src="<?php echo esc_url($images[0]); ?>"
                 alt="<?php echo esc_attr($gd_post->post_title); ?>">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg"
                 alt="No image available">
        <?php endif; ?>
    </div>

    <!-- Thumbnails -->
    <div class="hero-thumbnails">
        <?php if ($is_paid && $image_count > 1): ?>
            <!-- Paid: Show rotating thumbnail -->
            <div class="thumbnail-slot rotating">
                <img src="<?php echo esc_url($images[1]); ?>" alt="Gallery image">
            </div>
            <div class="thumbnail-slot">
                <?php if (!empty($images[2])): ?>
                    <img src="<?php echo esc_url($images[2]); ?>" alt="Gallery image">
                <?php endif; ?>
                <?php if ($image_count > 3): ?>
                    <span class="image-count">
                        <i class="fas fa-images"></i> +<?php echo $image_count - 3; ?> more
                    </span>
                <?php endif; ?>
            </div>
            <div class="view-all-btn">
                <a href="#">
                    <i class="fas fa-images"></i> View all <?php echo $image_count; ?> photos
                </a>
            </div>
        <?php else: ?>
            <!-- Free: Show 1 thumbnail + upgrade CTA -->
            <div class="thumbnail-slot">
                <?php if (!empty($images[1])): ?>
                    <img src="<?php echo esc_url($images[1]); ?>" alt="Gallery image">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg"
                         alt="Placeholder">
                <?php endif; ?>
            </div>
            <div class="thumbnail-slot upgrade-slot">
                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder-blur.jpg"
                     alt="" style="filter: blur(3px);">
                <a href="/upgrade/" class="upgrade-overlay">
                    <i class="fas fa-camera"></i>
                    <span class="upgrade-text">Add More Photos</span>
                    <span class="upgrade-count">Upgrade for 12 photos</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
```

---

## JavaScript API

The gallery exposes a global `StudioHeroGallery` object:

```javascript
// Open lightbox at specific image index
StudioHeroGallery.openLightbox(0);

// Close lightbox
StudioHeroGallery.closeLightbox();

// Set images programmatically (for AJAX-loaded content)
StudioHeroGallery.setImages(['url1.jpg', 'url2.jpg', 'url3.jpg']);

// Pause/resume auto-rotation
StudioHeroGallery.pauseRotation();
StudioHeroGallery.resumeRotation();

// Re-initialize (after dynamic content load)
StudioHeroGallery.init();
```

---

## Customization

### Change Rotation Speed

In `hero-image-gallery.js`, modify:
```javascript
const CONFIG = {
    rotationInterval: 4000,  // Change to desired ms (e.g., 5000 for 5 seconds)
    // ...
};
```

### Change Colors

In `hero-image-gallery.css`, modify:
```css
/* Accent color (progress bar, upgrade overlay) */
.studio-hero-gallery .thumbnail-slot.rotating::after {
    background: #e95c4b;  /* Change to your brand color */
}

.studio-hero-gallery .upgrade-overlay {
    background: linear-gradient(135deg, rgba(233, 92, 75, 0.9) 0%, rgba(189, 48, 0, 0.9) 100%);
    /* Change to your brand colors */
}
```

### Adjust Gallery Height

```css
.studio-hero-gallery {
    height: 400px;  /* Desktop height */
}

@media (max-width: 768px) {
    .studio-hero-gallery .hero-main {
        height: 250px;  /* Mobile hero height */
    }
    .studio-hero-gallery .hero-thumbnails {
        height: 100px;  /* Mobile thumbnails height */
    }
}
```

---

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile Safari (iOS 12+)
- Chrome for Android

---

## Accessibility

- Keyboard navigation: Arrow keys, Escape to close
- Focus management in lightbox
- Alt text support for all images
- ARIA labels on buttons
- Reduced motion respected via `prefers-reduced-motion`

---

## Troubleshooting

**Images not loading in lightbox?**
- Check that image URLs are correct and accessible
- Verify `data-images` attribute contains valid JSON
- Check browser console for errors

**Auto-rotation not working?**
- Ensure thumbnail has `.rotating` class
- Need at least 3 images for rotation to activate
- Check that Font Awesome is loaded (for icons)

**Lightbox not appearing?**
- Verify JavaScript is loaded after DOM
- Check for JavaScript errors in console
- Ensure CSS z-index isn't being overridden

---

## Version History

- **1.0.0** - Initial release
  - 70/30 split layout
  - Auto-rotating thumbnails
  - Lightbox with keyboard/touch navigation
  - Free/paid tier variants
