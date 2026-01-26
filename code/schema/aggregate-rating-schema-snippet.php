<?php
/**
 * YogaNearMe - Enhanced Studio Schema with AggregateRating
 *
 * This enhances the existing LocalBusiness/YogaStudio schema to include
 * AggregateRating when reviews exist. Works with GeoDirectory.
 *
 * INSTALLATION:
 * 1. Add to Appearance > Theme File Editor > functions.php (at the end)
 * 2. Or use a plugin like "Code Snippets" and add as a new snippet
 *
 * NOTE: This supplements (doesn't replace) GeoDirectory's built-in schema.
 * It adds AggregateRating data that may not be included by default.
 */

add_action('wp_head', 'ynm_studio_aggregate_rating_schema', 20);

function ynm_studio_aggregate_rating_schema() {
    // Only output on single studio pages
    if (!is_singular('gd_place')) {
        return;
    }

    global $post;

    // Get GeoDirectory post data
    $gd_post = geodir_get_post_info($post->ID);

    if (!$gd_post) {
        return;
    }

    // Check if studio has reviews
    $rating_count = isset($gd_post->rating_count) ? (int)$gd_post->rating_count : 0;
    $overall_rating = isset($gd_post->overall_rating) ? (float)$gd_post->overall_rating : 0;

    // Only add rating schema if there are actual reviews
    if ($rating_count < 1 || $overall_rating < 1) {
        return;
    }

    // Get address components
    $street = isset($gd_post->street) ? $gd_post->street : '';
    $city = isset($gd_post->city) ? $gd_post->city : '';
    $region = isset($gd_post->region) ? $gd_post->region : '';
    $zip = isset($gd_post->zip) ? $gd_post->zip : '';
    $country = isset($gd_post->country) ? $gd_post->country : 'US';

    // Build the schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => array('YogaStudio', 'LocalBusiness'),
        '@id' => get_permalink($post->ID) . '#business',
        'name' => get_the_title($post->ID),
        'url' => get_permalink($post->ID),
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => $street,
            'addressLocality' => $city,
            'addressRegion' => $region,
            'postalCode' => $zip,
            'addressCountry' => $country
        ),
        'aggregateRating' => array(
            '@type' => 'AggregateRating',
            'ratingValue' => number_format($overall_rating, 1),
            'bestRating' => '5',
            'worstRating' => '1',
            'ratingCount' => $rating_count,
            'reviewCount' => $rating_count
        )
    );

    // Add phone if available
    if (!empty($gd_post->phone)) {
        $schema['telephone'] = $gd_post->phone;
    }

    // Add website if available
    if (!empty($gd_post->website)) {
        $schema['sameAs'] = array($gd_post->website);
    }

    // Add image if available
    $featured_image = get_the_post_thumbnail_url($post->ID, 'large');
    if ($featured_image) {
        $schema['image'] = $featured_image;
    }

    // Add geo coordinates if available
    if (!empty($gd_post->latitude) && !empty($gd_post->longitude)) {
        $schema['geo'] = array(
            '@type' => 'GeoCoordinates',
            'latitude' => $gd_post->latitude,
            'longitude' => $gd_post->longitude
        );
    }

    // Add price range if available
    if (!empty($gd_post->price_range)) {
        $schema['priceRange'] = $gd_post->price_range;
    }

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

/**
 * Optional: Add HowTo schema to glossary pages with technique instructions
 * Uncomment and customize if you want HowTo rich snippets on pranayama/technique pages
 */
/*
add_action('wp_head', 'ynm_howto_schema_for_techniques', 20);

function ynm_howto_schema_for_techniques() {
    // Only on glossary term pages
    if (!is_singular('glossary') && !is_page()) {
        return;
    }

    global $post;

    // Check if this is a technique/practice page (customize this condition)
    $technique_pages = array('pranayama', 'surya-namaskar', 'meditation');
    $current_slug = $post->post_name;

    if (!in_array($current_slug, $technique_pages)) {
        return;
    }

    // Example HowTo schema - customize steps for each technique
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'How to Practice ' . get_the_title($post->ID),
        'description' => get_the_excerpt($post->ID),
        'totalTime' => 'PT10M', // Adjust per technique
        'step' => array(
            array(
                '@type' => 'HowToStep',
                'name' => 'Find a comfortable seat',
                'text' => 'Sit in a comfortable position with your spine tall and shoulders relaxed.'
            ),
            array(
                '@type' => 'HowToStep',
                'name' => 'Begin with natural breath',
                'text' => 'Close your eyes and take a few natural breaths to settle in.'
            ),
            // Add more steps as needed
        )
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
*/
