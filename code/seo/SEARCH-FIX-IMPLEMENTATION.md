# Search Bar Fix - Direct Implementation

## Problem
The search form only sends `snear` (city name) but GeoDirectory needs `sgeo_lat` and `sgeo_lon` to zoom the map to the city.

## Solution
Add hidden coordinate fields and JavaScript to geocode city names before form submission.

---

## Changes to Make

### 1. Update the Search Form (around line 200-210)

**FIND THIS:**
```html
<form class="hero-search" action="https://yoganearme.info/search-page/" method="get">
    <!-- Added Required GD Hidden Fields -->
    <input type="hidden" name="geodir_search" value="1">
    <input type="hidden" name="stype" value="gd_place">
    <input type="hidden" name="s" value="">
    
    <label for="hero-location" class="visually-hidden">Search yoga studios by city or zip code</label>
    <input
        type="text"
        id="hero-location"
        name="snear"
        class="search-input"
        placeholder="Enter your city or zip code"
    >
    <button type="submit" class="btn btn-cta">Search</button>
</form>
```

**REPLACE WITH:**
```html
<form class="hero-search" id="hero-search-form" action="https://yoganearme.info/search-page/" method="get">
    <!-- Added Required GD Hidden Fields -->
    <input type="hidden" name="geodir_search" value="1">
    <input type="hidden" name="stype" value="gd_place">
    <input type="hidden" name="s" value="">
    <!-- NEW: Hidden coordinate fields for map zoom -->
    <input type="hidden" name="sgeo_lat" id="hero-sgeo-lat" value="">
    <input type="hidden" name="sgeo_lon" id="hero-sgeo-lon" value="">
    
    <label for="hero-location" class="visually-hidden">Search yoga studios by city or zip code</label>
    <input
        type="text"
        id="hero-location"
        name="snear"
        class="search-input"
        placeholder="Enter your city or zip code"
        autocomplete="off"
    >
    <button type="submit" class="btn btn-cta">Search</button>
</form>
```

### 2. Add JavaScript Before Closing </body> Tag (after your existing nav toggle script)

**FIND THIS (around line 700-710):**
```html
    <script>
    // Mobile nav toggle
    const toggle = document.querySelector('.nav-toggle');
    const nav    = document.getElementById('primary-navigation');

    if (toggle && nav) {
      toggle.addEventListener('click', () => {
        const open = nav.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    }
    </script>
</body>
```

**ADD THIS RIGHT BEFORE </body>:**
```html
    <script>
    // Mobile nav toggle
    const toggle = document.querySelector('.nav-toggle');
    const nav    = document.getElementById('primary-navigation');

    if (toggle && nav) {
      toggle.addEventListener('click', () => {
        const open = nav.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    }

    // ============================================
    // SEARCH FORM COORDINATE FIX
    // ============================================
    
    // City coordinates lookup table
    const cityCoordinates = {
        // Major US Cities
        'new york': { lat: 40.7127281, lon: -74.0060152 },
        'new york city': { lat: 40.7127281, lon: -74.0060152 },
        'nyc': { lat: 40.7127281, lon: -74.0060152 },
        'los angeles': { lat: 34.0522342, lon: -118.2436849 },
        'la': { lat: 34.0522342, lon: -118.2436849 },
        'chicago': { lat: 41.8755616, lon: -87.6244212 },
        'san francisco': { lat: 37.7792588, lon: -122.4193286 },
        'sf': { lat: 37.7792588, lon: -122.4193286 },
        'miami': { lat: 25.7741728, lon: -80.1936200 },
        'austin': { lat: 30.2711286, lon: -97.7436995 },
        'denver': { lat: 39.7392364, lon: -104.9848620 },
        'seattle': { lat: 47.6038321, lon: -122.3300620 },
        'portland': { lat: 45.5202471, lon: -122.6741940 },
        'san diego': { lat: 32.7174202, lon: -117.1627720 },
        'washington dc': { lat: 38.8950368, lon: -77.0365427 },
        'washington': { lat: 38.8950368, lon: -77.0365427 },
        'boston': { lat: 42.3554334, lon: -71.0605110 },
        'philadelphia': { lat: 39.9525839, lon: -75.1652215 },
        'oakland': { lat: 37.8044557, lon: -122.2713560 },
        'atlanta': { lat: 33.7544657, lon: -84.3898151 },
        'charlotte': { lat: 35.2272086, lon: -80.8430827 },
        'houston': { lat: 29.7589382, lon: -95.3676974 },
        'scottsdale': { lat: 33.4942189, lon: -111.9260180 },
        'boulder': { lat: 40.0149856, lon: -105.2705450 },
        // Canadian Cities
        'toronto': { lat: 43.6534817, lon: -79.3839347 },
        'vancouver': { lat: 49.2608724, lon: -123.1139520 },
        'vancouver bc': { lat: 49.2608724, lon: -123.1139520 },
        'calgary': { lat: 51.0456064, lon: -114.0575410 },
        'victoria': { lat: 48.4283182, lon: -123.3649530 },
        'victoria bc': { lat: 48.4283182, lon: -123.3649530 },
        'montreal': { lat: 45.5031824, lon: -73.5698065 },
    };

    // Normalize city name for lookup
    function normalizeCityName(cityName) {
        return cityName.toLowerCase().trim();
    }

    // Get coordinates from lookup table
    function getCityCoordinates(cityName) {
        const normalized = normalizeCityName(cityName);
        
        // Direct match
        if (cityCoordinates[normalized]) {
            return cityCoordinates[normalized];
        }
        
        // Partial match (handles "New York, NY" or "Chicago, IL")
        for (const [key, coords] of Object.entries(cityCoordinates)) {
            if (normalized.includes(key) || key.includes(normalized)) {
                return coords;
            }
        }
        
        return null;
    }

    // Handle search form submission
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('hero-search-form');
        const locationInput = document.getElementById('hero-location');
        const latInput = document.getElementById('hero-sgeo-lat');
        const lonInput = document.getElementById('hero-sgeo-lon');
        
        if (!searchForm || !locationInput || !latInput || !lonInput) {
            console.warn('Search form elements not found');
            return;
        }
        
        // On form submit, geocode the city and add coordinates
        searchForm.addEventListener('submit', function(e) {
            const cityName = locationInput.value.trim();
            
            if (!cityName) {
                // Empty search - let form submit normally
                return;
            }
            
            // Get coordinates from lookup table
            const coords = getCityCoordinates(cityName);
            
            if (coords) {
                // Set coordinates in hidden fields
                latInput.value = coords.lat;
                lonInput.value = coords.lon;
            } else {
                // For unknown cities/zip codes, clear coordinates
                // GeoDirectory will attempt server-side geocoding
                latInput.value = '';
                lonInput.value = '';
            }
            
            // Form submits with coordinates if found
        });
        
        // Optional: Auto-populate coordinates as user types (better UX)
        let debounceTimer;
        locationInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const cityName = this.value.trim();
            
            if (cityName.length < 3) {
                latInput.value = '';
                lonInput.value = '';
                return;
            }
            
            debounceTimer = setTimeout(function() {
                const coords = getCityCoordinates(cityName);
                if (coords) {
                    latInput.value = coords.lat;
                    lonInput.value = coords.lon;
                }
            }, 300);
        });
    });
    </script>
</body>
```

---

## How It Works

1. **Hidden Fields**: Added `sgeo_lat` and `sgeo_lon` hidden inputs to the form
2. **Lookup Table**: JavaScript contains coordinates for common cities
3. **Form Submission**: When user submits, JavaScript looks up the city name and populates coordinates
4. **Map Zoom**: GeoDirectory receives the coordinates and zooms the map to that location

## Testing

After implementing:
- Search "Chicago" → Map should zoom to Chicago
- Search "New York" → Map should zoom to NYC  
- Search "90210" (zip code) → Will rely on GeoDirectory server-side geocoding
- Check URL: Should see `sgeo_lat` and `sgeo_lon` parameters in search results

## Adding More Cities

To add more cities to the lookup table, add entries to the `cityCoordinates` object:
```javascript
'city name': { lat: 40.123456, lon: -74.123456 },
```

## Notes

- The lookup table approach is fast (no API calls) and works offline
- For cities not in the table, coordinates will be empty and GeoDirectory will handle geocoding server-side
- You can expand the lookup table with more cities as needed
- The solution matches partial city names (e.g., "New York, NY" matches "new york")

---

## ⚠️ Important: Location Page Shows Only 10 Studios?

If your location pages (e.g., `/location/united-states/illinois/chicago/`) only show 10 studios on the map when there are 100+ in the area, you need to add PHP code to increase the listings per page.

**See `PHP-FIX-IMPLEMENTATION.md` for the complete solution.**

Quick fix: Add this to your theme's `functions.php`:

```php
function ynm_increase_location_page_listings($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (function_exists('geodir_is_page') && geodir_is_page('location')) {
            $query->set('posts_per_page', 50); // Change 50 to your preferred number
        }
    }
}
add_action('pre_get_posts', 'ynm_increase_location_page_listings', 20);
```

This will show 50 studios per page (adjust the number as needed).



