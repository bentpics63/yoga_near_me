# Structure & Data Grouping Fix Guide

## What This Fixes

1. ✅ **Removes search section** - No more search windows on single studio pages
2. ✅ **Adds breadcrumbs** - Navigation back to search page
3. ✅ **Reduces nested blocks** - Simplifies Elementor structure
4. ✅ **Groups related data** - Visual connections between related information
5. ✅ **Connects relational data** - Makes data relationships clear

---

## Step 1: Add PHP Code for Breadcrumbs

**File:** `functions.php`

Add this code at the very end of your `functions.php` file (after the `require_once` line):

```php
/**
 * Add Breadcrumbs to Single Studio Pages
 * Displays: Home > Studios > City > Studio Name
 */
function ynm_display_studio_breadcrumbs() {
    if (!is_singular('gd_place')) {
        return;
    }
    
    global $post;
    
    $city = get_post_meta($post->ID, 'geodir_city', true);
    $state = get_post_meta($post->ID, 'geodir_region', true);
    $studio_name = get_the_title($post->ID);
    
    echo '<div class="breadcrumb-section">';
    echo '<div class="breadcrumb">';
    
    // Home
    echo '<a href="' . esc_url(home_url('/')) . '">Home</a>';
    echo '<span class="separator">›</span>';
    
    // Studios
    $studios_url = home_url('/studios/');
    echo '<a href="' . esc_url($studios_url) . '">Studios</a>';
    
    // City (if available)
    if (!empty($city)) {
        echo '<span class="separator">›</span>';
        $city_slug = sanitize_title($city);
        $city_url = home_url('/studios/' . $city_slug . '/');
        echo '<a href="' . esc_url($city_url) . '">' . esc_html($city) . '</a>';
    }
    
    // Current Studio
    echo '<span class="separator">›</span>';
    echo '<span class="current">' . esc_html($studio_name) . '</span>';
    
    echo '</div>';
    echo '</div>';
}
add_action('geodir_before_main_content', 'ynm_display_studio_breadcrumbs', 5);
add_action('wp_body_open', 'ynm_display_studio_breadcrumbs', 5);
```

---

## Step 2: Add CSS

**File:** `FIX-STRUCTURE-AND-DATA-GROUPING.css`

1. Open: `code/single-studio-hero-custom/FIX-STRUCTURE-AND-DATA-GROUPING.css`
2. Copy ALL the code
3. WordPress → Appearance → Customize → Additional CSS
4. Paste at the very bottom
5. Click "Publish"
6. Clear cache

---

## What This CSS Does

### 1. Removes Search Section
- Hides all search forms/widgets on single studio pages
- Removes search-related sections completely

### 2. Adds Breadcrumbs
- Creates breadcrumb navigation at the top
- Links: Home > Studios > City > Studio Name
- Styled to match design

### 3. Reduces Nested Blocks
- Removes excessive padding from nested containers
- Only applies card styling to top-level sections
- Flattens unnecessary Elementor wrappers

### 4. Groups Related Data Visually

**Contact Information Group:**
- Groups email, phone, website, address together
- Visual connection with icons and consistent spacing
- Clear labels and values

**Hours of Operation Group:**
- Status indicator (Open/Closed) at top
- Hours list grouped below
- Today's hours highlighted

**Yoga Styles Group:**
- All styles displayed as cohesive pill badges
- Consistent spacing and styling

**Amenities Group:**
- Grid layout (3 columns desktop, 2 tablet, 1 mobile)
- Icons and labels grouped together
- Hover effects for interactivity

**Rating & Reviews Group:**
- Stars, rating number, review count together
- Clear visual hierarchy

**Location & Address Group:**
- Map pin icon + address text grouped
- Clear visual connection

### 5. Connects Relational Data

**Studio Header Group:**
- Badges, title, tagline grouped together
- Actions (buttons) aligned with title
- Meta information (rating, location, hours) grouped below

**Section Content Grouping:**
- Each section has heading + body grouped
- Clear visual separation between sections
- Related data within sections visually connected

**Data Relationships:**
- Uses visual indicators (borders, backgrounds) to show relationships
- Groups related fields together
- Clear labels and hierarchy

---

## Visual Improvements

### Before:
- Search section cluttering the page
- Nested blocks creating confusion
- Data scattered and disconnected
- No clear visual relationships

### After:
- Clean page without search
- Breadcrumbs for navigation
- Simplified structure
- Related data grouped visually
- Clear data relationships

---

## Testing Checklist

- [ ] Search section is hidden
- [ ] Breadcrumbs appear at top
- [ ] Breadcrumbs link correctly
- [ ] Contact info is grouped together
- [ ] Hours are grouped together
- [ ] Yoga styles are grouped together
- [ ] Amenities are in a grid
- [ ] Rating and reviews are grouped
- [ ] Less nested containers visible
- [ ] Data relationships are clear

---

## If Something Doesn't Work

1. **Breadcrumbs not showing?**
   - Check PHP code is in `functions.php`
   - Clear cache
   - Check GeoDirectory hooks are active

2. **Search still showing?**
   - Add more specific CSS selectors
   - Check Elementor widget IDs

3. **Data not grouping?**
   - Check Elementor widget classes match CSS
   - Inspect element to see actual classes
   - Adjust CSS selectors if needed

4. **Too many nested blocks?**
   - Check Elementor structure
   - Remove unnecessary nested sections
   - Simplify Elementor layout

---

## Next Steps

After applying this fix:
1. Review the page structure
2. Check data grouping looks good
3. Test breadcrumb links
4. Verify search is gone
5. Report any issues

