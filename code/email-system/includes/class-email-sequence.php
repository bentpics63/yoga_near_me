<?php
/**
 * Email Sequence Handler
 * Manages the onboarding email sequence logic
 */

if (!defined('ABSPATH')) {
    exit;
}

class YNM_Email_Sequence {

    /**
     * Sequence configuration
     * Defines all emails, timing, and conditions
     */
    private $sequence = array(
        // Onboarding sequence
        'welcome' => array(
            'name'     => 'Welcome',
            'delay'    => 0, // Immediate
            'template' => 'welcome',
            'subject'  => "You're live on YogaNearMe",
            'preview'  => 'Students in {city} can now find you.',
            'conditions' => array(),
            'skip_if' => array(),
        ),
        'photo_nudge' => array(
            'name'     => 'Photo Nudge',
            'delay'    => 2, // Day 2
            'template' => 'photo-nudge',
            'subject'  => 'The one thing that gets students to click',
            'preview'  => "It's not your schedule or your prices.",
            'conditions' => array(
                'has_photos' => false,
                'profile_completion' => array('operator' => '<', 'value' => 70),
            ),
            'skip_if' => array('has_photos'),
        ),
        'intro_offer' => array(
            'name'     => 'Intro Offer',
            'delay'    => 5, // Day 5
            'template' => 'intro-offer',
            'subject'  => 'Why students leave without booking',
            'preview'  => 'The hesitation happens at the same moment every time.',
            'conditions' => array(
                'has_intro_offer' => false,
            ),
            'skip_if' => array('has_intro_offer'),
        ),
        'first_student' => array(
            'name'     => 'First Student',
            'delay'    => 10, // Day 10
            'template' => 'first-student',
            'subject'  => '"I found them on YogaNearMe"',
            'preview'  => "What we're hearing from studios.",
            'conditions' => array(),
            'skip_if' => array(),
        ),
        'hows_it_going' => array(
            'name'     => "How's It Going",
            'delay'    => 21, // Day 21
            'template' => 'hows-it-going',
            'subject'  => 'Quick question',
            'preview'  => "How's your listing working?",
            'conditions' => array(),
            'skip_if' => array(),
            'from_name' => 'Eddie',
            'from_email' => 'eddie@yoganearme.info',
        ),
        'wake_up' => array(
            'name'     => 'Wake Up',
            'delay'    => 45, // Day 45
            'template' => 'wake-up',
            'subject'  => 'Still there?',
            'preview'  => 'Your listing is live but incomplete.',
            'conditions' => array(
                'profile_completion' => array('operator' => '<', 'value' => 70),
                'days_since_login' => array('operator' => '>', 'value' => 30),
            ),
            'skip_if' => array('profile_completion_70'),
            'from_name' => 'Eddie',
            'from_email' => 'eddie@yoganearme.info',
        ),
    );

    /**
     * Triggered emails (not part of timed sequence)
     */
    private $triggered = array(
        'first_offer_click' => array(
            'name'     => 'First Offer Click',
            'template' => 'first-offer-click',
            'subject'  => 'Someone just clicked your intro offer',
            'preview'  => 'A student in {city} is interested.',
            'max_delay' => 1, // Within 1 hour
        ),
        'profile_complete' => array(
            'name'     => 'Profile Complete',
            'template' => 'profile-complete',
            'subject'  => 'Your profile is complete',
            'preview'  => "You're now in the top 20% of studios on YogaNearMe.",
        ),
        'monthly_stats' => array(
            'name'     => 'Monthly Stats',
            'template' => 'monthly-stats',
            'subject'  => 'Your YogaNearMe stats for {month}',
            'preview'  => '{views} students viewed your listing.',
            'schedule' => 'monthly_first', // 1st of each month
        ),
    );

    /**
     * Start the onboarding sequence for a studio
     */
    public function start_sequence($studio_id) {
        global $wpdb;

        // Initialize studio email state
        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $wpdb->replace($table, array(
            'studio_id' => $studio_id,
            'sequence_started_at' => current_time('mysql'),
            'profile_completion' => $this->calculate_profile_completion($studio_id),
            'has_photos' => $this->studio_has_photos($studio_id) ? 1 : 0,
            'has_intro_offer' => $this->studio_has_intro_offer($studio_id) ? 1 : 0,
        ));

        // Queue the welcome email immediately
        $this->queue_email($studio_id, 'welcome', 0);

        // Schedule remaining sequence emails
        foreach ($this->sequence as $key => $email) {
            if ($key === 'welcome') continue;

            $this->queue_email($studio_id, $key, $email['delay'] * DAY_IN_SECONDS);
        }
    }

    /**
     * Queue a single email
     */
    public function queue_email($studio_id, $email_key, $delay_seconds = 0) {
        global $wpdb;

        $studio = $this->get_studio_data($studio_id);
        if (!$studio || empty($studio['email'])) {
            return false;
        }

        $scheduled_at = date('Y-m-d H:i:s', time() + $delay_seconds);

        $table = $wpdb->prefix . 'ynm_email_queue';
        return $wpdb->insert($table, array(
            'studio_id' => $studio_id,
            'email_key' => $email_key,
            'recipient_email' => $studio['email'],
            'scheduled_at' => $scheduled_at,
            'status' => 'pending',
        ));
    }

    /**
     * Check if an email should be sent (conditions met)
     */
    public function should_send_email($studio_id, $email_key) {
        $email = isset($this->sequence[$email_key])
            ? $this->sequence[$email_key]
            : (isset($this->triggered[$email_key]) ? $this->triggered[$email_key] : null);

        if (!$email) {
            return false;
        }

        $state = $this->get_studio_state($studio_id);

        // Check skip conditions
        if (!empty($email['skip_if'])) {
            foreach ($email['skip_if'] as $condition) {
                if ($this->check_skip_condition($condition, $state)) {
                    return false;
                }
            }
        }

        // Check required conditions
        if (!empty($email['conditions'])) {
            foreach ($email['conditions'] as $field => $condition) {
                if (!$this->check_condition($field, $condition, $state)) {
                    return false;
                }
            }
        }

        // Check suppression rules
        if ($this->should_suppress($studio_id, $email_key)) {
            return false;
        }

        return true;
    }

    /**
     * Check a skip condition
     */
    private function check_skip_condition($condition, $state) {
        switch ($condition) {
            case 'has_photos':
                return !empty($state['has_photos']);
            case 'has_intro_offer':
                return !empty($state['has_intro_offer']);
            case 'profile_completion_70':
                return $state['profile_completion'] >= 70;
            case 'profile_completion_100':
                return $state['profile_completion'] >= 100;
            default:
                return false;
        }
    }

    /**
     * Check a required condition
     */
    private function check_condition($field, $condition, $state) {
        $value = isset($state[$field]) ? $state[$field] : null;

        if (is_array($condition)) {
            $operator = $condition['operator'];
            $compare = $condition['value'];

            switch ($operator) {
                case '<':
                    return $value < $compare;
                case '>':
                    return $value > $compare;
                case '<=':
                    return $value <= $compare;
                case '>=':
                    return $value >= $compare;
                case '==':
                    return $value == $compare;
                case '!=':
                    return $value != $compare;
            }
        } else {
            // Boolean check
            return $value == $condition;
        }

        return true;
    }

    /**
     * Check suppression rules
     */
    private function should_suppress($studio_id, $email_key) {
        global $wpdb;

        $state = $this->get_studio_state($studio_id);

        // Check unsubscribe status
        if (!empty($state['unsubscribed_all'])) {
            return true;
        }

        // Tips emails
        $tip_emails = array('photo_nudge', 'intro_offer', 'wake_up');
        if (in_array($email_key, $tip_emails) && !empty($state['unsubscribed_tips'])) {
            return true;
        }

        // Stats emails
        if ($email_key === 'monthly_stats' && !empty($state['unsubscribed_stats'])) {
            return true;
        }

        // Never send more than 1 email per 48 hours
        $table = $wpdb->prefix . 'ynm_email_log';
        $recent = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE studio_id = %d AND sent_at > DATE_SUB(NOW(), INTERVAL 48 HOUR)",
            $studio_id
        ));
        if ($recent > 0) {
            return true;
        }

        // Skip nurture emails if studio logged in within 24 hours
        $nurture_emails = array('photo_nudge', 'intro_offer', 'hows_it_going', 'wake_up');
        if (in_array($email_key, $nurture_emails)) {
            $last_login = strtotime($state['last_login']);
            if ($last_login && (time() - $last_login) < DAY_IN_SECONDS) {
                return true;
            }
        }

        // Stop sequence if profile is 100% complete
        $sequence_emails = array('photo_nudge', 'intro_offer', 'wake_up');
        if (in_array($email_key, $sequence_emails) && $state['profile_completion'] >= 100) {
            return true;
        }

        return false;
    }

    /**
     * Check for triggered emails that need to be sent
     */
    public function check_triggers() {
        // Monthly stats - 1st of month
        if (date('j') === '1') {
            $this->queue_monthly_stats();
        }
    }

    /**
     * Queue monthly stats emails
     */
    private function queue_monthly_stats() {
        global $wpdb;

        // Get all studios active for 30+ days
        $state_table = $wpdb->prefix . 'ynm_studio_email_state';
        $studios = $wpdb->get_col($wpdb->prepare(
            "SELECT studio_id FROM $state_table
             WHERE sequence_started_at < DATE_SUB(NOW(), INTERVAL 30 DAY)
             AND unsubscribed_stats = 0
             AND unsubscribed_all = 0"
        ));

        foreach ($studios as $studio_id) {
            $this->queue_email($studio_id, 'monthly_stats', 0);
        }
    }

    /**
     * Get email configuration
     */
    public function get_email_config($email_key) {
        if (isset($this->sequence[$email_key])) {
            return $this->sequence[$email_key];
        }
        if (isset($this->triggered[$email_key])) {
            return $this->triggered[$email_key];
        }
        return null;
    }

    /**
     * Get studio data
     */
    private function get_studio_data($studio_id) {
        $post = get_post($studio_id);
        if (!$post) {
            return null;
        }

        return array(
            'id' => $studio_id,
            'name' => $post->post_title,
            'email' => get_post_meta($studio_id, 'geodir_email', true),
            'city' => get_post_meta($studio_id, 'geodir_city', true),
            'state' => get_post_meta($studio_id, 'geodir_region', true),
            'intro_offer' => get_post_meta($studio_id, 'geodir_intro_offer', true),
        );
    }

    /**
     * Get studio email state
     */
    private function get_studio_state($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $state = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE studio_id = %d",
            $studio_id
        ), ARRAY_A);

        if (!$state) {
            return array(
                'profile_completion' => 0,
                'has_photos' => false,
                'has_intro_offer' => false,
                'last_login' => null,
                'unsubscribed_tips' => false,
                'unsubscribed_stats' => false,
                'unsubscribed_all' => false,
            );
        }

        // Calculate days since login
        if (!empty($state['last_login'])) {
            $state['days_since_login'] = floor((time() - strtotime($state['last_login'])) / DAY_IN_SECONDS);
        } else {
            $state['days_since_login'] = 999;
        }

        return $state;
    }

    /**
     * Calculate profile completion percentage
     */
    private function calculate_profile_completion($studio_id) {
        $fields = array(
            'post_title' => 10,        // Studio name
            'geodir_street' => 10,     // Address
            'geodir_email' => 10,      // Email
            'geodir_business_hours' => 10, // Hours
            'geodir_primary_style' => 10,  // Primary style
            'geodir_vibe_tags' => 10,  // Vibe tags
            'geodir_intro_offer' => 15, // Intro offer (weighted higher)
            'geodir_why_students_love' => 10, // Why students love
            '_thumbnail_id' => 15,     // Photo (weighted higher)
        );

        $completion = 0;
        $post = get_post($studio_id);

        if ($post && !empty($post->post_title)) {
            $completion += $fields['post_title'];
        }

        foreach ($fields as $field => $weight) {
            if ($field === 'post_title') continue;

            if ($field === '_thumbnail_id') {
                if (has_post_thumbnail($studio_id)) {
                    $completion += $weight;
                }
            } else {
                $value = get_post_meta($studio_id, $field, true);
                if (!empty($value)) {
                    $completion += $weight;
                }
            }
        }

        return min(100, $completion);
    }

    /**
     * Check if studio has photos
     */
    private function studio_has_photos($studio_id) {
        return has_post_thumbnail($studio_id) ||
               !empty(get_post_meta($studio_id, 'geodir_post_images', true));
    }

    /**
     * Check if studio has intro offer
     */
    private function studio_has_intro_offer($studio_id) {
        $offer = get_post_meta($studio_id, 'geodir_intro_offer', true);
        return !empty($offer);
    }
}
