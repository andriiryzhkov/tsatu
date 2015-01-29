<?php
/**
 * Accordion shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_accordion($params, $content = null) {
    if (!has_shortcode($content, 'toggle')) {
        return;
    }
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">'
            . do_shortcode($content)
            . '</div>';
    return force_balance_tags($result);
}
add_shortcode('accordion', 'shortcode_accordion');


function shortcode_toggle($params, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'active' => 0
    ), $params ) );

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $heading_id = uniqid( 'heading_'. rand() );
    $toggle_id = uniqid( 'toggle_'. rand() );
    $active = ($active == 1) ? ' in' : '';
    $result = '<div class="panel panel-default">'
            . '<div class="panel-heading" role="tab" id="' . $heading_id . '">'
            . '<h4 class="panel-title">'
            . '<a data-toggle="collapse" data-parent="#accordion" href="#' . $toggle_id . '" aria-expanded="true" aria-controls="' . $toggle_id . '">'
            . $title
            . '</a>'
            . '</h4>'
            . '</div>'
            . '<div id="' . $toggle_id . '" class="panel-collapse collapse' . $active . '" role="tabpanel" aria-labelledby="' . $heading_id . '">'
            . '<div class="panel-body">'
            . do_shortcode($content)
            . '</div>'
            . '</div>'
            . '</div>';
    return force_balance_tags($result);
}
add_shortcode('toggle', 'shortcode_toggle');