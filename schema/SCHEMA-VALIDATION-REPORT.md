# Schema Validation Report
**Date:** December 28, 2025  
**Page:** https://yoganearme.info/studios/stretch-chi/

## Current Schema Status

### ❌ PROBLEMS FOUND:

1. **Incorrect LocalBusiness Schema Still Present**
   - **Type:** `LocalBusiness` (should be `YogaStudio`)
   - **Description Error:** Contains "CorePower Yoga - La Jolla, located in San Diego, California" (wrong studio)
   - **Empty Review Field:** `"review":""` (invalid JSON)
   - **Malformed Opening Hours:** Contains malformed array with extra metadata

2. **Missing Our Custom YogaStudio Schema**
   - Our custom schema from `schema-code-ready.php` is **NOT** appearing
   - This means the PHP code is either:
     - Not in `functions.php`
     - Has a PHP syntax error
     - Not running due to a hook conflict

3. **Rank Math Filter Not Working**
   - The `ynm_disable_rankmath_localbusiness_schema` filter is not preventing Rank Math from outputting LocalBusiness
   - Rank Math may be using a different output method

## Current Schema on Page:

```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Stretch Chi",
  "description": "Discover the transformative yoga experience at CorePower Yoga - La Jolla, located in San Diego, California...",
  "telephone": "773-800-0244",
  "url": "https://yoganearme.info/studios/stretch-chi/",
  "sameAs": ["https://clients.mindbodyonline.com/classic/ws?studioid=20894"],
  "image": { "@type": "ImageObject", ... },
  "address": { "@type": "PostalAddress", ... },
  "openingHours": ["Mo 07:30-20:00\", \"We 09:00-14:00\"..."],  // MALFORMED
  "geo": { "@type": "GeoCoordinates", ... },
  "review": ""  // INVALID - empty string
}
```

## Validation Errors:

1. ❌ Wrong `@type`: Should be `YogaStudio`, not `LocalBusiness`
2. ❌ Incorrect description mentioning "CorePower Yoga - La Jolla"
3. ❌ Empty `review` field (should be removed or properly structured)
4. ❌ Malformed `openingHours` array
5. ❌ Missing `aggregateRating` structure (should have `ratingValue` and `reviewCount`)

## What Should Be There:

```json
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "Stretch Chi",
  "description": "Stretch Chi - Yoga studio in Chicago",
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
  }
}
```

## Next Steps:

1. Verify PHP code is in `functions.php`
2. Check for PHP errors in WordPress debug log
3. Try more aggressive filter approach
4. Clear all caches again



