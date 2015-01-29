<?php

/**
 * Lead shortcode
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

function shortcode_lead($params, $content = null) {
    $content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="lead">';
    $result .= do_shortcode($content);
    $result .= '</div>';
    return force_balance_tags($result);
}

add_shortcode('lead', 'shortcode_lead');
