<?php

/**
 * Buttons shortcode
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

function shortcode_buttons($params, $content = null) {
    extract(shortcode_atts(array(
        'size' => 'default',
        'type' => 'default',
        'href' => "#"
                    ), $params));

    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<a class="btn btn-' . $size . ' btn-' . $type . '" href="' . $href . '">' . $content . '</a>';
    return force_balance_tags($result);
}

add_shortcode('button', 'shortcode_buttons');
