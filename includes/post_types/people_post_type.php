<?php
/**
 * People post type
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('people_post_type')) {
    /**
     * Register People Post Type
     */
    function people_post_type()
    {

        $labels = array(
            'name' => _x('People', 'Post Type General Name', 'tsatu'),
            'singular_name' => _x('People', 'Post Type Singular Name', 'tsatu'),
            'menu_name' => __('People', 'tsatu'),
            'parent_item_colon' => __('Parent Profile:', 'tsatu'),
            'all_items' => __('All People', 'tsatu'),
            'view_item' => __('View Profile', 'tsatu'),
            'add_new_item' => __('Add New Profile', 'tsatu'),
            'add_new' => __('Add New', 'tsatu'),
            'edit_item' => __('Edit Profile', 'tsatu'),
            'update_item' => __('Update Profile', 'tsatu'),
            'search_items' => __('Search Profiles', 'tsatu'),
            'not_found' => __('No Profiles found', 'tsatu'),
            'not_found_in_trash' => __('Not Profiles found in Trash', 'tsatu'),
        );
        $args = array(
            'label' => __('people', 'tsatu'),
            'description' => __('Faculty and Staff', 'tsatu'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 21,
            'menu_icon' => 'dashicons-id',
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'rewrite' => true,
        );
        register_post_type('people', $args);
        flush_rewrite_rules();
    }

    // Hook into the 'init' action
    add_action('init', 'people_post_type', 0);
}

if (!function_exists('add_people_metabox')) {
    /**
     * Add people metabox
     */
    function add_people_metabox()
    {
        add_meta_box('people_details', __('Profile details', 'tsatu'), 'display_people_metabox', 'people', 'normal', 'high');
    }

    add_action('add_meta_boxes', 'add_people_metabox');
}

if (!function_exists('display_people_metabox')) {
    /**
     * People details metabox display function
     */
    function display_people_metabox($people_post)
    {
        wp_nonce_field(basename(__FILE__), 'people_nonce');
        // Retrieve current name of the Director and Movie Rating based on review ID
        $people_office = esc_html(get_post_meta($people_post->ID, 'people_office', true));
        $people_phone = esc_html(get_post_meta($people_post->ID, 'people_phone', true));
        $people_email = esc_html(get_post_meta($people_post->ID, 'people_email', true));
        $people_moodle = esc_html(get_post_meta($people_post->ID, 'people_moodle', true));
        $people_facebook = esc_html(get_post_meta($people_post->ID, 'people_facebook', true));
        $people_google = esc_html(get_post_meta($people_post->ID, 'people_google', true));
        $people_tweeter = esc_html(get_post_meta($people_post->ID, 'people_twitter', true));
        $people_linkedin = esc_html(get_post_meta($people_post->ID, 'people_linkedin', true));
        ?>
        <table>
            <tr>
                <th colspan="2" style="text-align: left;"><?php _e('Contact Details', 'tsatu'); ?></th>
            </tr>
            <tr>
                <td><?php _e('Office:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_office" value="<?php echo $people_office; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('Phone number:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_phone" value="<?php echo $people_phone; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('Email:', 'tsatu'); ?></td>
                <td><input type="email" size="80" name="people_email" value="<?php echo $people_email; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('Moodle:', 'tsatu'); ?></td>
                <td><input type="url" size="80" name="people_moodle" value="<?php echo $people_moodle; ?>"/></td>
            </tr>
            <tr>
                <th colspan="2" style="text-align: left;"><?php _e('Social Networks', 'tsatu'); ?></th>
            </tr>
            <tr>
                <td><?php _e('Facebook:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_facebook" value="<?php echo $people_facebook; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('Google Plus:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_google" value="<?php echo $people_google; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('Twitter:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_twitter" value="<?php echo $people_tweeter; ?>"/></td>
            </tr>
            <tr>
                <td><?php _e('LinkedIn:', 'tsatu'); ?></td>
                <td><input type="text" size="80" name="people_linkedin" value="<?php echo $people_linkedin; ?>"/></td>
            </tr>
        </table>
    <?php
    }
}

if (!function_exists('add_people_fields')) {
    /**
     * Save people function
     */
    function add_people_fields($people_post_id, $people_post)
    {
        // Checks save status
        $is_autosave = wp_is_post_autosave($people_post_id);
        $is_revision = wp_is_post_revision($people_post_id);
        $is_valid_nonce = (isset($_POST['people_nonce']) && wp_verify_nonce($_POST['people_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        // Check post type for movie reviews
        if ($people_post->post_type == 'people') {
            // Store data in post meta table if present in post data
            if (isset($_POST['people_office'])) {
                update_post_meta($people_post_id, 'people_office', $_POST['people_office']);
            }
            if (isset($_POST['people_phone'])) {
                update_post_meta($people_post_id, 'people_phone', $_POST['people_phone']);
            }
            if (isset($_POST['people_email'])) {
                update_post_meta($people_post_id, 'people_email', $_POST['people_email']);
            }
            if (isset($_POST['people_moodle'])) {
                update_post_meta($people_post_id, 'people_moodle', $_POST['people_moodle']);
            }
            if (isset($_POST['people_facebook'])) {
                update_post_meta($people_post_id, 'people_facebook', $_POST['people_facebook']);
            }
            if (isset($_POST['people_google'])) {
                update_post_meta($people_post_id, 'people_google', $_POST['people_google']);
            }
            if (isset($_POST['people_twitter'])) {
                update_post_meta($people_post_id, 'people_twitter', $_POST['people_twitter']);
            }
            if (isset($_POST['people_linkedin'])) {
                update_post_meta($people_post_id, 'people_linkedin', $_POST['people_linkedin']);
            }
        }
    }

    add_action('save_post', 'add_people_fields', 10, 2);
}

if (!function_exists('custom_enter_title')) {
    /**
     * Change Text Prompt on post title
     */
    function custom_enter_title($input)
    {
        global $post_type;

        if (is_admin() && 'people' == $post_type)
            return __('Enter the last name and first name of the individual here', 'tsatu');

        return $input;
    }

    add_filter('enter_title_here', 'custom_enter_title');
}


if (!function_exists('people_position_taxonomy')) {
    /**
     * Register Position Taxonomy
     */
    function people_position_taxonomy()
    {

        $labels = array(
            'name' => _x('Positions', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Position', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Positions', 'tsatu'),
            'all_items' => __('All Positions', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Position Name', 'tsatu'),
            'add_new_item' => __('Add New Position', 'tsatu'),
            'edit_item' => __('Edit Position', 'tsatu'),
            'update_item' => __('Update Position', 'tsatu'),
            'separate_items_with_commas' => __('Separate positions with commas', 'tsatu'),
            'search_items' => __('Search Position', 'tsatu'),
            'add_or_remove_items' => __('Add or remove Positions', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used positions', 'tsatu'),
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
        register_taxonomy('people_position', array('people'), $args);
    }

    add_action('init', 'people_position_taxonomy', 0);
}

if (!function_exists('people_degree_taxonomy')) {
    /**
     * Register Degree Taxonomy
     */
    function people_degree_taxonomy()
    {

        $labels = array(
            'name' => _x('Degrees', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Degree', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Degrees', 'tsatu'),
            'all_items' => __('All Degrees', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Degree Name', 'tsatu'),
            'add_new_item' => __('Add New Degree', 'tsatu'),
            'edit_item' => __('Edit Degree', 'tsatu'),
            'update_item' => __('Update Degree', 'tsatu'),
            'separate_items_with_commas' => __('Separate degrees with commas', 'tsatu'),
            'search_items' => __('Search Degree', 'tsatu'),
            'add_or_remove_items' => __('Add or remove Degrees', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used degrees', 'tsatu'),
            'not_found' => __('Not Found', 'tsatu'),
        );

        $capabilities = array(
            'manage_terms' => 'manage_network',
            'edit_terms' => 'manage_network',
            'delete_terms' => 'manage_network',
            'assign_terms' => 'edit_posts',
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => false,
            'show_tagcloud' => false,
            //'capabilities' => $capabilities,
        );

        register_taxonomy('people_degree', array('people'), $args);
    }

    add_action('init', 'people_degree_taxonomy', 0);
}

// Add nonexistent degree terms
//if(!term_exists('Доктор філософії', 'people_degree'))
//    wp_insert_term('Доктор філософії', 'people_degree', array('slug' => 'phd'));
//if(!term_exists('Доктор наук', 'people_degree'))
//    wp_insert_term('Доктор наук', 'people_degree', array('slug' => 'dsc'));

if (!function_exists('people_title_taxonomy')) {
    /**
     * Register Title Taxonomy
     */
    function people_title_taxonomy()
    {

        $labels = array(
            'name' => _x('Title', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Title', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Titles', 'tsatu'),
            'all_items' => __('All Titles', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Title Name', 'tsatu'),
            'add_new_item' => __('Add New Title', 'tsatu'),
            'edit_item' => __('Edit Title', 'tsatu'),
            'update_item' => __('Update Title', 'tsatu'),
            'separate_items_with_commas' => __('Separate titles with commas', 'tsatu'),
            'search_items' => __('Search Titles', 'tsatu'),
            'add_or_remove_items' => __('Add or remove titles', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used titles', 'tsatu'),
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
        register_taxonomy('people_title', array('people'), $args);
    }

    add_action('init', 'people_title_taxonomy', 0);
}

if (!function_exists('inject_people')) {
    /**
     * Inject people archive on corresponding page
     */
    function inject_people($content)
    {
        if (get_theme_mod('people_page') == get_the_ID()) {

            ob_start();

            $query = new WP_Query(array('post_type' => 'people', 'orderby' => 'menu_order title', 'order' => 'ASC', 'post_status' => 'publish', 'posts_per_page' => -1));
            if ($query->have_posts()) : ?>
                <div class="row">
                    <?php
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('content', 'people');
                    endwhile; ?>
                </div>
            <?php
            endif;

            $content .= ob_get_clean();
        }

        return $content;
    }

    add_filter('the_content', 'inject_people');
}

if (!function_exists('people_editor_content')) {
    /**
     * Set default editor content
     */
    function people_editor_content($content)
    {
        if ('people' == get_post_type()) {
            $content = __('<h2>Biography</h2>', 'tsatu');
        }
        return $content;
    }

    add_filter('default_content', 'people_editor_content');
}
