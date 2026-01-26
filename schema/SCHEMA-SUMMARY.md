# Schema Markup Summary
## What Data Will Be Included

---

## 📋 Schema Overview

**Type:** `YogaStudio` (more specific than generic LocalBusiness)  
**Format:** JSON-LD (Google's preferred format)  
**Location:** Added to `<head>` section of every single studio page  
**Automatic:** Works for all 30,000+ studios automatically

---

## ✅ Data Fields Included

### 1. **Basic Business Info** (Always Included)
- ✅ **Studio Name** - From post title
- ✅ **URL** - Studio's website (if available) or page URL
- ✅ **Description** - Studio description or auto-generated

### 2. **Location Data** (If Available)
- ✅ **Full Address** - Street, City, State, ZIP, Country
- ✅ **Coordinates** - Latitude & Longitude (for map pins)

### 3. **Contact Information** (If Available)
- ✅ **Phone Number** - Studio phone
- ✅ **Email** - Studio email
- ✅ **Website** - External website URL

### 4. **Ratings & Reviews** (If Available)
- ✅ **Aggregate Rating** - Average rating score
- ✅ **Review Count** - Number of reviews

### 5. **Additional Data** (If Available)
- ✅ **Categories/Styles** - Yoga styles taught (as keywords)
- ✅ **Image** - Featured image or studio photo

---

## 🎯 What This Enables

### Rich Snippets in Google Search
When someone searches for a studio, Google can show:

```
┌─────────────────────────────────────┐
│  Studio Name                         │
│  ⭐⭐⭐⭐⭐ 4.8 (24 reviews)        │
│  410 S Michigan Ave, Chicago, IL     │
│  📞 (773) 800-0244                  │
│  🌐 www.studiowebsite.com           │
│  [Get Directions] [Call] [Website]  │
└─────────────────────────────────────┘
```

Instead of just:
```
Studio Name
yoganearme.info/places/...
```

### SEO Benefits
- ✅ **Higher Click-Through Rates** - Rich snippets get more clicks
- ✅ **Better Rankings** - Google prefers structured data
- ✅ **Local SEO Boost** - Helps with "yoga near me" searches
- ✅ **Knowledge Graph** - Can appear in Google's knowledge panel

---

## 📊 Data Source Mapping

| Schema Field | GeoDirectory Field | Required? |
|--------------|-------------------|-----------|
| `name` | Post Title | ✅ Yes |
| `url` | Website field | ⭐ Preferred |
| `description` | Post Description | ⭐ If available |
| `address.streetAddress` | Street | ⭐ If available |
| `address.addressLocality` | City | ⭐ If available |
| `address.addressRegion` | State/Region | ⭐ If available |
| `address.postalCode` | ZIP | ⭐ If available |
| `address.addressCountry` | Country | ⭐ If available |
| `geo.latitude` | Latitude | ⭐ If available |
| `geo.longitude` | Longitude | ⭐ If available |
| `telephone` | Phone | ⭐ If available |
| `email` | Email | ⭐ If available |
| `aggregateRating.ratingValue` | Post Rating | ⭐ If available |
| `aggregateRating.reviewCount` | Review Count | ⭐ If available |
| `keywords` | Categories/Styles | ⭐ If available |
| `image` | Featured Image | ⭐ If available |

**Note:** Only fields that exist in your GeoDirectory data will be included. Missing fields are simply omitted (schema still valid).

---

## 🔍 Example Output

Here's what the schema will look like for a studio:

```json
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "Stretch Chi",
  "url": "https://stretchchi.com",
  "description": "Discover the transformative yoga experience...",
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
    "latitude": "41.8755616",
    "longitude": "-87.6244212"
  },
  "telephone": "773-800-0244",
  "email": "info@stretchchi.com",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "24"
  },
  "keywords": "Hot Yoga, Vinyasa, Hatha",
  "image": "https://yoganearme.info/wp-content/uploads/studio-image.jpg"
}
```

---

## ⚠️ What's NOT Included (By Design)

These are intentionally excluded to keep schema clean:

- ❌ Class schedules (can add later if needed)
- ❌ Pricing information (can add later)
- ❌ Social media links (can add later)
- ❌ Opening hours (can add later)
- ❌ Amenities list (not standard schema field)

**Why:** We're starting with core LocalBusiness schema. Can expand later.

---

## 🚀 What Happens After Adding

### Immediate:
- ✅ Schema appears in page source (view source, search for "ld+json")
- ✅ Works on all existing studio pages automatically
- ✅ No visual changes to pages
- ✅ No breaking changes

### Within Days/Weeks:
- ✅ Google crawls and indexes schema
- ✅ Rich snippets may start appearing in search
- ✅ Better search result appearance
- ✅ Potential ranking improvements

### Testing:
- ✅ Validate at: https://search.google.com/test/rich-results
- ✅ Check page source for schema
- ✅ Monitor in Google Search Console

---

## 📝 Summary

**What gets added:**
- Studio name, address, contact info
- Location coordinates
- Ratings and reviews (if available)
- Categories/styles
- Image

**What it does:**
- Enables rich snippets in Google
- Improves SEO
- Better search appearance
- Higher click-through rates

**What it doesn't do:**
- Change page design (invisible to users)
- Break anything (safe to add)
- Require manual work (automatic for all studios)

---

**Ready to add?** Copy the code from `schema-code-ready.php` and paste into your `functions.php` file!



