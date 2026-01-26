<?php
/**
 * Email Templates
 * Handles loading and rendering email templates
 */

if (!defined('ABSPATH')) {
    exit;
}

class YNM_Email_Templates {

    /**
     * Templates directory
     */
    private $templates_dir;

    /**
     * Constructor
     */
    public function __construct() {
        $this->templates_dir = YNM_EMAILS_PATH . 'templates/';
    }

    /**
     * Render a template with data
     */
    public function render($template_name, $data = array()) {
        $template_file = $this->templates_dir . $template_name . '.html';

        if (!file_exists($template_file)) {
            error_log('YNM Emails: Template not found: ' . $template_name);
            return false;
        }

        // Load template
        $html = file_get_contents($template_file);

        // Wrap in base layout
        $html = $this->wrap_in_layout($html, $data);

        // Replace variables
        $html = $this->replace_variables($html, $data);

        // Process conditionals
        $html = $this->process_conditionals($html, $data);

        return $html;
    }

    /**
     * Wrap content in base layout
     */
    private function wrap_in_layout($content, $data) {
        $layout_file = $this->templates_dir . '_layout.html';

        if (!file_exists($layout_file)) {
            return $content;
        }

        $layout = file_get_contents($layout_file);
        return str_replace('{{content}}', $content, $layout);
    }

    /**
     * Replace template variables
     */
    private function replace_variables($html, $data) {
        // Standard replacements
        $replacements = array(
            '{{studio_name}}' => esc_html($data['name'] ?? ''),
            '{{city}}' => esc_html($data['city'] ?? ''),
            '{{state}}' => esc_html($data['state'] ?? ''),
            '{{completion_percent}}' => intval($data['profile_completion'] ?? 0),
            '{{intro_offer}}' => esc_html($data['intro_offer'] ?? ''),
            '{{listing_url}}' => esc_url($data['listing_url'] ?? '#'),
            '{{edit_url}}' => esc_url($data['edit_url'] ?? '#'),
            '{{dashboard_url}}' => esc_url($data['dashboard_url'] ?? '#'),
            '{{month}}' => date('F'),
            '{{year}}' => date('Y'),
            '{{listing_views}}' => number_format(intval($data['listing_views'] ?? 0)),
            '{{profile_clicks}}' => number_format(intval($data['profile_clicks'] ?? 0)),
            '{{offer_clicks}}' => number_format(intval($data['offer_clicks'] ?? 0)),
            '{{nearby_city}}' => esc_html($this->get_nearby_major_city($data['state'] ?? '')),
        );

        // Generate unsubscribe links
        $studio_id = $data['studio_id'] ?? 0;
        $unsubscribe_token = base64_encode($studio_id . ':' . time());
        $replacements['{{unsubscribe_tips_url}}'] = rest_url('yoganearme/v1/emails/unsubscribe?token=' . $unsubscribe_token . '&type=tips');
        $replacements['{{unsubscribe_stats_url}}'] = rest_url('yoganearme/v1/emails/unsubscribe?token=' . $unsubscribe_token . '&type=stats');
        $replacements['{{unsubscribe_all_url}}'] = rest_url('yoganearme/v1/emails/unsubscribe?token=' . $unsubscribe_token . '&type=all');
        $replacements['{{preferences_url}}'] = home_url('/email-preferences/?token=' . $unsubscribe_token);

        return str_replace(array_keys($replacements), array_values($replacements), $html);
    }

    /**
     * Process conditional blocks
     * Syntax: {{#if condition}}content{{/if}}
     * Syntax: {{#unless condition}}content{{/unless}}
     */
    private function process_conditionals($html, $data) {
        // Process {{#if condition}}...{{/if}}
        $html = preg_replace_callback(
            '/\{\{#if\s+(\w+)\}\}(.*?)\{\{\/if\}\}/s',
            function($matches) use ($data) {
                $condition = $matches[1];
                $content = $matches[2];

                if ($this->evaluate_condition($condition, $data)) {
                    return $content;
                }
                return '';
            },
            $html
        );

        // Process {{#unless condition}}...{{/unless}}
        $html = preg_replace_callback(
            '/\{\{#unless\s+(\w+)\}\}(.*?)\{\{\/unless\}\}/s',
            function($matches) use ($data) {
                $condition = $matches[1];
                $content = $matches[2];

                if (!$this->evaluate_condition($condition, $data)) {
                    return $content;
                }
                return '';
            },
            $html
        );

        return $html;
    }

    /**
     * Evaluate a condition
     */
    private function evaluate_condition($condition, $data) {
        switch ($condition) {
            case 'has_intro_offer':
                return !empty($data['intro_offer']);
            case 'no_intro_offer':
                return empty($data['intro_offer']);
            case 'has_photos':
                return !empty($data['has_photos']);
            case 'no_photos':
                return empty($data['has_photos']);
            case 'performance_improved':
                return isset($data['performance_trend']) && $data['performance_trend'] > 0;
            case 'performance_declined':
                return isset($data['performance_trend']) && $data['performance_trend'] < 0;
            case 'is_incomplete':
                return ($data['profile_completion'] ?? 0) < 100;
            default:
                return !empty($data[$condition]);
        }
    }

    /**
     * Get nearby major city for personalization
     */
    private function get_nearby_major_city($state) {
        $cities = array(
            'CA' => 'Los Angeles',
            'NY' => 'New York',
            'TX' => 'Houston',
            'FL' => 'Miami',
            'IL' => 'Chicago',
            'PA' => 'Philadelphia',
            'OH' => 'Columbus',
            'GA' => 'Atlanta',
            'NC' => 'Charlotte',
            'MI' => 'Detroit',
            'NJ' => 'Newark',
            'VA' => 'Virginia Beach',
            'WA' => 'Seattle',
            'AZ' => 'Phoenix',
            'MA' => 'Boston',
            'TN' => 'Nashville',
            'IN' => 'Indianapolis',
            'MO' => 'Kansas City',
            'MD' => 'Baltimore',
            'WI' => 'Milwaukee',
            'CO' => 'Denver',
            'MN' => 'Minneapolis',
            'SC' => 'Charleston',
            'AL' => 'Birmingham',
            'LA' => 'New Orleans',
            'KY' => 'Louisville',
            'OR' => 'Portland',
            'OK' => 'Oklahoma City',
            'CT' => 'Hartford',
            'UT' => 'Salt Lake City',
            'NV' => 'Las Vegas',
            'IA' => 'Des Moines',
            'AR' => 'Little Rock',
            'MS' => 'Jackson',
            'KS' => 'Wichita',
            'NM' => 'Albuquerque',
            'NE' => 'Omaha',
            'ID' => 'Boise',
            'WV' => 'Charleston',
            'HI' => 'Honolulu',
            'NH' => 'Manchester',
            'ME' => 'Portland',
            'RI' => 'Providence',
            'MT' => 'Billings',
            'DE' => 'Wilmington',
            'SD' => 'Sioux Falls',
            'ND' => 'Fargo',
            'AK' => 'Anchorage',
            'VT' => 'Burlington',
            'WY' => 'Cheyenne',
        );

        return $cities[$state] ?? 'your area';
    }

    /**
     * Get all available templates
     */
    public function get_available_templates() {
        $templates = array();
        $files = glob($this->templates_dir . '*.html');

        foreach ($files as $file) {
            $name = basename($file, '.html');
            if (strpos($name, '_') !== 0) { // Skip partials (starting with _)
                $templates[] = $name;
            }
        }

        return $templates;
    }
}
