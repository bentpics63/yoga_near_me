# Studio Onboarding System - Installation Guide

Complete installation and integration guide for the YogaNearMe studio onboarding system.

**Built:** January 2026
**Components:** Studio Onboarding Form, Claim Listing Overlay, Email Sequence System

---

## Overview

This system enables yoga studios to:
1. **Onboard new studios** via a 5-section data collection form
2. **Claim existing listings** via a multi-step verification flow
3. **Receive automated emails** for engagement and profile completion

All components follow the YogaNearMe design system:
- Editorial magazine aesthetic (not SaaS dashboard)
- No-pressure, no dark patterns UX
- Mobile-first, thumb-friendly interactions
- Brand colors: Sage `#5F7470`, Teal `#61948B`, Rust `#bd371a`, Paper `#F8FAFA`

---

## File Structure

```
code/
├── onboarding/
│   ├── studio-onboarding-form.html    # Complete 5-section form
│   ├── studio-onboarding-form.css     # Form styles
│   ├── studio-onboarding-form.js      # Form behavior & validation
│   ├── claim-listing-overlay.html     # Multi-step claim flow
│   ├── claim-listing-overlay.css      # Overlay styles
│   └── claim-listing-overlay.js       # Overlay behavior
│
└── email-system/
    ├── ynm-studio-emails.php          # Main WordPress plugin
    ├── includes/
    │   ├── class-email-sequence.php   # Sequence timing & conditions
    │   ├── class-email-sender.php     # Queue processing
    │   ├── class-email-templates.php  # Template rendering
    │   └── class-email-tracker.php    # Open/click tracking
    └── templates/
        ├── _layout.html               # Base email layout
        ├── welcome.html               # Day 0: Welcome email
        ├── photo-nudge.html           # Day 2: Add photos reminder
        ├── intro-offer.html           # Day 5: Set intro offer
        ├── first-student.html         # Day 10: Social proof story
        ├── hows-it-going.html         # Day 21: Feedback request
        ├── wake-up.html               # Day 45: Re-engagement
        ├── first-offer-click.html     # Triggered: First click
        ├── profile-complete.html      # Triggered: 100% complete
        └── monthly-stats.html         # Triggered: Monthly summary
```

---

## Component 1: Studio Onboarding Form

### What It Does
A 5-section progressive form that collects studio information for GeoDirectory listings.

### Sections
1. **The Basics** - Studio name, website, social links, contact info
2. **Who You Are** - Yoga styles, class format, vibe, hours
3. **The Practical Stuff** - Drop-in policy, class size, new student info, parking
4. **What Makes You Different** - Intro offer, subtitle, why students love, signature offering
5. **Optional Details** - Established year, certifications, social links, photos

### Installation

1. **Create a WordPress page** for the form (e.g., `/list-your-studio/`)

2. **Enqueue the CSS and JS** in your theme's `functions.php`:
```php
function ynm_enqueue_onboarding_assets() {
    if (is_page('list-your-studio')) {
        wp_enqueue_style('ynm-onboarding',
            get_stylesheet_directory_uri() . '/assets/studio-onboarding-form.css',
            array(),
            '1.0.0'
        );
        wp_enqueue_script('ynm-onboarding',
            get_stylesheet_directory_uri() . '/assets/studio-onboarding-form.js',
            array(),
            '1.0.0',
            true
        );

        // Pass WordPress data to JS
        wp_localize_script('ynm-onboarding', 'ynmOnboarding', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'restUrl' => rest_url('yoganearme/v1/'),
            'nonce' => wp_create_nonce('wp_rest'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'ynm_enqueue_onboarding_assets');
```

3. **Add the HTML** to your page template or use a shortcode:
```php
function ynm_onboarding_form_shortcode() {
    ob_start();
    include get_stylesheet_directory() . '/templates/studio-onboarding-form.html';
    return ob_get_clean();
}
add_shortcode('ynm_onboarding_form', 'ynm_onboarding_form_shortcode');
```

4. **Connect to GeoDirectory** - Update `studio-onboarding-form.js` submission handler:
```javascript
// In handleSubmission() function
const response = await fetch('/wp-json/geodir/v2/places', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': ynmOnboarding.nonce
    },
    body: JSON.stringify(formData)
});
```

### Form Fields → GeoDirectory Mapping

| Form Field | GeoDirectory Field |
|------------|-------------------|
| `studio_name` | `post_title` |
| `website_url` | `website` |
| `phone` | `phone` |
| `email` | `email` |
| `yoga_styles[]` | `yoga_styles` (custom field) |
| `class_formats[]` | `class_formats` (custom field) |
| `vibes[]` | `studio_vibe` (custom field) |
| `hours` | `business_hours` |
| `intro_offer` | `intro_offer` (custom field) |
| `subtitle` | `tagline` (custom field) |
| `why_students_love` | `why_students_love` (custom field) |

---

## Component 2: Claim Listing Overlay

### What It Does
A modal flow that lets existing studio owners claim their listings with verification.

### Steps
1. **Choose verification method** - Email, phone, or document upload
2. **Enter contact information** - Email or phone to receive code
3. **Enter verification code** - 6-digit code sent to their email/phone
4. **Success** - Confirmation with next steps

### Installation

1. **Enqueue assets** (add to the existing function or create new):
```php
function ynm_enqueue_claim_assets() {
    // Only load on studio single pages or archive pages
    if (geodir_is_page('detail') || geodir_is_page('archive')) {
        wp_enqueue_style('ynm-claim-overlay',
            get_stylesheet_directory_uri() . '/assets/claim-listing-overlay.css'
        );
        wp_enqueue_script('ynm-claim-overlay',
            get_stylesheet_directory_uri() . '/assets/claim-listing-overlay.js',
            array(),
            '1.0.0',
            true
        );

        wp_localize_script('ynm-claim-overlay', 'ynmClaim', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'restUrl' => rest_url('yoganearme/v1/'),
            'nonce' => wp_create_nonce('wp_rest'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'ynm_enqueue_claim_assets');
```

2. **Add the overlay HTML** to your theme footer or via action hook:
```php
function ynm_add_claim_overlay() {
    if (geodir_is_page('detail') || geodir_is_page('archive')) {
        include get_stylesheet_directory() . '/templates/claim-listing-overlay.html';
    }
}
add_action('wp_footer', 'ynm_add_claim_overlay');
```

3. **Add trigger buttons** to your listing templates:
```html
<button class="claim-listing-trigger" data-studio-id="<?php echo get_the_ID(); ?>">
    Own this studio? Claim it
</button>
```

4. **Create backend endpoints** for verification:
```php
// Send verification code
add_action('wp_ajax_ynm_send_verification', 'ynm_send_verification_code');
add_action('wp_ajax_nopriv_ynm_send_verification', 'ynm_send_verification_code');

function ynm_send_verification_code() {
    $studio_id = intval($_POST['studio_id']);
    $method = sanitize_text_field($_POST['method']);
    $contact = sanitize_email($_POST['email']) ?: sanitize_text_field($_POST['phone']);

    // Generate 6-digit code
    $code = sprintf('%06d', mt_rand(0, 999999));

    // Store in transient (expires in 15 minutes)
    set_transient('ynm_verify_' . $studio_id, $code, 15 * MINUTE_IN_SECONDS);

    // Send via email or SMS
    if ($method === 'email') {
        wp_mail($contact, 'Your YogaNearMe Verification Code',
            'Your code is: ' . $code);
    }

    wp_send_json_success();
}

// Verify code
add_action('wp_ajax_ynm_verify_code', 'ynm_verify_claim_code');
add_action('wp_ajax_nopriv_ynm_verify_code', 'ynm_verify_claim_code');

function ynm_verify_claim_code() {
    $studio_id = intval($_POST['studio_id']);
    $submitted_code = sanitize_text_field($_POST['code']);

    $stored_code = get_transient('ynm_verify_' . $studio_id);

    if ($stored_code === $submitted_code) {
        // Mark studio as claimed
        update_post_meta($studio_id, 'claimed', true);
        update_post_meta($studio_id, 'claimed_by', get_current_user_id());
        update_post_meta($studio_id, 'claimed_at', current_time('mysql'));

        // Trigger claim action for email system
        do_action('ynm_studio_claimed', $studio_id, get_current_user_id());

        delete_transient('ynm_verify_' . $studio_id);
        wp_send_json_success();
    } else {
        wp_send_json_error('Invalid code');
    }
}
```

---

## Component 3: Email Sequence System

### What It Does
WordPress plugin that sends automated emails to studios based on timing and conditions.

### Email Sequence

| Email | Day | Condition |
|-------|-----|-----------|
| Welcome | 0 | Always |
| Photo Nudge | 2 | No photos uploaded |
| Intro Offer | 5 | No intro offer set |
| First Student | 10 | Always |
| How's It Going | 21 | Always |
| Wake Up | 45 | Profile < 70%, inactive 30+ days |

### Triggered Emails

| Email | Trigger |
|-------|---------|
| First Offer Click | Within 1 hour of first "Claim Offer" click |
| Profile Complete | When profile reaches 100% |
| Monthly Stats | 1st of each month |

### Installation

1. **Upload the plugin folder** to `/wp-content/plugins/`:
```bash
cp -r code/email-system /path/to/wordpress/wp-content/plugins/ynm-studio-emails
```

2. **Activate the plugin** in WordPress Admin → Plugins

3. **The plugin will automatically:**
   - Create database tables on activation
   - Schedule WP Cron jobs for queue processing
   - Hook into GeoDirectory events

### Database Tables Created

```sql
-- Email queue
wp_ynm_email_queue (
    id, studio_id, email_key, recipient_email,
    scheduled_at, sent_at, status, attempts, last_error
)

-- Email log (for tracking)
wp_ynm_email_log (
    id, studio_id, email_key, recipient_email,
    subject, sent_at, opened_at, clicked_at
)

-- Studio email state
wp_ynm_studio_email_state (
    studio_id, sequence_started_at, last_email_sent,
    profile_completion, has_photos, has_intro_offer,
    first_offer_click_at, unsubscribed_tips, unsubscribed_all
)
```

### Configuration

Edit `includes/class-email-sequence.php` to adjust timing:

```php
private $sequence = array(
    'welcome' => array(
        'delay' => 0,  // Days after signup
        'subject' => 'Welcome to YogaNearMe',
        // ...
    ),
    'photo_nudge' => array(
        'delay' => 2,
        'conditions' => array('has_photos' => false),
        // ...
    ),
    // ...
);
```

### Template Variables

Templates use `{{variable}}` syntax. Available variables:

| Variable | Description |
|----------|-------------|
| `{{studio_name}}` | Studio name |
| `{{owner_first_name}}` | Owner's first name |
| `{{city}}` | Studio city |
| `{{edit_url}}` | Link to edit profile |
| `{{listing_url}}` | Link to public listing |
| `{{dashboard_url}}` | Link to studio dashboard |
| `{{intro_offer}}` | Current intro offer text |
| `{{month}}` | Current month name |
| `{{listing_views}}` | This month's views |
| `{{profile_clicks}}` | This month's profile clicks |
| `{{unsubscribe_url}}` | Unsubscribe link |

### Conditional Blocks

```html
{{#if has_intro_offer}}
  Content shown if true
{{/if}}

{{#unless has_photos}}
  Content shown if false
{{/unless}}
```

---

## Integration Checklist

### Before Launch

- [ ] Upload all CSS/JS files to theme assets folder
- [ ] Create WordPress pages for onboarding flow
- [ ] Add shortcodes or template includes
- [ ] Install and activate email plugin
- [ ] Configure email sender (wp_mail or SMTP plugin)
- [ ] Test form submission → GeoDirectory
- [ ] Test claim flow → verification email
- [ ] Test email sequence timing

### GeoDirectory Custom Fields Required

Ensure these custom fields exist in GeoDirectory:

| Field Key | Field Type | Description |
|-----------|------------|-------------|
| `yoga_styles` | Multiselect | Yoga styles offered |
| `class_formats` | Multiselect | In-person, online, hybrid |
| `studio_vibe` | Multiselect | Studio atmosphere |
| `intro_offer` | Text | Introductory offer |
| `tagline` | Text | Studio tagline/subtitle |
| `why_students_love` | Textarea | What students love |
| `signature_offering` | Text | Unique offering |
| `drop_in_policy` | Select | Drop-in allowed? |
| `class_size` | Select | Typical class size |
| `new_student_info` | Textarea | First visit info |
| `parking_info` | Text | Parking details |
| `established_year` | Number | Year founded |
| `yoga_alliance` | Checkbox | YA registered |
| `student_sources` | Multiselect | How students find you |

---

## Customization

### Brand Colors

All components use CSS custom properties. Override in your theme:

```css
:root {
    --ynm-sage: #5F7470;
    --ynm-teal: #61948B;
    --ynm-rust: #bd371a;
    --ynm-paper: #F8FAFA;
    --ynm-text-dark: #2C3E3A;
    --ynm-text-medium: #6B7C78;
}
```

### Email Templates

Edit templates in `email-system/templates/`. Each template is inserted into `_layout.html`.

### Form Sections

To add/remove form sections, edit `studio-onboarding-form.html` and update the corresponding handlers in `studio-onboarding-form.js`.

---

## Troubleshooting

### Form not submitting
- Check browser console for JS errors
- Verify REST API is accessible (`/wp-json/`)
- Check GeoDirectory API permissions

### Claim verification not sending
- Check wp_mail is configured (use SMTP plugin for production)
- Verify transients are working (check object cache)

### Emails not sending
- Check WP Cron is running (`wp cron event list`)
- Review queue table for pending emails
- Check email log for errors

### Styling issues
- Ensure CSS is enqueued after theme styles
- Check for specificity conflicts
- Verify custom properties are defined

---

## Support

For issues with:
- **GeoDirectory integration** → GeoDirectory support
- **WordPress/hosting** → Hosting provider
- **This system** → Review code comments or rebuild components

---

*Last updated: January 2026*
