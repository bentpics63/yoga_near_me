<?php
/**
 * YogaNearMe.info - Child Theme Functions
 */

// Enqueue parent theme styles
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles');
function hello_elementor_child_enqueue_styles() {
    wp_enqueue_style('hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', array('hello-elementor-theme-style'));
}

// WP All Import - GeoDirectory support
add_filter('pmxi_custom_post_types', function($post_types) {
    $post_types['gd_place'] = 'Places';
    return $post_types;
});

// ============================================
// RANK MATH KEYWORDS AUTO-GENERATION
// ============================================

function auto_set_geodirectory_keywords($post_id) {
    if (get_post_type($post_id) != 'gd_place' || wp_is_post_revision($post_id)) {
        return;
    }

    $existing_keyword = get_post_meta($post_id, 'rank_math_focus_keyword', true);
    if (!empty($existing_keyword)) {
        return;
    }

    $title = get_the_title($post_id);
    $city = get_post_meta($post_id, 'geodir_city', true);
    $state = get_post_meta($post_id, 'geodir_region', true);

    $clean_title = str_replace(['LLC', 'Inc', 'Studio', 'Center', 'Yoga'], '', $title);
    $clean_title = trim($clean_title);

    if (!empty($city)) {
        $keyword = strtolower($clean_title) . " yoga " . strtolower($city);
        if (!empty($state)) {
            $keyword .= " " . strtolower($state);
        }
        $keyword = preg_replace('/\s+/', ' ', $keyword);
        $keyword = trim($keyword);
        update_post_meta($post_id, 'rank_math_focus_keyword', $keyword);
    }
}
add_action('save_post', 'auto_set_geodirectory_keywords', 10, 1);

// ============================================
// STUDIO CUSTOMIZER SETTINGS
// ============================================

function add_studio_customizer_settings($wp_customize) {
    $wp_customize->add_section('studio_info', array(
        'title' => 'Studio Information',
        'priority' => 30,
    ));

    $wp_customize->add_setting('studio_name', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('studio_name', array('label' => 'Studio Name', 'section' => 'studio_info', 'type' => 'text'));

    $wp_customize->add_setting('city_name', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('city_name', array('label' => 'City Name', 'section' => 'studio_info', 'type' => 'text'));
}
add_action('customize_register', 'add_studio_customizer_settings');

function studio_name_shortcode() {
    return get_theme_mod('studio_name', 'Your Studio Name');
}
add_shortcode('studio_name', 'studio_name_shortcode');

function city_name_shortcode() {
    return get_theme_mod('city_name', 'Your City');
}
add_shortcode('city_name', 'city_name_shortcode');

function replace_studio_variables($content) {
    $studio_name = get_theme_mod('studio_name', 'Your Studio Name');
    $city_name = get_theme_mod('city_name', 'Your City');
    $content = str_replace('{{studio_name}}', $studio_name, $content);
    $content = str_replace('{{city_name}}', $city_name, $content);
    return $content;
}
add_filter('the_content', 'replace_studio_variables');
add_filter('the_excerpt', 'replace_studio_variables');
add_filter('widget_text', 'replace_studio_variables');

function studio_description_shortcode() {
    global $post;
    if (get_post_type($post) == 'gd_place') {
        $studio_name = get_the_title($post->ID);
        $city_name = get_post_meta($post->ID, 'geodir_city', true);
    } else {
        $studio_name = get_theme_mod('studio_name', 'Your Studio Name');
        $city_name = get_theme_mod('city_name', 'Your City');
    }
    return "Discover the transformative yoga experience at {$studio_name}, your yoga destination in {$city_name}. This studio offers a welcoming environment for all levels.";
}
add_shortcode('studio_description', 'studio_description_shortcode');

// ============================================
// RANK MATH SCHEMA CONTROL
// ============================================

add_filter('rank_math/json_ld', function($json_ld_array) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $json_ld_array;
    }
    if (!is_array($json_ld_array)) {
        return $json_ld_array;
    }
    if (isset($json_ld_array['LocalBusiness'])) {
        unset($json_ld_array['LocalBusiness']);
    }
    if (isset($json_ld_array['@graph']) && is_array($json_ld_array['@graph'])) {
        foreach ($json_ld_array['@graph'] as $key => $item) {
            if (isset($item['@type']) && $item['@type'] === 'LocalBusiness') {
                unset($json_ld_array['@graph'][$key]);
            }
        }
        $json_ld_array['@graph'] = array_values($json_ld_array['@graph']);
    }
    if (isset($json_ld_array['@type']) && $json_ld_array['@type'] === 'LocalBusiness') {
        return array();
    }
    return $json_ld_array;
}, 999999);

add_filter('rank_math/schema/schemas', function($schemas) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return $schemas;
    }
    if (isset($schemas['LocalBusiness'])) {
        unset($schemas['LocalBusiness']);
    }
    return $schemas;
}, 999999);

// ============================================
// YOGASTUDIO SCHEMA
// ============================================

function ynm_add_studio_schema() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return;
    }

    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    if (empty($studio_name)) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'YogaStudio',
        'name' => $studio_name,
        'url' => get_permalink($post_id),
    );

    $address = geodir_get_post_meta($post_id, 'street', true);
    $city = geodir_get_post_meta($post_id, 'city', true);
    $region = geodir_get_post_meta($post_id, 'region', true);
    $zip = geodir_get_post_meta($post_id, 'zip', true);

    if ($address || $city) {
        $schema['address'] = array(
            '@type' => 'PostalAddress',
            'streetAddress' => $address ?: '',
            'addressLocality' => $city ?: '',
            'addressRegion' => $region ?: '',
            'postalCode' => $zip ?: '',
        );
    }

    $latitude = geodir_get_post_meta($post_id, 'latitude', true);
    $longitude = geodir_get_post_meta($post_id, 'longitude', true);
    if ($latitude && $longitude) {
        $schema['geo'] = array(
            '@type' => 'GeoCoordinates',
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude
        );
    }

    $phone = geodir_get_post_meta($post_id, 'phone', true);
    if ($phone) {
        $schema['telephone'] = $phone;
    }

    $website = geodir_get_post_meta($post_id, 'website', true);
    if ($website) {
        $schema['url'] = $website;
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'ynm_add_studio_schema', 1);

// ============================================
// STUDIO BADGES SHORTCODE
// ============================================

function ynm_studio_badges_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;
    $is_featured = geodir_get_post_meta($post_id, 'featured', true);
    $is_verified = geodir_get_post_meta($post_id, 'verified', true);

    if (empty($is_featured) && isset($gd_post) && isset($gd_post->featured)) {
        $is_featured = $gd_post->featured;
    }
    if (empty($is_verified) && isset($gd_post) && isset($gd_post->verified)) {
        $is_verified = $gd_post->verified;
    }

    $show_featured = ($is_featured === '1' || $is_featured === 1 || $is_featured === true);
    $show_verified = ($is_verified === '1' || $is_verified === 1 || $is_verified === true);

    if (!$show_featured && !$show_verified) {
        return '';
    }

    ob_start();
    echo '<div class="studio-badges">';
    if ($show_verified) {
        echo '<span class="badge verified"><i class="fas fa-check-circle"></i> Verified</span>';
    }
    if ($show_featured) {
        echo '<span class="badge featured"><i class="fas fa-star"></i> Featured Studio</span>';
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('ynm_studio_badges', 'ynm_studio_badges_shortcode');

// ============================================
// BREADCRUMBS SHORTCODE
// ============================================

function ynm_breadcrumbs_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);
    $city = geodir_get_post_meta($post_id, 'city', true);

    $home_url = home_url('/');
    $studios_url = home_url('/studios/');

    ob_start();
    echo '<nav class="breadcrumb-section"><div class="breadcrumb">';
    echo '<a href="' . esc_url($home_url) . '">Home</a>';
    echo '<span class="separator">/</span>';
    echo '<a href="' . esc_url($studios_url) . '">Studios</a>';

    if (!empty($city)) {
        $city_url = home_url('/studios/' . sanitize_title($city) . '/');
        echo '<span class="separator">/</span>';
        echo '<a href="' . esc_url($city_url) . '">' . esc_html($city) . '</a>';
    }

    echo '<span class="separator">/</span>';
    echo '<span class="current">' . esc_html($studio_name) . '</span>';
    echo '</div></nav>';

    return ob_get_clean();
}
add_shortcode('ynm_breadcrumbs', 'ynm_breadcrumbs_shortcode');

// ============================================
// CONTACT CARD SHORTCODE
// ============================================

function ynm_contact_card_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $id = $post->ID;
    $street = geodir_get_post_meta($id, 'street', true);
    $city = geodir_get_post_meta($id, 'city', true);
    $region = geodir_get_post_meta($id, 'region', true);
    $zip = geodir_get_post_meta($id, 'zip', true);
    $phone = geodir_get_post_meta($id, 'phone', true);
    $email = geodir_get_post_meta($id, 'email', true);
    $website = geodir_get_post_meta($id, 'website', true);
    $facebook = geodir_get_post_meta($id, 'facebook', true);
    $instagram = geodir_get_post_meta($id, 'instagram', true);
    $twitter = geodir_get_post_meta($id, 'twitter', true);

    $addr_line1 = !empty($street) ? $street : '';
    $addr_line2 = '';
    if (!empty($city)) {
        $addr_line2 = $city;
        if (!empty($region)) $addr_line2 .= ', ' . $region;
        if (!empty($zip)) $addr_line2 .= ' ' . $zip;
    }

    ob_start();
    ?>
    <style>
    .ynm-contact-card{background:#FFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #E0E0E0;font-family:'Inter',-apple-system,sans-serif}
    .ynm-contact-card-title{font-size:1rem;font-weight:700;color:#222;margin:0 0 16px;padding:0 0 12px;border-bottom:1px solid #E0E0E0}
    .ynm-contact-list{display:flex;flex-direction:column;gap:16px}
    .ynm-contact-item{display:flex;align-items:flex-start;gap:12px}
    .ynm-contact-icon{width:36px;height:36px;min-width:36px;border-radius:8px;background:#F8F9FA;display:flex;align-items:center;justify-content:center}
    .ynm-contact-icon svg{width:18px;height:18px;fill:#5F7470}
    .ynm-contact-details{flex:1}
    .ynm-contact-label{font-size:0.7rem;color:#888;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:2px}
    .ynm-contact-value{color:#222;font-weight:500;font-size:0.9rem;line-height:1.4}
    .ynm-contact-value a{color:#5F7470;text-decoration:none}
    .ynm-contact-value a:hover{color:#D4A574}
    .ynm-social-section{margin-top:20px;padding-top:16px;border-top:1px solid #E0E0E0}
    .ynm-social-title{font-size:0.85rem;font-weight:700;color:#222;margin-bottom:12px}
    .ynm-social-links{display:flex;gap:8px}
    .ynm-social-link{width:40px;height:40px;border-radius:50%;background:#EDE4F3;display:flex;align-items:center;justify-content:center;transition:all 0.2s}
    .ynm-social-link:hover{background:#5F7470}
    .ynm-social-link svg{width:18px;height:18px;fill:#7C6A9A}
    .ynm-social-link:hover svg{fill:#FFF}
    </style>
    <div class="ynm-contact-card">
        <h3 class="ynm-contact-card-title">Contact Information</h3>
        <div class="ynm-contact-list">
            <?php if (!empty($addr_line1) || !empty($addr_line2)): ?>
            <div class="ynm-contact-item">
                <div class="ynm-contact-icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
                <div class="ynm-contact-details">
                    <div class="ynm-contact-label">Address</div>
                    <div class="ynm-contact-value"><?php echo esc_html($addr_line1); ?><?php if (!empty($addr_line1) && !empty($addr_line2)) echo '<br>'; ?><?php echo esc_html($addr_line2); ?></div>
                </div>
            </div>
            <?php endif; ?>
            <div class="ynm-contact-item">
                <div class="ynm-contact-icon"><svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></div>
                <div class="ynm-contact-details">
                    <div class="ynm-contact-label">Phone</div>
                    <div class="ynm-contact-value"><?php echo !empty($phone) ? '<a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a>' : '-'; ?></div>
                </div>
            </div>
            <div class="ynm-contact-item">
                <div class="ynm-contact-icon"><svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
                <div class="ynm-contact-details">
                    <div class="ynm-contact-label">Email</div>
                    <div class="ynm-contact-value"><?php echo !empty($email) ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '-'; ?></div>
                </div>
            </div>
            <?php if (!empty($website)): ?>
            <div class="ynm-contact-item">
                <div class="ynm-contact-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg></div>
                <div class="ynm-contact-details">
                    <div class="ynm-contact-label">Website</div>
                    <div class="ynm-contact-value"><a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo esc_html(preg_replace('#^https?://#', '', $website)); ?></a></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($facebook) || !empty($instagram) || !empty($twitter)): ?>
        <div class="ynm-social-section">
            <div class="ynm-social-title">Follow Us</div>
            <div class="ynm-social-links">
                <?php if (!empty($facebook)): ?><a href="<?php echo esc_url($facebook); ?>" class="ynm-social-link" target="_blank"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a><?php endif; ?>
                <?php if (!empty($instagram)): ?><a href="<?php echo esc_url($instagram); ?>" class="ynm-social-link" target="_blank"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" fill="none" stroke="#7C6A9A" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="#7C6A9A" stroke-width="2"/></svg></a><?php endif; ?>
                <?php if (!empty($twitter)): ?><a href="<?php echo esc_url($twitter); ?>" class="ynm-social-link" target="_blank"><svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg></a><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_contact_card', 'ynm_contact_card_shortcode');

// ============================================
// HOURS CARD SHORTCODE
// ============================================

function ynm_hours_card_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    global $post, $gd_post;

    $id = isset($post->ID) ? $post->ID : 0;
    $days_list = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    $today = date('l');

    $raw_hours = '';
    if (isset($gd_post) && isset($gd_post->business_hours)) {
        $raw_hours = $gd_post->business_hours;
    }
    if (empty($raw_hours) && $id) {
        $raw_hours = geodir_get_post_meta($id, 'business_hours', true);
    }

    $parsed = array();
    $has_data = false;

    if (!empty($raw_hours) && is_string($raw_hours)) {
        $day_map = array('Mo'=>'Monday','Tu'=>'Tuesday','We'=>'Wednesday','Th'=>'Thursday','Fr'=>'Friday','Sa'=>'Saturday','Su'=>'Sunday');
        preg_match_all('/([A-Za-z]{2})\s+(\d{2}:\d{2})-(\d{2}:\d{2})/', $raw_hours, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            if (isset($day_map[$m[1]])) {
                $open = date('g:i A', strtotime($m[2]));
                $close = date('g:i A', strtotime($m[3]));
                $parsed[$day_map[$m[1]]] = $open . ' - ' . $close;
                $has_data = true;
            }
        }
    }

    $html = '<style>
.ynm-hours-card{background:#FFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #E0E0E0}
.ynm-hours-title{font-size:1rem;font-weight:700;color:#222;margin:0 0 16px;padding:0 0 12px;border-bottom:1px solid #E0E0E0}
.ynm-hours-status{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:20px;margin-bottom:20px;font-size:0.85rem;font-weight:600;background:#F5F5F5;color:#666}
.ynm-hours-dot{width:8px;height:8px;border-radius:50%;background:#999}
.ynm-hours-list{display:flex;flex-direction:column}
.ynm-hours-row{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #F0F0F0}
.ynm-hours-row:last-child{border-bottom:none}
.ynm-hours-row.today .ynm-day{font-weight:700;color:#222}
.ynm-day{font-size:0.9rem;color:#555;width:120px;flex-shrink:0}
.ynm-time{font-size:0.9rem;color:#222;text-align:right;min-width:160px}
</style>';

    $html .= '<div class="ynm-hours-card">';
    $html .= '<h3 class="ynm-hours-title">Hours of Operation</h3>';
    $html .= '<div class="ynm-hours-status"><span class="ynm-hours-dot"></span>' . ($has_data ? 'See hours below' : 'Contact for hours') . '</div>';
    $html .= '<div class="ynm-hours-list">';

    foreach ($days_list as $day) {
        $class = ($day === $today) ? 'ynm-hours-row today' : 'ynm-hours-row';
        $time = isset($parsed[$day]) ? $parsed[$day] : '-';
        $html .= '<div class="' . $class . '"><span class="ynm-day">' . $day . '</span><span class="ynm-time">' . $time . '</span></div>';
    }

    $html .= '</div></div>';
    return $html;
}
add_shortcode('ynm_hours_card', 'ynm_hours_card_shortcode');

// ============================================
// HERO GALLERY GRID SHORTCODE
// 30% column: Up to 2 thumbnails + Upgrade CTA
// Height: 565px (matches hero image)
// ============================================

function ynm_hero_gallery_grid_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $wpdb;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;
    $images = array();
    $upload_dir = wp_upload_dir();

    if (function_exists('geodir_get_images')) {
        $gd_images = geodir_get_images($post_id);
        if (!empty($gd_images)) {
            foreach ($gd_images as $img) {
                if (isset($img->src) && !empty($img->src)) {
                    $images[] = $img->src;
                }
            }
        }
    }

    if (empty($images)) {
        $table = $wpdb->prefix . 'geodir_attachments';
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT file FROM {$table} WHERE post_id = %d AND type = 'post_images' ORDER BY menu_order ASC",
            $post_id
        ));
        if (!empty($results)) {
            foreach ($results as $row) {
                if (!empty($row->file)) {
                    $src = $row->file;
                    if (strpos($src, 'http') !== 0) {
                        $src = $upload_dir['baseurl'] . '/' . ltrim($src, '/');
                    }
                    $images[] = $src;
                }
            }
        }
    }

    $images = array_values(array_unique(array_filter($images)));
    $thumb1 = isset($images[1]) ? $images[1] : '';
    $thumb2 = isset($images[2]) ? $images[2] : '';

    $html = '<div style="display:flex;flex-direction:column;gap:8px;height:565px;">';

    if (!empty($thumb1)) {
        $html .= '<div style="flex:1;border-radius:10px;background:url(' . esc_url($thumb1) . ') center/cover no-repeat #ddd;"></div>';
    }

    if (!empty($thumb2)) {
        $html .= '<div style="flex:1;border-radius:10px;background:url(' . esc_url($thumb2) . ') center/cover no-repeat #ddd;"></div>';
    }

    $html .= '<a href="/upgrade/" style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;border-radius:10px;background:linear-gradient(135deg,#e95c4b,#bd3000);color:white;text-decoration:none;text-align:center;">';
    $html .= '<span style="font-size:13px;font-weight:600;text-transform:uppercase;margin-bottom:4px;">Add More Photos</span>';
    $html .= '<span style="font-size:12px;opacity:0.9;">Upgrade for 12 photos</span>';
    $html .= '</a>';

    $html .= '</div>';

    return $html;
}
add_shortcode('ynm_hero_gallery_grid', 'ynm_hero_gallery_grid_shortcode');

// ============================================
// TRUST BADGES SHORTCODE
// Shows: Yoga Alliance, Google Rating, Yelp Rating, Verified
// ============================================

function ynm_trust_badges_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;

    // Get data from GeoDirectory
    $is_verified = geodir_get_post_meta($post_id, 'verified', true);
    $yoga_alliance = geodir_get_post_meta($post_id, 'yoga_alliance', true);
    $google_rating = geodir_get_post_meta($post_id, 'google_rating', true);
    $google_reviews = geodir_get_post_meta($post_id, 'google_reviews', true);
    $yelp_rating = geodir_get_post_meta($post_id, 'yelp_rating', true);
    $yelp_reviews = geodir_get_post_meta($post_id, 'yelp_reviews', true);

    // Fallback to gd_post object
    if (empty($is_verified) && isset($gd_post->verified)) {
        $is_verified = $gd_post->verified;
    }

    // Check if we have anything to show
    $show_verified = ($is_verified === '1' || $is_verified === 1 || $is_verified === true);
    $show_yoga_alliance = !empty($yoga_alliance);
    $show_google = !empty($google_rating);
    $show_yelp = !empty($yelp_rating);

    // If nothing to show, return empty
    if (!$show_verified && !$show_yoga_alliance && !$show_google && !$show_yelp) {
        return '';
    }

    ob_start();
    ?>
    <style>
    .ynm-trust-badges{display:flex;flex-wrap:wrap;gap:8px;margin:12px 0}
    .ynm-trust-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:6px;font-family:'Inter',-apple-system,sans-serif;font-size:12px;font-weight:500;text-decoration:none;transition:all 0.2s ease}
    .ynm-trust-badge:hover{transform:translateY(-1px);box-shadow:0 2px 8px rgba(0,0,0,0.1)}
    .ynm-trust-badge i,.ynm-trust-badge svg{font-size:14px}
    .ynm-trust-badge.yoga-alliance{background:#FFF7ED;border:1px solid #FDBA74;color:#9A3412}
    .ynm-trust-badge.yoga-alliance i{color:#EA580C}
    .ynm-trust-badge.google{background:#F9FAFB;border:1px solid #E4E7EC;color:#344054}
    .ynm-trust-badge.google i{color:#4285F4}
    .ynm-trust-badge.yelp{background:#F9FAFB;border:1px solid #E4E7EC;color:#344054}
    .ynm-trust-badge.yelp i{color:#D32323}
    .ynm-trust-badge.verified{background:#ECFDF3;border:1px solid #86EFAC;color:#166534}
    .ynm-trust-badge.verified i{color:#12B76A}
    @media(max-width:480px){.ynm-trust-badges{gap:6px}.ynm-trust-badge{padding:5px 10px;font-size:11px}}
    </style>
    <div class="ynm-trust-badges">
        <?php if ($show_yoga_alliance): ?>
        <span class="ynm-trust-badge yoga-alliance">
            <i class="fas fa-certificate"></i>
            <?php echo esc_html($yoga_alliance); ?>
        </span>
        <?php endif; ?>

        <?php if ($show_google): ?>
        <span class="ynm-trust-badge google">
            <i class="fab fa-google"></i>
            <?php echo esc_html($google_rating); ?>
            <?php if (!empty($google_reviews)): ?>
                <span style="color:#667085">(<?php echo esc_html($google_reviews); ?>)</span>
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <?php if ($show_yelp): ?>
        <span class="ynm-trust-badge yelp">
            <i class="fab fa-yelp"></i>
            <?php echo esc_html($yelp_rating); ?>
            <?php if (!empty($yelp_reviews)): ?>
                <span style="color:#667085">(<?php echo esc_html($yelp_reviews); ?>)</span>
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <?php if ($show_verified): ?>
        <span class="ynm-trust-badge verified">
            <i class="fas fa-check-circle"></i>
            Verified
        </span>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_trust_badges', 'ynm_trust_badges_shortcode');
