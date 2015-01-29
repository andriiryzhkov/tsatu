<?php
/**
 * Icon shortcode
 * 
 * Forked from Bootstrap Shortcodes Plugin
 * (https://github.com/TheWebShop/bootstrap-shortcodes)
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_icons( $params, $content=null ) {
    extract(shortcode_atts(array(
        'name' => 'default'
    ), $params));

    $result = '<i class="' . $name . '"></i>';
    return force_balance_tags( $result );
}
add_shortcode( 'icon', 'shortcode_icons' );
