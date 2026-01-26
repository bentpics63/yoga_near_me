# Studio Listing Page - Full Implementation Progress

**Started:** January 15, 2026
**Updated:** January 24, 2026
**Status:** ✅ Mockup Complete — Ready for WordPress Implementation

---

## IMPLEMENTATION GUIDE

**See:** `content/studio-listing/WORDPRESS-IMPLEMENTATION-GUIDE.md` for step-by-step WordPress instructions.

---

## Design References
- Header closeup: `/Users/eddieb/Desktop/Screenshot 2026-01-15 at 4.23.24 PM.png`
- Full page: `/Users/eddieb/Desktop/Screenshot 2026-01-15 at 1.38.14 PM.png`

---

## KEY DECISIONS MADE

| Decision | Answer |
|----------|--------|
| Yelp integration | **NO** - Skip entirely |
| Studio logo | **Om symbol = free tier**, custom upload = paid subscription |
| Book a Class inactive | TBD - need to decide behavior |
| Claim button | GD widget, show only 1st checkmark |

---

## FULL PAGE SECTIONS

### Section 1: Hero Image
- [ ] Full-width banner image
- [ ] "View all X photos" button overlay
- [ ] Gallery lightbox functionality

### Section 2: Header Card
- [ ] Logo (Om placeholder OR custom if paid)
- [ ] Studio name (H1)
- [ ] Tagline in quotes
- [ ] Star rating + review count
- [ ] Location pin + neighborhood, city
- [ ] Open/Closed status with hours
- [ ] Est. year
- [ ] **Buttons:** Book a Class (conditional), Website, Call

### Section 3: Trust Badges Row
- [ ] Yoga Alliance certification badge (RYS-200, RYS-300, RYT-500)
- [ ] Google rating with count
- [ ] ~~Yelp~~ **SKIPPED**
- [ ] Verified badge (green checkmark)

### Section 4: Info Bar (6 items)
- [ ] DROP-IN price
- [ ] HEATED (Yes/No)
- [ ] STUDIO SIZE (Small/Medium/Large + capacity)
- [ ] TEACHERS count
- [ ] LEVELS (Beginner/All Levels/Advanced)
- [ ] VIRTUAL (Available/Not Available)

### Section 5: About + Contact + Map
- [ ] About Our Studio (text description)
- [ ] Contact sidebar: Phone, Email, Website, Address
- [ ] Social icons
- [ ] Embedded map
- [ ] Get Directions link
- [ ] Hours table (Mon-Sun)

### Section 6: Yoga Styles Offered
- [ ] Style tags (Vinyasa Flow, Hatha, Hot Yoga, Yin, etc.)
- [ ] Primary style highlighted in rust
- [ ] Class Levels legend (Beginner, All Levels, Intermediate, Advanced)

### Section 7: Pricing
- [ ] Drop-in price card
- [ ] 5-class pack card
- [ ] 10-class pack card
- [ ] Monthly unlimited card (highlighted rust)
- [ ] Special offer banner with CTA

### Section 8: Amenities & Features
- [ ] Tag pills: Free Parking, Props Provided, Mat Rentals, Changing Rooms, Showers, Lockers, Free WiFi, Filtered Water, Retail Shop

### Section 9: Our Teachers
- [ ] Teacher cards with photo, name, role/specialty
- [ ] Individual teacher tags (certifications)
- [ ] "View All X Teachers" link

### Section 10: Programs & Services
- [ ] Cards: Private Sessions, Workshops, 200-hour YTT, Retreats, Online Classes
- [ ] Price/availability under each

### Section 11: First Visit Information
- [ ] What to Bring checklist
- [ ] First-time visitor instructions (highlighted box)

### Section 12: Practical Information
- [ ] Parking info
- [ ] Public Transit
- [ ] Cancellation Policy
- [ ] Payment Methods
- [ ] Languages
- [ ] Booking method

### Section 13: Reviews
- [ ] Overall rating large
- [ ] Rating histogram (5-star breakdown)
- [ ] "Write a Review" button
- [ ] Individual reviews (if showing)

### Section 14: Nearby Yoga Studios
- [ ] Related studios carousel
- [ ] Studio cards with image, name, location, rating
- [ ] "View All in [City]" link

### Section 15: Footer
- [ ] Standard site footer

---

## COMPLETED FILES

| File | Purpose | Status |
|------|---------|--------|
| `code/single-studio-hero-custom/studio-header-section.html` | HTML structure with GD shortcodes | ✅ Complete |
| `code/single-studio-hero-custom/studio-header-section.css` | CSS styling with brand tokens | ✅ Complete |
| `code/single-studio-hero-custom/CONSOLIDATED-CLEAN-DESIGN.css` | Full page CSS with design tokens | ✅ Exists |

---

## Button Behavior Decisions

### "Book a Class" Button
- **Behavior:** Gray out with tooltip when inactive
- **Active when:** `scheduling_api_url` field has a value
- **Inactive tooltip:** "Online booking coming soon"
- **CSS classes:** `.ynm-btn-inactive`, `.ynm-btn-inactive-wrapper`, `.ynm-btn-tooltip`
- **Implementation:** Use GD conditional shortcode `[gd_if field="scheduling_api_url"]`

### "Claim Your Studio" Button
- **USE:** `[ynm_claim_button]` (custom shortcode - single checkmark ✓)
- **NOT:** `[gd_claim_link]` (default GD widget - shows two checkmarks)
- **File:** `code/PHP ADDS/CLAIM-BUTTON-SHORTCODE.php` (must add to functions.php)
- **Status:** ✅ SOLVED - use custom shortcode

### Studio Logo
- **FREE TIER:** Om symbol placeholder (default)
- **PAID TIER:** Custom logo via `studio_logo` image field
- **CSS class:** `.has-custom-logo` on `.ynm-studio-logo`
- **Implementation:** Use GD conditional or PHP template

---

## NEW GEODIRECTORY FIELDS REQUIRED

These must be added to GeoDirectory before the design will be functional:

| Field Key | Type | Options | Used In |
|-----------|------|---------|---------|
| `drop_in_price` | Text/Currency | e.g., "$25" | Info Bar |
| `heated` | Select | "Yes" / "No" | Info Bar |
| `studio_size` | Select | "Small (under 15)" / "Medium (15-30)" / "Large (30+)" | Info Bar |
| `num_teachers` | Number | Integer | Info Bar |
| `levels_offered` | Select | "Beginner" / "All Levels" / "Intermediate" / "Advanced" | Info Bar |
| `virtual_classes` | Select | "Available" / "Not Available" | Info Bar |
| `established_year` | Text | e.g., "2015" | Header |
| `yoga_alliance_cert` | Select | "RYS-200" / "RYS-300" / "RYT-500" / "None" | Badges |
| `google_rating` | Text | e.g., "4.7" | Badges |
| `google_review_count` | Number | Integer | Badges |
| `scheduling_api_url` | URL | MindBody, Momence, etc. | Book Button |
| `studio_logo` | Image | PAID TIER ONLY | Header |
| `tagline` | Text | Short description | Header |

---

## Technical Decisions

### Yelp Integration
- **Decision:** ❌ NOT INCLUDING
- **Rationale:** Simplifies implementation, Google + Verified is sufficient

### Empty State Handling
- **Recommendation:** Hide items with no data
- **Implementation:** Use GD `[gd_if]` conditionals or CSS `:empty` selectors

### Rating Source
- **Primary:** Google reviews (manual entry or API)
- **Secondary:** Internal YogaNearMe reviews via GD

---

## IMPLEMENTATION CHECKLIST

### Phase 1: GeoDirectory Setup ⏳
- [ ] Add all new custom fields to GeoDirectory
- [ ] Update studio claim/edit form with new fields
- [ ] Set up field validation rules
- [ ] Configure Claim widget (single checkmark only)

### Phase 2: WordPress Integration ⏳
- [ ] Add CSS to WordPress Customizer > Additional CSS
- [ ] Create Elementor template for single studio page
- [ ] Add HTML widget with header section code
- [ ] Configure GD shortcodes in template

### Phase 3: Conditional Logic ⏳
- [ ] Implement Book a Class button conditionals
- [ ] Implement studio logo conditionals
- [ ] Implement badge visibility conditionals
- [ ] Hide empty info bar items

### Phase 4: Testing ⏳
- [ ] Cross-browser testing (Chrome, Safari, Firefox)
- [ ] Mobile responsiveness (test at 768px, 480px)
- [ ] Empty state handling for all fields
- [ ] Button states (active/inactive)
- [ ] Logo states (Om/custom)

---

## Brand Tokens (from CLAUDE.md)

```css
--ynm-sage: #5F7470;
--ynm-teal: #61948B;
--ynm-rust: #bd371a;
--ynm-paper: #F8FAFA;
--ynm-text-dark: #2C3E3A;
--ynm-text-medium: #6B7C78;
```

**Fonts:** Inter (primary), Crimson Pro (editorial accent)

---

## QUESTIONS RESOLVED

| Question | Answer |
|----------|--------|
| Include Yelp? | **No** - skip entirely |
| Book a Class inactive behavior? | **Gray out + tooltip** "Online booking coming soon" |
| Studio logo feature? | **Om = free, Custom = paid tier** |
| Empty info bar items? | **Hide items with no data** (recommended) |

## QUESTIONS REMAINING

1. Which scheduling APIs to support? (MindBody, Momence, Vagaro, etc.)
2. Which GD widget is Claim Your Studio using? Need to configure single checkmark.

---

## Session Notes

### Session 1 (Jan 15, 2026)
- Received design screenshots (header closeup + full page)
- Created progress document
- Identified all sections needed (15 total)
- Clarified key decisions:
  - No Yelp integration
  - Om symbol = free tier, custom logo = paid tier
  - Book a Class grays out when no scheduling API
  - Claim button uses GD widget, needs single checkmark config
- Built/updated HTML with GD shortcodes
- Added inactive button state CSS with tooltip
- Added custom logo CSS support
- Documented all new GeoDirectory fields needed
- Updated comprehensive progress tracking

