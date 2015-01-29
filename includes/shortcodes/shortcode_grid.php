<?php
/**
 * Grid shortcodes
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

function shortcode_row( $params, $content=null ) {
    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<div class="row">';
    $result .= do_shortcode( $content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode('row', 'shortcode_row');

function shortcode_col( $params, $content=null ) {
    extract( shortcode_atts( array(
        'type' => '4'
        ), $params ) );

    $result = '<div class="' . $type . '">';
    $result .= do_shortcode( $content );
    $result .= '</div>';
    return force_balance_tags( $result );
}
add_shortcode( 'col', 'shortcode_col' );