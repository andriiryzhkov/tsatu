<?php
/**
 * General configuration.
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enable theme features
 * 
 */
//add_theme_support('soil-clean-up');         // Enable clean up from Soil
//add_theme_support('soil-relative-urls');    // Enable relative URLs from Soil
//add_theme_support('soil-nice-search');      // Enable /?s= to /search/ redirect from Soil
//add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */
define('UI_FRAMEWORK', 'Bootstrap'); // 

define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)

if (!defined('WP_ENV')) {
    define('WP_ENV', 'production');  // scripts.php checks for values 'production' or 'development'
}

/**
 * Add body class if sidebar is active
 */
function tsatu_sidebar_body_class($classes) {
  if (tsatu_display_sidebar()) {
    $classes[] = 'sidebar-side';
  }
  return $classes;
}
add_filter('body_class', 'tsatu_sidebar_body_class');

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function tsatu_display_sidebar() {
  static $display;

  if (!isset($display)) {
    $sidebar_config = new TSATU_Sidebar(
      /**
       * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
       * Any of these conditional tags that return true won't show the sidebar
       *
       * To use a function that accepts arguments, use the following format:
       *
       * array('function_name', array('arg1', 'arg2'))
       *
       * The second element must be an array even if there's only 1 argument.
       */
      array(
        'is_404',
        'is_front_page'
      ),
      /**
       * Page template checks (via is_page_template())
       * Any of these page templates that return true won't show the sidebar
       */
      array(
        'template-full-page.php'
      )
    );
    $display = apply_filters('tsatu/display_sidebar', $sidebar_config->display);
  }  

  return $display;
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) {
    $content_width = 848; //1140;
}

function annointed_admin_bar_remove() {
  global $wp_admin_bar;

  /* Remove their stuff */
  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('comments');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

function remove_menus() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_menus' );

