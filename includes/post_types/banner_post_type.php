<?php
/**
 * Banner custom post type
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('banner_post_type')) {

// Register Banner Post Type
    function banner_post_type() {

        $labels = array(
            'name' => _x('Banners', 'Post Type General Name', 'tsatu'),
            'singular_name' => _x('Banner', 'Post Type Singular Name', 'tsatu'),
            'menu_name' => __('Banners', 'tsatu'),
            'all_items' => __('All Banners', 'tsatu'),
            'view_item' => __('View Banner', 'tsatu'),
            'add_new_item' => __('Add New Banner', 'tsatu'),
            'add_new' => __('Add New', 'tsatu'),
            'edit_item' => __('Edit Banner', 'tsatu'),
            'update_item' => __('Update Banner', 'tsatu'),
            'search_items' => __('Search Banners', 'tsatu'),
            'not_found' => __('No Banners found', 'tsatu'),
            'not_found_in_trash' => __('Not Banners found in Trash', 'tsatu'),
        );
        $args = array(
            'label' => __('banners', 'tsatu'),
            'description' => __('Banner', 'tsatu'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
            'menu_position' => 17,
            'menu_icon' => 'dashicons-images-alt',
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('banner', $args);
    }

    // Hook into the 'init' action
    add_action('init', 'banner_post_type', 0);
}

// Add banner metabox
function add_banner_metabox() {
    add_meta_box( 'banner_details',
        __('Banner details', 'tsatu'),
        'display_banner_metabox',
        'banner', 'normal', 'high'
    );
}
add_action( 'add_meta_boxes', 'add_banner_metabox' );

// Banner details metabox display function
function display_banner_metabox( $banner_post ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $banner_url = esc_html( get_post_meta( $banner_post->ID, 'banner_url', true ) );
    ?>
    <table>
        <tr>
            <td><?php _e('URL:', 'tsatu'); ?></td>
            <td><input type="url" size="100%" name="banner_url" value="<?php echo $banner_url; ?>" /></td>
        </tr>
    </table>
    <?php
}

// Save banner function
function add_banner_fields( $banner_post_id, $banner_post ) {
    // Check post type for movie reviews
    if ( $banner_post->post_type == 'banner' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['banner_url'] ) && $_POST['banner_url'] != '' ) {
            update_post_meta( $banner_post_id, 'banner_url', $_POST['banner_url'] );
        }
    }
}
add_action( 'save_post', 'add_banner_fields', 10, 2);