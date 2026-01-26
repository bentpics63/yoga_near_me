<?php
/**
 * Email Tracker
 * Tracks email engagement and manages studio email state
 */

if (!defined('ABSPATH')) {
    exit;
}

class YNM_Email_Tracker {

    /**
     * Update studio email state
     */
    public function update_studio_state($studio_id, $changes) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';

        // Build update data
        $update_data = array();

        if (isset($changes['profile_completion'])) {
            $update_data['profile_completion'] = intval($changes['profile_completion']);
        }

        if (isset($changes['has_photos'])) {
            $update_data['has_photos'] = $changes['has_photos'] ? 1 : 0;
        }

        if (isset($changes['has_intro_offer'])) {
            $update_data['has_intro_offer'] = $changes['has_intro_offer'] ? 1 : 0;
        }

        if (isset($changes['last_login'])) {
            $update_data['last_login'] = $changes['last_login'];
        }

        if (empty($update_data)) {
            return;
        }

        // Check if record exists
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT studio_id FROM $table WHERE studio_id = %d",
            $studio_id
        ));

        if ($exists) {
            $wpdb->update($table, $update_data, array('studio_id' => $studio_id));
        } else {
            $update_data['studio_id'] = $studio_id;
            $wpdb->insert($table, $update_data);
        }
    }

    /**
     * Get studio state
     */
    public function get_studio_state($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $state = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table WHERE studio_id = %d",
            $studio_id
        ), ARRAY_A);

        return $state ?: array(
            'studio_id' => $studio_id,
            'profile_completion' => 0,
            'has_photos' => false,
            'has_intro_offer' => false,
            'last_login' => null,
            'first_offer_click_at' => null,
            'profile_complete_email_sent' => false,
            'unsubscribed_tips' => false,
            'unsubscribed_stats' => false,
            'unsubscribed_all' => false,
        );
    }

    /**
     * Record first offer click
     */
    public function record_first_offer_click($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $wpdb->update($table, array(
            'first_offer_click_at' => current_time('mysql'),
        ), array('studio_id' => $studio_id));
    }

    /**
     * Mark profile complete email as sent
     */
    public function mark_profile_complete_sent($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $wpdb->update($table, array(
            'profile_complete_email_sent' => 1,
        ), array('studio_id' => $studio_id));
    }

    /**
     * Record email open
     */
    public function record_open($log_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_email_log';
        $wpdb->update($table, array(
            'opened_at' => current_time('mysql'),
        ), array(
            'id' => $log_id,
            'opened_at' => null, // Only update if not already opened
        ));
    }

    /**
     * Record email click
     */
    public function record_click($log_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_email_log';
        $wpdb->update($table, array(
            'clicked_at' => current_time('mysql'),
        ), array('id' => $log_id));
    }

    /**
     * Update email preferences
     */
    public function update_preferences($studio_id, $preferences) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';
        $update_data = array();

        if (isset($preferences['tips'])) {
            $update_data['unsubscribed_tips'] = $preferences['tips'] ? 0 : 1;
        }

        if (isset($preferences['stats'])) {
            $update_data['unsubscribed_stats'] = $preferences['stats'] ? 0 : 1;
        }

        if (!empty($update_data)) {
            $wpdb->update($table, $update_data, array('studio_id' => $studio_id));
        }
    }

    /**
     * Unsubscribe from email type
     */
    public function unsubscribe($studio_id, $type) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_studio_email_state';

        switch ($type) {
            case 'tips':
                $wpdb->update($table, array('unsubscribed_tips' => 1), array('studio_id' => $studio_id));
                break;
            case 'stats':
                $wpdb->update($table, array('unsubscribed_stats' => 1), array('studio_id' => $studio_id));
                break;
            case 'all':
                $wpdb->update($table, array('unsubscribed_all' => 1), array('studio_id' => $studio_id));
                break;
        }

        // Also cancel any pending emails
        if ($type === 'all') {
            $queue_table = $wpdb->prefix . 'ynm_email_queue';
            $wpdb->update($queue_table, array(
                'status' => 'cancelled',
            ), array(
                'studio_id' => $studio_id,
                'status' => 'pending',
            ));
        }
    }

    /**
     * Get email stats for a studio
     */
    public function get_email_stats($studio_id) {
        global $wpdb;

        $table = $wpdb->prefix . 'ynm_email_log';

        $stats = array(
            'total_sent' => 0,
            'total_opened' => 0,
            'total_clicked' => 0,
            'open_rate' => 0,
            'click_rate' => 0,
            'emails' => array(),
        );

        // Get counts
        $stats['total_sent'] = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE studio_id = %d",
            $studio_id
        ));

        $stats['total_opened'] = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE studio_id = %d AND opened_at IS NOT NULL",
            $studio_id
        ));

        $stats['total_clicked'] = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE studio_id = %d AND clicked_at IS NOT NULL",
            $studio_id
        ));

        // Calculate rates
        if ($stats['total_sent'] > 0) {
            $stats['open_rate'] = round(($stats['total_opened'] / $stats['total_sent']) * 100, 1);
            $stats['click_rate'] = round(($stats['total_clicked'] / $stats['total_sent']) * 100, 1);
        }

        // Get recent emails
        $stats['emails'] = $wpdb->get_results($wpdb->prepare(
            "SELECT email_key, subject, sent_at, opened_at, clicked_at
             FROM $table
             WHERE studio_id = %d
             ORDER BY sent_at DESC
             LIMIT 10",
            $studio_id
        ), ARRAY_A);

        return $stats;
    }

    /**
     * Get listing performance stats
     */
    public function get_listing_stats($studio_id, $month = null) {
        // This would integrate with your analytics system
        // For now, return placeholder data structure

        if ($month === null) {
            $month = date('Y-m');
        }

        $prev_month = date('Y-m', strtotime($month . '-01 -1 month'));

        // In production, query your analytics tables
        return array(
            'current' => array(
                'month' => $month,
                'listing_views' => 0,
                'profile_clicks' => 0,
                'offer_clicks' => 0,
            ),
            'previous' => array(
                'month' => $prev_month,
                'listing_views' => 0,
                'profile_clicks' => 0,
                'offer_clicks' => 0,
            ),
            'trend' => array(
                'listing_views' => 0,
                'profile_clicks' => 0,
                'offer_clicks' => 0,
            ),
        );
    }
}
