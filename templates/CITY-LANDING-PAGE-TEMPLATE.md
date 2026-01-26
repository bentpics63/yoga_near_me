# City Landing Page Template
## "Yoga Near Me" Local SEO Pages

These templates help you create high-ranking city-specific landing pages that capture "yoga near me" and "yoga in [city]" searches.

---

## Target Keywords Per Page

Each city page should target:
- `yoga near me [city]`
- `yoga studios in [city]`
- `yoga classes [city]`
- `best yoga [city]`
- `[city] yoga studios`

---

## Page Structure Template

### 1. Hero Section

```
[City Name] Yoga Studios
Find Your Perfect Practice in [City]

[Number] yoga studios • [Popular styles] • All levels welcome

[Search Box: "Search studios in [City]..."]
```

**H1:** `Yoga Studios in [City], [State]`

**Meta Title:** `Yoga Studios in [City], [State] | Find Classes Near You | YogaNearMe`

**Meta Description:** `Discover [X]+ yoga studios in [City], [State]. Compare reviews, class schedules & prices. Find Vinyasa, Hot Yoga, Beginner classes near you. ★ Updated [Month] [Year].`

---

### 2. Featured Studios Section

```html
<section class="featured-studios">
  <h2>Featured Yoga Studios in [City]</h2>
  
  [3-4 top-rated or featured studios with:]
  - Studio image
  - Name
  - Rating (★ 4.8)
  - Location/neighborhood
  - Styles offered (badges)
  - "View Studio" button
</section>
```

---

### 3. Browse by Style Section

```html
<section class="browse-by-style">
  <h2>Find [City] Studios by Yoga Style</h2>
  
  <div class="style-grid">
    [Vinyasa Yoga] - X studios
    [Hot Yoga] - X studios
    [Beginner Yoga] - X studios
    [Hatha Yoga] - X studios
    [Yin Yoga] - X studios
    [Prenatal Yoga] - X studios
    [Kundalini Yoga] - X studios
    [Restorative Yoga] - X studios
  </div>
</section>
```

---

### 4. Browse by Neighborhood Section (for large cities)

```html
<section class="browse-by-neighborhood">
  <h2>Yoga Studios by Neighborhood</h2>
  
  <div class="neighborhood-grid">
    [Downtown] - X studios
    [Westside] - X studios
    [Eastside] - X studios
    [North [City]] - X studios
    etc.
  </div>
</section>
```

---

### 5. About Yoga in [City] Section

```html
<section class="city-yoga-guide">
  <h2>Your Guide to Yoga in [City]</h2>
  
  <p>[2-3 paragraphs about the yoga scene in this city:]
  - Brief history/culture of yoga in the area
  - What makes this city's yoga scene unique
  - Types of studios common in the area
  - Tips for finding the right studio
  </p>
</section>
```

**Example for Los Angeles:**

> Los Angeles has one of the most vibrant yoga communities in the United States, with studios ranging from traditional ashram-style centers to modern hot yoga powerhouses. The city's wellness culture and year-round sunshine make it an ideal place to deepen your practice.
>
> Whether you're looking for a sunrise beach yoga class in Santa Monica, an intense Bikram session in Hollywood, or a meditative Kundalini practice in Silver Lake, LA's diverse yoga scene has something for every practitioner.
>
> Many LA studios cater to the entertainment industry schedule, offering early morning, lunch, and late evening classes. Drop-in rates typically range from $20-35, with monthly unlimited packages from $150-250.

---

### 6. All Studios Grid Section

```html
<section class="all-studios">
  <h2>All Yoga Studios in [City]</h2>
  
  <div class="filter-bar">
    [Filter by: Style | Rating | Distance | Price Range]
    [Sort by: Distance | Rating | Name]
  </div>
  
  <div class="studio-grid">
    [Paginated grid of all studios - use GeoDirectory listing widget]
  </div>
</section>
```

---

### 7. FAQ Section (for FAQ Schema)

```html
<section class="city-faq">
  <h2>Frequently Asked Questions About Yoga in [City]</h2>
  
  <div class="faq-item">
    <h3>How much do yoga classes cost in [City]?</h3>
    <p>Drop-in yoga classes in [City] typically range from $[X] to $[Y]. Many studios offer first-class-free deals and monthly unlimited packages ranging from $[X] to $[Y].</p>
  </div>
  
  <div class="faq-item">
    <h3>What's the best yoga studio in [City]?</h3>
    <p>The best yoga studio depends on your goals and preferred style. [Top-rated studio] has [X] stars from [Y] reviews and is known for [specialty]. Browse our ratings to find studios matching your preferences.</p>
  </div>
  
  <div class="faq-item">
    <h3>Are there beginner yoga classes in [City]?</h3>
    <p>Yes! [X] studios in [City] offer beginner-friendly classes. Look for classes labeled "Gentle," "Basics," "Level 1," or "All Levels."</p>
  </div>
  
  <div class="faq-item">
    <h3>Do I need to bring my own yoga mat?</h3>
    <p>Most studios in [City] provide mats for rent or free use. However, bringing your own mat is recommended for hygiene and comfort.</p>
  </div>
</section>
```

---

### 8. Nearby Cities Section

```html
<section class="nearby-cities">
  <h2>Explore More Yoga Studios Nearby</h2>
  
  <div class="city-links">
    [Nearby City 1] - X studios
    [Nearby City 2] - X studios
    [Nearby City 3] - X studios
  </div>
</section>
```

---

## Priority Cities List

### Tier 1 (Create First - Highest Search Volume)

| City | State | Est. Studios |
|------|-------|--------------|
| Los Angeles | CA | 800+ |
| New York City | NY | 700+ |
| San Francisco | CA | 300+ |
| Chicago | IL | 250+ |
| Houston | TX | 200+ |
| Phoenix | AZ | 180+ |
| Dallas | TX | 170+ |
| San Diego | CA | 160+ |
| Denver | CO | 150+ |
| Seattle | WA | 140+ |

### Tier 2 (Create Second)

| City | State | Est. Studios |
|------|-------|--------------|
| Austin | TX | 130+ |
| Portland | OR | 120+ |
| Miami | FL | 110+ |
| Atlanta | GA | 100+ |
| Boston | MA | 100+ |
| Nashville | TN | 80+ |
| San Jose | CA | 80+ |
| Minneapolis | MN | 75+ |
| Charlotte | NC | 70+ |
| Philadelphia | PA | 70+ |

### Tier 3 (Create Third)

All remaining cities with 30+ studio listings.

---

## Schema Markup for City Pages

Add this to each city landing page:

```php
// In your city page template or via shortcode
function ynm_city_page_schema($city, $state, $studio_count) {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => 'Yoga Studios in ' . $city . ', ' . $state,
        'description' => 'Find ' . $studio_count . '+ yoga studios in ' . $city . '. Browse by style, read reviews, and compare class schedules.',
        'url' => home_url('/location/' . sanitize_title($city) . '/'),
        'mainEntity' => array(
            '@type' => 'ItemList',
            'itemListElement' => array(
                // Populated dynamically with top studios
            )
        ),
        'about' => array(
            '@type' => 'City',
            'name' => $city,
            'containedIn' => array(
                '@type' => 'State',
                'name' => $state
            )
        )
    );
    
    return $schema;
}
```

---

## Implementation Steps

### Step 1: Create Template in Elementor

1. Create a new Page Template: "City Landing Page"
2. Add sections matching structure above
3. Use GeoDirectory dynamic tags for studio counts
4. Add filter/sort functionality

### Step 2: Create Pages for Tier 1 Cities

1. Create page: `/los-angeles-yoga-studios/`
2. Apply "City Landing Page" template
3. Configure GeoDirectory widget to filter by city
4. Write unique "About Yoga in [City]" content
5. Add city-specific FAQs

### Step 3: Add Internal Links

- Link from studio pages to their city page
- Link from style pages to relevant city pages
- Add city navigation in footer/header

### Step 4: Submit to Search Console

- Add city pages to sitemap
- Request indexing for priority cities
- Monitor rankings for target keywords

---

## Content Checklist Per City Page

- [ ] Unique H1 with city name
- [ ] Optimized meta title (50-60 chars)
- [ ] Optimized meta description (150-160 chars)
- [ ] Featured studios section
- [ ] Browse by style section
- [ ] Browse by neighborhood (large cities)
- [ ] Unique "About Yoga in [City]" content (200+ words)
- [ ] FAQ section (4-6 questions)
- [ ] Nearby cities links
- [ ] Schema markup added
- [ ] Internal links to/from related pages

---

## URL Structure

**Recommended:**
```
/yoga-studios/los-angeles/
/yoga-studios/new-york-city/
/yoga-studios/san-francisco/
```

**Alternative:**
```
/location/los-angeles/
/location/new-york/
/location/san-francisco/
```

**With State:**
```
/yoga-studios/california/los-angeles/
/yoga-studios/new-york/new-york-city/
```

---

## Expected SEO Results

After implementing city landing pages:

| Timeframe | Expected Result |
|-----------|-----------------|
| 1-2 weeks | Pages indexed |
| 1-2 months | Ranking for long-tail city keywords |
| 3-6 months | Ranking for competitive "[city] yoga" keywords |
| 6-12 months | Top 10 for "yoga near me" in target cities |

---

## Maintenance

### Monthly
- Update studio counts
- Refresh "About" content if needed
- Check for new neighborhoods to add

### Quarterly
- Review rankings for target keywords
- Add new city pages as listings grow
- Update FAQs based on Search Console queries
