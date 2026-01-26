<?php
/**
 * YogaNearMe.info - Child Theme Functions
 * CLEAN VERSION - All duplicates removed, syntax errors fixed
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
    ?>
    <style>
    .breadcrumb-section{background:transparent;box-shadow:none;border:none;padding:0;margin:0 0 8px 0}
    .breadcrumb{display:flex;align-items:center;gap:8px;font-family:'Inter',-apple-system,sans-serif;font-size:13px;background:transparent;padding:0;margin:0;box-shadow:none;border:none}
    .breadcrumb a{color:#61948B;text-decoration:none}
    .breadcrumb a:hover{text-decoration:underline}
    .breadcrumb .separator{color:#9CA3AF}
    .breadcrumb .current{color:#6B7280}
    </style>
    <?php
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
    .ynm-contact-card{background:#FFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #E0E0E0;font-family:'Inter',-apple-system,sans-serif;width:100%;height:100%;display:flex;flex-direction:column;box-sizing:border-box}
    .ynm-contact-card-title{font-size:1rem;font-weight:700;color:#222;margin:0 0 16px;padding:0 0 12px;border-bottom:1px solid #E0E0E0}
    .ynm-contact-list{display:flex;flex-direction:column;gap:16px;flex:1}
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
    <div class="ynm-contact-card" id="ynm-contact-card">
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
.ynm-hours-card{background:#FFF;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #E0E0E0;width:100%;height:100%;display:flex;flex-direction:column;box-sizing:border-box}
.ynm-hours-title{font-size:1rem;font-weight:700;color:#222;margin:0 0 16px;padding:0 0 12px;border-bottom:1px solid #E0E0E0}
.ynm-hours-status{display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:20px;margin-bottom:20px;font-size:0.85rem;font-weight:600;background:#F5F5F5;color:#666}
.ynm-hours-dot{width:8px;height:8px;border-radius:50%;background:#999}
.ynm-hours-list{display:flex;flex-direction:column;flex:1}
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

    $is_verified = geodir_get_post_meta($post_id, 'claimed', true);
    if (empty($is_verified)) $is_verified = geodir_get_post_meta($post_id, 'verified', true);
    $is_featured = geodir_get_post_meta($post_id, 'featured', true);

    $yoga_alliance = geodir_get_post_meta($post_id, 'yoga_alliance', true);
    if (empty($yoga_alliance)) $yoga_alliance = geodir_get_post_meta($post_id, 'yoga_alliance_certification', true);

    $established = geodir_get_post_meta($post_id, 'established', true);
    if (empty($established)) $established = geodir_get_post_meta($post_id, 'established_year', true);
    if (empty($established)) $established = geodir_get_post_meta($post_id, 'year_established', true);

    $google_rating = geodir_get_post_meta($post_id, 'google_rating', true);
    $google_reviews = geodir_get_post_meta($post_id, 'google_reviews', true);

    $yelp_rating = geodir_get_post_meta($post_id, 'yelp_rating', true);
    $yelp_reviews = geodir_get_post_meta($post_id, 'yelp_reviews', true);

    if (empty($is_verified) && isset($gd_post->claimed)) {
        $is_verified = $gd_post->claimed;
    }
    if (empty($is_featured) && isset($gd_post->featured)) {
        $is_featured = $gd_post->featured;
    }

    $show_verified = ($is_verified === '1' || $is_verified === 1 || $is_verified === true);
    $show_featured = ($is_featured === '1' || $is_featured === 1 || $is_featured === true);
    $show_yoga_alliance = !empty($yoga_alliance);
    $show_established = !empty($established);
    $show_google = !empty($google_rating);
    $show_yelp = !empty($yelp_rating);

    if (!$show_verified && !$show_featured && !$show_yoga_alliance && !$show_established && !$show_google && !$show_yelp) {
        return '';
    }

    ob_start();
    ?>
    <style>
    .ynm-trust-badges{display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin:8px 0 12px 0;width:100%}
    .ynm-trust-badge{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:20px;font-family:'Inter',-apple-system,sans-serif;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.2s ease;border:1px solid}
    .ynm-trust-badge:hover{transform:translateY(-1px);box-shadow:0 2px 8px rgba(0,0,0,0.08)}
    .ynm-trust-badge i{font-size:14px}
    .ynm-trust-badge.established{background:#F9FAFB;border-color:#E4E7EC;color:#344054}
    .ynm-trust-badge.established i{color:#667085}
    .ynm-trust-badge.yoga-alliance{background:#C9553A;border-color:#C9553A;color:#FFFFFF}
    .ynm-trust-badge.yoga-alliance i{color:#FFFFFF}
    .ynm-trust-badge.google{background:#FFFFFF;border-color:#E4E7EC;color:#344054}
    .ynm-trust-badge.google i{color:#4285F4}
    .ynm-trust-badge.yelp{background:#FFFFFF;border-color:#E4E7EC;color:#344054}
    .ynm-trust-badge.yelp i{color:#D32323}
    .ynm-trust-badge.verified{background:#FFFFFF;border-color:#E4E7EC;color:#344054}
    .ynm-trust-badge.verified i{color:#12B76A}
    .ynm-trust-badge.featured{background:#FFF7ED;border-color:#FDBA74;color:#9A3412}
    .ynm-trust-badge.featured i{color:#EA580C}
    @media(max-width:600px){.ynm-trust-badges{gap:6px}.ynm-trust-badge{padding:6px 10px;font-size:11px}}
    </style>
    <div class="ynm-trust-badges">
        <?php if ($show_established): ?>
        <span class="ynm-trust-badge established"><i class="fas fa-calendar-alt"></i> Est. <?php echo esc_html($established); ?></span>
        <?php endif; ?>
        <?php if ($show_yoga_alliance): ?>
        <span class="ynm-trust-badge yoga-alliance"><i class="fas fa-om"></i> Yoga Alliance <?php echo esc_html($yoga_alliance); ?></span>
        <?php endif; ?>
        <?php if ($show_google): ?>
        <span class="ynm-trust-badge google"><i class="fab fa-google"></i> <?php echo esc_html($google_rating); ?><?php if (!empty($google_reviews)): ?> <span class="rating-count">(<?php echo esc_html($google_reviews); ?>)</span><?php endif; ?></span>
        <?php endif; ?>
        <?php if ($show_yelp): ?>
        <span class="ynm-trust-badge yelp"><i class="fab fa-yelp"></i> <?php echo esc_html($yelp_rating); ?><?php if (!empty($yelp_reviews)): ?> <span class="rating-count">(<?php echo esc_html($yelp_reviews); ?>)</span><?php endif; ?></span>
        <?php endif; ?>
        <?php if ($show_verified): ?>
        <span class="ynm-trust-badge verified"><i class="fas fa-check-circle"></i> Verified</span>
        <?php endif; ?>
        <?php if ($show_featured): ?>
        <span class="ynm-trust-badge featured"><i class="fas fa-star"></i> Featured</span>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_trust_badges', 'ynm_trust_badges_shortcode');

// ============================================
// SEARCH FIX - NOMINATIM GEOCODING
// ============================================

add_action('wp_footer', function() {
    ?>
    <script id="ynm-search-fix">
    (function(){
        var cities = {
            'new york': [40.7127, -74.0060],
            'los angeles': [34.0522, -118.2437],
            'chicago': [41.8756, -87.6244],
            'houston': [29.7589, -95.3677],
            'phoenix': [33.4484, -112.0741],
            'san diego': [32.7174, -117.1628],
            'san francisco': [37.7793, -122.4193],
            'seattle': [47.6038, -122.3301],
            'denver': [39.7392, -104.9849],
            'boston': [42.3554, -71.0605],
            'miami': [25.7742, -80.1936],
            'atlanta': [33.7490, -84.3903],
            'toronto': [43.6535, -79.3839],
            'vancouver': [49.2609, -123.1140]
        };

        function localLookup(q) {
            var n = q.toLowerCase().replace(/,.*/, '').trim();
            for (var c in cities) {
                if (n === c || n.indexOf(c) > -1) return cities[c];
            }
            return null;
        }

        async function nominatim(q) {
            try {
                var r = await fetch('https://nominatim.openstreetmap.org/search?format=json&countrycodes=us,ca&limit=1&q=' + encodeURIComponent(q));
                var d = await r.json();
                if (d && d[0]) return [parseFloat(d[0].lat), parseFloat(d[0].lon)];
            } catch(e) { console.warn('Nominatim error', e); }
            return null;
        }

        var form = document.querySelector('form.geodir-listing-search');
        if (!form) return;

        var snear = form.querySelector('input[name="snear"]');
        var lat = form.querySelector('input[name="sgeo_lat"]');
        var lon = form.querySelector('input[name="sgeo_lon"]');
        var btn = form.querySelector('button.geodir_submit_search');

        if (!snear || !lat || !lon || !btn) return;

        snear.addEventListener('input', function() {
            lat.value = '';
            lon.value = '';
        });

        btn.addEventListener('click', async function(e) {
            var q = snear.value.trim();
            if (!q || (lat.value && lon.value)) return;

            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            btn.textContent = 'Finding...';
            btn.disabled = true;

            var coords = localLookup(q) || await nominatim(q);
            if (coords) {
                lat.value = coords[0];
                lon.value = coords[1];
            }

            btn.textContent = 'Search';
            btn.disabled = false;
            form.submit();
        }, true);
    })();
    </script>
    <?php
}, 9999);

// ============================================
// REGISTER GEODIRECTORY CUSTOM FIELDS
// ============================================

function ynm_register_custom_fields() {
    // Only run if GeoDirectory is active
    if (!function_exists('geodir_custom_field_save')) {
        return;
    }

    // Check if we've already registered (run once)
    if (get_option('ynm_custom_fields_registered')) {
        return;
    }

    $post_type = 'gd_place';

    // Define the custom fields we need
    $custom_fields = array(
        // Quick Stats Fields
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'drop_in_price',
            'admin_title'       => 'Drop-in Price',
            'frontend_title'    => 'Drop-in Price',
            'frontend_desc'     => 'Single class drop-in price (e.g., $20)',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fas fa-dollar-sign',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 100,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'select',
            'htmlvar_name'      => 'heated',
            'admin_title'       => 'Heated Studio',
            'frontend_title'    => 'Heated',
            'frontend_desc'     => 'Does the studio offer heated classes?',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => 'Select/,Yes,No',
            'field_icon'        => 'fas fa-fire',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 101,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'select',
            'htmlvar_name'      => 'studio_size',
            'admin_title'       => 'Studio Size',
            'frontend_title'    => 'Studio Size',
            'frontend_desc'     => 'Approximate studio size',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => 'Select/,Boutique,Small,Medium,Large,Multi-Room',
            'field_icon'        => 'fas fa-expand-arrows-alt',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 102,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'teachers_count',
            'admin_title'       => 'Number of Teachers',
            'frontend_title'    => 'Teachers',
            'frontend_desc'     => 'Number of teachers/instructors',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fas fa-users',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 103,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'select',
            'htmlvar_name'      => 'virtual_classes',
            'admin_title'       => 'Virtual Classes',
            'frontend_title'    => 'Virtual Classes',
            'frontend_desc'     => 'Does the studio offer online/virtual classes?',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => 'Select/,Yes,No',
            'field_icon'        => 'fas fa-video',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 104,
        ),
        // Trust Badge Fields
        array(
            'post_type'         => $post_type,
            'field_type'        => 'select',
            'htmlvar_name'      => 'yoga_alliance',
            'admin_title'       => 'Yoga Alliance Certification',
            'frontend_title'    => 'Yoga Alliance',
            'frontend_desc'     => 'Yoga Alliance registration status',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => 'Select/,RYS 200,RYS 300,RYS 500,RPYS,RCYS,YACEP',
            'field_icon'        => 'fas fa-certificate',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 105,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'established',
            'admin_title'       => 'Year Established',
            'frontend_title'    => 'Established',
            'frontend_desc'     => 'Year the studio was founded (e.g., 2015)',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fas fa-calendar',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 106,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'google_rating',
            'admin_title'       => 'Google Rating',
            'frontend_title'    => 'Google Rating',
            'frontend_desc'     => 'Google Maps rating (e.g., 4.8)',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fab fa-google',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 107,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'google_reviews',
            'admin_title'       => 'Google Review Count',
            'frontend_title'    => 'Google Reviews',
            'frontend_desc'     => 'Number of Google reviews',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fab fa-google',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 108,
        ),
        // Intro Offer Fields
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'intro_offer',
            'admin_title'       => 'Intro Offer',
            'frontend_title'    => 'Intro Offer',
            'frontend_desc'     => 'New student special offer (e.g., "2 Weeks Unlimited for $40")',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fas fa-gift',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 109,
        ),
        array(
            'post_type'         => $post_type,
            'field_type'        => 'text',
            'htmlvar_name'      => 'intro_offer_terms',
            'admin_title'       => 'Intro Offer Terms',
            'frontend_title'    => 'Offer Terms',
            'frontend_desc'     => 'Terms and conditions for intro offer',
            'is_active'         => 1,
            'is_default'        => 0,
            'show_in'           => '[detail]',
            'option_values'     => '',
            'field_icon'        => 'fas fa-info-circle',
            'css_class'         => '',
            'cat_sort'          => 0,
            'sort_order'        => 110,
        ),
    );

    // Register each field
    foreach ($custom_fields as $field) {
        // Check if field already exists
        global $wpdb;
        $table = $wpdb->prefix . 'geodir_custom_fields';
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$table} WHERE htmlvar_name = %s AND post_type = %s",
            $field['htmlvar_name'],
            $field['post_type']
        ));

        if (!$exists) {
            geodir_custom_field_save($field);
        }
    }

    // Mark as registered so we don't run again
    update_option('ynm_custom_fields_registered', true);
}
add_action('init', 'ynm_register_custom_fields', 20);

// Admin button to re-register fields if needed
function ynm_add_reregister_fields_button() {
    if (isset($_GET['ynm_reregister_fields']) && current_user_can('manage_options')) {
        delete_option('ynm_custom_fields_registered');
        ynm_register_custom_fields();
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p>YNM custom fields have been re-registered.</p></div>';
        });
    }
}
add_action('admin_init', 'ynm_add_reregister_fields_button');

// ============================================
// QUICK STATS BAR SHORTCODE
// ============================================

function ynm_quick_stats_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;

    $drop_in = geodir_get_post_meta($post_id, 'drop_in_price', true);
    if (empty($drop_in)) {
        $drop_in = geodir_get_post_meta($post_id, 'price', true);
    }

    $heated = geodir_get_post_meta($post_id, 'heated', true);
    $studio_size = geodir_get_post_meta($post_id, 'studio_size', true);
    $teachers = geodir_get_post_meta($post_id, 'teachers_count', true);
    $virtual = geodir_get_post_meta($post_id, 'virtual_classes', true);

    // Add dollar sign if price doesn't have one
    if (!empty($drop_in) && strpos($drop_in, '$') === false && is_numeric(str_replace(',', '', $drop_in))) {
        $drop_in = '$' . $drop_in;
    }

    $heated_display = ($heated === '1' || $heated === 1 || strtolower($heated) === 'yes') ? 'Yes' : 'No';
    $virtual_display = ($virtual === '1' || $virtual === 1 || strtolower($virtual) === 'yes') ? 'Available' : 'No';

    ob_start();
    ?>
    <style>
    .ynm-quick-info-bar{display:flex;flex-wrap:wrap;gap:2rem;padding:1.25rem 2rem;background:#F8F9FA;border-radius:12px;margin:0 0 1.5rem 0;font-family:'Inter',-apple-system,sans-serif;width:100%;box-sizing:border-box}
    .ynm-quick-info-item{display:flex;align-items:center;gap:0.75rem}
    .ynm-quick-info-icon{color:#FF5733;font-size:1.1rem;width:24px;text-align:center}
    .ynm-quick-info-icon svg{width:20px;height:20px;fill:#FF5733}
    .ynm-quick-info-label{font-size:0.7rem;color:#6B7280;text-transform:uppercase;letter-spacing:0.03em;margin-bottom:2px}
    .ynm-quick-info-value{font-size:0.9rem;font-weight:600;color:#1F2937}
    @media(max-width:600px){.ynm-quick-info-bar{gap:1.25rem;padding:1rem}.ynm-quick-info-item{min-width:45%}}
    </style>
    <div class="ynm-quick-info-bar">
        <div class="ynm-quick-info-item">
            <div class="ynm-quick-info-icon"><svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg></div>
            <div>
                <div class="ynm-quick-info-label">Drop-in</div>
                <div class="ynm-quick-info-value"><?php echo !empty($drop_in) ? esc_html($drop_in) : '—'; ?></div>
            </div>
        </div>
        <div class="ynm-quick-info-item">
            <div class="ynm-quick-info-icon"><svg viewBox="0 0 24 24"><path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67z"/></svg></div>
            <div>
                <div class="ynm-quick-info-label">Heated</div>
                <div class="ynm-quick-info-value"><?php echo esc_html($heated_display); ?></div>
            </div>
        </div>
        <div class="ynm-quick-info-item">
            <div class="ynm-quick-info-icon"><svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></div>
            <div>
                <div class="ynm-quick-info-label">Studio Size</div>
                <div class="ynm-quick-info-value"><?php echo !empty($studio_size) ? esc_html($studio_size) : 'Medium'; ?></div>
            </div>
        </div>
        <div class="ynm-quick-info-item">
            <div class="ynm-quick-info-icon"><svg viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg></div>
            <div>
                <div class="ynm-quick-info-label">Teachers</div>
                <div class="ynm-quick-info-value"><?php echo !empty($teachers) ? esc_html($teachers) . ' instructors' : '—'; ?></div>
            </div>
        </div>
        <div class="ynm-quick-info-item">
            <div class="ynm-quick-info-icon"><svg viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg></div>
            <div>
                <div class="ynm-quick-info-label">Virtual</div>
                <div class="ynm-quick-info-value"><?php echo esc_html($virtual_display); ?></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_quick_stats', 'ynm_quick_stats_shortcode');

// ============================================
// INTRO OFFER BANNER SHORTCODE
// ============================================

function ynm_intro_offer_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;
    $studio_name = get_the_title($post_id);

    $intro_offer = geodir_get_post_meta($post_id, 'intro_offer', true);
    if (empty($intro_offer)) {
        $intro_offer = geodir_get_post_meta($post_id, 'special_offers', true);
    }

    $intro_terms = geodir_get_post_meta($post_id, 'intro_offer_terms', true);
    $has_offer = !empty($intro_offer);

    if ($has_offer && empty($intro_terms)) {
        $intro_terms = 'First-time visitors only';
    }

    ob_start();
    ?>
    <style>
    .ynm-intro-offer{background:linear-gradient(135deg,#5F7470 0%,#4A5D5A 100%);border-radius:12px;padding:24px 32px;margin:0 0 24px 0;display:flex;justify-content:space-between;align-items:center;gap:24px;font-family:'Inter',-apple-system,sans-serif;width:100%;box-sizing:border-box}
    .ynm-intro-offer.no-offer{background:rgba(97,148,139,0.2)}
    .ynm-intro-offer.no-offer .ynm-offer-text h3,.ynm-intro-offer.no-offer .ynm-offer-text p{color:#1F2937}
    .ynm-intro-offer.no-offer .ynm-offer-text p{color:#4B5563}
    .ynm-offer-left{display:flex;align-items:center;gap:16px;flex:1}
    .ynm-offer-icon{width:52px;height:52px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0}
    .ynm-intro-offer.no-offer .ynm-offer-icon{background:#FFFFFF;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
    .ynm-offer-text h3{color:#FFFFFF;font-size:20px;font-weight:700;margin:0 0 4px 0;line-height:1.3}
    .ynm-offer-text p{color:rgba(255,255,255,0.85);font-size:14px;margin:0}
    .ynm-offer-btn{background:#FF5733;color:#FFFFFF !important;padding:16px 32px;border-radius:8px;font-weight:700;font-size:15px;border:none;cursor:pointer;white-space:nowrap;transition:all 0.2s ease;text-decoration:none !important;display:inline-flex;align-items:center;gap:8px}
    .ynm-offer-btn:hover{background:#E64A2A;transform:translateY(-2px);box-shadow:0 6px 20px rgba(255,87,51,0.35)}
    .ynm-offer-btn.secondary{background:#5F7470}
    .ynm-offer-btn.secondary:hover{background:#4A5D5A}
    @media(max-width:700px){.ynm-intro-offer{flex-direction:column;text-align:center;padding:24px 20px}.ynm-offer-left{flex-direction:column}.ynm-offer-btn{width:100%;justify-content:center}}
    </style>

    <?php if ($has_offer): ?>
    <div class="ynm-intro-offer">
        <div class="ynm-offer-left">
            <div class="ynm-offer-icon">🎁</div>
            <div class="ynm-offer-text">
                <h3><?php echo esc_html($intro_offer); ?></h3>
                <p><?php echo esc_html($intro_terms); ?></p>
            </div>
        </div>
        <a href="#ynm-contact-card" class="ynm-offer-btn">Claim This Offer →</a>
    </div>
    <?php else: ?>
    <div class="ynm-intro-offer no-offer">
        <div class="ynm-offer-left">
            <div class="ynm-offer-icon">📞</div>
            <div class="ynm-offer-text">
                <h3>New student specials may be available</h3>
                <p>Contact studio for current offers and pricing</p>
            </div>
        </div>
        <a href="#ynm-contact-card" class="ynm-offer-btn secondary">Ask About Intro Offers</a>
    </div>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_intro_offer', 'ynm_intro_offer_shortcode');

// ============================================
// YOGA STYLES SHORTCODE (WITH LABELS)
// ============================================

function ynm_yoga_styles_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $atts = shortcode_atts(array(
        'show_links'   => 'true',
        'show_icons'   => 'true',
        'show_heading' => 'false',
        'heading_text' => 'Yoga Styles Offered',
        'class'        => 'ynm-yoga-styles-section'
    ), $atts);

    $post_id = $post->ID;

    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }
    if (empty($yoga_styles) && isset($gd_post) && isset($gd_post->yoga_styles)) {
        $yoga_styles = $gd_post->yoga_styles;
    }

    if (empty($yoga_styles)) {
        return '';
    }

    $styles_array = ynm_parse_yoga_styles($yoga_styles);

    if (empty($styles_array)) {
        return '';
    }

    $style_urls = ynm_get_yoga_style_urls();
    $style_labels = ynm_get_yoga_style_labels();

    ob_start();
    ynm_yoga_styles_inline_css();
    ?>
    <div class="<?php echo esc_attr($atts['class']); ?>">
        <?php if ($atts['show_heading'] === 'true'): ?>
        <h3 class="ynm-yoga-styles-heading"><?php echo esc_html($atts['heading_text']); ?></h3>
        <?php endif; ?>
        <div class="ynm-yoga-styles-container">
            <?php foreach ($styles_array as $style):
                $style_clean = trim($style);
                $style_slug = sanitize_title($style_clean);
                $style_url = isset($style_urls[$style_clean]) ? $style_urls[$style_clean] : (isset($style_urls[$style_slug]) ? $style_urls[$style_slug] : '');
                $display_name = isset($style_labels[$style_clean]) ? $style_labels[$style_clean] : ucwords(str_replace(array('-', '_', '/'), ' ', $style_clean));
                $show_link = ($atts['show_links'] === 'true' && !empty($style_url));
                $show_icon = ($atts['show_icons'] === 'true');
            ?>
                <?php if ($show_link): ?>
                <a href="<?php echo esc_url($style_url); ?>" class="ynm-yoga-style-badge<?php echo $show_icon ? ' with-icon' : ''; ?>">
                    <?php if ($show_icon): ?><span class="style-icon">&#9733;</span><?php endif; ?>
                    <span class="style-name"><?php echo esc_html($display_name); ?></span>
                </a>
                <?php else: ?>
                <span class="ynm-yoga-style-badge<?php echo $show_icon ? ' with-icon' : ''; ?>">
                    <?php if ($show_icon): ?><span class="style-icon">&#9733;</span><?php endif; ?>
                    <span class="style-name"><?php echo esc_html($display_name); ?></span>
                </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_yoga_styles', 'ynm_yoga_styles_shortcode');

function ynm_parse_yoga_styles($yoga_styles) {
    if (is_array($yoga_styles)) {
        return array_filter(array_map('trim', $yoga_styles));
    }
    $decoded = json_decode($yoga_styles, true);
    if (is_array($decoded)) {
        return array_filter(array_map('trim', $decoded));
    }
    if (strpos($yoga_styles, ',') !== false) {
        return array_filter(array_map('trim', explode(',', $yoga_styles)));
    }
    if (strpos($yoga_styles, '|') !== false) {
        return array_filter(array_map('trim', explode('|', $yoga_styles)));
    }
    if (!empty(trim($yoga_styles))) {
        return array(trim($yoga_styles));
    }
    return array();
}

function ynm_get_yoga_style_urls() {
    $base_url = home_url('/yoga-styles/');
    return array(
        'hot-yoga/26+2'     => $base_url . 'hot-yoga/',
        'vinyassa-yoga'     => $base_url . 'vinyasa/',
        'hatha-yoga'        => $base_url . 'hatha/',
        'yin-yoga'          => $base_url . 'yin/',
        'prenatal_yoga'     => $base_url . 'prenatal/',
        'ashtanga-yoga'     => $base_url . 'ashtanga/',
        'restorative-yoga'  => $base_url . 'restorative/',
        'kundalini'         => $base_url . 'kundalini/',
        'rocket_yoga'       => $base_url . 'rocket/',
        'aerial_yoga'       => $base_url . 'aerial/',
        'iyengar_yoga'      => $base_url . 'iyengar/',
        'power_yoga'        => $base_url . 'power-yoga/',
        'kriya_yoga'        => $base_url . 'kriya/',
        'dharma_yoga'       => $base_url . 'dharma/',
        'yoga_nidra'        => $base_url . 'yoga-nidra/',
        'chair_yoga'        => $base_url . 'chair-yoga/',
        'kids_yoga'         => $base_url . 'kids-yoga/',
        'gentle_yoga'       => $base_url . 'gentle/',
        'slow_flow'         => $base_url . 'slow-flow/',
        'jivamukti'         => $base_url . 'jivamukti/',
        'mysore'            => $base_url . 'ashtanga/',
    );
}

function ynm_get_yoga_style_labels() {
    return array(
        'hot-yoga/26+2'     => 'Hot Yoga (26+2)',
        'vinyassa-yoga'     => 'Vinyasa',
        'hatha-yoga'        => 'Hatha',
        'yin-yoga'          => 'Yin',
        'prenatal_yoga'     => 'Prenatal',
        'ashtanga-yoga'     => 'Ashtanga',
        'restorative-yoga'  => 'Restorative',
        'kundalini'         => 'Kundalini',
        'rocket_yoga'       => 'Rocket',
        'aerial_yoga'       => 'Aerial',
        'iyengar_yoga'      => 'Iyengar',
        'power_yoga'        => 'Power Yoga',
        'kriya_yoga'        => 'Kriya',
        'dharma_yoga'       => 'Dharma',
        'yoga_nidra'        => 'Yoga Nidra',
        'chair_yoga'        => 'Chair Yoga',
        'kids_yoga'         => 'Kids Yoga',
        'gentle_yoga'       => 'Gentle Yoga',
        'slow_flow'         => 'Slow Flow',
        'jivamukti'         => 'Jivamukti',
        'mysore'            => 'Mysore',
    );
}

function ynm_yoga_styles_inline_css() {
    static $css_output = false;
    if ($css_output) return;
    $css_output = true;
    ?>
    <style>
    .ynm-yoga-styles-section{margin-bottom:24px}
    .ynm-yoga-styles-container{display:flex;flex-wrap:wrap;gap:12px;width:100%}
    .ynm-yoga-style-badge{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:24px;border:2px solid #61948B;background:#FFFFFF;color:#61948B;font-family:Inter,-apple-system,sans-serif;font-weight:500;font-size:14px;text-decoration:none;transition:all 0.2s ease}
    a.ynm-yoga-style-badge:hover{background:#61948B;color:#FFFFFF;transform:translateY(-2px);box-shadow:0 4px 12px rgba(97,148,139,0.25)}
    a.ynm-yoga-style-badge:hover .style-icon{color:#FFFFFF}
    .ynm-yoga-style-badge .style-icon{font-size:12px;color:#61948B;transition:color 0.2s ease}
    @media(max-width:768px){.ynm-yoga-styles-container{gap:8px}.ynm-yoga-style-badge{padding:8px 14px;font-size:13px}}
    </style>
    <?php
}

function ynm_studio_has_yoga_styles($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
    }
    if (!$post_id) return false;
    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    return !empty($yoga_styles);
}

function ynm_get_studio_yoga_styles($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = isset($post->ID) ? $post->ID : 0;
    }
    if (!$post_id) return array();
    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    return ynm_parse_yoga_styles($yoga_styles);
}

// ============================================
// YOGA STYLES CARD SHORTCODE
// ============================================

function ynm_yoga_styles_card_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }

    global $post, $gd_post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $post_id = $post->ID;

    $yoga_styles = geodir_get_post_meta($post_id, 'yoga_styles', true);
    if (empty($yoga_styles)) {
        $yoga_styles = geodir_get_post_meta($post_id, 'yogastyles', true);
    }
    if (empty($yoga_styles) && isset($gd_post) && isset($gd_post->yoga_styles)) {
        $yoga_styles = $gd_post->yoga_styles;
    }

    if (empty($yoga_styles)) {
        return '';
    }

    $styles_array = ynm_parse_yoga_styles($yoga_styles);

    if (empty($styles_array)) {
        return '';
    }

    $style_urls = ynm_get_yoga_style_urls();
    $style_labels = ynm_get_yoga_style_labels();

    $html = '<style>
.ynm-styles-card{background:#FFF !important;border-radius:12px !important;padding:24px !important;box-shadow:0 2px 8px rgba(0,0,0,0.06) !important;border:1px solid #E0E0E0 !important;margin:0 0 24px 0 !important;overflow:hidden}
.ynm-styles-card-title{font-family:Inter,-apple-system,sans-serif;font-size:1rem;font-weight:700;color:#222;margin:0 0 16px;padding:0 0 12px;border-bottom:1px solid #E0E0E0}
.ynm-styles-card .ynm-yoga-styles-container{display:flex;flex-wrap:wrap;gap:10px}
.ynm-styles-card .ynm-yoga-style-badge{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:20px;border:2px solid #61948B;background:#FFF;color:#61948B;font-family:Inter,-apple-system,sans-serif;font-weight:500;font-size:13px;text-decoration:none;transition:all 0.2s ease}
.ynm-styles-card a.ynm-yoga-style-badge:hover{background:#61948B;color:#FFF}
.ynm-styles-card .style-icon{color:#61948B;font-size:11px}
.ynm-styles-card a.ynm-yoga-style-badge:hover .style-icon{color:#FFF}
</style>';

    $html .= '<div class="ynm-styles-card">';
    $html .= '<h3 class="ynm-styles-card-title">Yoga Styles Offered</h3>';
    $html .= '<div class="ynm-yoga-styles-container">';

    foreach ($styles_array as $style) {
        $style_clean = trim($style);
        $style_slug = sanitize_title($style_clean);
        $style_url = isset($style_urls[$style_clean]) ? $style_urls[$style_clean] : (isset($style_urls[$style_slug]) ? $style_urls[$style_slug] : '');
        $display_name = isset($style_labels[$style_clean]) ? $style_labels[$style_clean] : ucwords(str_replace(array('-', '_', '/'), ' ', $style_clean));
        $show_link = !empty($style_url);

        if ($show_link) {
            $html .= '<a href="' . esc_url($style_url) . '" class="ynm-yoga-style-badge">';
            $html .= '<span class="style-icon">&#9733;</span>';
            $html .= '<span class="style-name">' . esc_html($display_name) . '</span>';
            $html .= '</a>';
        } else {
            $html .= '<span class="ynm-yoga-style-badge">';
            $html .= '<span class="style-icon">&#9733;</span>';
            $html .= '<span class="style-name">' . esc_html($display_name) . '</span>';
            $html .= '</span>';
        }
    }

    $html .= '</div></div>';

    return $html;
}
add_shortcode('ynm_yoga_styles_card', 'ynm_yoga_styles_card_shortcode');

// ============================================
// CLICKABLE GOOGLE RATING
// Makes rating link to Google search for reviews
// ============================================

/**
 * JavaScript to make existing rating elements clickable
 * Changes the #reviews link to open Google search for studio reviews
 */
function ynm_clickable_rating_script() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }

    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return;
    }

    $post_id = $post->ID;

    // Get Google reviews URL or build search URL
    $google_url = geodir_get_post_meta($post_id, 'google_reviews_url', true);
    if (empty($google_url)) {
        $google_url = geodir_get_post_meta($post_id, 'googlereviewsurl', true);
    }
    if (empty($google_url)) {
        $studio_name = get_the_title($post_id);
        $city = geodir_get_post_meta($post_id, 'city', true);
        $search_query = $studio_name;
        if (!empty($city)) {
            $search_query .= ' ' . $city;
        }
        $search_query .= ' reviews';
        $google_url = 'https://www.google.com/search?q=' . urlencode($search_query);
    }
    ?>
    <script>
    (function() {
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            var reviewUrl = <?php echo json_encode(esc_url($google_url)); ?>;

            // Target 1: Change the #reviews link inside .ynm-rating-count
            var reviewLinks = document.querySelectorAll('.ynm-rating-count a[href="#reviews"], .ynm-rating-count a[href$="#reviews"]');
            reviewLinks.forEach(function(link) {
                link.href = reviewUrl;
                link.target = '_blank';
                link.rel = 'noopener noreferrer';
            });

            // Target 2: Make the rating number clickable too
            var ratingNumbers = document.querySelectorAll('.ynm-rating-number');
            ratingNumbers.forEach(function(el) {
                el.style.cursor = 'pointer';
                el.addEventListener('click', function() {
                    window.open(reviewUrl, '_blank');
                });
            });

            // Target 3: Make the stars clickable
            var stars = document.querySelectorAll('.ynm-stars, .ynm-hero-rating-row .ynm-stars');
            stars.forEach(function(el) {
                el.style.cursor = 'pointer';
                el.addEventListener('click', function() {
                    window.open(reviewUrl, '_blank');
                });
            });

            // Target 4: Wrap entire rating row for better UX (optional hover effect)
            var ratingRow = document.querySelector('.ynm-hero-rating-row');
            if (ratingRow) {
                ratingRow.style.cursor = 'pointer';
                ratingRow.title = 'View Google reviews';
            }
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'ynm_clickable_rating_script');

