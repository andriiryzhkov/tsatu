<?php
/**
 * The header for TSATU theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package TSATU
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
    <link rel="icon" href="<?php echo get_template_directory_uri() . '/favicon.ico'; ?>" />
    <!--[if IE]><link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/favicon.ico'; ?>" /><![endif]-->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--[if lt IE 8]>
    <div class="alert alert-warning">
<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'tsatu'); ?>
    </div>
<![endif]-->

<header class="site-header" role="banner">
    <!-- Logo -->
    <div class="container logo">
        <div class="row">
            <div class="branding col-md-1">
                <a href="<?php echo esc_url(network_site_url('/')); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png"></a>
            </div>
            <div class="branding col-md-7">
                <?php if (!is_child_theme()) : ?>
                    <a class="name" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php _e('Tavria State Agrotechnological University', 'tsatu'); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <div class="name-dep">
                            <?php bloginfo('name'); ?>
                        </div>
                        <div class="name-main">
                            <?php echo get_network_bloginfo('name'); ?>
                        </div>
                    </a>
            <?php endif; ?>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <div class="row">
                    <?php if (function_exists('qtrans_generateLanguageSelectCode')) : // mqTranslate language select ?>
                        <div class="site-language">
                            <?php echo qtrans_generateLanguageSelectCode('image'); ?>
                        </div>
                    <?php endif; // end mqTranslate  ?>
                    <div class="minor">
                        <a href="<?php echo network_site_url('/pidrozdily/'); ?>"><?php _e('Subdivisions', 'tsatu'); ?></a>
                        <a href="<?php echo network_site_url('/online/'); ?>"><?php _e('On-line Services', 'tsatu'); ?></a>
                        <a href="<?php echo home_url('/wp-login.php'); ?>"><?php _e('Sign In', 'tsatu'); ?></a>
                    </div>
                </div>
                <div class="row">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Header primary menu -->
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed"
                        data-toggle="collapse" data-target="#primary-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="primary-navbar"
                 role="navigation">
                     <?php
                     if (has_nav_menu('primary')) :
                         wp_nav_menu(array(
                             'theme_location' => 'primary',
                             'depth' => 3,
                             'walker' => new wp_bootstrap_navwalker(),
                             'menu_class' => 'nav navbar-nav'
                         ));

                     endif;
                     ?>
            </div>
        </div>
    </nav>
</header>
<!-- Front page -->
<?php
if (function_exists('tsatu_slider') && is_front_page() && !is_child_theme() && get_theme_mod('show_slider') == 1) {
    tsatu_slider(get_theme_mod('num_slides'));
}
?>
<!-- Main container -->
<div class="wrap container"  role="document">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
    <?php
    if (!is_home() && !is_front_page()) {
        tsatu_breadcrumb();
    }
    ?>
    <div class="content row">
        <div id="content" class="main">

