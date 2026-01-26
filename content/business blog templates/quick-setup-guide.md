# Quick Setup Guide - WordPress Plugin Method

## Step 1: Create Plugin Structure

Create this folder structure in `/wp-content/plugins/`:

```
yoga-blog-template/
├── yoga-blog-template.php
├── assets/
│   ├── css/
│   │   └── blog-template.css
│   └── js/
│       └── blog-template.js
├── templates/
│   └── single-post.php
└── includes/
    └── class-template-loader.php
```

## Step 2: Main Plugin File

Create `yoga-blog-template.php`:

```php
<?php
/**
 * Plugin Name: Yoga Blog Template
 * Description: Professional blog template for yoga websites with reading progress, TOC, and accessibility features
 * Version: 1.0.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('YBT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('YBT_PLUGIN_PATH', plugin_dir_path(__FILE__));

class YogaBlogTemplate {

    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_filter('single_template', array($this, 'load_custom_template'));
        add_action('add_meta_boxes', array($this, 'add_template_meta_box'));
        add_action('save_post', array($this, 'save_template_meta'));
    }

    public function init() {
        // Initialize plugin
    }

    public function enqueue_assets() {
        if ($this->should_load_template()) {
            wp_enqueue_style(
                'yoga-blog-template',
                YBT_PLUGIN_URL . 'assets/css/blog-template.css',
                array(),
                '1.0.0'
            );

            wp_enqueue_script(
                'yoga-blog-template',
                YBT_PLUGIN_URL . 'assets/js/blog-template.js',
                array(),
                '1.0.0',
                true
            );
        }
    }

    public function load_custom_template($template) {
        if (is_single() && $this->should_load_template()) {
            $custom_template = YBT_PLUGIN_PATH . 'templates/single-post.php';
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }

    public function add_template_meta_box() {
        add_meta_box(
            'yoga_blog_template',
            'Blog Template Settings',
            array($this, 'template_meta_box_callback'),
            'post',
            'side'
        );
    }

    public function template_meta_box_callback($post) {
        wp_nonce_field('yoga_blog_template_nonce', 'yoga_blog_template_nonce');

        $use_template = get_post_meta($post->ID, '_use_yoga_template', true);
        $yoga_style = get_post_meta($post->ID, '_yoga_style', true);
        $hero_subtitle = get_post_meta($post->ID, '_hero_subtitle', true);

        ?>
        <table class="form-table">
            <tr>
                <td>
                    <label>
                        <input type="checkbox" name="use_yoga_template" value="1" <?php checked($use_template, '1'); ?>>
                        Use Yoga Blog Template
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="yoga_style">Yoga Style:</label>
                    <select name="yoga_style" id="yoga_style">
                        <option value="vinyasa" <?php selected($yoga_style, 'vinyasa'); ?>>Vinyasa</option>
                        <option value="hatha" <?php selected($yoga_style, 'hatha'); ?>>Hatha</option>
                        <option value="yin" <?php selected($yoga_style, 'yin'); ?>>Yin</option>
                        <option value="restorative" <?php selected($yoga_style, 'restorative'); ?>>Restorative</option>
                        <option value="hot" <?php selected($yoga_style, 'hot'); ?>>Hot Yoga</option>
                        <option value="kundalini" <?php selected($yoga_style, 'kundalini'); ?>>Kundalini</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hero_subtitle">Hero Subtitle:</label>
                    <textarea name="hero_subtitle" id="hero_subtitle" rows="3" style="width:100%;"><?php echo esc_textarea($hero_subtitle); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_template_meta($post_id) {
        if (!isset($_POST['yoga_blog_template_nonce']) ||
            !wp_verify_nonce($_POST['yoga_blog_template_nonce'], 'yoga_blog_template_nonce') ||
            !current_user_can('edit_post', $post_id)) {
            return;
        }

        update_post_meta($post_id, '_use_yoga_template', isset($_POST['use_yoga_template']) ? '1' : '0');
        update_post_meta($post_id, '_yoga_style', sanitize_text_field($_POST['yoga_style']));
        update_post_meta($post_id, '_hero_subtitle', sanitize_textarea_field($_POST['hero_subtitle']));
    }

    private function should_load_template() {
        if (is_single()) {
            global $post;
            return get_post_meta($post->ID, '_use_yoga_template', true) === '1';
        }
        return false;
    }
}

// Initialize the plugin
new YogaBlogTemplate();
```

## Step 3: Convert HTML Template to PHP

Create `templates/single-post.php` by converting the HTML template:

```php
<?php
// Get post meta
$yoga_style = get_post_meta(get_the_ID(), '_yoga_style', true) ?: 'vinyasa';
$hero_subtitle = get_post_meta(get_the_ID(), '_hero_subtitle', true);

// Set dynamic style color based on yoga style
$style_colors = array(
    'vinyasa' => '#ff5733',
    'hatha' => '#B8BD5',
    'yin' => '#706677',
    'restorative' => '#706677',
    'hot' => '#FFD966',
    'kundalini' => '#FFD966'
);
$style_color = $style_colors[$yoga_style] ?? '#ff5733';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dynamic meta -->
    <meta name="description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
    <meta name="author" content="<?php echo esc_attr(get_the_author()); ?>">

    <title><?php wp_title(); ?></title>

    <!-- Dynamic style color -->
    <style>
        :root {
            --style-color: <?php echo esc_attr($style_color); ?>;
        }
    </style>

    <?php wp_head(); ?>

    <!-- JSON-LD Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "<?php echo esc_js(get_the_title()); ?>",
        "description": "<?php echo esc_js(get_the_excerpt()); ?>",
        "image": "<?php echo esc_js(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>",
        "author": {
            "@type": "Person",
            "name": "<?php echo esc_js(get_the_author()); ?>",
            "url": "<?php echo esc_js(get_author_posts_url(get_the_author_meta('ID'))); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_js(get_site_icon_url()); ?>"
            }
        },
        "datePublished": "<?php echo esc_js(get_the_date('c')); ?>",
        "dateModified": "<?php echo esc_js(get_the_modified_date('c')); ?>",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo esc_js(get_permalink()); ?>"
        },
        "articleSection": "Yoga",
        "keywords": [<?php
            $tags = get_the_tags();
            if ($tags) {
                $tag_names = array_map(function($tag) { return '"' . esc_js($tag->name) . '"'; }, $tags);
                echo implode(', ', $tag_names);
            }
        ?>]
    }
    </script>
</head>
<body <?php body_class(); ?> data-yoga-style="<?php echo esc_attr($yoga_style); ?>">

<!-- Reading Progress Bar -->
<div class="reading-progress" aria-hidden="true">
    <div class="reading-progress-bar" id="reading-progress-bar"></div>
</div>

<!-- Hero Section -->
<section class="hero" role="banner">
    <div class="hero-content">
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<ol>', '</ol>');
            } else { ?>
                <ol>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog</a></li>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            <?php } ?>
        </nav>

        <div class="hero-text">
            <h1 class="hero-title"><?php the_title(); ?></h1>
            <?php if ($hero_subtitle): ?>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
            <?php endif; ?>

            <div class="article-meta">
                <div class="meta-item">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <span>By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author"><?php the_author(); ?></a></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar" aria-hidden="true"></i>
                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    <span><?php echo do_shortcode('[rt_reading_time]'); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-tag" aria-hidden="true"></i>
                    <span><?php echo ucfirst($yoga_style); ?> Yoga</span>
                </div>
            </div>
        </div>
    </div>

    <?php if (has_post_thumbnail()): ?>
        <picture class="hero-image">
            <?php the_post_thumbnail('full', array('loading' => 'eager')); ?>
        </picture>
    <?php endif; ?>

    <div class="hero-overlay"></div>
</section>

<!-- Main Content -->
<main id="main-content" class="main-content" role="main">
    <div class="container">
        <div class="content-wrapper">
            <!-- Table of Contents -->
            <aside class="table-of-contents" role="complementary" aria-label="Table of contents">
                <div class="toc-container">
                    <h2 class="toc-title">Table of Contents</h2>
                    <nav class="toc-nav">
                        <ol class="toc-list" id="auto-generated-toc">
                            <!-- Auto-generated by JavaScript -->
                        </ol>
                    </nav>
                </div>
            </aside>

            <!-- Article Content -->
            <article class="article-content" role="article">
                <?php the_content(); ?>
            </article>
        </div>
    </div>
</main>

<?php get_footer(); ?>
</body>
</html>
```

## Step 4: Installation Instructions

1. **Upload plugin folder** to `/wp-content/plugins/`
2. **Copy CSS and JS files** to the assets folders
3. **Activate plugin** in WordPress admin
4. **Edit any blog post** and check "Use Yoga Blog Template" in the meta box
5. **Set yoga style and hero subtitle**
6. **View the post** to see the template in action

## Step 5: Optional Enhancements

### Add Reading Time Function
```php
// Add to functions.php or plugin
function calculate_reading_time($post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed

    return $reading_time . ' min read';
}

// Shortcode for reading time
function reading_time_shortcode() {
    return calculate_reading_time();
}
add_shortcode('rt_reading_time', 'reading_time_shortcode');
```

### Auto-Generate Table of Contents
```javascript
// Add to the JavaScript file
function generateTOC() {
    const headings = document.querySelectorAll('.article-content h2, .article-content h3');
    const tocList = document.getElementById('auto-generated-toc');

    if (!tocList || headings.length === 0) return;

    headings.forEach((heading, index) => {
        // Create ID if not exists
        if (!heading.id) {
            heading.id = 'heading-' + index;
        }

        // Create TOC item
        const li = document.createElement('li');
        const link = document.createElement('a');
        link.href = '#' + heading.id;
        link.textContent = heading.textContent;
        link.className = 'toc-link';

        li.appendChild(link);
        tocList.appendChild(li);
    });
}

// Run after DOM loads
document.addEventListener('DOMContentLoaded', generateTOC);
```

This setup gives you a fully functional WordPress plugin that can be easily installed and configured!