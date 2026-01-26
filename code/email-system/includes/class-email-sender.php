<?php
/**
 * Email Sender
 * Handles sending emails from the queue
 */

if (!defined('ABSPATH')) {
    exit;
}

class YNM_Email_Sender {

    /**
     * Default from settings
     */
    private $default_from_name = 'YogaNearMe';
    private $default_from_email = 'hello@yoganearme.info';

    /**
     * Process the email queue
     */
    public function process_queue($limit = 50) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_email_queue';

        // Get pending emails that are due
        $emails = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table
             WHERE status = 'pending'
             AND scheduled_at <= NOW()
             AND attempts < 3
             ORDER BY scheduled_at ASC
             LIMIT %d",
            $limit
        ));

        foreach ($emails as $email) {
            $this->process_email($email);
        }
    }

    /**
     * Process a single queued email
     */
    private function process_email($queue_item) {
        global $wpdb;
        $table = $wpdb->prefix . 'ynm_email_queue';

        $sequence = new YNM_Email_Sequence();

        // Check if conditions are still met
        if (!$sequence->should_send_email($queue_item->studio_id, $queue_item->email_key)) {
            // Mark as skipped
            $wpdb->update($table, array(
                'status' => 'skipped',
            ), array('id' => $queue_item->id));
            return;
        }

        // Get email config
        $config = $sequence->get_email_config($queue_item->email_key);
        if (!$config) {
            $wpdb->update($table, array(
                'status' => 'failed',
                'last_error' => 'Unknown email key: ' . $queue_item->email_key,
            ), array('id' => $queue_item->id));
            return;
        }

        // Build and send email
        $result = $this->send_email($queue_item, $config);

        if ($result) {
            // Mark as sent
            $wpdb->update($table, array(
                'status' => 'sent',
                'sent_at' => current_time('mysql'),
            ), array('id' => $queue_item->id));

            // Log the send
            $this->log_send($queue_item, $config);

            // Update studio state
            $state_table = $wpdb->prefix . 'ynm_studio_email_state';
            $wpdb->update($state_table, array(
                'last_email_sent' => $queue_item->email_key,
                'last_email_sent_at' => current_time('mysql'),
            ), array('studio_id' => $queue_item->studio_id));

        } else {
            // Mark failed attempt
            $wpdb->update($table, array(
                'attempts' => $queue_item->attempts + 1,
                'last_error' => 'Send failed',
            ), array('id' => $queue_item->id));
        }
    }

    /**
     * Send an email
     */
    private function send_email($queue_item, $config) {
        $templates = new YNM_Email_Templates();

        // Get studio data for personalization
        $studio_data = $this->get_studio_data($queue_item->studio_id);
        $studio_state = $this->get_studio_state($queue_item->studio_id);

        // Merge data for template
        $data = array_merge($studio_data, $studio_state, array(
            'studio_id' => $queue_item->studio_id,
            'email_key' => $queue_item->email_key,
        ));

        // Get personalized subject
        $subject = $this->personalize($config['subject'], $data);

        // Get email body
        $body = $templates->render($config['template'], $data);
        if (!$body) {
            return false;
        }

        // Set from address
        $from_name = isset($config['from_name']) ? $config['from_name'] : $this->default_from_name;
        $from_email = isset($config['from_email']) ? $config['from_email'] : $this->default_from_email;

        // Build headers
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $from_email,
        );

        // Add tracking pixel
        $tracking_token = $this->generate_tracking_token($queue_item->id);
        $tracking_pixel = '<img src="' . rest_url('yoganearme/v1/emails/track/open?token=' . $tracking_token) . '" width="1" height="1" />';
        $body = str_replace('</body>', $tracking_pixel . '</body>', $body);

        // Send via wp_mail
        return wp_mail($queue_item->recipient_email, $subject, $body, $headers);
    }

    /**
     * Personalize text with data
     */
    private function personalize($text, $data) {
        $replacements = array(
            '{studio_name}' => $data['name'] ?? '',
            '{city}' => $data['city'] ?? '',
            '{state}' => $data['state'] ?? '',
            '{completion_percent}' => $data['profile_completion'] ?? '0',
            '{intro_offer}' => $data['intro_offer'] ?? '',
            '{month}' => date('F'),
            '{views}' => $data['listing_views'] ?? '0',
            '{clicks}' => $data['profile_clicks'] ?? '0',
            '{offer_clicks}' => $data['offer_clicks'] ?? '0',
        );

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }

    /**
     * Log email send
     */
    private function log_send($queue_item, $config) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_email_log';
        $wpdb->insert($table, array(
            'studio_id' => $queue_item->studio_id,
            'email_key' => $queue_item->email_key,
            'recipient_email' => $queue_item->recipient_email,
            'subject' => $config['subject'],
            'sent_at' => current_time('mysql'),
        ));
    }

    /**
     * Generate tracking token
     */
    private function generate_tracking_token($queue_id) {
        // In production, use proper encryption
        return base64_encode($queue_id);
    }

    /**
     * Get studio data
     */
    private function get_studio_data($studio_id) {
        $post = get_post($studio_id);
        if (!$post) {
            return array();
        }

        return array(
            'id' => $studio_id,
            'name' => $post->post_title,
            'email' => get_post_meta($studio_id, 'geodir_email', true),
            'city' => get_post_meta($studio_id, 'geodir_city', true),
            'state' => get_post_meta($studio_id, 'geodir_region', true),
            'intro_offer' => get_post_meta($studio_id, 'geodir_intro_offer', true),
            'listing_url' => get_permalink($studio_id),
            'edit_url' => home_url('/edit-listing/?id=' . $studio_id),
            'dashboard_url' => home_url('/studio-dashboard/'),
        );
    }

    /**
     * Get studio state
     */
    private function get_studio_state($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $state = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE studio_id = %d",
            $studio_id
        ), ARRAY_A);

        return $state ?: array();
    }

    /**
     * Send immediate email (not queued)
     */
    public function send_immediate($studio_id, $email_key) {
        $sequence = new YNM_Email_Sequence();
        $config = $sequence->get_email_config($email_key);

        if (!$config) {
            return false;
        }

        $studio_data = $this->get_studio_data($studio_id);
        if (empty($studio_data['email'])) {
            return false;
        }

        $queue_item = (object) array(
            'id' => 0,
            'studio_id' => $studio_id,
            'email_key' => $email_key,
            'recipient_email' => $studio_data['email'],
        );

        return $this->send_email($queue_item, $config);
    }
}
