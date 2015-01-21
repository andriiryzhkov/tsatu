<?php
/**
 * TSATU theme init
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('tsatu_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function tsatu_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on tsatu, use a find and replace
         * to change 'tsatu' to the name of your theme in all the template files
         */
        load_theme_textdomain('tsatu', get_template_directory() . '/languages');

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
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('tsatu-posts', 555, 327, true);
        add_image_size('tsatu-single', 848, 500, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'tsatu'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        //add_theme_support('post-formats', array(
        //    'aside', 'image', 'video', 'quote', 'link',
        //));

        // Set up the WordPress core custom background feature.
        //add_theme_support('custom-background', apply_filters('tsatu_custom_background_args', array(
        //    'default-color' => 'ffffff',
        //    'default-image' => '',
        //)));

        /*
         *  Tell the TinyMCE editor to use a custom stylesheet
         */
        add_editor_style('/assets/css/editor-style.css');
    }

endif; // tsatu_setup
add_action('after_setup_theme', 'tsatu_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tsatu_widgets_init() {
    register_sidebar(array(
        'name'          => __('Deafult Sidebar', 'tsatu'),
        'id'            => 'sidebar-default',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));

    register_sidebar(array(
        'name'          => __('Page Sidebar', 'tsatu'),
        'id'            => 'sidebar-page',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));

  //Footer
    register_sidebar(array(
        'name'          => sprintf(__('Footer', 'tsatu'), ' 1/4'),
        'id'            => 'sidebar-footer-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => sprintf(__('Footer', 'tsatu'), ' 2/4'),
        'id'            => 'sidebar-footer-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => sprintf(__('Footer', 'tsatu'), ' 3/4'),
        'id'            => 'sidebar-footer-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => sprintf(__('Footer', 'tsatu'), ' 4/4'),
        'id'            => 'sidebar-footer-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    //Widgets
    register_widget( 'TSATU_Recent_Posts_Widget' );
    register_widget( 'TSATU_Service_Widget' );
    register_widget( 'TSATU_Social_Widget' );
    register_widget( 'TSATU_Pagenav_Widget' );
    register_widget( 'TSATU_Shortlink_Widget' );
    register_widget( 'TSATU_CTA_Widget' );
    register_widget( 'TSATU_Thumbnail_Widget' );
    register_widget( 'TSATU_Banner_Widget' );
    register_widget( 'TSATU_Tabs_Widget' );
    register_widget( 'TSATU_Slider_Widget' );
    register_widget( 'TSATU_Department_Widget' );

}

add_action('widgets_init', 'tsatu_widgets_init');
