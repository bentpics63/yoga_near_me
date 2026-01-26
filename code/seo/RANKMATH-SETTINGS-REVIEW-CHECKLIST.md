# RankMath Settings Review Checklist
## Post-Schema Implementation Review

**Date:** Tomorrow's Session  
**Purpose:** Review RankMath settings after custom YogaStudio schema implementation  
**Goal:** Re-enable useful features while keeping schema conflicts resolved

---

## 🎯 Current Situation

**What happened:**
- You disabled RankMath's Local SEO/Schema features to fix schema conflicts
- Custom YogaStudio schema is now working via functions.php
- Need to review what can be safely re-enabled

**What we need to check:**
1. Schema settings (keep disabled for studios)
2. Local SEO settings (may need updates)
3. Meta tag settings (should be active)
4. Social media settings (should be active)
5. Sitemap settings (should be active)

---

## 📋 RankMath Settings Review Checklist

### **1. Schema Settings** ⚠️ CRITICAL

**Location:** WordPress Admin → Rank Math → General Settings → Schema

#### ✅ Keep Disabled (For Studio Pages):
- [ ] **Local SEO Schema** - Keep DISABLED
  - **Why:** We're using custom YogaStudio schema instead
  - **Status:** Should remain OFF

- [ ] **Auto-generate Schema** - Check if this affects studios
  - **Action:** If enabled, verify it's not creating LocalBusiness schema
  - **Test:** View page source on a studio page, search for "LocalBusiness"

#### ✅ Can Enable (For Other Pages):
- [ ] **Article Schema** - Can be ENABLED for blog posts
- [ ] **WebPage Schema** - Can be ENABLED for regular pages
- [ ] **Breadcrumb Schema** - Should be ENABLED (you're keeping this)
- [ ] **Organization Schema** - Can be ENABLED for homepage

**Action Items:**
- [ ] Verify Local SEO Schema is disabled
- [ ] Test that no LocalBusiness schema appears on studio pages
- [ ] Enable Article/WebPage schema for non-studio pages

---

### **2. Local SEO Settings** 🔍 REVIEW CAREFULLY

**Location:** WordPress Admin → Rank Math → General Settings → Local SEO

#### ⚠️ Check These Settings:

- [ ] **Local SEO Module** - Status: ?
  - **If Enabled:** May conflict with custom schema
  - **If Disabled:** Good - keep it disabled
  - **Action:** Verify it's disabled or configure to exclude studio pages

- [ ] **Business Type** - Current setting: ?
  - **Note:** This might affect schema generation
  - **Action:** If Local SEO is enabled, set to exclude `gd_place` post type

- [ ] **Address Fields** - Current settings: ?
  - **Note:** These shouldn't matter if Local SEO is disabled
  - **Action:** Review but likely no changes needed

**Action Items:**
- [ ] Verify Local SEO module is disabled OR configured to exclude studio pages
- [ ] Document current Local SEO settings
- [ ] Test that disabling Local SEO doesn't break anything else

---

### **3. Titles & Meta Settings** ✅ SHOULD BE ACTIVE

**Location:** WordPress Admin → Rank Math → Titles & Meta

#### ✅ Verify These Are Active:

- [ ] **Homepage Title** - Should be set
  - **Check:** Does it match your brand?
  - **Example:** "Yoga Near Me | Find Yoga Studios Near You"

- [ ] **Post Type Settings** - Check `gd_place` settings
  - **Title Template:** Should be set (e.g., `%title% | Yoga Near Me`)
  - **Description Template:** Should be set
  - **Action:** Verify templates are appropriate for studio pages

- [ ] **Archive Settings** - Check studio archive pages
  - **Title Template:** Should be set
  - **Description:** Should be set

**Action Items:**
- [ ] Review title templates for `gd_place` post type
- [ ] Review description templates
- [ ] Test meta tags on a studio page (view source)
- [ ] Ensure titles/descriptions are pulling correct data

---

### **4. Social Media Settings** ✅ SHOULD BE ACTIVE

**Location:** WordPress Admin → Rank Math → Social Media

#### ✅ Verify These Are Active:

- [ ] **Facebook Settings**
  - **Open Graph Tags:** Should be ENABLED
  - **Default Image:** Should be set
  - **App ID:** If you have one, should be set
  - **Action:** Test Facebook sharing on a studio page

- [ ] **Twitter Settings**
  - **Twitter Cards:** Should be ENABLED
  - **Card Type:** Should be set (Summary or Summary Large Image)
  - **Default Image:** Should be set
  - **Action:** Test Twitter sharing on a studio page

- [ ] **Post Type Settings** - Check `gd_place` settings
  - **Facebook Image:** Should pull studio featured image
  - **Twitter Image:** Should pull studio featured image
  - **Action:** Verify images are correct when sharing

**Action Items:**
- [ ] Verify Open Graph tags are enabled
- [ ] Verify Twitter Cards are enabled
- [ ] Test social sharing on a studio page
- [ ] Check that images are pulling correctly

---

### **5. Sitemap Settings** ✅ SHOULD BE ACTIVE

**Location:** WordPress Admin → Rank Math → Sitemap Settings

#### ✅ Verify These Are Active:

- [ ] **Sitemap Status** - Should be ENABLED
  - **Check:** Is sitemap being generated?
  - **URL:** Should be `yoursite.com/sitemap.xml`

- [ ] **Post Types** - Check `gd_place` inclusion
  - **Status:** Should be INCLUDED in sitemap
  - **Action:** Verify studio pages are in sitemap

- [ ] **Taxonomies** - Check category/tag inclusion
  - **Status:** Should be included if relevant
  - **Action:** Review which taxonomies to include

- [ ] **Images** - Check image sitemap
  - **Status:** Should be ENABLED
  - **Action:** Verify studio images are in image sitemap

**Action Items:**
- [ ] Verify sitemap is enabled
- [ ] Check that `gd_place` post type is included
- [ ] Test sitemap URL: `yoursite.com/sitemap.xml`
- [ ] Verify studio pages appear in sitemap

---

### **6. Advanced Settings** 🔍 REVIEW

**Location:** WordPress Admin → Rank Math → General Settings → Advanced

#### ⚠️ Check These:

- [ ] **Auto-update Internal Links** - Current: ?
  - **Note:** Should be safe to enable
  - **Action:** Review if needed

- [ ] **Remove Stopwords from Permalinks** - Current: ?
  - **Note:** Should be safe to enable
  - **Action:** Review if needed

- [ ] **Strip Category Base** - Current: ?
  - **Note:** May affect URL structure
  - **Action:** Review carefully

**Action Items:**
- [ ] Review advanced settings
- [ ] Document current settings
- [ ] Test any changes before enabling

---

### **7. Post Type Specific Settings** 🎯 IMPORTANT

**Location:** WordPress Admin → Rank Math → Titles & Meta → Post Types → `gd_place`

#### ✅ Review Studio Page Settings:

- [ ] **Title Template**
  - **Current:** `%title% | Yoga Near Me` (or similar)
  - **Action:** Verify it's correct
  - **Test:** Check a studio page's `<title>` tag

- [ ] **Description Template**
  - **Current:** Should pull studio description
  - **Action:** Verify it's pulling correct data
  - **Test:** Check a studio page's meta description

- [ ] **Schema Type** - ⚠️ CRITICAL
  - **Current:** Should be set to "None" or "WebPage"
  - **Why:** We're using custom YogaStudio schema
  - **Action:** Verify it's NOT set to "LocalBusiness"
  - **Test:** View page source, search for schema

- [ ] **Robots Meta**
  - **Current:** Should allow indexing
  - **Action:** Verify `noindex` is NOT checked

**Action Items:**
- [ ] Review `gd_place` post type settings
- [ ] Verify schema type is NOT LocalBusiness
- [ ] Test title/description templates
- [ ] Verify robots meta is correct

---

## 🧪 Testing Checklist

After reviewing settings, test these:

### **1. Schema Testing**
- [ ] Visit a studio page
- [ ] View page source (Right-click → View Page Source)
- [ ] Search for `ld+json`
- [ ] **Expected:** Should see `YogaStudio` schema (your custom)
- [ ] **Expected:** Should see `BreadcrumbList` schema (from RankMath)
- [ ] **NOT Expected:** Should NOT see `LocalBusiness` schema

### **2. Meta Tags Testing**
- [ ] Visit a studio page
- [ ] View page source
- [ ] Check `<title>` tag - should match template
- [ ] Check `<meta name="description">` - should have description
- [ ] Check `<meta property="og:title">` - should match title
- [ ] Check `<meta property="og:description">` - should match description
- [ ] Check `<meta property="og:image">` - should have studio image

### **3. Social Media Testing**
- [ ] **Facebook:** Use Facebook Debugger (https://developers.facebook.com/tools/debug/)
  - Enter studio page URL
  - Check OG tags are correct
  - Check image is correct
- [ ] **Twitter:** Use Twitter Card Validator (https://cards-dev.twitter.com/validator)
  - Enter studio page URL
  - Check card preview is correct

### **4. Sitemap Testing**
- [ ] Visit `yoursite.com/sitemap.xml`
- [ ] Check that studio pages (`gd_place`) are listed
- [ ] Verify URLs are correct
- [ ] Check image sitemap if enabled

---

## 📝 Settings Documentation Template

Use this to document current settings:

```
RANKMATH SETTINGS - [DATE]

Schema Settings:
- Local SEO Schema: [ENABLED/DISABLED]
- Auto-generate Schema: [ENABLED/DISABLED]
- Article Schema: [ENABLED/DISABLED]
- Breadcrumb Schema: [ENABLED/DISABLED]

Local SEO Settings:
- Local SEO Module: [ENABLED/DISABLED]
- Business Type: [SETTING]
- Address Fields: [SETTINGS]

Titles & Meta:
- Homepage Title: [TITLE]
- gd_place Title Template: [TEMPLATE]
- gd_place Description Template: [TEMPLATE]
- gd_place Schema Type: [TYPE]

Social Media:
- Facebook OG Tags: [ENABLED/DISABLED]
- Twitter Cards: [ENABLED/DISABLED]
- Default Images: [SET]

Sitemap:
- Sitemap Enabled: [YES/NO]
- gd_place Included: [YES/NO]
- Image Sitemap: [ENABLED/DISABLED]
```

---

## 🚨 Critical Rules

### **DO NOT Re-enable:**
1. ❌ **Local SEO Schema** - Will conflict with custom YogaStudio schema
2. ❌ **LocalBusiness Schema** - Will create duplicates/wrong data
3. ❌ **Auto-schema for gd_place** - Will conflict with custom schema

### **DO Re-enable (if disabled):**
1. ✅ **Meta Tags** - Titles, descriptions, OG tags
2. ✅ **Social Media** - Facebook OG, Twitter Cards
3. ✅ **Sitemaps** - XML sitemap generation
4. ✅ **Breadcrumb Schema** - Safe and useful
5. ✅ **Article Schema** - For blog posts (not studios)

### **DO Test After Changes:**
1. ✅ View page source on studio pages
2. ✅ Check for schema conflicts
3. ✅ Test social media sharing
4. ✅ Verify sitemap includes studios
5. ✅ Check meta tags are correct

---

## 🎯 Priority Actions for Tomorrow

### **High Priority:**
1. [ ] **Verify Local SEO Schema is disabled**
2. [ ] **Check gd_place schema type is NOT LocalBusiness**
3. [ ] **Test that no LocalBusiness schema appears**
4. [ ] **Review title/description templates for studios**

### **Medium Priority:**
5. [ ] **Verify social media settings are active**
6. [ ] **Test Facebook/Twitter sharing**
7. [ ] **Check sitemap includes studio pages**
8. [ ] **Review meta tags on studio pages**

### **Low Priority:**
9. [ ] **Review advanced settings**
10. [ ] **Document all current settings**
11. [ ] **Optimize title/description templates**

---

## 📚 Reference Files

**Related Documentation:**
- `RANKMATH-USAGE-ANALYSIS.md` - What RankMath is currently doing
- `SCHEMA/SCHEMA-SUMMARY.md` - Your custom schema implementation
- `PHP ADDS/functions.php` - Schema code (lines 178-1455)

**Key Functions to Check:**
- `ynm_remove_rankmath_localbusiness_jsonld()` - Removes LocalBusiness schema
- `ynm_add_studio_schema()` - Adds YogaStudio schema

---

## ✅ Success Criteria

**After tomorrow's review, you should have:**
- ✅ Local SEO Schema disabled (no conflicts)
- ✅ Custom YogaStudio schema working (verified)
- ✅ Meta tags active and correct (titles, descriptions)
- ✅ Social media tags active (OG, Twitter)
- ✅ Sitemap including studio pages
- ✅ No duplicate or conflicting schema
- ✅ All settings documented

---

**Ready for tomorrow's review!** 📋

