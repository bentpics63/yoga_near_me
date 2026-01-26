# Schema Validation Results
**Date:** December 28, 2025  
**Page:** https://yoganearme.info/studios/stretch-chi/  
**Status:** ❌ **SCHEMA ISSUES FOUND**

---

## Current Schema Status on Live Page

### ✅ Found: BreadcrumbList Schema (Rank Math)
**Status:** ✅ CORRECT  
**Location:** Present in page source

```json
{
  "@context": "https://schema.org",
  "@graph": [{
    "@type": "BreadcrumbList",
    "@id": "https://yoganearme.info/studios/stretch-chi/#breadcrumb",
    "itemListElement": [...]
  }]
}
```

### ❌ Found: LocalBusiness Schema (Incorrect)
**Status:** ❌ **CRITICAL ERRORS**

**Problems:**
1. **Wrong `@type`:** Uses `LocalBusiness` instead of `YogaStudio`
2. **Wrong Description:** Contains "CorePower Yoga - La Jolla, located in San Diego, California" (this is for a DIFFERENT studio)
3. **Invalid Review Field:** `"review":""` (empty string is invalid JSON)
4. **Malformed Opening Hours:** Contains corrupted array data

**Current Schema (from page):**
```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Stretch Chi",
  "description": "Discover the transformative yoga experience at CorePower Yoga - La Jolla, located in San Diego, California. This studio offers a welcoming environment for all levels, helping you find balance, flexibility, and peace of mind. Join a vibrant community and elevate your practice with expert instructors and diverse classes tailored to your needs. Let the beauty of what you love be what you do.",
  "telephone": "773-800-0244",
  "url": "https://yoganearme.info/studios/stretch-chi/",
  "sameAs": ["https://clients.mindbodyonline.com/classic/ws?studioid=20894"],
  "image": {
    "@type": "ImageObject",
    "url": "https://yoganearme.info/wp-content/uploads/2025/06/27-2131.jpg",
    ...
  },
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "410 S Michigan Ave",
    "addressLocality": "Chicago",
    "addressRegion": "Illinois",
    "addressCountry": "United States",
    "postalCode": "60605"
  },
  "openingHours": ["Mo 07:30-20:00\", \"We 09:00-14:00\", \"Th 07:30-19:00\", \"Sa 09:00-14:00\", \"Su 11:00-00:00, UTC\":\"+0\", \"Timezone\":\"UTC"],
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "41.8764412",
    "longitude": "-87.6246904"
  },
  "review": ""
}
```

### ❌ Missing: YogaStudio Schema (Our Custom Schema)
**Status:** ❌ **NOT FOUND**  
**Expected:** Custom `YogaStudio` schema from `schema-code-ready.php`  
**Reality:** This schema block is completely missing from the page

### ❌ Missing: ImageObject Schema (Rank Math Custom Template)
**Status:** ❌ **NOT FOUND**  
**Expected:** Your custom Rank Math ImageObject template  
**Reality:** Not present in the page source

---

## Validation Errors Summary

| Issue | Severity | Description |
|-------|----------|-------------|
| Wrong Schema Type | ❌ Critical | Using `LocalBusiness` instead of `YogaStudio` |
| Incorrect Description | ❌ Critical | Mentions "CorePower Yoga - La Jolla" (wrong studio) |
| Empty Review Field | ❌ Error | `"review":""` is invalid JSON (should be removed or structured) |
| Malformed Opening Hours | ❌ Error | Array contains corrupted metadata strings |
| Missing YogaStudio Schema | ❌ Critical | Our custom schema is not appearing |
| Missing ImageObject Schema | ⚠️ Warning | Rank Math custom template not appearing |

---

## Expected Correct Schema

**What SHOULD be on the page:**

```json
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "Stretch Chi",
  "description": "Stretch Chi - Yoga studio in Chicago, Illinois",
  "url": "https://yoganearme.info/studios/stretch-chi/",
  "telephone": "773-800-0244",
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
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "3.8",
    "reviewCount": "X"
  },
  "image": {
    "@type": "ImageObject",
    "url": "https://yoganearme.info/wp-content/uploads/2025/06/27-2131.jpg",
    "contentUrl": "https://yoganearme.info/wp-content/uploads/2025/06/27-2131.jpg"
  }
}
```

---

## Root Cause Analysis

### Why the Issues Persist

1. **LocalBusiness Schema Still Present:**
   - The `ynm_disable_rankmath_localbusiness_schema` filter is NOT working
   - Rank Math is still outputting LocalBusiness schema despite:
     - Filter being in place
     - Local SEO/Schema being disabled in Rank Math settings
   
   **Possible Reasons:**
   - Rank Math is using a different hook/mechanism we're not catching
   - The filter priority is wrong (we're using `20`, might need to be higher)
   - Rank Math is outputting via a different method than `rank_math/schema/validated_data`

2. **Custom YogaStudio Schema Missing:**
   - Our `ynm_add_studio_schema` function is NOT running
   
   **Possible Reasons:**
   - Code not in `functions.php`
   - PHP syntax error preventing execution
   - WordPress debug mode would show errors (check error logs)
   - Cache preventing updated code from executing
   - `geodir_is_page('detail')` returning false (unlikely, since Rank Math detects the page)

3. **ImageObject Schema Missing:**
   - Your Rank Math custom template is not being output
   - This suggests Rank Math schema output might be partially disabled or filtered incorrectly

---

## Next Steps - Troubleshooting Checklist

### Step 1: Verify PHP Code is Active
- [ ] Check that `schema-code-ready.php` code is in your theme's `functions.php`
- [ ] Verify no PHP syntax errors (enable WordPress debug mode)
- [ ] Check WordPress error logs for PHP errors

### Step 2: Try More Aggressive Filter
- [ ] Use the `schema-code-aggressive-fix.php` version instead
- [ ] This uses multiple filter hooks and output buffering as a last resort

### Step 3: Clear All Caches
- [ ] LiteSpeed Cache: Purge all caches
- [ ] WordPress: Clear object cache
- [ ] Browser: Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)
- [ ] Test in incognito/private browsing mode

### Step 4: Check Rank Math Settings
- [ ] Go to Rank Math → General Settings → Schema Markup
- [ ] Verify "Local SEO/Schema" is disabled
- [ ] Check for any post-specific schema settings on this studio post
- [ ] Look for conflicting schema settings

### Step 5: Test PHP Function Directly
Add this temporary code to `functions.php` to verify the function runs:

```php
function ynm_test_schema_function() {
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        error_log('YNM SCHEMA: Function is running on detail page');
    } else {
        error_log('YNM SCHEMA: Function is NOT running on detail page');
    }
}
add_action('wp_head', 'ynm_test_schema_function', 999);
```

Then check your WordPress debug log to see if the message appears.

---

## Recommended Solution

**Use the aggressive fix version** (`schema-code-aggressive-fix.php`) which:
1. Uses multiple Rank Math filter hooks
2. Filters `rank_math/json_ld` (more reliable)
3. Filters `rank_math/schema/validated_data` (backup)
4. Uses output buffering as last resort (currently commented out)

---

## Validation Status: ❌ FAILED

**Current State:**
- ❌ Wrong schema type (LocalBusiness instead of YogaStudio)
- ❌ Wrong description (mentions different studio)
- ❌ Invalid JSON (empty review field)
- ❌ Missing custom YogaStudio schema
- ❌ Missing ImageObject schema

**Required Actions:**
1. Verify PHP code is in functions.php
2. Check for PHP errors
3. Try aggressive fix version
4. Clear all caches
5. Test again and validate



