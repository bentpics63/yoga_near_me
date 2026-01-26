<?php
/**
 * GA4 Event Tracking Setup for YogaNearMe.info
 *
 * Enqueues the tracking JavaScript and provides page data.
 *
 * INSTALLATION:
 * Add to child theme functions.php:
 * require_once get_stylesheet_directory() . '/includes/GA4-TRACKING-SETUP.php';
 *
 * @package YogaNearMe
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue GA4 tracking script
 */
add_action('wp_enqueue_scripts', 'ynm_enqueue_ga4_tracking');

function ynm_enqueue_ga4_tracking() {

    // Enqueue the tracking script
    wp_enqueue_script(
        'ynm-ga4-tracking',
        get_stylesheet_directory_uri() . '/js/GA4-EVENT-TRACKING.js',
        array(), // No dependencies (gtag loaded separately)
        '1.0.0',
        true // Load in footer
    );

    // Prepare page data for JavaScript
    $page_data = ynm_get_page_tracking_data();

    // Pass data to JavaScript
    wp_localize_script('ynm-ga4-tracking', 'ynmPageData', $page_data);
}


/**
 * Get page-specific tracking data
 */
function ynm_get_page_tracking_data() {

    $data = array(
        'pageType' => 'other',
        'debug'    => defined('WP_DEBUG') && WP_DEBUG,
    );

    // Single listing page
    if (is_singular('gd_place')) {
        global $post;

        $data['pageType']          = 'single_listing';
        $data['listingId']         = $post->ID;
        $data['studioName']        = get_the_title($post->ID);
        $data['city']              = ynm_get_listing_city($post->ID);
        $data['hasOffer']          = ynm_listing_has_offer($post->ID) ? 'true' : 'false';
        $data['hasPhotos']         = has_post_thumbnail($post->ID) ? 'true' : 'false';
        $data['profileCompletion'] = ynm_get_profile_completion($post->ID);
        $data['introOffer']        = geodir_get_post_meta($post->ID, 'intro_offer', true);
    }

    // Search results page
    elseif (is_post_type_archive('gd_place') || ynm_is_search_page()) {
        global $wp_query;

        $data['pageType']       = 'search_results';
        $data['searchQuery']    = get_search_query();
        $data['resultCount']    = $wp_query->found_posts;
        $data['searchLocation'] = isset($_GET['sgeo_lat']) ? 'geo' : (isset($_GET['s']) ? $_GET['s'] : '');
    }

    // Location/category archive
    elseif (is_tax('gd_placecategory') || is_tax('gd_place_tags')) {
        $data['pageType'] = 'category_archive';
        $term = get_queried_object();
        if ($term) {
            $data['categoryName'] = $term->name;
            $data['categorySlug'] = $term->slug;
        }
    }

    return $data;
}


/**
 * Helper: Check if current page is GD search
 */
function ynm_is_search_page() {
    global $post;

    // Check if it's the GeoDirectory search page
    if ($post && has_shortcode($post->post_content, 'gd_search')) {
        return true;
    }

    // Check URL parameters
    if (isset($_GET['geodir_search']) || isset($_GET['sgeo_lat'])) {
        return true;
    }

    // Check if on search-page
    if ($post && $post->post_name === 'search-page') {
        return true;
    }

    return false;
}


/**
 * Helper: Get listing city
 */
function ynm_get_listing_city($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $city = geodir_get_post_meta($post_id, 'city', true);
        if ($city) return $city;
    }

    // Fallback to taxonomy
    $locations = wp_get_post_terms($post_id, 'gd_place_location');
    if (!empty($locations) && !is_wp_error($locations)) {
        return $locations[0]->name;
    }

    return '';
}


/**
 * Helper: Check if listing has intro offer
 */
function ynm_listing_has_offer($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $offer = geodir_get_post_meta($post_id, 'intro_offer', true);
        return !empty($offer);
    }
    return false;
}


/**
 * Helper: Get profile completion percentage
 */
function ynm_get_profile_completion($post_id) {
    if (function_exists('geodir_get_post_meta')) {
        $completion = geodir_get_post_meta($post_id, 'profile_completion', true);
        if ($completion) return intval($completion);
    }

    // Calculate if not stored
    if (function_exists('ynm_calculate_profile_completion')) {
        return ynm_calculate_profile_completion($post_id);
    }

    return 0;
}


/**
 * Add data attributes to listing cards for tracking
 */
add_filter('geodir_listing_attrs', 'ynm_add_tracking_attrs_to_cards', 10, 2);

function ynm_add_tracking_attrs_to_cards($attrs, $post) {

    static $position = 0;
    $position++;

    $attrs .= ' data-listing-id="' . esc_attr($post->ID) . '"';
    $attrs .= ' data-studio-name="' . esc_attr(get_the_title($post->ID)) . '"';
    $attrs .= ' data-city="' . esc_attr(ynm_get_listing_city($post->ID)) . '"';
    $attrs .= ' data-has-offer="' . (ynm_listing_has_offer($post->ID) ? 'true' : 'false') . '"';
    $attrs .= ' data-position="' . $position . '"';

    return $attrs;
}


/**
 * Alternative: Add data attributes via JavaScript injection
 * Use if the filter above doesn't work with your theme
 */
add_action('wp_footer', 'ynm_inject_card_tracking_data');

function ynm_inject_card_tracking_data() {

    // Only on archive/search pages
    if (!is_post_type_archive('gd_place') && !ynm_is_search_page()) {
        return;
    }

    global $wp_query;

    if (empty($wp_query->posts)) {
        return;
    }

    $cards_data = array();
    $position = 0;

    foreach ($wp_query->posts as $post) {
        $position++;
        $cards_data[$post->ID] = array(
            'listing_id'   => $post->ID,
            'studio_name'  => get_the_title($post->ID),
            'city'         => ynm_get_listing_city($post->ID),
            'has_offer'    => ynm_listing_has_offer($post->ID),
            'position'     => $position,
        );
    }

    ?>
    <script>
    (function() {
        var cardsData = <?php echo json_encode($cards_data); ?>;

        document.querySelectorAll('.geodir-post, article.gd_place').forEach(function(card) {
            // Try to find post ID from card
            var link = card.querySelector('a[href]');
            if (!link) return;

            // Match by checking which listing URL is in this card
            for (var id in cardsData) {
                var data = cardsData[id];
                card.dataset.listingId = data.listing_id;
                card.dataset.studioName = data.studio_name;
                card.dataset.city = data.city;
                card.dataset.hasOffer = data.has_offer ? 'true' : 'false';
                card.dataset.position = data.position;
                delete cardsData[id];
                break;
            }
        });
    })();
    </script>
    <?php
}
