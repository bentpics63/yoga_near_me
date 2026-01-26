# Consolidated CSS Guide

## What Was Preserved

I've reviewed your existing CSS and created a **consolidated version** that preserves all critical styles while adding clean design fixes. Here's what was kept:

### ✅ **Design Tokens (CSS Variables)**
- All color variables (`--color-sage`, `--color-terracotta`, `--color-teal`, etc.)
- All spacing variables (`--space-xs` through `--space-3xl`)
- All shadow variables (`--shadow-sm`, `--shadow-md`, `--shadow-lg`)
- All font families (`--font-heading`, `--font-body`, `--font-accent`)
- All border radius variables
- All transition variables

### ✅ **Footer Styling (100% Preserved)**
- Complete footer styling with high specificity overrides
- Footer grid layout (4 columns → 2 columns → 1 column responsive)
- Footer colors, typography, links, social icons
- Newsletter form styling
- Footer bottom section with copyright and links
- All `!important` flags preserved exactly as you had them

### ✅ **Hero & Gallery Section**
- Complete hero gallery grid layout (2fr 1fr with 2 rows)
- Gallery hover effects and image scaling
- "View more" overlay styling

### ✅ **Studio Header Info**
- Badge styling (verified, featured)
- Studio name, tagline, meta information
- Rating stars and review count
- Action buttons (primary, secondary)
- All button hover effects

### ✅ **Content Cards & Sections**
- Content card base styling
- Card headers and titles
- About section styling
- Class schedule tabs and items
- Reviews summary and individual review items
- All section-specific styling

### ✅ **Sidebar**
- Sidebar card styling
- Contact list, hours list, map placeholder
- Claim card with gradient background
- Social links styling

### ✅ **Nearby Studios**
- Section header with "View All" link
- Studio card grid (3 columns → 2 columns → 1 column responsive)
- Card hover effects and image scaling
- Rating and distance display

### ✅ **Responsive Breakpoints**
- All media queries preserved (1024px, 900px, 768px, 600px)
- Reduced motion preference support
- All responsive grid adjustments

## What Was Added (Clean Design Fixes)

### 🆕 **GeoDirectory Widgets - Target & Style**
- **CRITICAL**: CSS now targets GeoDirectory widget classes (`.geodir-post-meta`, `.geodir-widget`, etc.)
- Styles GeoDirectory Post Meta widgets for contact info, hours, yoga styles, amenities
- Hides empty/unused GeoDirectory fields automatically
- Removes excessive styling from GeoDirectory widget containers
- Properly styles GeoDirectory Post Title, Content, Images, Rating, Reviews, Map, and Nearby Places widgets
- **Important**: You must use GeoDirectory widgets in Elementor to pull data from listings - unused fields can be hidden with CSS

### 🆕 **Remove Excessive Shadows & Borders**
- Removes shadows from deeply nested Elementor containers
- Removes borders from nested Elementor sections
- Keeps subtle shadows ONLY on main content sections

### 🆕 **Contact Information Grouping**
- Groups contact items without individual cards
- Simple list layout with dividers
- Clean icon and text alignment

### 🆕 **Hours Grouping**
- Simple list layout for hours
- Status indicator without background box
- Clean day/time display

### 🆕 **Yoga Styles & Amenities**
- Clean pill styling for yoga styles (white background, teal border)
- Simple grid for amenities (no individual cards)
- Star icon in yoga style pills

### 🆕 **Section Headings**
- Orange dot (●) before section headings
- Consistent heading styling
- Proper spacing and typography

### 🆕 **Search Section Removal**
- Completely hides search forms and search-related elements
- Removes search section containers

### 🆕 **Placeholder Hiding**
- Hides empty placeholder elements
- Removes placeholder styling

### 🆕 **Main Layout Fixes**
- Two-column layout (2fr 1fr) for content sections
- Proper max-width and centering
- Background color for page

## How to Apply

1. **Backup Your Current CSS**
   - Copy your existing CSS from WordPress Customizer → Additional CSS
   - Save it somewhere safe

2. **Remove Old CSS**
   - Go to WordPress Customizer → Additional CSS
   - Remove all existing CSS (or comment it out)

3. **Add Consolidated CSS**
   - Copy the entire contents of `CONSOLIDATED-CLEAN-DESIGN.css`
   - Paste into WordPress Customizer → Additional CSS
   - Click "Publish"

4. **Clear Cache**
   - Clear WordPress cache (if using a caching plugin)
   - Clear browser cache (Ctrl+Shift+R or Cmd+Shift+R)

5. **Test**
   - Check the single studio page
   - Verify footer still looks correct
   - Verify hero section displays properly
   - Check that nested shadows/borders are removed
   - Verify contact/hours/yoga styles are grouped cleanly

## File Location

The consolidated CSS file is located at:
```
/Users/eddieb/Projects/Yoganearme.info/code/single-studio-hero-custom/CONSOLIDATED-CLEAN-DESIGN.css
```

## What This Achieves

✅ **Preserves** all your existing design work (footer, hero, content sections)  
✅ **Removes** excessive shadows and borders from nested Elementor widgets  
✅ **Groups** related data visually (contact, hours, yoga styles, amenities)  
✅ **Maintains** responsive design across all breakpoints  
✅ **Keeps** all design tokens for easy future customization  

## Notes

- **GeoDirectory Widgets**: The CSS targets GeoDirectory widget classes (`.geodir-post-meta`, `.geodir-widget`, etc.) to style the actual data from your listings. You must use GeoDirectory widgets in Elementor to pull data - unused fields are automatically hidden.
- **Hidden Fields**: Empty GeoDirectory fields and unused social media fields (fax, twitter, linkedin, youtube, tiktok, pinterest) are automatically hidden. You can customize which fields to hide by modifying the CSS selectors.
- The footer styling uses high-specificity selectors (`footer.ynm-footer`) to ensure it overrides any conflicting styles
- Elementor-specific fixes use `body.single-gd_place` to target only single studio pages
- All `!important` flags from your footer CSS are preserved
- Design tokens (CSS variables) are defined at the top for easy customization

## GeoDirectory Widgets to Use in Elementor

When building your single studio page in Elementor, use these GeoDirectory widgets:

1. **GeoDirectory Post Title** - Studio name
2. **GeoDirectory Post Meta** - For contact info (phone, email, website), hours, yoga styles, amenities
3. **GeoDirectory Post Content** - About section
4. **GeoDirectory Post Images** - Hero gallery
5. **GeoDirectory Post Rating** - Star rating and review count
6. **GeoDirectory Post Reviews** - Individual reviews
7. **GeoDirectory Business Hours** - Hours of operation
8. **GeoDirectory Post Map** - Location map
9. **GeoDirectory Nearby Posts** - Nearby studios

Unused fields will be automatically hidden by the CSS. If you need to hide additional fields, add them to the "Hide specific unused GeoDirectory fields" section in the CSS.

