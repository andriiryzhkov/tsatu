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
    <!-- Branding -->
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-9 col-lg-8">
                <div class="branding branding-logo">
                    <a href="<?php echo esc_url(network_site_url('/')); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png"></a>
                </div>

                <div class="branding branding-title">
                    <?php if (is_main_site()) : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php _e('Tavria State Agrotechnological University', 'tsatu'); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <div class="branding-division">
                                <?php bloginfo('name'); ?>
                            </div>
                            <div class="branding-child-title">
                                <?php echo get_network_bloginfo('name'); ?>
                            </div>
                        </a>
                <?php endif; ?>
                </div>
            </div>
            <!-- Top menu -->
            <div class="col-sm-12 col-md-3 col-lg-4">
                <div class="row">
                    <div class="top-nav col-xs-6 col-sm-6 col-md-12">
                        <div class="top-nav-items">
                            <a href="<?php echo network_site_url('/pidrozdily/'); ?>" title="<?php _e('Subdivisions', 'tsatu'); ?>"><i class="fa fa-sitemap"></i></a>
                            <a href="<?php echo network_site_url('/online/'); ?>" title="<?php _e('On-line Services', 'tsatu'); ?>"><i class="fa fa-cogs"></i></a>
                            <a href="<?php echo home_url('/wp-login.php'); ?>" title="<?php _e('Sign In', 'tsatu'); ?>"><i class="fa fa-sign-in"></i></a>
                        </div>
                        <ul class="top-nav-language">
                            <?php pll_the_languages(array('show_flags' => 1,'show_names' => 0));?>
                        </ul>
                        <?php if (function_exists('qtrans_generateLanguageSelectCode')) : // mqTranslate language select ?>
                            <div class="top-nav-language">
                                <?php echo qtrans_generateLanguageSelectCode('image'); ?>
                            </div>
                        <?php endif; // end mqTranslate  ?>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-12">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div> <!-- End branding -->
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
                             'walker' => new TSATU_Nav_Walker(),
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
if (function_exists('tsatu_slider') && is_front_page() && is_main_site() && get_theme_mod('show_slider') == 1) {
    tsatu_slider(get_theme_mod('num_slides'));
}
?>
<!-- Main container -->
<div class="wrap container"  role="document">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
    <?php //tsatu_breadcrumb(); ?>
    <div class="content row">
        <div id="content" class="main">

