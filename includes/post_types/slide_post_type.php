<?php
/**
 * Slide custom post type
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('slide_post_type')) {

// Register Slide Post Type
    function slide_post_type() {

        $labels = array(
            'name' => _x('Slides', 'Post Type General Name', 'tsatu'),
            'singular_name' => _x('Slide', 'Post Type Singular Name', 'tsatu'),
            'menu_name' => __('Slides', 'tsatu'),
            'all_items' => __('All Slides', 'tsatu'),
            'view_item' => __('View Slide', 'tsatu'),
            'add_new_item' => __('Add New Slide', 'tsatu'),
            'add_new' => __('Add New', 'tsatu'),
            'edit_item' => __('Edit Slide', 'tsatu'),
            'update_item' => __('Update Slide', 'tsatu'),
            'search_items' => __('Search Slides', 'tsatu'),
            'not_found' => __('No Slides found', 'tsatu'),
            'not_found_in_trash' => __('Not Slides found in Trash', 'tsatu'),
        );
        $args = array(
            'label' => __('slides', 'tsatu'),
            'description' => __('Slide', 'tsatu'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
            'menu_position' => 16,
            'menu_icon' => 'dashicons-slides',
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('slide', $args);
    }

    // Hook into the 'init' action
    add_action('init', 'slide_post_type', 0);
}

// Add slide metabox
function add_slide_metabox() {
    add_meta_box( 'slide_details',
        __('Slide details', 'tsatu'),
        'display_slide_metabox',
        'slide', 'normal', 'high'
    );
}
add_action( 'add_meta_boxes', 'add_slide_metabox' );

// Slide details metabox display function
function display_slide_metabox( $slide_post ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $slide_url = esc_html( get_post_meta( $slide_post->ID, 'slide_url', true ) );
    ?>
    <table>
        <tr>
            <td><?php _e('Internal relative URL:', 'tsatu'); ?></td>
            <td><input type="text" size="100%" name="slide_url" value="<?php echo $slide_url; ?>" /></td>
        </tr>
    </table>
    <?php
}

// Save slide function
function add_slide_fields( $slide_post_id, $slide_post ) {
    // Check post type for movie reviews
    if ( $slide_post->post_type == 'slide' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['slide_url'] ) && $_POST['slide_url'] != '' ) {
            update_post_meta( $slide_post_id, 'slide_url', $_POST['slide_url'] );
        }
    }
}
add_action( 'save_post', 'add_slide_fields', 10, 2);