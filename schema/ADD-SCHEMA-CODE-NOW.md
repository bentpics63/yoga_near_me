# Add Schema Code - Simple Instructions

## ✅ You're Ready!

Your `functions.php` is clean and working. Now let's add the safe schema code.

## 📋 Step-by-Step

### Step 1: Open Your functions.php
- WordPress Admin → Appearance → Theme Editor
- Select your active theme's `functions.php`

### Step 2: Scroll to the Bottom
- Find the very last line of code (should end with the `ynm_increase_location_page_listings` function)
- Add a blank line after it

### Step 3: Copy the Schema Code
- Open `schema-code-SAFE-FIX.php` from this project
- Copy **ALL** the code (from line 15 to line 314 - skip the comment block at the top)
- Or copy everything starting from `// ============================================` down to the end

### Step 4: Paste at the End
- Paste the code at the very end of your `functions.php`
- Make sure there's no duplicate `<?php` tag (the code doesn't include one)

### Step 5: Save the File
- Click "Update File"
- The site should still work (no critical errors)

### Step 6: Clear All Caches
1. **LiteSpeed Cache:** Purge All
2. **Browser:** Hard refresh (Cmd+Shift+R or Ctrl+Shift+R)

### Step 7: Test
- Visit: `https://yoganearme.info/studios/stretch-chi/`
- View page source (Right-click → View Page Source)
- Search for: `ld+json` or `YogaStudio`

## 🎯 What This Code Does

1. **Removes Rank Math's LocalBusiness schema** - Uses 2 filter hooks
2. **Output buffering backup** - Strips LocalBusiness from final HTML if filters miss it
3. **Adds custom YogaStudio schema** - Outputs correct schema with proper data

## ✅ Expected Result

After adding the code, you should see:
- ✅ **YogaStudio schema** in the page source
- ❌ **LocalBusiness schema** should be gone (or at least have wrong data removed)

## 🐛 If You Get Errors

If you see a critical error again:
1. **Immediately remove the code** you just added
2. **Check for syntax errors** (missing semicolons, brackets, etc.)
3. **Share the error message** so we can fix it

## 📝 Your functions.php Should Look Like:

```php
<?php
// ... your existing code ...

// Studio Information Customizer Settings
// ... more existing code ...

// Show more listings on GeoDirectory location pages
function ynm_increase_location_page_listings($query) {
    // ... existing code ...
}
add_action('pre_get_posts', 'ynm_increase_location_page_listings', 20);

// ============================================
// METHOD 1: Filter Rank Math's JSON-LD output
// ============================================
// ... NEW SCHEMA CODE STARTS HERE ...
```

The new code goes **after** your existing code, **before** the closing `?>` tag (if there is one).



