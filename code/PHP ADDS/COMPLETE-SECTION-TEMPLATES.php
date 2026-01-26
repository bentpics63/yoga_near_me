<?php
/**
 * Complete Section Templates
 * Shows all fields with placeholders (TBD) until data is filled
 * Matches green layout structure with white/off-white colors
 */

/**
 * Display complete Contact Information section
 * Shows all fields (Address, Phone, Email, Website) even if empty
 */
function ynm_display_complete_contact_info() {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    // Get contact data
    $address = geodir_get_post_meta($post_id, 'geodir_address', true);
    if (empty($address)) {
        $address = get_post_meta($post_id, 'geodir_address', true);
    }
    
    $phone = geodir_get_post_meta($post_id, 'geodir_phone', true);
    if (empty($phone)) {
        $phone = get_post_meta($post_id, 'geodir_phone', true);
    }
    
    $email = geodir_get_post_meta($post_id, 'geodir_email', true);
    if (empty($email)) {
        $email = get_post_meta($post_id, 'geodir_email', true);
    }
    
    $website = geodir_get_post_meta($post_id, 'geodir_website', true);
    if (empty($website)) {
        $website = get_post_meta($post_id, 'geodir_website', true);
    }
    
    // Get social media links
    $facebook = get_post_meta($post_id, 'facebook_url', true);
    $instagram = get_post_meta($post_id, 'instagram_url', true);
    $youtube = get_post_meta($post_id, 'youtube_url', true);
    
    ob_start();
    ?>
    <div class="contact-information-group">
        <h2>Contact Information</h2>
        
        <div class="contact-items-wrapper">
            <!-- Address -->
            <div class="contact-item-wrapper">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">ADDRESS</span>
                    <span class="contact-value"><?php echo !empty($address) ? esc_html($address) : 'TBD'; ?></span>
                </div>
            </div>
            
            <!-- Phone -->
            <div class="contact-item-wrapper">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
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
            <div class="contact-item-wrapper">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
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
            <div class="contact-item-wrapper">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM18.92 8h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zM8.03 8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.34.16-2h4.68c.09.66.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/>
                    </svg>
                </div>
                <div class="contact-details">
                    <span class="contact-label">WEBSITE</span>
                    <span class="contact-value">
                        <?php if (!empty($website)): ?>
                            <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"><?php echo esc_html($website); ?></a>
                        <?php else: ?>
                            TBD
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Follow Us Section -->
        <div class="follow-us-section">
            <h3 class="follow-us-heading">Follow Us</h3>
            <div class="social-links">
                <?php if (!empty($facebook)): ?>
                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" class="social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($instagram)): ?>
                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($youtube)): ?>
                    <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener" class="social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    echo ob_get_clean();
}

/**
 * Display complete Hours of Operation section
 * Shows all 7 days with TBD if empty
 */
function ynm_display_complete_hours() {
    // Only show on single studio pages
    if (!function_exists('geodir_is_page') || !geodir_is_page('detail')) {
        return;
    }
    
    global $post;
    
    if (!isset($post) || !isset($post->ID)) {
        return;
    }
    
    $post_id = $post->ID;
    
    // Get business hours
    $business_hours = geodir_get_post_meta($post_id, 'business_hours', true);
    if (empty($business_hours)) {
        $business_hours = get_post_meta($post_id, 'business_hours', true);
    }
    
    // Parse hours if available
    $hours_data = array();
    if (!empty($business_hours)) {
        $hours_data = ynm_parse_business_hours($business_hours);
    }
    
    // Get current status
    $status = ynm_get_current_business_status($business_hours);
    $status_text = 'TBD';
    $is_open = false;
    
    if ($status) {
        $is_open = $status['is_open'];
        if ($is_open && !empty($status['closes_at'])) {
            $status_text = 'Open Now · Closes ' . $status['closes_at'];
        } elseif ($is_open) {
            $status_text = 'Open Now';
        } else {
            $status_text = 'Closed';
        }
    }
    
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
    
    // Get today's day name
    $today = strtolower(date('l'));
    $today_key = strtolower($today);
    
    ob_start();
    ?>
    <div class="hours-of-operation-group">
        <h2>Hours of Operation</h2>
        
        <!-- Status Indicator -->
        <div class="hours-status-group <?php echo $is_open ? 'open' : 'closed'; ?>">
            <span class="status-dot"></span>
            <span class="status-text"><?php echo esc_html($status_text); ?></span>
        </div>
        
        <!-- Hours List -->
        <div class="hours-list">
            <?php
            // Show today first
            if (isset($days[$today_key])) {
                $day_name = $days[$today_key];
                $day_hours = isset($hours_data[$today_key]) ? $hours_data[$today_key] : 'TBD';
                ?>
                <div class="hours-row-group today" data-day="<?php echo esc_attr($today_key); ?>">
                    <span class="day"><?php echo esc_html($day_name); ?></span>
                    <span class="time"><?php echo esc_html($day_hours); ?></span>
                </div>
                <?php
            }
            
            // Show rest of days
            foreach ($days as $key => $day_name) {
                if ($key === $today_key) {
                    continue; // Skip today, already shown
                }
                
                $day_hours = isset($hours_data[$key]) ? $hours_data[$key] : 'TBD';
                ?>
                <div class="hours-row-group" data-day="<?php echo esc_attr($key); ?>">
                    <span class="day"><?php echo esc_html($day_name); ?></span>
                    <span class="time"><?php echo esc_html($day_hours); ?></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    echo ob_get_clean();
}

/**
 * Parse business hours string into array
 */
function ynm_parse_business_hours($hours_string) {
    $hours = array();
    
    if (empty($hours_string)) {
        return $hours;
    }
    
    // Common formats: "Mo-Fr 09:00-17:00", "Monday 9:00 AM - 5:00 PM", etc.
    $lines = explode("\n", $hours_string);
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) {
            continue;
        }
        
        // Try to parse day and time
        if (preg_match('/([A-Za-z]+)[\s\-]+(.+)/', $line, $matches)) {
            $day = strtolower(substr($matches[1], 0, 3));
            $time = trim($matches[2]);
            
            // Map day abbreviations
            $day_map = array(
                'mon' => 'monday',
                'tue' => 'tuesday',
                'wed' => 'wednesday',
                'thu' => 'thursday',
                'fri' => 'friday',
                'sat' => 'saturday',
                'sun' => 'sunday'
            );
            
            if (isset($day_map[$day])) {
                $hours[$day_map[$day]] = $time;
            }
        }
    }
    
    return $hours;
}

/**
 * Shortcode for complete contact information
 * Usage: [ynm_complete_contact_info]
 */
function ynm_complete_contact_info_shortcode($atts) {
    ob_start();
    ynm_display_complete_contact_info();
    return ob_get_clean();
}
add_shortcode('ynm_complete_contact_info', 'ynm_complete_contact_info_shortcode');

/**
 * Shortcode for complete hours of operation
 * Usage: [ynm_complete_hours]
 */
function ynm_complete_hours_shortcode($atts) {
    ob_start();
    ynm_display_complete_hours();
    return ob_get_clean();
}
add_shortcode('ynm_complete_hours', 'ynm_complete_hours_shortcode');

