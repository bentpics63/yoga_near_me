/**
 * Complete Section Templates - FIXED VERSION
 * Copy everything below into your functions.php (without the opening <?php tag)
 */

// =====================================================
// CONTACT INFORMATION SHORTCODE
// =====================================================
function ynm_complete_contact_info_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    $post_id = $post->ID;
    
    // Get contact data from GeoDirectory
    $address = geodir_get_post_meta($post_id, 'street', true);
    $city = geodir_get_post_meta($post_id, 'city', true);
    $region = geodir_get_post_meta($post_id, 'region', true);
    $zip = geodir_get_post_meta($post_id, 'zip', true);
    $country = geodir_get_post_meta($post_id, 'country', true);
    $phone = geodir_get_post_meta($post_id, 'phone', true);
    $email = geodir_get_post_meta($post_id, 'email', true);
    $website = geodir_get_post_meta($post_id, 'website', true);
    
    // Build full address
    $full_address = '';
    if (!empty($address)) {
        $full_address = $address;
    }
    $city_line = '';
    if (!empty($city)) {
        $city_line = $city;
        if (!empty($region)) {
            $city_line .= ', ' . $region;
        }
        if (!empty($zip)) {
            $city_line .= ' ' . $zip;
        }
    }
    
    ob_start();
    ?>
    <div class="contact-information-card">
        <h2 class="section-heading">Contact Information</h2>
        
        <div class="contact-items">
            <!-- Address -->
            <div class="contact-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#5F7470">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">ADDRESS</span>
                    <span class="contact-value">
                        <?php if (!empty($full_address) || !empty($city_line)): ?>
                            <?php if (!empty($full_address)): ?>
                                <?php echo esc_html($full_address); ?><br>
                            <?php endif; ?>
                            <?php if (!empty($city_line)): ?>
                                <?php echo esc_html($city_line); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            TBD
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            
            <!-- Phone -->
            <div class="contact-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#5F7470">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">PHONE</span>
                    <span class="contact-value">
                        <?php if (!empty($phone)): ?>
                            <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                        <?php else: ?>
                            TBD
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            
            <!-- Email -->
            <div class="contact-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#5F7470">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">EMAIL</span>
                    <span class="contact-value">
                        <?php if (!empty($email)): ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        <?php else: ?>
                            TBD
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            
            <!-- Website -->
            <div class="contact-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#5F7470">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM18.92 8h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zM8.03 8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.34.16-2h4.68c.09.66.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">WEBSITE</span>
                    <span class="contact-value">
                        <?php if (!empty($website)): ?>
                            <a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo esc_html(str_replace(array('https://', 'http://'), '', $website)); ?></a>
                        <?php else: ?>
                            TBD
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Follow Us -->
        <div class="follow-us-section">
            <h3 class="follow-us-heading">Follow Us</h3>
            <div class="social-icons">
                <span class="social-icon facebook"></span>
                <span class="social-icon instagram"></span>
                <span class="social-icon youtube"></span>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_complete_contact_info', 'ynm_complete_contact_info_shortcode');

// =====================================================
// HOURS OF OPERATION SHORTCODE
// =====================================================
function ynm_complete_hours_shortcode($atts) {
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return '';
    }
    
    global $post;
    if (!isset($post) || !isset($post->ID)) {
        return '';
    }
    
    $post_id = $post->ID;
    
    // Days of the week
    $days = array(
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    );
    
    // Get today
    $today_key = strtolower(date('l'));
    
    ob_start();
    ?>
    <div class="hours-of-operation-card">
        <h2 class="section-heading">Hours of Operation</h2>
        
        <!-- Status -->
        <div class="hours-status">
            <span class="status-dot"></span>
            <span class="status-text">TBD</span>
        </div>
        
        <!-- Hours List -->
        <div class="hours-list">
            <?php
            // Show today first
            if (isset($days[$today_key])):
            ?>
            <div class="hours-row today">
                <span class="day"><?php echo esc_html($days[$today_key]); ?></span>
                <span class="time">TBD</span>
            </div>
            <?php
            endif;
            
            // Show rest of days
            foreach ($days as $key => $day_name):
                if ($key === $today_key) continue;
            ?>
            <div class="hours-row">
                <span class="day"><?php echo esc_html($day_name); ?></span>
                <span class="time">TBD</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_complete_hours', 'ynm_complete_hours_shortcode');

