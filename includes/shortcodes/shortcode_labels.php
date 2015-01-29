<?php
/**
 * Labels shortcode
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

function shortcode_labels( $params, $content=null ) {
    extract( shortcode_atts( array(
        'type' => 'default'
    ), $params ) );

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<span class="label label-' . $type . '">' . $content . '</span>';
    return force_balance_tags( $result );
}
add_shortcode( 'label', 'shortcode_labels' );
