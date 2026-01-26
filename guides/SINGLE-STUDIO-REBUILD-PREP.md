# Single Studio Page Rebuild - Preparation Document

## Working Code (Don't Lose This!)

### Breadcrumbs HTML Widget
```html
<style>
.ynm-breadcrumb,
.ynm-breadcrumb-container,
.elementor-widget-html,
.elementor-widget-container,
.elementor-element {
  background: transparent !important;
  box-shadow: none !important;
  border: none !important;
}

.ynm-breadcrumb {
  padding: 12px 0 !important;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

.ynm-breadcrumb-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  padding: 0 24px !important;
}

.ynm-breadcrumb-list {
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
  flex-wrap: wrap !important;
  list-style: none !important;
  margin: 0 !important;
  padding: 0 !important;
  font-size: 13px !important;
  line-height: 1 !important;
}

.ynm-breadcrumb-item {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  line-height: 1 !important;
}

.ynm-breadcrumb-item a {
  color: #61948B !important;
  text-decoration: none !important;
}

.ynm-breadcrumb-item a:hover {
  text-decoration: underline !important;
}

.ynm-breadcrumb-separator {
  color: #9CA3AF !important;
}

.ynm-breadcrumb-current {
  display: inline-flex !important;
  align-items: center !important;
  line-height: 1 !important;
  position: relative !important;
  top: -3px !important;
}

/* GeoDirectory title fixes */
.ynm-breadcrumb-current .geodir-post-title {
  display: inline !important;
  margin: 0 !important;
  padding: 0 !important;
}

.ynm-breadcrumb-current h2.geodir-entry-title {
  display: inline !important;
  margin: 0 !important;
  padding: 0 !important;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  font-size: 13px !important;
  font-weight: 600 !important;
  line-height: 1 !important;
  vertical-align: baseline !important;
}

.ynm-breadcrumb-current h2.geodir-entry-title a {
  color: #FF5733 !important;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  font-size: 13px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
}

/* GeoDirectory title - no unset */
.ynm-breadcrumb-current .geodir-post-title,
.ynm-breadcrumb-current .bsui,
.ynm-breadcrumb-current h2 {
  display: inline !important;
  margin: 0 !important;
  padding: 0 !important;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  font-size: 13px !important;
  font-weight: 600 !important;
}

.ynm-breadcrumb-current h2 a {
  color: #FF5733 !important;
  text-decoration: none !important;
}

/* Kill the dot - target everything */
.ynm-breadcrumb h2::before,
.ynm-breadcrumb .bsui h2::before,
.ynm-breadcrumb .geodir-entry-title::before,
.ynm-breadcrumb [class*="geodir"]::before,
.ynm-breadcrumb .h5::before,
.bsui .geodir-entry-title::before,
h2.geodir-entry-title::before,
.geodir-entry-title.h5::before {
  content: none !important;
  display: none !important;
  opacity: 0 !important;
  visibility: hidden !important;
  width: 0 !important;
  height: 0 !important;
  position: absolute !important;
  left: -9999px !important;
}
</style>

<nav class="ynm-breadcrumb" aria-label="Breadcrumb">
  <div class="ynm-breadcrumb-container">
    <ol class="ynm-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="ynm-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="https://yoganearme.info/" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1" />
        <span class="ynm-breadcrumb-separator">/</span>
      </li>
      <li class="ynm-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="https://yoganearme.info/studios/" itemprop="item"><span itemprop="name">Studios</span></a>
        <meta itemprop="position" content="2" />
        <span class="ynm-breadcrumb-separator">/</span>
      </li>
      <li class="ynm-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="https://yoganearme.info/studios/" itemprop="item"><span itemprop="name">[gd_post_meta key="city" show="value-strip" no_wrap="1"]</span></a>
        <meta itemprop="position" content="3" />
        <span class="ynm-breadcrumb-separator">/</span>
      </li>
      <li class="ynm-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span class="ynm-breadcrumb-current" itemprop="name">[gd_post_title tag=""]</span>
        <meta itemprop="position" content="4" />
      </li>
    </ol>
  </div>
</nav>
```

---

## Design Components (10 Sections)

### 1. Hero Section
- Studio logo (80x80)
- Studio name
- Tagline
- Rating stars + count
- Location badge
- Open/Closed status
- Book a Class + Claim buttons

### 2. Trust Badges Row
- Established year
- Yoga Alliance certification
- Google rating
- Yelp rating
- Verified badge
- Featured badge

### 3. Quick Info Bar
- Phone
- Email
- Website
- Styles offered count

### 4. Yoga Styles Section
- Style tags (pills)
- Primary style highlighted
- Heated indicator

### 5. Pricing Section
- Drop-in rate
- Monthly unlimited
- New student offer
- Featured pricing card

### 6. Teachers Section
- Teacher cards (photo, name, role, credentials)
- "View All Teachers" link

### 7. Programs & Services
- Teacher Training
- Private Sessions
- Workshops
- Online Classes
- Corporate
- Retreats

### 8. First Visit Info
- What to bring list
- Arrival instructions
- Note about first-timers

### 9. Contact Section
- Address
- Phone
- Email
- Website
- Social links (Instagram, Facebook)

### 10. Practical Info
- Parking
- Mat rentals
- Changing rooms
- Showers

---

## GeoDirectory Fields Required

### Already Exist:
- `post_title` - Studio name
- `city` - City name
- `region` - State
- `street` - Address
- `phone` - Phone number
- `email` - Email
- `website` - Website URL
- `business_hours` - Hours
- `post_images` - Gallery

### Need to Create:

| Field | Key | Type | Notes |
|-------|-----|------|-------|
| Yoga Alliance | `yoga_alliance` | Text | RYS-200, RYS-500, etc. |
| Established Year | `established` | Text | e.g., 2015 |
| Google Rating | `google_rating` | Text | e.g., 4.5 |
| Google Reviews | `google_reviews` | Text | e.g., 127 |
| Yelp Rating | `yelp_rating` | Text | e.g., 4.2 |
| Yelp Reviews | `yelp_reviews` | Text | e.g., 89 |
| Tagline | `tagline` | Text | Short quote |
| Drop-in Price | `dropin_price` | Text | e.g., $25 |
| Monthly Price | `monthly_price` | Text | e.g., $149 |
| New Student Offer | `new_student_offer` | Textarea | Description |
| Parking | `parking` | Select | Free, Paid, Street, None |
| Mat Rental | `mat_rental` | Checkbox | Yes/No |
| Props Available | `props_available` | Checkbox | Yes/No |
| Changing Rooms | `changing_rooms` | Checkbox | Yes/No |
| Showers | `showers` | Checkbox | Yes/No |
| Heated Studio | `heated` | Checkbox | Yes/No |
| Instagram | `instagram` | Text | URL or handle |
| Facebook | `facebook` | Text | URL |

---

## PHP Shortcodes Available

Located in: `/code/PHP ADDS/functions-COMPLETE-CLEAN.php`

| Shortcode | Purpose |
|-----------|---------|
| `[ynm_studio_badges]` | Verified/Featured badges |
| `[ynm_breadcrumbs]` | Breadcrumb navigation |
| `[ynm_contact_card]` | Contact info card |
| `[ynm_hours_card]` | Business hours |
| `[ynm_hero_gallery_grid]` | Gallery grid |
| `[ynm_trust_badges]` | Trust badges row |

---

## Elementor Template Structure (Rebuild Plan)

```
SINGLE STUDIO TEMPLATE
│
├── SECTION: Full Width (no padding)
│   └── Breadcrumbs HTML Widget
│
├── SECTION: Content Width (max 1200px)
│   │
│   ├── CONTAINER: Hero Row (flex, gap 24px)
│   │   ├── Hero HTML Widget (title, tagline, meta, buttons)
│   │   └── [Future: Gallery Grid]
│   │
│   ├── CONTAINER: Trust Badges
│   │   └── Shortcode: [ynm_trust_badges]
│   │
│   ├── CONTAINER: Two Column Layout
│   │   │
│   │   ├── COLUMN: Main Content (65%)
│   │   │   ├── About Section
│   │   │   ├── Yoga Styles
│   │   │   ├── Reviews
│   │   │   └── Location Map
│   │   │
│   │   └── COLUMN: Sidebar (35%)
│   │       ├── Contact Card
│   │       ├── Hours Card
│   │       └── Pricing Card
│   │
│   └── CONTAINER: Full Width Bottom
│       ├── Similar Studios
│       └── Nearby Studios
│
└── END TEMPLATE
```

---

## Mobile Breakpoints

| Breakpoint | Layout Changes |
|------------|----------------|
| Desktop (1024px+) | Two columns, horizontal badges |
| Tablet (768-1023px) | Single column, stacked cards |
| Mobile (0-767px) | Full width, compact spacing |

---

## CSS Variables (Brand)

```css
--ynm-sage: #5F7470;
--ynm-teal: #61948B;
--ynm-rust: #bd371a;
--ynm-coral: #FF5733;
--ynm-paper: #F8FAFA;
--ynm-text-dark: #2C3E3A;
--ynm-text-medium: #6B7C78;
```

---

## Next Steps

1. [ ] Create dummy studio with all fields populated for testing
2. [ ] Add remaining GeoDirectory custom fields
3. [ ] Test all shortcodes with real data
4. [ ] Build new Elementor template from scratch
5. [ ] Implement mobile-first, then enhance for desktop

---

## Files Reference

- Design reference: `/content/studio-listing/single-listing-redesign.html`
- PHP functions: `/code/PHP ADDS/functions-COMPLETE-CLEAN.php`
- Rebuild guide: `/guides/SINGLE-STUDIO-REBUILD-GUIDE.md`
- This file: `/guides/SINGLE-STUDIO-REBUILD-PREP.md`
