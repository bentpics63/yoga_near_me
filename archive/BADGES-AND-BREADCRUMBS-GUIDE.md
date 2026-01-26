# Badges and Breadcrumbs Guide

## Important: HTML Alone Cannot Check WordPress Fields

**HTML widgets cannot check WordPress/GeoDirectory fields directly.** You need PHP to check the database and conditionally display content.

## Solution: Use PHP Shortcodes

I've created PHP shortcodes that check WordPress/GeoDirectory fields and output HTML. These shortcodes can be used in Elementor HTML widgets.

## Setup Instructions

### Step 1: Add Shortcode Functions to functions.php

Copy the contents of `BADGES-SHORTCODE.php` and add it to your `functions.php` file (or include the file).

**File location:**
```
/Users/eddieb/Projects/Yoganearme.info/code/PHP ADDS/BADGES-SHORTCODE.php
```

**To add to functions.php:**
1. Open `functions.php` in your child theme
2. Add this line at the end (before the closing `?>` if present):
   ```php
   require_once get_stylesheet_directory() . '/../code/PHP ADDS/BADGES-SHORTCODE.php';
   ```
   
   OR copy the entire contents of `BADGES-SHORTCODE.php` and paste it into `functions.php`.

### Step 2: Use Shortcodes in Elementor HTML Widgets

#### For Badges (Verified/Featured Studio)

1. Add an **HTML widget** in Elementor where you want the badges to appear (above the studio name)
2. Paste this code:
   ```html
   [ynm_studio_badges]
   ```

**How it works:**
- The shortcode checks `studio_verified` and `studio_featured` custom fields
- If a studio is verified, it shows "✓ VERIFIED" badge (teal)
- If a studio is featured, it shows "FEATURED STUDIO" badge (orange)
- If neither field is checked, nothing displays
- **When you approve a studio claim in WordPress/GeoDirectory, the badges automatically appear**

#### For Breadcrumbs

1. Add an **HTML widget** at the very top of your page
2. Paste this code:
   ```html
   [ynm_breadcrumbs]
   ```

**How it works:**
- Dynamically generates breadcrumbs based on current page
- Shows: Home / Studios / [City] / [Studio Name]
- Automatically pulls city and studio name from GeoDirectory

## Alternative: Static HTML (Not Recommended)

If you want static HTML without PHP checks, you can use the HTML code in `BREADCRUMB-HTML-CODE.html`, but:

- ❌ Badges won't check WordPress fields
- ❌ Badges won't appear/disappear based on approval status
- ❌ Breadcrumbs won't update dynamically
- ✅ Only use if you want static content that never changes

## How Badges Work with Approval System

1. **Studio Claims Listing**: When someone claims a studio, it goes to pending approval
2. **You Approve in WordPress/GeoDirectory**: You check the `studio_verified` or `studio_featured` checkbox
3. **Badge Appears Automatically**: The shortcode checks these fields and displays the badge
4. **No Manual HTML Updates Needed**: The badge appears/disappears automatically based on the field values

## Custom Fields Required

Make sure these custom fields exist in GeoDirectory:

1. **studio_verified** - Checkbox field
   - Location: GeoDirectory → Settings → Custom Fields
   - Field Type: Checkbox
   - Field Key: `studio_verified`

2. **studio_featured** - Checkbox field
   - Location: GeoDirectory → Settings → Custom Fields
   - Field Type: Checkbox
   - Field Key: `studio_featured`

**OR** use GeoDirectory's built-in "Featured" system (the shortcode checks both).

## Testing

1. **Test Badges:**
   - Edit a studio listing in WordPress
   - Check/uncheck `studio_verified` or `studio_featured`
   - View the page - badge should appear/disappear

2. **Test Breadcrumbs:**
   - View any studio page
   - Breadcrumbs should show: Home / Studios / [City] / [Studio Name]

## Troubleshooting

**Problem**: Shortcode shows nothing
- **Solution**: Make sure you added the shortcode functions to `functions.php`
- **Solution**: Check that you're on a single studio page (shortcode only works on detail pages)

**Problem**: Badge doesn't appear after approval
- **Solution**: Check that the custom field `studio_verified` or `studio_featured` is actually checked in the listing
- **Solution**: Clear WordPress cache
- **Solution**: Check that the field key matches exactly (`studio_verified`, not `verified`)

**Problem**: Breadcrumbs show wrong city
- **Solution**: Make sure the GeoDirectory listing has the `geodir_city` field filled in

## CSS Styling

The badges and breadcrumbs are automatically styled by the CSS in `CONSOLIDATED-CLEAN-DESIGN.css`. The styles include:

- Badge colors (teal for verified, orange for featured)
- Badge spacing and typography
- Breadcrumb link colors and hover effects
- Responsive design

No additional CSS needed unless you want to customize the appearance.

