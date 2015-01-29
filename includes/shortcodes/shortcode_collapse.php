<?php
/**
 * Collapse shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_collapse($params, $content = null) {
    extract(shortcode_atts(array(
        'id' => 'collapseId',
        'button' => 'Button'
                    ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#' . $id . '" aria-expanded="false" aria-controls="' . $id . '">'
            . $button
            . '</button>'
            . '<div class="collapse" id="' . $id . '">'
            . '<div class="well">'
            . do_shortcode($content)
            . '</div>'
            . '</div>';
    return force_balance_tags($result);
}
add_shortcode('collapse', 'shortcode_collapse');
