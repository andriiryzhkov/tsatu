<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function tsatu_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'tsatu_jetpack_setup' );

/**
 * Backlist modules
 */
function tsatu_blacklist_jetpack_modules( $modules ){
    $jp_mods_to_disable = array(
        // 'shortcodes',
        // 'widget-visibility',
        // 'contact-form',
        // 'shortlinks',
        'infinite-scroll',
        // 'wpcc',
        // 'tiled-gallery',
        // 'json-api',
        // 'publicize',
        'vaultpress',
        'custom-css',
        // 'post-by-email',
        'widgets',
        'comments',
        // 'minileven',
        // 'latex',
        'gravatar-hovercards',
        // 'enhanced-distribution',
        // 'notes',
        // 'subscriptions',
        // 'stats',
        // 'after-the-deadline',
        // 'carousel',
        // 'photon',
        //'sharedaddy',
        // 'omnisearch',
        // 'mobile-push',
        // 'likes',
        'videopress',
        // 'gplus-authorship',
        'sso',
        // 'monitor',
        // 'markdown',
        // 'verification-tools',
        'related-posts',
        'custom-content-types',
        'site-icon',
    );

    foreach ( $jp_mods_to_disable as $mod ) {
        if ( isset( $modules[$mod] ) ) {
            unset( $modules[$mod] );
        }
    }

    return $modules;
}
add_filter( 'jetpack_get_available_modules', 'tsatu_blacklist_jetpack_modules' );