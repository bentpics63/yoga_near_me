# Schema Validation Guide

## Current Status ✅

Based on the HTML you provided, your schema is **working correctly**:

✅ **YogaStudio schema is present** - Correctly outputted  
✅ **LocalBusiness schema removed** - No conflicting schema  
✅ **Required properties present**: name, address, geo, telephone  
✅ **Proper JSON-LD format** - Valid structure  

## Quick Validation Steps

### 1. Google Rich Results Test (5 minutes)

**Test URL:** https://search.google.com/test/rich-results

1. Go to: https://search.google.com/test/rich-results
2. Enter your page URL: `https://yoganearme.info/studios/stretch-chi/`
3. Click "Test URL"
4. Check for:
   - ✅ No errors
   - ✅ Schema detected as "LocalBusiness" (Google may show this even though we use YogaStudio - that's OK)
   - ✅ All properties recognized

**Expected Result:** Should show "Valid" with no critical errors.

### 2. Schema.org Validator (Optional)

**Test URL:** https://validator.schema.org/

1. Go to: https://validator.schema.org/
2. Paste your page URL
3. Check for warnings/errors

**Note:** Schema.org validator may show warnings about YogaStudio not being a "core" type, but that's fine - YogaStudio is a valid Schema.org type.

### 3. Manual HTML Check ✅ (Already Done)

From your HTML, I can see:
```json
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "Stretch Chi",
  "url": "https://clients.mindbodyonline.com/classic/ws?studioid=20894",
  "address": { ... },
  "geo": { ... },
  "telephone": "773-800-0244"
}
```

**Status:** ✅ All correct!

## Optional Enhancements

Your schema is complete, but you could optionally add:

### 1. Opening Hours (if available)
If the studio has business hours set in GeoDirectory, they'll automatically be added. Currently not showing, which means either:
- No hours set in GeoDirectory
- Hours field is empty

**To add:** Set business hours in GeoDirectory admin for this listing.

### 2. Aggregate Rating (if reviews exist)
If reviews exist, rating will automatically be added. Currently not showing, which means:
- No reviews yet, OR
- Reviews exist but rating calculation needs review

**To add:** Ensure reviews are properly set up in GeoDirectory.

### 3. Image (if featured image exists)
Featured image will automatically be added if set. Currently not showing.

**To add:** Set a featured image for the listing in WordPress admin.

## Validation Checklist

- [x] Schema type is YogaStudio (not LocalBusiness)
- [x] Required properties present (name, address)
- [x] Address structure correct (PostalAddress)
- [x] Geo coordinates present
- [x] Telephone present
- [x] URL present
- [ ] Opening hours (optional - add if available)
- [ ] Aggregate rating (optional - add if reviews exist)
- [ ] Image (optional - add if featured image exists)

## Conclusion

**Your schema is VALID and working correctly!** ✅

The only "missing" properties are optional enhancements (opening hours, rating, image) that will automatically appear once you add that data to the GeoDirectory listing.

**No action needed** unless you want to:
1. Add business hours to the listing
2. Add reviews/ratings
3. Set a featured image

The schema structure itself is perfect and will pass Google's validation.



