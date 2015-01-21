<?php
/**
 * Tabs custom post type
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('tab_post_type')) {

// Register Tab Post Type
    function tab_post_type() {

        $labels = array(
            'name' => _x('Tabs', 'Post Type General Name', 'tsatu'),
            'singular_name' => _x('Tab', 'Post Type Singular Name', 'tsatu'),
            'menu_name' => __('Tabs', 'tsatu'),
            'all_items' => __('All Tabs', 'tsatu'),
            'view_item' => __('View Tab', 'tsatu'),
            'add_new_item' => __('Add New Tab', 'tsatu'),
            'add_new' => __('Add New', 'tsatu'),
            'edit_item' => __('Edit Tab', 'tsatu'),
            'update_item' => __('Update Tab', 'tsatu'),
            'search_items' => __('Search Tabs', 'tsatu'),
            'not_found' => __('No Tabs found', 'tsatu'),
            'not_found_in_trash' => __('Not Tabs found in Trash', 'tsatu'),
        );
        $args = array(
            'label' => __('tabs', 'tsatu'),
            'description' => __('Tab', 'tsatu'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'page-attributes'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
            'menu_position' => 18,
            'menu_icon' => 'dashicons-index-card',
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('tab', $args);
    }

    // Hook into the 'init' action
    add_action('init', 'tab_post_type', 0);
}


if (!function_exists('tab_category_taxonomy')) {

// Register Category Taxonomy
    function tab_category_taxonomy() {

        $labels = array(
            'name' => _x('Categories', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Category', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Categories', 'tsatu'),
            'all_items' => __('All Categories', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Category Name', 'tsatu'),
            'add_new_item' => __('Add New Category', 'tsatu'),
            'edit_item' => __('Edit Category', 'tsatu'),
            'update_item' => __('Update Category', 'tsatu'),
            'separate_items_with_commas' => __('Separate categories with commas', 'tsatu'),
            'search_items' => __('Search Category', 'tsatu'),
            'add_or_remove_items' => __('Add or remove Categories', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used categories', 'tsatu'),
            'not_found' => __('Not Found', 'tsatu'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => false,
            'show_tagcloud' => false,
        );
        register_taxonomy('tab_category', array('tab'), $args);
    }

// Hook into the 'init' action
    add_action('init', 'tab_category_taxonomy', 0);
}

// Add tab metabox
function add_tab_metabox() {
    add_meta_box( 'tab_details',
        __('Tab defaults', 'tsatu'),
        'display_tab_metabox',
        'tab', 'side', 'low'
    );
}
add_action( 'add_meta_boxes', 'add_tab_metabox' );

// Banner details metabox display function
function display_tab_metabox( $tab_post ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $tab_active = esc_html( get_post_meta( $tab_post->ID, 'tab_active', true ) );
    ?>
    <p>
        <input type="checkbox" id="tab_active" name="tab_active" <?php checked( $tab_active, 'on' ); ?> />
        <label for="tab_active"><?php _e('Active tab', 'tsatu'); ?></label>
    </p>
    <?php
}

// Save banner function
function add_tab_fields( $tab_post_id, $tab_post ) {
    // Check post type for movie reviews
    if ( $tab_post->post_type == 'tab' ) {
        // Store data in post meta table if present in post data
        $active = isset( $_POST['tab_active'] ) && $_POST['tab_active'] ? 'on' : 'off';
        update_post_meta( $tab_post_id, 'tab_active', $active );
        //if ( isset( $_POST['tab_active'] ) && $_POST['tab_active'] != '' ) {
        //    update_post_meta( $banner_post_id, 'tab_active', $_POST['tab_active'] );
        //}
    }
}
add_action( 'save_post', 'add_tab_fields', 10, 2);