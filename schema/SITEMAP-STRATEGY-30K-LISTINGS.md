# XML Sitemap Strategy for 30,000+ Listings

## The Challenge

With 30,000+ studio listings, a single sitemap file becomes:
- Too large (Google recommends max 50,000 URLs per sitemap)
- Slow to parse
- Difficult to manage crawl priority

## Recommended Solution: Sitemap Index with Segmentation

### Structure

```
sitemap_index.xml
├── sitemap-studios-1.xml     (studios 1-10,000)
├── sitemap-studios-2.xml     (studios 10,001-20,000)
├── sitemap-studios-3.xml     (studios 20,001-30,000)
├── sitemap-locations.xml     (city/state pages)
├── sitemap-styles.xml        (yoga style pages)
├── sitemap-glossary.xml      (glossary terms)
├── sitemap-blog.xml          (blog posts)
└── sitemap-pages.xml         (static pages)
```

---

## Implementation Options

### Option 1: Rank Math SEO (Recommended if installed)

Rank Math automatically handles sitemap segmentation. To configure:

1. **Go to:** Rank Math → Sitemap Settings
2. **Links Per Sitemap:** Set to 1000 or 2000 (creates more, smaller files)
3. **Post Types:** Enable for `gd_place` (GeoDirectory), `post`, `page`
4. **Taxonomies:** Enable for categories, tags, locations

**Pros:**
- Automatic
- Handles GeoDirectory integration
- Auto-pings Google on updates

### Option 2: GeoDirectory Sitemap (Built-in)

GeoDirectory has its own sitemap functionality:

1. **Go to:** GeoDirectory → General → SEO
2. **Enable:** Sitemap for listings
3. **Configure:** Segments by location/category

### Option 3: Custom PHP Implementation

Add to `functions.php`:

```php
/**
 * Custom Sitemap Segmentation for YogaNearMe
 * 
 * Creates multiple sitemap files for better crawl efficiency
 */

// Register custom sitemap provider
add_action('init', 'ynm_register_custom_sitemaps');

function ynm_register_custom_sitemaps() {
    // Only if using WordPress native sitemaps (WP 5.5+)
    if (!function_exists('wp_sitemaps_get_server')) {
        return;
    }
    
    // Register custom provider for studios
    $provider = new YNM_Studio_Sitemap_Provider();
    wp_register_sitemap_provider('studios', $provider);
}

class YNM_Studio_Sitemap_Provider extends WP_Sitemaps_Provider {
    
    public function __construct() {
        $this->name = 'studios';
        $this->object_type = 'gd_place';
    }
    
    public function get_url_list($page_num, $object_subtype = '') {
        $per_page = 2000; // URLs per sitemap file
        $offset = ($page_num - 1) * $per_page;
        
        $args = array(
            'post_type' => 'gd_place',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'offset' => $offset,
            'orderby' => 'modified',
            'order' => 'DESC',
            'fields' => 'ids'
        );
        
        $posts = get_posts($args);
        $urls = array();
        
        foreach ($posts as $post_id) {
            $urls[] = array(
                'loc' => get_permalink($post_id),
                'lastmod' => get_post_modified_time('Y-m-d\TH:i:sP', true, $post_id),
                'changefreq' => 'weekly',
                'priority' => 0.7
            );
        }
        
        return $urls;
    }
    
    public function get_max_num_pages($object_subtype = '') {
        $count = wp_count_posts('gd_place')->publish;
        $per_page = 2000;
        return (int) ceil($count / $per_page);
    }
}
```

---

## Priority Configuration

### High Priority (1.0 - 0.8)
- Homepage: 1.0
- Main category pages (Yoga Styles, Locations): 0.9
- Popular city landing pages (LA, NYC, Chicago): 0.8

### Medium Priority (0.7 - 0.5)
- Individual studio pages: 0.7
- Blog posts: 0.6
- Glossary terms: 0.6

### Low Priority (0.4 - 0.2)
- Archive pages: 0.4
- Tag pages: 0.3
- Author pages: 0.2

---

## Crawl Budget Optimization

### 1. Update Frequency Tags

```xml
<!-- Frequently updated content -->
<changefreq>daily</changefreq>

<!-- Studio listings (update when claimed/reviewed) -->
<changefreq>weekly</changefreq>

<!-- Static content (glossary, about pages) -->
<changefreq>monthly</changefreq>
```

### 2. Last Modified Dates

Ensure all content has accurate `lastmod` dates:

```php
// Add to functions.php
function ynm_update_studio_modified_date($post_id) {
    if (get_post_type($post_id) === 'gd_place') {
        wp_update_post(array(
            'ID' => $post_id,
            'post_modified' => current_time('mysql'),
            'post_modified_gmt' => current_time('mysql', 1)
        ));
    }
}
// Trigger on review, claim, or data update
add_action('geodir_after_save_comment', 'ynm_update_studio_modified_date');
add_action('geodir_after_save_listing', 'ynm_update_studio_modified_date');
```

### 3. Exclude Low-Value Pages

In Rank Math or robots.txt, exclude:
- Paginated archive pages beyond page 10
- Empty category pages
- Duplicate location variations

---

## Robots.txt Configuration

```txt
User-agent: *
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /?s=
Disallow: /search/
Allow: /wp-admin/admin-ajax.php

# Allow important bots full access
User-agent: Googlebot
Allow: /

User-agent: Bingbot
Allow: /

# Sitemap location
Sitemap: https://yoganearme.info/sitemap_index.xml
```

---

## Google Search Console Setup

### 1. Submit Sitemap Index
- Go to Search Console → Sitemaps
- Enter: `sitemap_index.xml`
- Submit

### 2. Monitor Coverage
- Check "Coverage" report weekly
- Look for:
  - Crawl errors
  - "Discovered - not indexed" pages
  - Duplicate content issues

### 3. Request Indexing for Important Pages
- New high-value pages (city landing pages)
- Updated studio listings
- New blog content

---

## Maintenance Schedule

### Weekly
- [ ] Check Search Console for crawl errors
- [ ] Verify sitemap is updating with new listings

### Monthly
- [ ] Review "Discovered - not indexed" pages
- [ ] Check sitemap size (should auto-segment)
- [ ] Verify priority pages are being crawled

### Quarterly
- [ ] Full sitemap audit
- [ ] Review crawl stats
- [ ] Adjust priority/frequency as needed

---

## Quick Implementation Checklist

- [ ] Verify Rank Math sitemap settings (if using)
- [ ] Set "Links Per Sitemap" to 2000 or less
- [ ] Enable GeoDirectory sitemap integration
- [ ] Submit sitemap_index.xml to Google Search Console
- [ ] Submit sitemap_index.xml to Bing Webmaster Tools
- [ ] Configure robots.txt with sitemap location
- [ ] Set up Search Console monitoring
- [ ] Test with: `site:yoganearme.info` to verify indexing

---

## Expected Results

After proper sitemap configuration:
- **Faster discovery** of new listings
- **Better crawl efficiency** for 30,000+ pages
- **Improved indexing rate** for studio pages
- **Clearer signals** to Google about important content
