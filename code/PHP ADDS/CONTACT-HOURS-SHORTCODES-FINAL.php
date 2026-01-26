// =====================================================
// CONTACT INFORMATION - Exact Layout
// Add to functions.php
// =====================================================
function ynm_contact_info_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    $post_id = $post->ID;
    
    // Get data
    $street = geodir_get_post_meta($post_id, 'street', true);
    $city = geodir_get_post_meta($post_id, 'city', true);
    $region = geodir_get_post_meta($post_id, 'region', true);
    $zip = geodir_get_post_meta($post_id, 'zip', true);
    $phone = geodir_get_post_meta($post_id, 'phone', true);
    $email = geodir_get_post_meta($post_id, 'email', true);
    $website = geodir_get_post_meta($post_id, 'website', true);
    $facebook = geodir_get_post_meta($post_id, 'facebook', true);
    $instagram = geodir_get_post_meta($post_id, 'instagram', true);
    $youtube = geodir_get_post_meta($post_id, 'youtube', true);
    
    // Build address lines
    $addr_line1 = !empty($street) ? $street : 'TBD';
    $addr_line2 = '';
    if (!empty($city)) {
        $addr_line2 = $city;
        if (!empty($region)) $addr_line2 .= ', ' . $region;
        if (!empty($zip)) $addr_line2 .= ' ' . $zip;
    }
    
    ob_start();
    ?>
    <div class="ynm-contact-card">
        <h2 class="ynm-card-title">Contact Information</h2>
        
        <div class="ynm-contact-list">
            <!-- Address -->
            <div class="ynm-contact-row">
                <div class="ynm-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#5F7470"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <div class="ynm-contact-info">
                    <span class="ynm-label">ADDRESS</span>
                    <span class="ynm-value"><?php echo esc_html($addr_line1); ?></span>
                    <?php if (!empty($addr_line2)): ?>
                    <span class="ynm-value"><?php echo esc_html($addr_line2); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Phone -->
            <div class="ynm-contact-row">
                <div class="ynm-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#5F7470"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                </div>
                <div class="ynm-contact-info">
                    <span class="ynm-label">PHONE</span>
                    <?php if (!empty($phone)): ?>
                    <a href="tel:<?php echo esc_attr($phone); ?>" class="ynm-link"><?php echo esc_html($phone); ?></a>
                    <?php else: ?>
                    <span class="ynm-value ynm-tbd">TBD</span>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Email -->
            <div class="ynm-contact-row">
                <div class="ynm-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#5F7470"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <div class="ynm-contact-info">
                    <span class="ynm-label">EMAIL</span>
                    <?php if (!empty($email)): ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="ynm-link"><?php echo esc_html($email); ?></a>
                    <?php else: ?>
                    <span class="ynm-value ynm-tbd">TBD</span>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Website -->
            <div class="ynm-contact-row">
                <div class="ynm-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#5F7470"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </div>
                <div class="ynm-contact-info">
                    <span class="ynm-label">WEBSITE</span>
                    <?php if (!empty($website)): ?>
                    <a href="<?php echo esc_url($website); ?>" target="_blank" class="ynm-link"><?php echo esc_html(preg_replace('#^https?://#', '', $website)); ?></a>
                    <?php else: ?>
                    <span class="ynm-value ynm-tbd">TBD</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Follow Us -->
        <div class="ynm-follow-section">
            <span class="ynm-follow-title">Follow Us</span>
            <div class="ynm-social-icons">
                <a href="<?php echo !empty($facebook) ? esc_url($facebook) : '#'; ?>" class="ynm-social-icon" aria-label="Facebook">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#7C6A9A"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="<?php echo !empty($instagram) ? esc_url($instagram) : '#'; ?>" class="ynm-social-icon" aria-label="Instagram">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#7C6A9A"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="#7C6A9A" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="#7C6A9A" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5" fill="#7C6A9A"/></svg>
                </a>
                <a href="<?php echo !empty($youtube) ? esc_url($youtube) : '#'; ?>" class="ynm-social-icon" aria-label="YouTube">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#7C6A9A"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                </a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_contact_info', 'ynm_contact_info_shortcode');

// =====================================================
// HOURS OF OPERATION - Exact Layout
// =====================================================
function ynm_hours_shortcode() {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    $days = array(
        'monday' => 'Monday',
        'tuesday' => 'Tuesday', 
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    );
    $today = strtolower(date('l'));
    
    ob_start();
    ?>
    <div class="ynm-hours-card">
        <h2 class="ynm-card-title">Hours of Operation</h2>
        
        <div class="ynm-status-badge">
            <span class="ynm-status-dot"></span>
            <span class="ynm-status-text">TBD</span>
        </div>
        
        <div class="ynm-hours-list">
            <?php foreach ($days as $key => $name): ?>
            <div class="ynm-hours-row<?php echo ($key === $today) ? ' ynm-today' : ''; ?>">
                <span class="ynm-day"><?php echo $name; ?></span>
                <span class="ynm-time">TBD</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_hours', 'ynm_hours_shortcode');

