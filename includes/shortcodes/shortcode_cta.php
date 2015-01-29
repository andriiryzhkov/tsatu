<?php
/**
 * Call to action shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_cta( $params, $content = null ) {
    extract( shortcode_atts( array(
        'title' => __('Call to Action', 'tsatu'),
        'button' => __('Button', 'tsatu'),
        'href' => '#'
    ), $params ) );
    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<div class="jumbotron">'
            . '<h1>' . $title . '</h1>'
            . '<p>' . $content . '</p>'
            . '<p><a class="btn btn-primary btn-lg" href="' . $href . '" role="button">' . $button . '</a></p>'
            . '</div>';
    return force_balance_tags( $result );
}
add_shortcode( 'cta', 'shortcode_cta' );
