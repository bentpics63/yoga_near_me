<?php
/**
 * YogaNearMe - Hide Placeholder Emails
 *
 * PURPOSE: Prevents displaying "info@yoganearme.info" placeholder emails
 * that were used during data import. Shows "TBD" or hides the field entirely.
 *
 * INSTALLATION:
 * 1. Add the helper function to your child theme's functions.php
 * 2. Update your contact template to use the new check
 *
 * @package YogaNearMe
 * @since 1.0.0
 */

// ============================================
// OPTION 1: HELPER FUNCTION (Recommended)
// Add this to your functions.php
// ============================================

/**
 * Check if email is valid (not empty and not a placeholder)
 *
 * @param string $email The email to check
 * @return bool True if email is valid for display
 */
function ynm_is_valid_email($email) {
    // List of placeholder emails to hide
    $placeholder_emails = array(
        'info@yoganearme.info',
        'contact@yoganearme.info',
        'hello@yoganearme.info',
        'email@example.com',
        'test@test.com',
    );

    // Return false if empty or matches a placeholder
    if (empty($email)) {
        return false;
    }

    // Normalize and check against placeholders
    $email_lower = strtolower(trim($email));

    foreach ($placeholder_emails as $placeholder) {
        if ($email_lower === strtolower($placeholder)) {
            return false;
        }
    }

    return true;
}

/**
 * Get email for display - returns empty string if placeholder
 *
 * @param int $post_id The GeoDirectory post ID
 * @return string The email or empty string
 */
function ynm_get_display_email($post_id) {
    $email = geodir_get_post_meta($post_id, 'geodir_email', true);

    if (empty($email)) {
        $email = get_post_meta($post_id, 'geodir_email', true);
    }

    return ynm_is_valid_email($email) ? $email : '';
}


// ============================================
// OPTION 2: SHORTCODE FOR ELEMENTOR
// Use [ynm_studio_email] in your template
// ============================================

/**
 * Shortcode to display studio email (hides placeholders)
 * Returns the full email link or nothing
 *
 * Usage: [ynm_studio_email]
 * Usage with fallback: [ynm_studio_email fallback="Contact via website"]
 */
function ynm_studio_email_shortcode($atts) {
    $atts = shortcode_atts(array(
        'fallback' => '', // Optional fallback text (empty = hide completely)
        'show_label' => 'false', // Set to 'true' to include "EMAIL" label
    ), $atts);

    global $post;

    if (!isset($post) || !isset($post->ID)) {
        return $atts['fallback'];
    }

    $email = ynm_get_display_email($post->ID);

    if (empty($email)) {
        return $atts['fallback'];
    }

    $output = '';

    if ($atts['show_label'] === 'true') {
        $output .= '<span class="contact-label">EMAIL</span> ';
    }

    $output .= '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';

    return $output;
}
add_shortcode('ynm_studio_email', 'ynm_studio_email_shortcode');


// ============================================
// OPTION 3: COMPLETE EMAIL CONTACT ITEM
// Use [ynm_email_contact_item] for full styled block
// ============================================

/**
 * Shortcode for complete email contact item with icon
 * Hides entire block if email is placeholder
 *
 * Usage: [ynm_email_contact_item]
 */
function ynm_email_contact_item_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show_tbd' => 'false', // Set to 'true' to show "TBD" instead of hiding
    ), $atts);

    global $post;

    if (!isset($post) || !isset($post->ID)) {
        return '';
    }

    $email = ynm_get_display_email($post->ID);

    // If no valid email and we don't want to show TBD, return nothing
    if (empty($email) && $atts['show_tbd'] !== 'true') {
        return '';
    }

    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode('ynm_email_contact_item', 'ynm_email_contact_item_shortcode');


// ============================================
// HOW TO UPDATE EXISTING TEMPLATE
// ============================================

/**
 * In your COMPLETE-SECTION-TEMPLATES.php, change line 100 from:
 *
 * OLD CODE:
 * <?php if (!empty($email)): ?>
 *
 * NEW CODE:
 * <?php if (ynm_is_valid_email($email)): ?>
 *
 * This single change will hide placeholder emails throughout the template.
 */


// ============================================
// FILTER TO AUTO-HIDE IN GEODIRECTORY OUTPUT
// This hooks into GeoDirectory's output filter
// ============================================

/**
 * Filter GeoDirectory email field output
 * Replaces placeholder emails with empty string
 */
function ynm_filter_geodir_email_output($output, $cf, $output_type) {
    // Only filter email fields
    if (!isset($cf['htmlvar_name']) || $cf['htmlvar_name'] !== 'geodir_email') {
        return $output;
    }

    // Check if the output contains a placeholder email
    $placeholder_emails = array(
        'info@yoganearme.info',
        'contact@yoganearme.info',
    );

    foreach ($placeholder_emails as $placeholder) {
        if (stripos($output, $placeholder) !== false) {
            return ''; // Return empty to hide the field
        }
    }

    return $output;
}
add_filter('geodir_custom_field_output_email', 'ynm_filter_geodir_email_output', 10, 3);


// ============================================
// CLEANUP: BULK UPDATE PLACEHOLDER EMAILS
// Run once via WP-CLI or temporarily in functions.php
// ============================================

/**
 * One-time cleanup: Set placeholder emails to empty
 * CAUTION: Run this only once, then remove the code
 *
 * To run: Add to functions.php, load any admin page, then remove
 *
 * Uncomment the add_action line to run:
 */
function ynm_cleanup_placeholder_emails() {
    // Safety check - only run for admins
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check if already run
    if (get_option('ynm_placeholder_emails_cleaned')) {
        return;
    }

    global $wpdb;

    $placeholder_emails = array(
        'info@yoganearme.info',
        'contact@yoganearme.info',
    );

    $updated = 0;

    foreach ($placeholder_emails as $placeholder) {
        // Update GeoDirectory meta
        $result = $wpdb->query($wpdb->prepare(
            "UPDATE {$wpdb->postmeta}
             SET meta_value = ''
             WHERE meta_key IN ('geodir_email', 'email')
             AND meta_value = %s",
            $placeholder
        ));

        $updated += $result;
    }

    // Mark as complete
    update_option('ynm_placeholder_emails_cleaned', true);

    // Log result
    error_log("YogaNearMe: Cleaned {$updated} placeholder emails");
}
// Uncomment next line to run cleanup (then comment it out again):
// add_action('admin_init', 'ynm_cleanup_placeholder_emails');
