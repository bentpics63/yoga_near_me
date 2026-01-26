<?php
/**
 * Plugin Name: YogaNearMe Studio Emails
 * Description: Automated email sequences for studio onboarding and engagement
 * Version: 1.0.0
 * Author: YogaNearMe
 * Text Domain: ynm-emails
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Plugin constants
define('YNM_EMAILS_VERSION', '1.0.0');
define('YNM_EMAILS_PATH', plugin_dir_path(__FILE__));
define('YNM_EMAILS_URL', plugin_dir_url(__FILE__));

/**
 * Main Plugin Class
 */
class YNM_Studio_Emails {

    /**
     * Instance
     */
    private static $instance = null;

    /**
     * Get instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Include required files
     */
    private function includes() {
        require_once YNM_EMAILS_PATH . 'includes/class-email-sequence.php';
        require_once YNM_EMAILS_PATH . 'includes/class-email-templates.php';
        require_once YNM_EMAILS_PATH . 'includes/class-email-sender.php';
        require_once YNM_EMAILS_PATH . 'includes/class-email-tracker.php';
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Activation/Deactivation
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Initialize components
        add_action('init', array($this, 'init'));

        // Schedule cron events
        add_action('ynm_process_email_queue', array($this, 'process_email_queue'));
        add_action('ynm_check_triggered_emails', array($this, 'check_triggered_emails'));

        // Studio events that trigger emails
        add_action('geodir_post_published', array($this, 'on_studio_created'), 10, 2);
        add_action('ynm_studio_claimed', array($this, 'on_studio_claimed'), 10, 2);
        add_action('ynm_profile_updated', array($this, 'on_profile_updated'), 10, 2);
        add_action('ynm_offer_clicked', array($this, 'on_offer_clicked'), 10, 2);

        // REST API endpoints
        add_action('rest_api_init', array($this, 'register_rest_routes'));
    }

    /**
     * Plugin activation
     */
    public function activate() {
        $this->create_tables();
        $this->schedule_cron_events();
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     */
    public function deactivate() {
        $this->unschedule_cron_events();
    }

    /**
     * Initialize
     */
    public function init() {
        // Load text domain
        load_plugin_textdomain('ynm-emails', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Create database tables
     */
    private function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        // Email queue table
        $table_queue = $wpdb->prefix . 'ynm_email_queue';
        $sql_queue = "CREATE TABLE IF NOT EXISTS $table_queue (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            studio_id bigint(20) NOT NULL,
            email_key varchar(50) NOT NULL,
            recipient_email varchar(255) NOT NULL,
            scheduled_at datetime NOT NULL,
            sent_at datetime DEFAULT NULL,
            status varchar(20) DEFAULT 'pending',
            attempts int(11) DEFAULT 0,
            last_error text DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY studio_id (studio_id),
            KEY email_key (email_key),
            KEY status (status),
            KEY scheduled_at (scheduled_at)
        ) $charset_collate;";

        // Email log table
        $table_log = $wpdb->prefix . 'ynm_email_log';
        $sql_log = "CREATE TABLE IF NOT EXISTS $table_log (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            studio_id bigint(20) NOT NULL,
            email_key varchar(50) NOT NULL,
            recipient_email varchar(255) NOT NULL,
            subject varchar(255) NOT NULL,
            sent_at datetime DEFAULT CURRENT_TIMESTAMP,
            opened_at datetime DEFAULT NULL,
            clicked_at datetime DEFAULT NULL,
            PRIMARY KEY (id),
            KEY studio_id (studio_id),
            KEY email_key (email_key)
        ) $charset_collate;";

        // Studio email state table
        $table_state = $wpdb->prefix . 'ynm_studio_email_state';
        $sql_state = "CREATE TABLE IF NOT EXISTS $table_state (
            studio_id bigint(20) NOT NULL,
            sequence_started_at datetime DEFAULT NULL,
            last_email_sent varchar(50) DEFAULT NULL,
            last_email_sent_at datetime DEFAULT NULL,
            last_login datetime DEFAULT NULL,
            profile_completion int(11) DEFAULT 0,
            has_photos tinyint(1) DEFAULT 0,
            has_intro_offer tinyint(1) DEFAULT 0,
            first_offer_click_at datetime DEFAULT NULL,
            profile_complete_email_sent tinyint(1) DEFAULT 0,
            unsubscribed_tips tinyint(1) DEFAULT 0,
            unsubscribed_stats tinyint(1) DEFAULT 0,
            unsubscribed_all tinyint(1) DEFAULT 0,
            PRIMARY KEY (studio_id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_queue);
        dbDelta($sql_log);
        dbDelta($sql_state);
    }

    /**
     * Schedule cron events
     */
    private function schedule_cron_events() {
        if (!wp_next_scheduled('ynm_process_email_queue')) {
            wp_schedule_event(time(), 'hourly', 'ynm_process_email_queue');
        }
        if (!wp_next_scheduled('ynm_check_triggered_emails')) {
            wp_schedule_event(time(), 'twicedaily', 'ynm_check_triggered_emails');
        }
    }

    /**
     * Unschedule cron events
     */
    private function unschedule_cron_events() {
        wp_clear_scheduled_hook('ynm_process_email_queue');
        wp_clear_scheduled_hook('ynm_check_triggered_emails');
    }

    /**
     * Process email queue
     */
    public function process_email_queue() {
        $sender = new YNM_Email_Sender();
        $sender->process_queue();
    }

    /**
     * Check for triggered emails
     */
    public function check_triggered_emails() {
        $sequence = new YNM_Email_Sequence();
        $sequence->check_triggers();
    }

    /**
     * Studio created event
     */
    public function on_studio_created($post_id, $post) {
        if (get_post_type($post_id) !== 'gd_place') {
            return;
        }

        $sequence = new YNM_Email_Sequence();
        $sequence->start_sequence($post_id);
    }

    /**
     * Studio claimed event
     */
    public function on_studio_claimed($studio_id, $user_id) {
        $sequence = new YNM_Email_Sequence();
        $sequence->start_sequence($studio_id);
    }

    /**
     * Profile updated event
     */
    public function on_profile_updated($studio_id, $changes) {
        $tracker = new YNM_Email_Tracker();
        $tracker->update_studio_state($studio_id, $changes);

        // Check if profile just hit 100%
        $state = $tracker->get_studio_state($studio_id);
        if ($state['profile_completion'] >= 100 && !$state['profile_complete_email_sent']) {
            $sequence = new YNM_Email_Sequence();
            $sequence->queue_email($studio_id, 'profile_complete');
            $tracker->mark_profile_complete_sent($studio_id);
        }
    }

    /**
     * Offer clicked event
     */
    public function on_offer_clicked($studio_id, $click_data) {
        $tracker = new YNM_Email_Tracker();
        $state = $tracker->get_studio_state($studio_id);

        // Only send on first click
        if (empty($state['first_offer_click_at'])) {
            $tracker->record_first_offer_click($studio_id);

            $sequence = new YNM_Email_Sequence();
            $sequence->queue_email($studio_id, 'first_offer_click', 1); // Send within 1 hour
        }
    }

    /**
     * Register REST API routes
     */
    public function register_rest_routes() {
        register_rest_route('yoganearme/v1', '/emails/preferences', array(
            'methods'  => 'POST',
            'callback' => array($this, 'update_email_preferences'),
            'permission_callback' => array($this, 'check_auth'),
        ));

        register_rest_route('yoganearme/v1', '/emails/unsubscribe', array(
            'methods'  => 'GET',
            'callback' => array($this, 'handle_unsubscribe'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('yoganearme/v1', '/emails/track/open', array(
            'methods'  => 'GET',
            'callback' => array($this, 'track_email_open'),
            'permission_callback' => '__return_true',
        ));
    }

    /**
     * Check authentication
     */
    public function check_auth($request) {
        return is_user_logged_in();
    }

    /**
     * Update email preferences
     */
    public function update_email_preferences($request) {
        $studio_id = $request->get_param('studio_id');
        $preferences = $request->get_param('preferences');

        $tracker = new YNM_Email_Tracker();
        $tracker->update_preferences($studio_id, $preferences);

        return new WP_REST_Response(array('success' => true), 200);
    }

    /**
     * Handle unsubscribe
     */
    public function handle_unsubscribe($request) {
        $token = $request->get_param('token');
        $type = $request->get_param('type');

        // Decode token to get studio_id
        $studio_id = $this->decode_unsubscribe_token($token);
        if (!$studio_id) {
            return new WP_REST_Response(array('error' => 'Invalid token'), 400);
        }

        $tracker = new YNM_Email_Tracker();
        $tracker->unsubscribe($studio_id, $type);

        // Redirect to confirmation page
        wp_redirect(home_url('/email-preferences/?unsubscribed=' . $type));
        exit;
    }

    /**
     * Track email open
     */
    public function track_email_open($request) {
        $token = $request->get_param('token');

        // Decode token to get log_id
        $log_id = $this->decode_tracking_token($token);
        if ($log_id) {
            $tracker = new YNM_Email_Tracker();
            $tracker->record_open($log_id);
        }

        // Return 1x1 transparent GIF
        header('Content-Type: image/gif');
        echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
        exit;
    }

    /**
     * Decode unsubscribe token
     */
    private function decode_unsubscribe_token($token) {
        // In production, use proper encryption
        $decoded = base64_decode($token);
        $parts = explode(':', $decoded);
        return isset($parts[0]) ? intval($parts[0]) : false;
    }

    /**
     * Decode tracking token
     */
    private function decode_tracking_token($token) {
        $decoded = base64_decode($token);
        return intval($decoded);
    }
}

// Initialize plugin
function ynm_studio_emails() {
    return YNM_Studio_Emails::get_instance();
}
add_action('plugins_loaded', 'ynm_studio_emails');
