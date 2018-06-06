<?php
/**
 * Education Master functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

if (!function_exists('education_master_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function education_master_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Education Master, use a find and replace
         * to change 'education-master' to the name of your theme in all the template files.
         */
        load_theme_textdomain('education-master', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('education-master-block-medium', 305, 207, true);
        add_image_size('education-master-block-thumb', 136, 102, true);
        add_image_size('education-master-slider-medium', 622, 420, true);
        add_image_size('education-master-carousel-portrait', 400, 600, true);
        add_image_size('education-master-alternate-grid', 340, 316, true);
        add_image_size('education-master-carousel-blog', 555, 311, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'education_master_top_menu' => esc_html__('Top Menu', 'education-master'),
            'education_master_primary_menu' => esc_html__('Primary Menu', 'education-master'),
            'education_master_footer_menu' => esc_html__('Footer Menu', 'education-master')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for Custom Logo.
        add_theme_support('custom-logo', array(
            'width' => 300,
            'height' => 45,
            'flex-width' => true,
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('education_master_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');

    }
endif;
add_action('after_setup_theme', 'education_master_setup');

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_master_content_width()
{
    $GLOBALS['content_width'] = apply_filters('education_master_content_width', 640);
}

add_action('after_setup_theme', 'education_master_content_width', 0);

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global int $education_master_version
 * @since 1.0.0
 */
function education_master_theme_version()
{
    $education_master_theme_info = wp_get_theme();
    $GLOBALS['education_master_version'] = $education_master_theme_info->get('Version');
}

add_action('after_setup_theme', 'education_master_theme_version', 0);


if (!function_exists('edm_get_number_of_services')) :

    /**
     * Get theme option.
     *

     */
    function edm_get_number_of_services()
    {

        $value = 4;

        return $value;

    }

endif;

if (!function_exists('education_master_get_option')) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     *
     * @return mixed Option value.
     */
    function education_master_get_option($key = '')
    {

        $default_options = education_master_get_default_theme_options();

        if (empty($key)) {
            return;
        }

        $theme_options = (array)get_theme_mod('theme_options');
        $theme_options = wp_parse_args($theme_options, $default_options);

        $value = null;

        if (isset($theme_options[$key])) {
            $value = $theme_options[$key];
        }

        return $value;

    }

endif;

if (!function_exists('education_master_the_excerpt')) :

    /**
     * Generate excerpt.
     *
     * @since 1.0.0
     *
     * @param int $length Excerpt length in words.
     * @param WP_Post $post_obj WP_Post instance (Optional).
     *
     * @return string Excerpt.
     */
    function education_master_the_excerpt($length = 40, $post_obj = null)
    {

        global $post;
        if (is_null($post_obj)) {
            $post_obj = $post;
        }
        $length = absint($length);
        if ($length < 1) {
            $length = 40;
        }
        $source_content = $post_obj->post_content;
        if (!empty($post_obj->post_excerpt)) {
            $source_content = $post_obj->post_excerpt;
        }
        $source_content = preg_replace('`\[[^\]]*\]`', '', $source_content);
        $trimmed_content = wp_trim_words($source_content, $length, '...');

        return $trimmed_content;

    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function education_master_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'education_master_pingback_header');


require_once get_template_directory() . '/core/edm-customizer/parts/customizer-default.php';
require_once get_template_directory() . '/core/edm-functions/options.php';

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/core/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/core/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/core/edm-customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/core/jetpack.php';

/**
 * Load Widget function file
 */
require get_template_directory() . '/core/edm-widgets/edm-widget-functions.php';

/**
 * Custom files for hook
 */
require get_template_directory() . '/core/edm-hooks/edm-header-hooks.php';
require get_template_directory() . '/core/edm-hooks/edm-slider-hooks.php';
require get_template_directory() . '/core/edm-hooks/edm-service-hooks.php';
require get_template_directory() . '/core/edm-hooks/edm-widget-hooks.php';
require get_template_directory() . '/core/edm-hooks/edm-custom-hooks.php';
require get_template_directory() . '/core/edm-hooks/edm-footer-hooks.php';

/**
 * Custom files for post metabox
 */

require get_template_directory() . '/core/edm-metaboxes/edm-post-metabox.php';
require get_template_directory() . '/core/edm-metaboxes/edm-page-metabox.php';


/**
 * Load TGMPA Configs.
 */
require get_template_directory() . '/core/tgm-plugin-activation/class-tgm-plugin-activation.php';
require get_template_directory() . '/core/tgm-plugin-activation/tgmpa-education-master.php';

/* Calling in the admin area for the Welcome Page */
if (is_admin()) {
    require get_template_directory() . '/core/admin/class-education-master-admin.php';
}