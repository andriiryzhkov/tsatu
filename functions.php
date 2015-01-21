<?php
/**
 * TSATU functions and definitions
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Tsatu includes
 *
 * The $tsatu_includes array determines the code includesrary included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$tsatu_includes = array(
    'includes/init.php',           // Theme init
    'includes/sidebar.php',        // Sidebar class
    'includes/config.php',         // Configuration
    'includes/scripts.php',        // Scripts and stylesheets
    'includes/customizer.php',     // Customizer additions
    'includes/navwalker.php',      // Custom nav modifications
    'includes/template-tags.php',  // Custom template tags for this theme
    'includes/extras.php',         // Custom functions that act independently of the theme templates
    'includes/breadcrumb.php',     // Navigation breadcrumb function
    'includes/jetpack.php',        // Jetpack compatibility file
    'includes/translit.php',       // Cyr to Lat titles
    'includes/post_types/banner_post_type.php',        // Banners
    'includes/post_types/slide_post_type.php',         // Slies
    'includes/post_types/tab_post_type.php',           // Tabs
    'includes/widgets/widget-recent-posts.php', // Recent Posts Widget
    'includes/widgets/widget-service.php',      // Sevice Widget
    'includes/widgets/widget-pagenav.php',      // Page Sidebar Navigation Widget
    'includes/widgets/widget-shortlink.php',    // Shortlink Widget
    'includes/widgets/widget-cta.php',          // Call to Action Widget
    'includes/widgets/widget-social.php',       // Social icons Widget
    'includes/widgets/widget-thumbnail.php',    // Thumbnail Widget
    'includes/widgets/widget-banner.php',       // Bunner Widget
    'includes/widgets/widget-tabs.php',         // Tabs Widget
    'includes/widgets/widget-slider.php',       // Slider Widget
    'includes/widgets/widget-department.php',   // Department Widget
);

foreach ($tsatu_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'tsatu'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);
