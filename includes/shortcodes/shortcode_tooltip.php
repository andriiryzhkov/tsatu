<?php
/**
 * Tooltip shortcode
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

function shortcode_tooltip($params, $content = null) {
    extract(shortcode_atts(array(
        'placement' => 'top',
        'trigger' => 'hover',
                    ), $params));

    $placement = (in_array($placement, array('top', 'right', 'bottom', 'left'))) ? $placement : 'top';
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $title = explode('\n', wordwrap($content, 20, '\n'));
    //$result = '<span data-toggle="tooltip" title="' . $title[0] . '" data-placement="' . esc_attr($placement) . '" data-trigger="' . esc_attr($trigger) . '">' . esc_attr($content) . '</span>';
    $result = '<span class="tooltip ' . esc_attr($placement) . '' . $title[0] . '" data-placement="" data-trigger="' . esc_attr($trigger) . '">' . esc_attr($content) . '</span>';
    return force_balance_tags($result);
}

add_shortcode('tooltip', 'shortcode_tooltip');
