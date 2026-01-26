# How to Find Rank Math Schema Settings

## If Schema Module is Disabled

If you don't see "Schema" in the Rank Math menu, the Schema module might be disabled.

### Step 1: Enable Schema Module
1. Go to: **WordPress Admin → Rank Math → Dashboard**
2. Look for **"Modules"** section
3. Find **"Schema"** module
4. Toggle it **ON** (enable it)
5. Save changes

### Step 2: Access Schema Settings
Once enabled, you should see:
- **Rank Math → General Settings → Schema**

---

## Alternative Locations to Check

### Option 1: Titles & Meta
- **Rank Math → Titles & Meta → Schema**
- Some versions have schema settings here

### Option 2: Post Type Settings
- **Rank Math → Titles & Meta → Post Types → `gd_place`**
- Look for "Schema Type" dropdown in individual post type settings

---

## What We're Looking For

### Critical Settings:
1. **Local SEO Schema** - Should be DISABLED
2. **Auto-generate Schema** - Check if enabled
3. **Post Type Schema** - For `gd_place`, should NOT be "LocalBusiness"

---

## Quick Check: Post Type Settings

Even if Schema module is disabled, check:
- **Rank Math → Titles & Meta → Post Types → `gd_place`**
- Look for "Schema Type" dropdown
- Should be set to "None" or "WebPage"
- Should NOT be "LocalBusiness"

---

## Next Steps

1. Check if Schema module needs to be enabled
2. Check Post Type settings for `gd_place`
3. Test a studio page to see what schema is outputting

