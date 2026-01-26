# Schema Markup Implementation Guide
## For Single Studio Pages

---

## ❌ Don't Add Schema in Elementor Template

**Why not:**
- Elementor templates are static HTML
- Schema needs to be dynamic (different data per studio)
- Would require manual editing for each studio
- Not scalable for 30,000+ listings

---

## ✅ Correct Approach: Add Schema via PHP

**Why this works:**
- Dynamic - populates automatically for all studios
- Uses GeoDirectory data fields
- One code snippet, infinite studios
- Future-proof (updates automatically)

---

## Method 1: Using RankMath (Easiest - If You Have It)

If you're using RankMath SEO plugin:

1. **RankMath automatically detects GeoDirectory**
2. **Go to:** RankMath → General Settings → Schema
3. **Enable:** LocalBusiness schema
4. **Configure:** Map GeoDirectory fields to schema properties

**Pros:**
- Visual interface
- Automatic field mapping
- Easy to update

**Cons:**
- Requires RankMath Pro (for advanced schema)
- May need custom mapping for YogaStudio type

---

## Method 2: Add Schema via functions.php (Recommended)

Add this code to your theme's `functions.php` file:

```php
/**
 * Add LocalBusiness/YogaStudio Schema to Single Studio Pages
 * 
 * This automatically adds structured data to all GeoDirectory single listing pages
 */
function ynm_add_studio_schema() {
    // Only on single GeoDirectory listing pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    // Get GeoDirectory post data
    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    $studio_url = get_permalink($post_id);
    $studio_description = geodir_get_post_meta($post_id, 'post_desc', true);
    
    // Get address data
    $address = geodir_get_post_meta($post_id, 'street', true);
    $city = geodir_get_post_meta($post_id, 'city', true);
    $region = geodir_get_post_meta($post_id, 'region', true);
    $zip = geodir_get_post_meta($post_id, 'zip', true);
    $country = geodir_get_post_meta($post_id, 'country', true);
    
    // Get coordinates
    $latitude = geodir_get_post_meta($post_id, 'latitude', true);
    $longitude = geodir_get_post_meta($post_id, 'longitude', true);
    
    // Get contact info
    $phone = geodir_get_post_meta($post_id, 'phone', true);
    $website = geodir_get_post_meta($post_id, 'website', true);
    $email = geodir_get_post_meta($post_id, 'email', true);
    
    // Get rating
    $rating = geodir_get_post_rating($post_id);
    $review_count = geodir_get_review_count($post_id);
    
    // Get categories/styles
    $categories = wp_get_post_terms($post_id, 'gd_placecategory', array('fields' => 'names'));
    
    // Build schema array
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'YogaStudio', // More specific than LocalBusiness
        'name' => $studio_name,
        'url' => $studio_url,
        'description' => $studio_description ?: $studio_name . ' - Yoga studio in ' . $city,
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => $address,
            'addressLocality' => $city,
            'addressRegion' => $region,
            'postalCode' => $zip,
            'addressCountry' => $country
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => $latitude,
            'longitude' => $longitude
        ),
        'telephone' => $phone,
        'email' => $email,
        'sameAs' => array() // For social media links
    );
    
    // Add website if available
    if ($website) {
        $schema['url'] = $website;
        $schema['sameAs'][] = $website;
    }
    
    // Add rating if available
    if ($rating && $review_count > 0) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $rating,
            'reviewCount' => $review_count
        );
    }
    
    // Add categories as keywords
    if (!empty($categories)) {
        $schema['keywords'] = implode(', ', $categories);
    }
    
    // Add image if available
    $image = get_the_post_thumbnail_url($post_id, 'large');
    if ($image) {
        $schema['image'] = $image;
    }
    
    // Add price range if available
    $price_range = geodir_get_post_meta($post_id, 'price_range', true);
    if ($price_range) {
        $schema['priceRange'] = $price_range;
    }
    
    // Output schema as JSON-LD
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'ynm_add_studio_schema', 5);
```

---

## Method 3: Using GeoDirectory Hooks (Most Flexible)

If you need more control, use GeoDirectory-specific hooks:

```php
/**
 * Add Schema using GeoDirectory hooks
 */
function ynm_geodir_schema($schema, $post) {
    // Only for single listing pages
    if (!geodir_is_page('detail')) {
        return $schema;
    }
    
    // Your custom schema logic here
    // This hook allows you to modify schema that GeoDirectory might already be generating
    
    return $schema;
}
add_filter('geodir_schema_output', 'ynm_geodir_schema', 10, 2);
```

---

## Method 4: Add Schema to Elementor Template (Not Recommended, But Possible)

If you MUST add it in Elementor:

1. **Add HTML widget** to your template
2. **Use GeoDirectory dynamic tags** for data
3. **Add JSON-LD script** with placeholders

**Example in Elementor HTML widget:**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "YogaStudio",
  "name": "[geodir_post_title]",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "[geodir_post_address]",
    "addressLocality": "[geodir_post_city]",
    "addressRegion": "[geodir_post_region]",
    "postalCode": "[geodir_post_zip]"
  },
  "telephone": "[geodir_post_phone]",
  "url": "[geodir_post_website]"
}
</script>
```

**Problems with this approach:**
- Elementor may not support all GeoDirectory dynamic tags
- Less flexible than PHP
- Harder to maintain
- May not work for all fields

---

## ✅ Recommended Implementation Steps

### Step 1: Choose Your Method
- **Have RankMath?** → Use Method 1 (easiest)
- **No RankMath?** → Use Method 2 (functions.php)

### Step 2: Add Code
- Copy the functions.php code above
- Paste at the end of your theme's `functions.php`
- Save file

### Step 3: Test
1. Visit a single studio page
2. View page source (Ctrl+U or Cmd+U)
3. Search for "application/ld+json"
4. Copy the schema JSON
5. Test at: https://search.google.com/test/rich-results

### Step 4: Validate
- Use Google Rich Results Test
- Fix any errors
- Ensure all required fields populated

---

## 🎯 Schema Fields to Include

### Required (High Priority)
- ✅ @type: YogaStudio
- ✅ name
- ✅ address (full)
- ✅ geo (coordinates)

### Recommended (Medium Priority)
- ✅ telephone
- ✅ url/website
- ✅ description
- ✅ image

### Optional (Low Priority)
- ⭐ aggregateRating
- ⭐ priceRange
- ⭐ openingHours
- ⭐ sameAs (social links)

---

## 🔍 Testing Your Schema

### Tools:
1. **Google Rich Results Test**: https://search.google.com/test/rich-results
2. **Schema.org Validator**: https://validator.schema.org/
3. **Google Search Console**: Monitor rich results

### What to Check:
- ✅ Schema validates without errors
- ✅ All required fields present
- ✅ Data populates correctly
- ✅ No duplicate schema (if RankMath also adding)

---

## ⚠️ Important Notes

1. **Don't add schema in Elementor template** - Use PHP instead
2. **Test on multiple studios** - Ensure it works for all
3. **Check for duplicates** - If RankMath is adding schema, don't duplicate
4. **Update as needed** - Add more fields as you expand data

---

## 🚀 Quick Start

**Fastest way to get started:**

1. Copy Method 2 code (functions.php)
2. Paste at end of your theme's `functions.php`
3. Save and test on one studio page
4. Validate with Google Rich Results Test
5. Adjust fields as needed

**Time investment:** 15-30 minutes

---

## 📝 Customization

**To customize the schema:**
- Modify the `$schema` array in the function
- Add/remove fields as needed
- Change `@type` if needed (YogaStudio, LocalBusiness, etc.)
- Add custom fields from GeoDirectory

**Example - Add opening hours:**
```php
$opening_hours = geodir_get_post_meta($post_id, 'business_hours', true);
if ($opening_hours) {
    $schema['openingHours'] = $opening_hours;
}
```

---

**Bottom line:** Add schema via `functions.php`, not in the Elementor template. This ensures it's dynamic, automatic, and scalable.



