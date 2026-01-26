# Schema Markup Diagnosis & Fix

## 🔍 Current Status (From Live Page HTML)

### ❌ **CRITICAL ISSUES FOUND:**

1. **LocalBusiness Schema Still Present**
   - **Type:** `LocalBusiness` (should be `YogaStudio`)
   - **Wrong Description:** Contains "CorePower Yoga - La Jolla, located in San Diego, California" 
   - **Correct Studio:** Should be "Stretch Chi" in Chicago, Illinois
   - **Location in HTML:** Found in `<head>` section as JSON-LD script tag

2. **YogaStudio Schema Missing**
   - Our custom `YogaStudio` schema is **NOT appearing** in the HTML
   - The `ynm_add_studio_schema()` function is not outputting

## 🔧 Root Cause Analysis

The filters (`rank_math/json_ld` and `rank_math/schema/validated_data`) are **NOT working** because:

1. **Rank Math is outputting schema in a format our filters don't catch**
   - The schema appears as a single JSON-LD script tag
   - It's not in the `@graph` format our filters check for
   - The filters may be running at the wrong time

2. **Output buffering was incorrectly implemented**
   - Previous version checked `geodir_is_page()` at plugin load time (too early)
   - Needs to check during `template_redirect` hook

## ✅ Solution: `schema-code-final-fix.php`

This new version includes:

1. **Multiple Filter Methods** (same as before)
   - `rank_math/json_ld` filter
   - `rank_math/schema/validated_data` filter

2. **Fixed Output Buffering** (NEW)
   - Checks `geodir_is_page()` at the correct time (`template_redirect`)
   - Uses improved regex patterns to match LocalBusiness schema
   - Handles escaped JSON and multiline content

3. **Custom YogaStudio Schema** (same as before)
   - Outputs correct `YogaStudio` type
   - Pulls data from GeoDirectory fields

## 📋 Implementation Steps

1. **Backup your current `functions.php`**

2. **Remove ALL existing schema code** from `functions.php`
   - Look for functions starting with `ynm_`
   - Remove any `add_filter` or `add_action` calls related to schema

3. **Copy the ENTIRE contents** of `schema-code-final-fix.php` into `functions.php`

4. **Save the file**

5. **Clear ALL caches:**
   - LiteSpeed Cache: Purge All
   - WordPress cache (if any)
   - Browser cache (hard refresh: Cmd+Shift+R / Ctrl+Shift+R)

6. **Test on:** https://yoganearme.info/studios/stretch-chi/

7. **Verify:**
   - View page source (right-click → View Page Source)
   - Search for `"@type":"LocalBusiness"` - should NOT find it
   - Search for `"@type":"YogaStudio"` - should find it
   - Check description matches "Stretch Chi" not "CorePower Yoga"

## 🎯 Expected Results

After implementation, you should see:

✅ **LocalBusiness schema REMOVED**  
✅ **YogaStudio schema PRESENT** with correct data:
   - `@type: "YogaStudio"`
   - `name: "Stretch Chi"`
   - `description: "Stretch Chi - Yoga studio in Chicago"` (or correct description)
   - Correct address, phone, coordinates, etc.

## ⚠️ If It Still Doesn't Work

If after implementing this fix the issues persist:

1. **Check Rank Math Settings:**
   - Go to: Rank Math → Titles & Meta → Post Types → Studios
   - Set "Schema Type" to **"None"** or **"Off"**

2. **Check for PHP Errors:**
   - Enable WordPress debug mode
   - Check error logs

3. **Verify Code is Active:**
   - Add a test `error_log()` statement in the function
   - Check if it appears in PHP error logs

4. **Consider Rank Math Module:**
   - Go to: Rank Math → General Settings → Modules
   - Disable "Local SEO" module if enabled



