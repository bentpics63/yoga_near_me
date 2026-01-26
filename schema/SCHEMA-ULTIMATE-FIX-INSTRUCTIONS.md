# Schema Ultimate Fix - Implementation Instructions

## 🔍 Problem Diagnosis

The live page HTML shows:
- ❌ **Rank Math's `LocalBusiness` schema is STILL present** with wrong data
- ❌ **Custom `YogaStudio` schema is MISSING**
- ❌ **Wrong description**: "CorePower Yoga - La Jolla, located in San Diego, California" (should be Stretch Chi in Chicago)

## 🎯 Solution Overview

This ultimate fix uses **4 layers of protection**:

1. **Multiple Rank Math Filter Hooks** - Catches schema at different stages
2. **Early Filter (Priority 1)** - Removes LocalBusiness before Rank Math processes it
3. **Output Buffering** - Strips LocalBusiness from final HTML (last resort)
4. **Custom YogaStudio Schema** - Outputs correct schema with proper data

## 📋 Step-by-Step Implementation

### Step 1: Backup Your Current functions.php
**CRITICAL:** Always backup before making changes!

1. Go to WordPress Admin → Appearance → Theme Editor
2. Select your active theme's `functions.php`
3. Copy ALL contents to a text file and save it as backup

### Step 2: Remove Existing Schema Code
1. In `functions.php`, search for these function names:
   - `ynm_remove_rankmath_localbusiness_jsonld`
   - `ynm_remove_rankmath_localbusiness_validated`
   - `ynm_add_studio_schema`
   - `ynm_remove_localbusiness_from_output`
   - Any other functions starting with `ynm_`
2. **Delete ALL of these functions and their `add_filter`/`add_action` calls**
3. Save the file

### Step 3: Add the New Code
1. Open `schema-code-ULTIMATE-FIX.php` from this project
2. Copy **ALL** the code (from `<?php` to the end)
3. Paste it at the **END** of your `functions.php` file
4. Save the file

### Step 4: Clear ALL Caches
**This is critical - the schema is cached!**

1. **LiteSpeed Cache:**
   - WordPress Admin → LiteSpeed Cache → Toolbox → Purge → Purge All
   - Or use the "Purge All" button in the admin bar

2. **WordPress Cache (if any):**
   - Clear any other caching plugins

3. **Browser Cache:**
   - Hard refresh: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows)
   - Or clear browser cache completely

### Step 5: Test the Fix
1. Visit: `https://yoganearme.info/studios/stretch-chi/`
2. **View Page Source** (Right-click → View Page Source)
3. Search for: `ld+json` (or `LocalBusiness` or `YogaStudio`)

**Expected Results:**
- ✅ **YogaStudio schema** should be present with correct data
- ❌ **LocalBusiness schema** should be GONE
- ✅ Description should say "Stretch Chi" not "CorePower Yoga - La Jolla"

### Step 6: Validate Schema
1. Go to: https://search.google.com/test/rich-results
2. Enter: `https://yoganearme.info/studios/stretch-chi/`
3. Click "Test URL"
4. Should show **YogaStudio** schema (not LocalBusiness)

## 🔧 How This Fix Works

### Layer 1: Early Filter (Priority 1)
- Runs BEFORE Rank Math processes schema
- Removes LocalBusiness from the data array
- Keeps other schemas (BreadcrumbList, ImageObject)

### Layer 2: Primary Filter (Priority 999)
- `rank_math/json_ld` filter
- Removes LocalBusiness from top-level and @graph arrays
- Runs after Rank Math processes but before output

### Layer 3: Backup Filter (Priority 999)
- `rank_math/schema/validated_data` filter
- Catches schema in validated data format
- Backup in case primary filter misses it

### Layer 4: Output Buffering
- Catches ANY LocalBusiness schema in final HTML
- Uses multiple regex patterns to match all variations
- Runs during `template_redirect` and `shutdown` hooks
- **This is the nuclear option** - it will catch everything

### Custom Schema Output
- Outputs `YogaStudio` schema with correct GeoDirectory data
- Uses `wp_head` hook with priority 1
- Ensures it appears in `<head>` section

## 🐛 Troubleshooting

### If LocalBusiness is STILL appearing:

1. **Check if code is in functions.php:**
   - Search for `ynm_remove_rankmath_localbusiness_jsonld` in functions.php
   - If not found, the code wasn't added correctly

2. **Check for PHP errors:**
   - WordPress Admin → Tools → Site Health
   - Look for PHP errors that might prevent code from running

3. **Verify GeoDirectory is active:**
   - The code checks `geodir_is_page('detail')`
   - Make sure GeoDirectory plugin is active

4. **Check cache again:**
   - Clear LiteSpeed Cache again
   - Try accessing with `?nocache=1` parameter

5. **Check for conflicting code:**
   - Search functions.php for other schema-related code
   - Look for other plugins that might be adding schema

### If YogaStudio schema is missing:

1. **Check if function is being called:**
   - Add temporary error_log to see if function runs:
   ```php
   error_log('YogaStudio schema function called');
   ```
   - Check WordPress debug.log

2. **Verify post data:**
   - Make sure `$post->ID` exists
   - Check that GeoDirectory meta fields have data

3. **Check wp_head hook:**
   - Verify theme calls `wp_head()` in header.php
   - Some themes might not call it

## 📊 Expected Schema Output

After implementing this fix, you should see:

```json
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "Stretch Chi",
  "url": "https://yoganearme.info/studios/stretch-chi/",
  "description": "Stretch Chi - Yoga studio in Chicago",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "410 S Michigan Ave",
    "addressLocality": "Chicago",
    "addressRegion": "Illinois",
    "postalCode": "60605",
    "addressCountry": "United States"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 41.8764412,
    "longitude": -87.6246904
  },
  "telephone": "773-800-0244"
}
```

## ✅ Success Criteria

- [ ] LocalBusiness schema is GONE from page source
- [ ] YogaStudio schema is PRESENT in page source
- [ ] Description contains correct studio name (Stretch Chi)
- [ ] Address data is correct (Chicago, not San Diego)
- [ ] Schema validates in Google Rich Results Test

## 🆘 Still Not Working?

If after all these steps the schema is still wrong:

1. **Check Rank Math settings:**
   - Rank Math → General Settings → Schema
   - Make sure Local SEO/Schema is disabled for "Studios" post type

2. **Check for other plugins:**
   - Other SEO plugins might be adding schema
   - Disable other plugins temporarily to test

3. **Check theme functions:**
   - Some themes add schema in their own functions.php
   - Check parent theme's functions.php too

4. **Contact support:**
   - Share the page source HTML
   - Share your functions.php (sanitized)
   - Share Rank Math settings screenshots



