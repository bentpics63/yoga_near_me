<?php
/**
 * YogaNearMe - FAQ Page Schema Markup
 *
 * Add this to your theme's functions.php or use a code snippets plugin.
 * This adds FAQPage schema to the FAQ page for rich snippet eligibility.
 *
 * INSTALLATION:
 * 1. Add to Appearance > Theme File Editor > functions.php (at the end)
 * 2. Or use a plugin like "Code Snippets" and add as a new snippet
 */

add_action('wp_head', 'ynm_faq_page_schema');

function ynm_faq_page_schema() {
    // Only output on the FAQ page
    if (!is_page('30-essential-questions-answered')) {
        return;
    }

    // FAQ items - update these with your actual FAQ content
    $faqs = array(
        array(
            'question' => 'How do I find a yoga studio near me?',
            'answer' => 'Use our search feature at the top of the page or browse by location. You can filter by yoga style, distance, and amenities to find the perfect studio.'
        ),
        array(
            'question' => 'What should I bring to my first yoga class?',
            'answer' => 'Bring a yoga mat (most studios have rentals), water bottle, and comfortable clothing that allows movement. Arrive 10-15 minutes early to sign in and get settled.'
        ),
        array(
            'question' => 'Which yoga style is best for beginners?',
            'answer' => 'Hatha and Vinyasa basics classes are ideal for beginners. Hatha moves slower with longer holds, while Vinyasa basics introduces flowing movement at a gentle pace.'
        ),
        array(
            'question' => 'How often should I practice yoga?',
            'answer' => '2-3 times per week is a good starting point. Consistency matters more than frequency - even once a week builds benefits over time.'
        ),
        array(
            'question' => 'Do I need to be flexible to do yoga?',
            'answer' => 'No. Yoga develops flexibility over time. Every pose can be modified to meet you where you are. Flexibility is a result of practice, not a prerequisite.'
        ),
        array(
            'question' => 'What is the difference between yoga and Pilates?',
            'answer' => 'Yoga emphasizes breath, meditation, and spiritual elements alongside physical postures. Pilates focuses on core strength and controlled movement without the spiritual component.'
        ),
        array(
            'question' => 'Is hot yoga safe for beginners?',
            'answer' => 'Hot yoga can be intense for beginners. Start with a regular temperature class to learn the poses, stay well hydrated, and listen to your body if you try a heated class.'
        ),
        array(
            'question' => 'How do I know if a yoga studio is right for me?',
            'answer' => 'Try an intro offer or drop-in class. Look for welcoming staff, clean facilities, qualified teachers, and a schedule that fits your life. Trust your gut feeling about the community.'
        ),
    );

    $faq_items = array();
    foreach ($faqs as $faq) {
        $faq_items[] = array(
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => $faq['answer']
            )
        );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faq_items
    );

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
