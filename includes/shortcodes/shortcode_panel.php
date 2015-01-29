<?php
/**
 * Panel shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_panel($params, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'type' => 'default'
    ), $params ) );

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $heading_id = uniqid( 'heading_'. rand() );
    $toggle_id = uniqid( 'toggle_'. rand() );
    $result = '<div class="panel panel-' . $type . '">'
            . '    <div class="panel-heading">'
            . '        <h3 class="panel-title">' . $title . '</h3>'
            . '    </div>'
            . '    <div class="panel-body">'
            .          do_shortcode($content)
            . '    </div>'
            . '</div>';
    return force_balance_tags($result);
}
add_shortcode('panel', 'shortcode_panel');