<?php
/**
 * Progress bar shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_progressbar( $params, $content=null ) {
    extract(shortcode_atts(array(
        'percent' => 50,
        'type' => 'default'
    ), $params ) );

    $content = preg_replace( '/<br class="nc".\/>/', '', $content );
    $result = '<div class="progress">'
            . '    <div class="progress-bar progress-bar-' . $type . '" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%">'
            . '        <span class="sr-only">' . $percent . '% Complete (success)</span>'
            . '    </div>'
            . '</div>';
    return force_balance_tags( $result );
}
add_shortcode( 'progressbar', 'shortcode_progressbar' );