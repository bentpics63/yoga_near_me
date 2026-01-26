# Single Studio Listing Page — WordPress Implementation Guide

**For:** Eddie
**Created:** January 24, 2026
**Status:** Ready for WordPress Implementation

---

## Quick Reference

| Item | Location |
|------|----------|
| **HTML/CSS Mockup** | `content/studio-listing/single-listing-MERGED.html` |
| **Progress Tracker** | `.claude/STUDIO_LISTING_PROGRESS.md` |
| **Hero Gallery CSS** | `code/single-studio-hero-custom/hero-image-gallery.css` |
| **Nearby Studios CSS** | `code/single-studio-hero-custom/NEARBY-STUDIOS-CARDS.css` |
| **Claim Button PHP** | `code/PHP ADDS/CLAIM-BUTTON-SHORTCODE.php` |

---

## Implementation Checklist

### Step 1: Add GeoDirectory Custom Fields

Go to: **WordPress Admin → GeoDirectory → Settings → Custom Fields**

Add these fields to the "gd_place" (Studios) post type:

| Field Key | Label | Type | Options/Notes |
|-----------|-------|------|---------------|
| `drop_in_price` | Drop-in Price | Text | Example: "$25" |
| `heated` | Heated Studio | Select | Yes, No |
| `studio_size` | Studio Size | Select | Small (under 15), Medium (15-30), Large (30+) |
| `num_teachers` | Number of Teachers | Number | Integer |
| `levels_offered` | Levels Offered | Multiselect | Beginner, All Levels, Intermediate, Advanced |
| `virtual_classes` | Virtual Classes | Select | Available, Not Available |
| `established_year` | Established | Text | Example: "2015" |
| `yoga_alliance_cert` | Yoga Alliance | Select | RYS-200, RYS-300, RYT-500, None |
| `google_rating` | Google Rating | Text | Example: "4.7" |
| `google_review_count` | Google Reviews | Number | Integer |
| `scheduling_api_url` | Booking URL | URL | MindBody/Momence/etc. link |
| `studio_logo` | Studio Logo | Image | For paid tier only |
| `tagline` | Tagline | Text | Short description in quotes |

### Step 2: Add Custom Shortcode

Add to `functions.php` (or use Code Snippets plugin):

```php
// Custom Claim Button Shortcode (single checkmark)
function ynm_claim_button_shortcode($atts) {
    if (!function_exists('geodir_get_post_info')) return '';

    global $gd_post;
    $post_id = isset($gd_post->ID) ? $gd_post->ID : get_the_ID();

    if (geodir_listing_is_claimed($post_id)) {
        return '<span class="ynm-verified-badge">✓ Verified</span>';
    }

    $claim_url = geodir_claim_page_url($post_id);
    return '<a href="' . esc_url($claim_url) . '" class="ynm-claim-btn">
        <span class="ynm-claim-check">✓</span> Claim Your Studio
    </a>';
}
add_shortcode('ynm_claim_button', 'ynm_claim_button_shortcode');
```

### Step 3: Create Elementor Template

1. Go to **Templates → Theme Builder → Add New**
2. Choose **Single Post** template
3. Set condition: **GD Places** (or your studio post type)

#### Template Structure:

```
[Elementor Section: Full Width]
├── Breadcrumbs (Elementor Breadcrumb widget or custom)
│
[Elementor Section: Full Width]
├── Hero Gallery (HTML widget with hero-image-gallery code)
│
[Elementor Section: Boxed]
├── [Column 2/3]
│   ├── Studio Title (H1)
│   ├── Tagline
│   ├── Rating + Reviews
│   ├── Location + Hours
│   ├── Action Buttons (Book, Website, Call)
│   ├── Trust Badges Row
│   ├── Quick Info Bar (6 items)
│   ├── About Section
│   ├── Yoga Styles
│   ├── Pricing Cards
│   ├── Amenities
│   ├── Teachers
│   ├── Programs & Services
│   ├── First Visit Info
│   ├── Practical Info
│   └── Reviews Section
│
├── [Column 1/3 - Sidebar]
│   ├── Contact Card
│   ├── Hours Card
│   ├── Map
│   └── Claim CTA
│
[Elementor Section: Full Width]
├── Nearby Studios (using NEARBY-STUDIOS-CARDS.css)
```

### Step 4: Add CSS to WordPress

Go to: **Appearance → Customize → Additional CSS**

Paste the contents of these files (in order):
1. `code/single-studio-hero-custom/hero-image-gallery.css`
2. `code/single-studio-hero-custom/NEARBY-STUDIOS-CARDS.css`
3. Any additional styling from `single-listing-MERGED.html`

### Step 5: Add GeoDirectory Shortcodes

Replace static content with GD shortcodes:

| Static Content | Replace With |
|----------------|--------------|
| Studio Name | `[gd_post_title]` |
| Address | `[gd_post_meta key="street"]` |
| Phone | `[gd_post_meta key="phone"]` |
| Website | `[gd_post_meta key="website"]` |
| Email | `[gd_post_meta key="email"]` |
| Rating | `[gd_post_rating]` |
| Hours | `[gd_output_location location="listing" list_order="business_hours"]` |
| Map | `[gd_map]` |
| Gallery | `[gd_post_images type="gallery"]` |
| Categories | `[gd_categories]` |

For custom fields:
```
[gd_post_meta key="drop_in_price"]
[gd_post_meta key="heated"]
[gd_post_meta key="studio_size"]
...etc
```

### Step 6: Implement Conditional Logic

Use GeoDirectory's `[gd_if]` shortcode to hide empty sections:

```html
[gd_if field="drop_in_price"]
<div class="info-item">
    <span class="info-label">DROP-IN</span>
    <span class="info-value">[gd_post_meta key="drop_in_price"]</span>
</div>
[/gd_if]
```

For the Book a Class button (gray when no booking URL):
```html
[gd_if field="scheduling_api_url"]
<a href="[gd_post_meta key='scheduling_api_url']" class="ynm-btn ynm-btn-primary">
    Book a Class
</a>
[else]
<span class="ynm-btn ynm-btn-inactive" title="Online booking coming soon">
    Book a Class
</span>
[/gd_if]
```

### Step 7: Test

- [ ] Test with a studio that has all fields filled
- [ ] Test with a studio missing some fields (verify hiding works)
- [ ] Test mobile responsiveness (768px, 480px)
- [ ] Test Book a Class button states (active/inactive)
- [ ] Test Claim button (shows for unclaimed, hides for claimed)
- [ ] Cross-browser test (Chrome, Safari, Firefox)

---

## Brand Colors Reference

```css
:root {
    --ynm-sage: #5F7470;
    --ynm-teal: #61948B;
    --ynm-rust: #bd371a;
    --ynm-paper: #F8FAFA;
    --ynm-text-dark: #2C3E3A;
    --ynm-text-medium: #6B7C78;
}
```

---

## Files to Review

| File | Purpose |
|------|---------|
| `single-listing-MERGED.html` | Complete mockup with all sections |
| `.claude/STUDIO_LISTING_PROGRESS.md` | Detailed progress tracker |
| `code/PHP ADDS/CLAIM-BUTTON-SHORTCODE.php` | Custom claim button |
| `code/PHP ADDS/DYNAMIC-ABOUT-SHORTCODE.php` | Dynamic about section |

---

## Questions for Eddie

1. **Scheduling APIs:** Which platforms to support first? (MindBody, Momence, Vagaro)
2. **Studio Logo:** How to restrict custom logo to paid tier?
3. **Reviews:** Use GD reviews or pull from Google?
4. **Gallery Lightbox:** Use built-in GD gallery or custom?

---

*Last updated: January 24, 2026*
