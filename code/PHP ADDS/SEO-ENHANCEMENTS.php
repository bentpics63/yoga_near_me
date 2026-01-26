<?php
/**
 * YogaNearMe.info - SEO Enhancements
 * 
 * This file contains:
 * 1. FAQ Schema for Modern Yogi Guide pages
 * 2. BreadcrumbList Schema
 * 3. Optimized Title Tags
 * 4. Open Graph / Twitter Cards enhancements
 * 
 * INSTALLATION:
 * Add to functions.php:
 * require_once get_stylesheet_directory() . '/code/PHP ADDS/SEO-ENHANCEMENTS.php';
 * 
 * Or copy contents directly into functions.php
 */

// ============================================
// 1. FAQ SCHEMA FOR MODERN YOGI GUIDE PAGES
// ============================================

/**
 * Add FAQ Schema to designated FAQ/Guide pages
 * 
 * Works with pages that have FAQ content structured with:
 * - H2 or H3 as questions
 * - Following paragraph(s) as answers
 * 
 * Or use the shortcode: [ynm_faq_schema]
 */
function ynm_add_faq_schema() {
    // Only on single posts/pages (not archives)
    if (!is_singular()) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    // Check if this is a FAQ/Guide page
    // Method 1: Check for custom field
    $is_faq_page = get_post_meta($post->ID, 'ynm_faq_schema', true);
    
    // Method 2: Check if post is in "Modern Yogi Guide" category or has specific tag
    $categories = wp_get_post_categories($post->ID, array('fields' => 'slugs'));
    $tags = wp_get_post_tags($post->ID, array('fields' => 'slugs'));
    
    $faq_categories = array('modern-yogi-guide', 'faq', 'frequently-asked-questions', 'guide');
    $faq_tags = array('faq', 'guide', 'questions');
    
    $in_faq_category = !empty(array_intersect($faq_categories, $categories));
    $has_faq_tag = !empty(array_intersect($faq_tags, $tags));
    
    // Method 3: Check URL pattern
    $url = get_permalink($post->ID);
    $is_faq_url = (
        strpos($url, '/guide/') !== false ||
        strpos($url, '/faq/') !== false ||
        strpos($url, '/modern-yogi-guide/') !== false
    );
    
    // If not a FAQ page, exit
    if (!$is_faq_page && !$in_faq_category && !$has_faq_tag && !$is_faq_url) {
        return;
    }
    
    // Get FAQ items from post meta (if manually defined)
    $faq_items = get_post_meta($post->ID, 'ynm_faq_items', true);
    
    if (empty($faq_items) || !is_array($faq_items)) {
        // Try to extract FAQs from content
        $faq_items = ynm_extract_faqs_from_content($post->post_content);
    }
    
    if (empty($faq_items)) {
        return;
    }
    
    // Build FAQ Schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array()
    );
    
    foreach ($faq_items as $faq) {
        if (!empty($faq['question']) && !empty($faq['answer'])) {
            $schema['mainEntity'][] = array(
                '@type' => 'Question',
                'name' => wp_strip_all_tags($faq['question']),
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => wp_strip_all_tags($faq['answer'])
                )
            );
        }
    }
    
    // Only output if we have FAQs
    if (!empty($schema['mainEntity'])) {
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'ynm_add_faq_schema', 10);

/**
 * Extract FAQs from post content
 * Looks for H2/H3 headings followed by paragraphs
 */
function ynm_extract_faqs_from_content($content) {
    $faqs = array();
    
    if (empty($content)) {
        return $faqs;
    }
    
    // Pattern to find H2/H3 headings that look like questions
    $pattern = '/<h[23][^>]*>(.*?)<\/h[23]>/is';
    
    preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);
    
    if (empty($matches[0])) {
        return $faqs;
    }
    
    foreach ($matches[0] as $index => $match) {
        $heading = $matches[1][$index][0];
        $heading_pos = $match[1];
        
        // Check if heading looks like a question (ends with ? or starts with question words)
        $is_question = (
            strpos($heading, '?') !== false ||
            preg_match('/^(what|how|why|when|where|who|can|do|does|is|are|should|will|would)/i', strip_tags($heading))
        );
        
        if (!$is_question) {
            continue;
        }
        
        // Find next heading position or end of content
        $next_heading_pos = strlen($content);
        if (isset($matches[0][$index + 1])) {
            $next_heading_pos = $matches[0][$index + 1][1];
        }
        
        // Extract content between this heading and next
        $answer_html = substr($content, $heading_pos + strlen($match[0]), $next_heading_pos - $heading_pos - strlen($match[0]));
        
        // Extract text from paragraphs
        preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $answer_html, $paragraphs);
        $answer = '';
        if (!empty($paragraphs[1])) {
            $answer = implode(' ', array_slice($paragraphs[1], 0, 3)); // First 3 paragraphs
        }
        
        if (!empty($answer)) {
            $faqs[] = array(
                'question' => wp_strip_all_tags($heading),
                'answer' => wp_strip_all_tags($answer)
            );
        }
    }
    
    return $faqs;
}

/**
 * Shortcode to manually define FAQ items for schema
 * 
 * Usage in post content:
 * [ynm_faq_schema]
 * [ynm_faq question="What is yoga?" answer="Yoga is a practice that combines physical postures..."]
 * [ynm_faq question="How often should I practice?" answer="Most teachers recommend..."]
 * [/ynm_faq_schema]
 */
function ynm_faq_schema_shortcode($atts, $content = null) {
    // This shortcode doesn't output anything visible
    // It just triggers the FAQ schema to be added
    
    if (!empty($content)) {
        // Parse nested [ynm_faq] shortcodes
        global $ynm_current_faqs;
        $ynm_current_faqs = array();
        
        do_shortcode($content);
        
        if (!empty($ynm_current_faqs)) {
            global $post;
            update_post_meta($post->ID, 'ynm_faq_items', $ynm_current_faqs);
            update_post_meta($post->ID, 'ynm_faq_schema', true);
        }
    }
    
    return '';
}
add_shortcode('ynm_faq_schema', 'ynm_faq_schema_shortcode');

function ynm_faq_item_shortcode($atts) {
    global $ynm_current_faqs;
    
    $atts = shortcode_atts(array(
        'question' => '',
        'answer' => ''
    ), $atts);
    
    if (!empty($atts['question']) && !empty($atts['answer'])) {
        $ynm_current_faqs[] = array(
            'question' => $atts['question'],
            'answer' => $atts['answer']
        );
    }
    
    return '';
}
add_shortcode('ynm_faq', 'ynm_faq_item_shortcode');


// ============================================
// 2. BREADCRUMBLIST SCHEMA
// ============================================

/**
 * Add BreadcrumbList Schema to all pages
 */
function ynm_add_breadcrumb_schema() {
    // Skip admin pages
    if (is_admin()) {
        return;
    }
    
    $breadcrumbs = array();
    $position = 1;
    
    // Home is always first
    $breadcrumbs[] = array(
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => 'Home',
        'item' => home_url('/')
    );
    
    // GeoDirectory single studio page
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        global $post;
        
        // Add "Studios" level
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => 'Yoga Studios',
            'item' => home_url('/studios/')
        );
        
        // Add City if available
        $city = geodir_get_post_meta($post->ID, 'city', true);
        $region = geodir_get_post_meta($post->ID, 'region', true);
        
        if ($city) {
            $city_slug = sanitize_title($city);
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $city . ($region ? ', ' . $region : ''),
                'item' => home_url('/location/' . $city_slug . '/')
            );
        }
        
        // Add current studio (no item URL for last breadcrumb per Google guidelines)
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title($post->ID)
        );
        
    } elseif (is_singular('post')) {
        // Blog post
        $categories = get_the_category();
        
        // Add Blog level
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => 'Blog',
            'item' => home_url('/blog/')
        );
        
        // Add primary category
        if (!empty($categories)) {
            $primary_cat = $categories[0];
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $primary_cat->name,
                'item' => get_category_link($primary_cat->term_id)
            );
        }
        
        // Add current post
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title()
        );
        
    } elseif (is_singular('page')) {
        // Regular page
        global $post;
        
        // Get parent pages
        $ancestors = get_post_ancestors($post->ID);
        $ancestors = array_reverse($ancestors);
        
        foreach ($ancestors as $ancestor_id) {
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => get_the_title($ancestor_id),
                'item' => get_permalink($ancestor_id)
            );
        }
        
        // Add current page
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title()
        );
        
    } elseif (is_category()) {
        $category = get_queried_object();
        
        // Add Blog level
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => 'Blog',
            'item' => home_url('/blog/')
        );
        
        // Add parent categories
        if ($category->parent) {
            $parent_cats = get_ancestors($category->term_id, 'category');
            $parent_cats = array_reverse($parent_cats);
            
            foreach ($parent_cats as $parent_id) {
                $parent = get_category($parent_id);
                $breadcrumbs[] = array(
                    '@type' => 'ListItem',
                    'position' => $position++,
                    'name' => $parent->name,
                    'item' => get_category_link($parent_id)
                );
            }
        }
        
        // Add current category
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $category->name
        );
        
    } elseif (is_search()) {
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => 'Search Results: ' . get_search_query()
        );
    }
    
    // Only output if we have more than just Home
    if (count($breadcrumbs) > 1) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbs
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'ynm_add_breadcrumb_schema', 11);


// ============================================
// 3. OPTIMIZED TITLE TAGS
// ============================================

/**
 * Optimize title tags for studio pages
 * Format: [Studio Name] | Yoga Studio in [City], [State] | YogaNearMe
 */
function ynm_optimize_title_tag($title) {
    // GeoDirectory single studio page
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        global $post;
        
        $studio_name = get_the_title($post->ID);
        $city = geodir_get_post_meta($post->ID, 'city', true);
        $region = geodir_get_post_meta($post->ID, 'region', true);
        
        $location = '';
        if ($city) {
            $location = $city;
            if ($region) {
                $location .= ', ' . $region;
            }
        }
        
        if ($location) {
            return $studio_name . ' | Yoga Studio in ' . $location . ' | YogaNearMe';
        } else {
            return $studio_name . ' | Yoga Studio | YogaNearMe';
        }
    }
    
    return $title;
}
add_filter('pre_get_document_title', 'ynm_optimize_title_tag', 999);

/**
 * Also filter wp_title for older themes
 */
add_filter('wp_title', 'ynm_optimize_title_tag', 999);

/**
 * Filter Rank Math title if using Rank Math
 */
function ynm_optimize_rankmath_title($title) {
    return ynm_optimize_title_tag($title);
}
add_filter('rank_math/frontend/title', 'ynm_optimize_rankmath_title', 999);

/**
 * Optimize meta description for studio pages
 */
function ynm_optimize_meta_description($description) {
    if (function_exists('geodir_is_page') && geodir_is_page('detail')) {
        global $post;
        
        $studio_name = get_the_title($post->ID);
        $city = geodir_get_post_meta($post->ID, 'city', true);
        $region = geodir_get_post_meta($post->ID, 'region', true);
        
        // Try to get excerpt or description
        $studio_desc = get_the_excerpt($post->ID);
        if (empty($studio_desc)) {
            $studio_desc = geodir_get_post_meta($post->ID, 'post_desc', true);
        }
        
        // Get rating
        $rating = '';
        if (function_exists('geodir_get_post_rating')) {
            $rating_val = geodir_get_post_rating($post->ID);
            $review_count = geodir_get_review_count($post->ID);
            if ($rating_val && $review_count > 0) {
                $rating = ' ★ ' . number_format($rating_val, 1) . ' rating.';
            }
        }
        
        $location = '';
        if ($city) {
            $location = $city;
            if ($region) {
                $location .= ', ' . $region;
            }
        }
        
        // Build description (max 160 chars)
        if (!empty($studio_desc) && strlen($studio_desc) > 50) {
            // Use first ~120 chars of description
            $description = substr(wp_strip_all_tags($studio_desc), 0, 120) . '...' . $rating;
        } else {
            $description = $studio_name . ' yoga studio in ' . $location . '.' . $rating . ' View classes, reviews & directions.';
        }
        
        // Ensure under 160 chars
        if (strlen($description) > 160) {
            $description = substr($description, 0, 157) . '...';
        }
        
        return $description;
    }
    
    return $description;
}
add_filter('rank_math/frontend/description', 'ynm_optimize_meta_description', 999);


// ============================================
// 4. OPEN GRAPH & TWITTER CARDS
// ============================================

/**
 * Add Open Graph tags for studio pages
 */
function ynm_add_open_graph_tags() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    $studio_name = get_the_title($post->ID);
    $studio_url = get_permalink($post->ID);
    $city = geodir_get_post_meta($post->ID, 'city', true);
    $region = geodir_get_post_meta($post->ID, 'region', true);
    
    $location = '';
    if ($city) {
        $location = $city;
        if ($region) {
            $location .= ', ' . $region;
        }
    }
    
    // Get image
    $image = get_the_post_thumbnail_url($post->ID, 'large');
    if (!$image) {
        // Fallback to default image
        $image = home_url('/wp-content/uploads/yoganearme-og-default.jpg');
    }
    
    // Get description
    $description = get_the_excerpt($post->ID);
    if (empty($description)) {
        $description = $studio_name . ' yoga studio in ' . $location . '. View class schedules, reviews, and get directions.';
    }
    $description = substr(wp_strip_all_tags($description), 0, 200);
    
    // Only output if Rank Math isn't handling this
    if (!class_exists('RankMath')) {
        echo '<meta property="og:type" content="business.business" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($studio_name . ' | Yoga Studio in ' . $location) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($studio_url) . '" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image) . '" />' . "\n";
        echo '<meta property="og:site_name" content="YogaNearMe.info" />' . "\n";
        
        // Twitter Cards
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($studio_name . ' | Yoga Studio') . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '" />' . "\n";
    }
}
add_action('wp_head', 'ynm_add_open_graph_tags', 5);


// ============================================
// 5. ARTICLE SCHEMA FOR BLOG POSTS
// ============================================

/**
 * Add Article schema to blog posts with author info (E-E-A-T)
 */
function ynm_add_article_schema() {
    if (!is_singular('post')) {
        return;
    }
    
    global $post;
    
    $author_id = $post->post_author;
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_url = get_author_posts_url($author_id);
    $author_bio = get_the_author_meta('description', $author_id);
    
    // Get featured image
    $image = get_the_post_thumbnail_url($post->ID, 'large');
    
    // Get categories
    $categories = get_the_category($post->ID);
    $category_names = array();
    foreach ($categories as $cat) {
        $category_names[] = $cat->name;
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => get_the_title($post->ID),
        'description' => get_the_excerpt($post->ID),
        'url' => get_permalink($post->ID),
        'datePublished' => get_the_date('c', $post->ID),
        'dateModified' => get_the_modified_date('c', $post->ID),
        'author' => array(
            '@type' => 'Person',
            'name' => $author_name,
            'url' => $author_url
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => 'YogaNearMe.info',
            'url' => home_url('/'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => home_url('/wp-content/uploads/yoganearme-logo.png')
            )
        ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink($post->ID)
        )
    );
    
    // Add author description for E-E-A-T
    if (!empty($author_bio)) {
        $schema['author']['description'] = $author_bio;
    }
    
    // Add image
    if ($image) {
        $schema['image'] = array(
            '@type' => 'ImageObject',
            'url' => $image
        );
    }
    
    // Add article section (category)
    if (!empty($category_names)) {
        $schema['articleSection'] = $category_names[0];
        $schema['keywords'] = implode(', ', $category_names);
    }
    
    // Add word count
    $word_count = str_word_count(strip_tags($post->post_content));
    if ($word_count > 0) {
        $schema['wordCount'] = $word_count;
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'ynm_add_article_schema', 12);


// ============================================
// 6. GLOSSARY TERM SCHEMA (DefinedTerm)
// ============================================

/**
 * Add DefinedTerm schema for glossary pages
 */
function ynm_add_glossary_schema() {
    if (!is_singular('page')) {
        return;
    }
    
    global $post;
    
    // Check if this is a glossary page
    $is_glossary = (
        strpos(get_permalink($post->ID), '/glossary/') !== false ||
        has_category('glossary', $post->ID) ||
        has_tag('glossary', $post->ID) ||
        get_post_meta($post->ID, 'ynm_glossary_term', true)
    );
    
    if (!$is_glossary) {
        return;
    }
    
    $term_name = get_the_title($post->ID);
    $definition = get_the_excerpt($post->ID);
    
    if (empty($definition)) {
        // Get first paragraph as definition
        $content = $post->post_content;
        preg_match('/<p[^>]*>(.*?)<\/p>/is', $content, $matches);
        if (!empty($matches[1])) {
            $definition = wp_strip_all_tags($matches[1]);
        }
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'DefinedTerm',
        'name' => $term_name,
        'description' => $definition,
        'url' => get_permalink($post->ID),
        'inDefinedTermSet' => array(
            '@type' => 'DefinedTermSet',
            'name' => 'YogaNearMe Yoga Glossary',
            'url' => home_url('/glossary/')
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'ynm_add_glossary_schema', 13);


// ============================================
// 7. PREVENT DUPLICATE SCHEMA
// ============================================

/**
 * Remove default WordPress schema if Rank Math is handling it
 */
function ynm_prevent_duplicate_schema() {
    // If Rank Math is active, let it handle base schemas
    if (class_exists('RankMath')) {
        // Rank Math handles: WebSite, Organization, WebPage
        // We add: YogaStudio, BreadcrumbList, FAQPage, Article, DefinedTerm
        return;
    }
}
add_action('init', 'ynm_prevent_duplicate_schema');

?>
