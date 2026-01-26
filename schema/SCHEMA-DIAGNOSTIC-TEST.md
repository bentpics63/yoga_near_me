# Schema Diagnostic Test - Disable Rank Math

## 🧪 Test Purpose
Determine if Rank Math is the source of the problematic `LocalBusiness` schema by temporarily disabling it.

## 📋 Test Steps

### Step 1: Disable Rank Math Plugin
1. Go to WordPress Admin → Plugins
2. Find "Rank Math SEO" plugin
3. Click "Deactivate"
4. **DO NOT** delete it - just deactivate

### Step 2: Clear All Caches
1. **LiteSpeed Cache:**
   - WordPress Admin → LiteSpeed Cache → Toolbox → Purge → Purge All
   
2. **Browser Cache:**
   - Hard refresh: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows)

### Step 3: Test the Page
1. Visit: `https://yoganearme.info/studios/stretch-chi/`
2. **View Page Source** (Right-click → View Page Source)
3. Search for: `ld+json` or `LocalBusiness` or `YogaStudio`

## 🔍 Expected Results

### Scenario A: LocalBusiness Schema DISAPPEARS
**Meaning:** Rank Math was definitely the source of the problem.

**Next Steps:**
1. Re-activate Rank Math
2. Implement the `schema-code-ULTIMATE-FIX.php` solution
3. The output buffering will catch Rank Math's schema even if filters don't work

### Scenario B: LocalBusiness Schema STILL PRESENT
**Meaning:** Something ELSE is generating the schema (not Rank Math).

**Possible Sources:**
- Another SEO plugin (Yoast, All in One SEO, etc.)
- Theme's built-in schema
- Another custom plugin
- GeoDirectory plugin itself might be adding schema

**Next Steps:**
1. Check for other SEO plugins
2. Check theme's functions.php for schema code
3. Check GeoDirectory settings for schema options
4. Search functions.php for other schema-related code

### Scenario C: NO Schema at All
**Meaning:** Rank Math was generating ALL the schema, and our custom code isn't running.

**Next Steps:**
1. Check if `ynm_add_studio_schema` function is in functions.php
2. Check for PHP errors in WordPress debug.log
3. Verify GeoDirectory is active and `geodir_is_page('detail')` works
4. Check if theme calls `wp_head()` in header.php

## 📊 What to Look For

After disabling Rank Math, check the page source for:

1. **LocalBusiness schema:**
   - Search for: `"@type":"LocalBusiness"`
   - If found → Something else is generating it
   - If NOT found → Rank Math was the source ✅

2. **YogaStudio schema:**
   - Search for: `"@type":"YogaStudio"`
   - If found → Our custom code is working ✅
   - If NOT found → Our custom code isn't running

3. **Other schemas:**
   - BreadcrumbList
   - ImageObject
   - Organization
   - These might come from Rank Math or other sources

## 🔄 After the Test

### If Rank Math Was the Problem:
1. **Re-activate Rank Math**
2. **Implement the ultimate fix:**
   - Use `schema-code-ULTIMATE-FIX.php`
   - The output buffering will catch Rank Math's schema

### If Something Else Is the Problem:
1. **Keep Rank Math disabled** (or re-enable if you need it)
2. **Find the real source:**
   - Check other plugins
   - Check theme files
   - Check GeoDirectory settings
3. **Update the fix** to target the correct source

## 📝 Report Back

After running this test, please report:
1. ✅ or ❌ - Was LocalBusiness schema still present after disabling Rank Math?
2. ✅ or ❌ - Was YogaStudio schema present?
3. What other schemas (if any) were present?
4. Any errors in WordPress debug.log?

This will help us identify the exact source and create the right fix!



