# Fix: Location Page Showing Only 10 Studios on Map

## Problem
The SEO-friendly location page (`/location/united-states/illinois/chicago/`) only shows 10 studios on the map when there are 100+ in the area. This is because GeoDirectory's location page uses default pagination (10 per page).

## Solution Options

### Option 1: Increase Posts Per Page on Location Pages (Recommended)

Add this code to your theme's `functions.php` file (or use a code snippets plugin):

```php
/**
 * Show more listings on GeoDirectory location pages
 * This increases the number of listings shown per page, which also increases map markers
 */
function ynm_increase_location_page_listings($query) {
    // Only affect GeoDirectory location pages
    if (!is_admin() && $query->is_main_query()) {
        // Check if we're on a GeoDirectory location page
        if (function_exists('geodir_is_page') && geodir_is_page('location')) {
            // Set to show 50 listings per page (adjust as needed)
            // Use -1 to show ALL listings (may be slow for large cities)
            $query->set('posts_per_page', 50);
        }
    }
}
add_action('pre_get_posts', 'ynm_increase_location_page_listings', 20);
```

**Adjust the number:**
- `50` = Shows 50 studios per page (good for most cities)
- `100` = Shows 100 studios per page (for large cities)
- `-1` = Shows ALL studios (may slow down page load for cities with 200+ studios)

### Option 2: Show All Listings on Location Pages (For Map Display)

If you want the map to show ALL studios but keep pagination for the list view:

```php
/**
 * Show all listings on location page map (but keep pagination for list)
 * This ensures the map shows all studios while list view remains paginated
 */
function ynm_show_all_on_location_map($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (function_exists('geodir_is_page') && geodir_is_page('location')) {
            // Check if this is the map query (GeoDirectory uses separate queries)
            if (isset($query->query_vars['gd_map_query']) || 
                (isset($_REQUEST['action']) && $_REQUEST['action'] == 'geodir_map_markers')) {
                $query->set('posts_per_page', -1); // Show all on map
            } else {
                $query->set('posts_per_page', 50); // Paginate list view
            }
        }
    }
}
add_action('pre_get_posts', 'ynm_show_all_on_location_map', 20);
```

### Option 3: Use Search-Page Instead (Hybrid Approach)

Modify the JavaScript redirect to use the search-page URL with coordinates instead of the location page. This way you get:
- SEO-friendly coordinates in URL
- All studios visible with pagination
- Map that shows all results

Update the JavaScript in `home-page-FIXED.html`:

```javascript
// Instead of redirecting to location page, redirect to search-page with coordinates
if (cityInfo && cityInfo.locationPath) {
    // Use search-page with coordinates for better functionality
    const searchUrl = `https://yoganearme.info/search-page/?geodir_search=1&stype=gd_place&s=&snear=${encodeURIComponent(cityName)}&sgeo_lat=${cityInfo.lat}&sgeo_lon=${cityInfo.lon}`;
    window.location.href = searchUrl;
}
```

### Option 4: Configure GeoDirectory Settings

1. Go to **GeoDirectory → Settings → General**
2. Look for **"Posts per page"** or **"Listings per page"** setting
3. Increase it from 10 to 50 or 100
4. Note: This affects ALL GeoDirectory pages site-wide

---

## Recommended Solution

**I recommend Option 1** - Add the code to increase listings per page to 50. This provides:
- ✅ Better map coverage (50 studios visible)
- ✅ Still manageable page load
- ✅ Maintains SEO-friendly URLs
- ✅ Keeps pagination for very large cities

For cities with 100+ studios, you might want to increase to 100, or use Option 2 to show all on the map while keeping list pagination.

---

## Testing

After implementing Option 1:
1. Search for "Chicago" from home page
2. Should redirect to `/location/united-states/illinois/chicago/`
3. Map should now show 50 studios (or whatever number you set)
4. List view should show 50 studios with pagination if there are more

## Performance Note

- **50 listings**: Good balance, fast load times
- **100 listings**: Slower but manageable for large cities
- **-1 (all listings)**: May be slow for cities with 200+ studios. Consider using Option 2 instead.



