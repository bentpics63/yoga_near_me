# YogaNearMe.info SEO Implementation Guide

## Overview

This guide covers all SEO enhancements created for the directory launch. Follow the installation steps in order.

---

## 📁 Files Created

| File | Purpose |
|------|---------|
| `code/PHP ADDS/SEO-ENHANCEMENTS.php` | All schema + title optimizations |
| `schema/SITEMAP-STRATEGY-30K-LISTINGS.md` | Sitemap configuration guide |
| `templates/CITY-LANDING-PAGE-TEMPLATE.md` | City page templates for local SEO |

---

## 🚀 Quick Installation

### Step 1: Add SEO Enhancements to WordPress

Add this line to your theme's `functions.php`:

```php
// YogaNearMe SEO Enhancements
require_once get_stylesheet_directory() . '/code/PHP ADDS/SEO-ENHANCEMENTS.php';
```

**Or** copy the entire contents of `SEO-ENHANCEMENTS.php` into `functions.php`.

### Step 2: Clear All Caches

After adding the code:
1. Clear WordPress cache (if using caching plugin)
2. Clear LiteSpeed cache (if applicable)
3. Clear browser cache
4. Wait 1-2 minutes for changes to propagate

### Step 3: Verify Schema

Test on a studio page:
1. Visit any studio page (e.g., `/studios/stretch-chi/`)
2. View page source (Ctrl+U / Cmd+U)
3. Search for `application/ld+json`
4. You should see:
   - YogaStudio schema (from existing code)
   - BreadcrumbList schema (new)

Test on a blog post:
1. Visit any blog post
2. View page source
3. You should see:
   - Article schema with author info

### Step 4: Validate with Google

Use [Google Rich Results Test](https://search.google.com/test/rich-results):
1. Enter a studio page URL
2. Check for:
   - ✅ Local Business (YogaStudio)
   - ✅ Breadcrumb
   - ✅ Aggregate Rating (if reviews exist)

---

## 📋 What Was Added

### 1. FAQ Schema
- Automatically adds FAQPage schema to Modern Yogi Guide pages
- Triggers when page URL contains `/guide/` or `/faq/`
- Can also use shortcode: `[ynm_faq_schema]`

### 2. BreadcrumbList Schema
- Adds proper breadcrumb schema to all pages
- Studio pages: Home → Studios → [City] → [Studio Name]
- Blog posts: Home → Blog → [Category] → [Post Title]
- Follows Google's guidelines (no URL on last item)

### 3. Optimized Title Tags
- Studio pages now use format: `[Studio Name] | Yoga Studio in [City], [State] | YogaNearMe`
- Under 60 characters
- Keyword-forward

### 4. Optimized Meta Descriptions
- Includes rating stars if available
- Call-to-action: "View classes, reviews & directions"
- Under 160 characters

### 5. Article Schema (E-E-A-T)
- Adds proper Article schema to blog posts
- Includes author name, bio, and credentials
- Publisher information
- Word count
- Dates (published & modified)

### 6. Glossary Schema
- Adds DefinedTerm schema to glossary pages
- Links to DefinedTermSet (YogaNearMe Glossary)

### 7. Open Graph & Twitter Cards
- Enhanced sharing preview for studio pages
- Falls back to default image if no featured image

---

## 🗺️ Sitemap Configuration

See `schema/SITEMAP-STRATEGY-30K-LISTINGS.md` for full details.

### Quick Setup (Rank Math)

1. Go to **Rank Math → Sitemap Settings**
2. Set **Links Per Sitemap**: 2000
3. Enable for post types: `gd_place`, `post`, `page`
4. Submit `sitemap_index.xml` to Search Console

### robots.txt Addition

Add to your robots.txt:
```
Sitemap: https://yoganearme.info/sitemap_index.xml
```

---

## 🏙️ City Landing Pages

See `templates/CITY-LANDING-PAGE-TEMPLATE.md` for full template.

### Priority Cities to Create First

1. Los Angeles, CA
2. New York City, NY
3. San Francisco, CA
4. Chicago, IL
5. Houston, TX
6. Phoenix, AZ
7. Dallas, TX
8. San Diego, CA
9. Denver, CO
10. Seattle, WA

### URL Structure

```
/yoga-studios/los-angeles/
/yoga-studios/new-york-city/
/yoga-studios/san-francisco/
```

---

## ✅ Launch Checklist

### Before Launch
- [ ] Install `SEO-ENHANCEMENTS.php`
- [ ] Verify YogaStudio schema on studio pages
- [ ] Verify BreadcrumbList schema
- [ ] Verify Article schema on blog posts
- [ ] Test with Google Rich Results Tool
- [ ] Configure sitemap (2000 URLs per file max)
- [ ] Update robots.txt with sitemap location
- [ ] Create top 10 city landing pages

### After Launch
- [ ] Submit sitemap_index.xml to Google Search Console
- [ ] Submit sitemap_index.xml to Bing Webmaster Tools
- [ ] Request indexing for priority pages
- [ ] Monitor Coverage report in Search Console
- [ ] Set up weekly indexing check

### Ongoing (Monthly)
- [ ] Check Search Console for crawl errors
- [ ] Review "Discovered - not indexed" pages
- [ ] Monitor rankings for target keywords
- [ ] Create additional city landing pages
- [ ] Update FAQ content based on real queries

---

## 🔍 Testing Commands

### View Schema on Any Page

```javascript
// In browser console:
document.querySelectorAll('script[type="application/ld+json"]').forEach(el => console.log(JSON.parse(el.textContent)));
```

### Check Title Tag

```javascript
// In browser console:
console.log(document.title);
```

### Check Meta Description

```javascript
// In browser console:
console.log(document.querySelector('meta[name="description"]')?.content);
```

---

## 🐛 Troubleshooting

### Schema Not Appearing

1. Clear all caches
2. Check for PHP errors in `wp-content/debug.log`
3. Verify the code was added to active theme's `functions.php`
4. Make sure you're on the right page type (studio, blog, etc.)

### Duplicate Schema

If you see duplicate LocalBusiness schema:
- The existing `schema-code-FINAL-WORKING.php` should filter out Rank Math's LocalBusiness
- If still seeing duplicates, check Rank Math → Schema settings

### Title Not Changing

1. Check if Rank Math is overriding (disable temporarily to test)
2. Verify the filter priority (999 should override most plugins)
3. Clear browser cache

---

## 📈 Expected SEO Impact

| Metric | Timeline | Expected Change |
|--------|----------|-----------------|
| Rich Results | 1-2 weeks | Stars, breadcrumbs appearing in SERPs |
| Indexing Rate | 2-4 weeks | More pages indexed |
| Click-Through Rate | 1-2 months | +15-30% from rich snippets |
| Local Rankings | 2-4 months | Improvement in "yoga near me" |
| Organic Traffic | 3-6 months | +20-50% from city pages |

---

## 📚 Related Documentation

- `schema/SCHEMA-IMPLEMENTATION-GUIDE.md` - Original schema setup
- `schema/schema-code-FINAL-WORKING.php` - YogaStudio schema
- `CLAUDE.md` - Project overview and brand guidelines
- `knowledge/BRAND_IDENTITY.md` - Voice and design standards

---

## Questions?

All SEO code is in:
- `code/PHP ADDS/SEO-ENHANCEMENTS.php`

All strategy docs are in:
- `schema/` folder
- `templates/` folder

Test changes on staging before production if possible.
