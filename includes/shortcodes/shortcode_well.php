<?php
/**
 * Well shortcode
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

function shortcode_well( $params, $content=null ) {
    extract( shortcode_atts( array(
        'size' => 'unknown'
    ), $params));

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result =  '<div class="well well-' . $size . '">';
    $result .= do_shortcode( $content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode( 'well', 'shortcode_well' );