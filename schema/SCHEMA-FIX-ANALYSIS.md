# Schema Markup Issue Analysis & Fix

## 🔍 Problem Identified

**Issue:** The schema JSON-LD on single studio pages contains **wrong data**:
- ❌ Description mentions "CorePower Yoga - La Jolla" instead of "Stretch Chi - Chicago"
- ❌ Uses generic `LocalBusiness` type instead of `YogaStudio`
- ❌ Empty `review` field
- ❌ Missing proper `aggregateRating` structure

## 🎯 Root Cause

**Rank Math SEO Plugin** is automatically generating `LocalBusiness` schema for GeoDirectory posts, but it's:
1. Pulling description from the wrong field or using a template
2. Not properly mapping GeoDirectory custom fields
3. Using generic `LocalBusiness` instead of `YogaStudio` type

## ✅ Solution Implemented

The updated `schema-code-ready.php` now includes:

### 1. **Disable Rank Math's LocalBusiness Schema**
```php
function ynm_disable_rankmath_localbusiness_schema($schemas) {
    // Removes Rank Math's LocalBusiness schema on GeoDirectory pages
    // So our custom schema takes over
}
```

### 2. **Custom YogaStudio Schema**
- ✅ Uses `YogaStudio` type (more specific than LocalBusiness)
- ✅ Pulls correct data from GeoDirectory fields
- ✅ Validates description to prevent wrong data
- ✅ Includes proper `aggregateRating` structure
- ✅ Better image handling with `ImageObject`

### 3. **Description Validation**
- Checks if description contains the studio name
- Falls back to auto-generated description if data seems wrong
- Prevents "CorePower Yoga - La Jolla" type errors

## 📋 Implementation Steps

1. **Copy the updated code** from `schema-code-ready.php`
2. **Paste at the END** of your theme's `functions.php` file
3. **Save the file**
4. **Clear all caches:**
   - LiteSpeed Cache
   - WordPress cache
   - Browser cache
5. **Test:**
   - Visit: `https://yoganearme.info/studios/stretch-chi/`
   - View page source (Ctrl+U / Cmd+U)
   - Search for "application/ld+json"
   - Verify schema shows:
     - `@type: "YogaStudio"` (not LocalBusiness)
     - Correct studio name: "Stretch Chi"
     - Correct description (not mentioning CorePower Yoga)
     - Proper address, phone, etc.
6. **Validate:**
   - Test at: https://search.google.com/test/rich-results
   - Should show no errors

## 🔧 If Rank Math Schema Still Appears

If after implementing the code, Rank Math's schema still shows up:

1. **Try the alternative filter** (uncomment lines 50-59 in the code)
2. **Or disable Rank Math schema in settings:**
   - Go to: Rank Math → General Settings → Schema
   - Disable "LocalBusiness" schema for GeoDirectory post types
   - Or disable auto-schema generation entirely for `gd_place` post type

## 📊 Expected Schema Output

After fix, the schema should look like:

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
    "latitude": "41.8764412",
    "longitude": "-87.6246904"
  },
  "telephone": "773-800-0244",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "3.8",
    "reviewCount": "X"
  }
}
```

## ⚠️ Important Notes

- **Rank Math BreadcrumbList schema is fine** - we're only removing the LocalBusiness one
- **Cache clearing is critical** - LiteSpeed Cache was active, so clear it
- **Test on multiple studios** - verify it works for different listings
- **Monitor for a few days** - ensure no conflicts with other plugins

## 🎯 Next Steps After Implementation

1. ✅ Verify schema appears correctly
2. ✅ Test with Google Rich Results Test
3. ✅ Check a few different studio pages
4. ✅ Monitor for any errors in WordPress debug log
5. ✅ Wait 1-2 weeks for Google to re-crawl and show rich snippets



