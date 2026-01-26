# PHP Fix: Show More Studios on Location Pages

## Problem
Location pages (`/location/united-states/illinois/chicago/`) only show 10 studios on the map when there are 100+ in the area.

## Solution
Add PHP code to increase the number of listings shown on GeoDirectory location pages.

---

## Implementation Steps

### Step 1: Access Your Theme's functions.php File

**Option A: Via WordPress Admin (Recommended)**
1. Go to **WordPress Admin → Appearance → Theme File Editor**
2. Select your active theme
3. Click on `functions.php` in the file list
4. Scroll to the bottom of the file

**Option B: Via FTP/cPanel File Manager**
1. Navigate to: `/wp-content/themes/[your-theme-name]/`
2. Open `functions.php` in a text editor
3. Scroll to the bottom

**Option C: Use a Code Snippets Plugin (Safest)**
1. Install "Code Snippets" plugin
2. Go to **Snippets → Add New**
3. Paste the code below
4. Activate the snippet

---

### Step 2: Add This Code

Add the following code to the **end** of your `functions.php` file (before the closing `?>` tag if there is one, or just at the end):

```php
/**
 * Show more listings on GeoDirectory location pages
 * This increases the number of listings shown per page, which also increases map markers
 * 
 * @param WP_Query $query The WordPress query object
 */
function ynm_increase_location_page_listings($query) {
    // Only affect front-end queries, not admin
    if (is_admin()) {
        return;
    }
    
    // Only affect the main query
    if (!$query->is_main_query()) {
        return;
    }
    
    // Check if we're on a GeoDirectory location page
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        // Set to show 50 listings per page
        // Adjust this number based on your needs:
        // - 50 = Good for most cities (recommended)
        // - 100 = For large cities with many studios
        // - -1 = Show ALL listings (may be slow for 200+ studios)
        $query->set('posts_per_page', 50);
    }
}
add_action('pre_get_posts', 'ynm_increase_location_page_listings', 20);
```

---

### Step 3: Adjust the Number (Optional)

In the code above, change `50` to your preferred number:

- **`50`** - Recommended for most cities. Shows 50 studios per page with pagination.
- **`100`** - For large cities. Shows 100 studios per page.
- **`-1`** - Shows ALL studios on one page. Use with caution for cities with 200+ studios as it may slow down page load.

---

### Step 4: Save and Test

1. **Save** the `functions.php` file
2. **Clear any caching** (if you use a caching plugin)
3. **Test** by:
   - Searching for "Chicago" from your home page
   - It should redirect to `/location/united-states/illinois/chicago/`
   - The map should now show 50 studios (or your chosen number)
   - The list should show 50 studios with pagination if there are more

---

## Alternative: Show All on Map, Paginate List

If you want the **map to show ALL studios** but keep **pagination for the list view**, use this code instead:

```php
/**
 * Show all listings on location page map (but keep pagination for list)
 */
function ynm_show_all_on_location_map($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if (function_exists('geodir_is_page') && geodir_is_page('location')) {
        // Check if this is a map query (AJAX request for map markers)
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'geodir_map_markers') {
            $query->set('posts_per_page', -1); // Show all on map
        } else {
            $query->set('posts_per_page', 50); // Paginate list view
        }
    }
}
add_action('pre_get_posts', 'ynm_show_all_on_location_map', 20);
```

---

## Troubleshooting

### Code Not Working?

1. **Check for syntax errors**: Make sure there are no typos in the code
2. **Clear cache**: Clear WordPress cache and browser cache
3. **Check theme**: Make sure you're editing the correct theme's `functions.php`
4. **Check GeoDirectory**: Ensure GeoDirectory plugin is active
5. **Check priority**: The `20` at the end of `add_action` sets the priority. If other code conflicts, try changing it to `10` or `30`

### White Screen of Death?

If your site goes blank after adding the code:
1. **Remove the code immediately** via FTP or file manager
2. **Check for syntax errors** (missing semicolons, quotes, etc.)
3. **Re-add the code** carefully

### Still Only Showing 10?

1. Check if another plugin or theme is overriding this
2. Try increasing the priority number: change `20` to `30` or `99`
3. Check GeoDirectory settings: Go to **GeoDirectory → Settings → General** and look for pagination settings

---

## Performance Notes

- **50 listings**: Fast load, good user experience
- **100 listings**: Slightly slower but manageable
- **-1 (all listings)**: May be slow for cities with 200+ studios. Consider using the alternative code above to show all on map but paginate the list.

---

## Need Help?

If you need assistance:
1. Make sure you're editing the correct file
2. Double-check the code for typos
3. Test on a staging site first if possible
4. Consider using the Code Snippets plugin for safer code management



