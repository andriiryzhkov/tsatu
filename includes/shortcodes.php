<?php

/**
 * Shortcodes
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode includes
 */
$tsatu_shortcode_includes = array(
    'includes/shortcodes/shortcode_grid.php',
    'includes/shortcodes/shortcode_well.php',
    'includes/shortcodes/shortcode_alert.php',
    'includes/shortcodes/shortcode_buttons.php',
    'includes/shortcodes/shortcode_labels.php',
    'includes/shortcodes/shortcode_lead.php',
    'includes/shortcodes/shortcode_icons.php',
    'includes/shortcodes/shortcode_progressbar.php',
    'includes/shortcodes/shortcode_panel.php',
    'includes/shortcodes/shortcode_tabs.php',
    'includes/shortcodes/shortcode_collapse.php',
    'includes/shortcodes/shortcode_accordion.php',
    'includes/shortcodes/shortcode_tooltip.php',
    'includes/shortcodes/shortcode_cta.php',
    'includes/shortcodes/shortcode_map.php',
    'includes/shortcodes/shortcode_table.php',
);

foreach ($tsatu_shortcode_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'tsatu'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);




add_action('init', 'tsatu_buttons');

function tsatu_buttons() {
    add_filter("mce_external_plugins", "tsatu_add_buttons");
    add_filter('mce_buttons_2', 'tsatu_register_buttons');
}

function tsatu_add_buttons($plugin_array) {
    $plugin_array['tsatu'] = get_template_directory_uri() . '/includes/shortcodes/tinymce/shortcodes-plugin.js';
    return $plugin_array;
}

function tsatu_register_buttons($buttons) {
    array_push($buttons, 'tsatu_shortcodes');
    return $buttons;
}
