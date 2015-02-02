<?php
/**
 * Course post type
 *
 * @package tsatu
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('course_post_type')) {
    /**
     * Register Course Post Type
     */
    function course_post_type() {

        $labels = array(
            'name' => _x('Courses', 'Post Type General Name', 'tsatu'),
            'singular_name' => _x('Course', 'Post Type Singular Name', 'tsatu'),
            'menu_name' => __('Courses', 'tsatu'),
            'all_items' => __('All Courses', 'tsatu'),
            'view_item' => __('View Course', 'tsatu'),
            'add_new_item' => __('Add New Course', 'tsatu'),
            'add_new' => __('Add New', 'tsatu'),
            'edit_item' => __('Edit Course', 'tsatu'),
            'update_item' => __('Update Course', 'tsatu'),
            'search_items' => __('Search Courses', 'tsatu'),
            'not_found' => __('No Courses found', 'tsatu'),
            'not_found_in_trash' => __('Not Courses found in Trash', 'tsatu'),
        );
        $args = array(
            'label' => __('course', 'tsatu'),
            'description' => __('Course', 'tsatu'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'page-attributes'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 22,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('course', $args);
        flush_rewrite_rules();
    }

    add_action('init', 'course_post_type', 0);
}

if (!function_exists('add_course_metabox')) {
    /**
     * Add course metabox
     */
    function add_course_metabox()
    {
        add_meta_box('course_details', 'Course details', 'display_course_metabox', 'course', 'normal', 'high'
        );
    }

    add_action('add_meta_boxes', 'add_course_metabox');
}

if (!function_exists('display_course_metabox')) {
    /**
     * Course details metabox display function
     */
    function display_course_metabox($course_post)
    {
        // Retrieve current name of the Director and Movie Rating based on review ID
        $course_lecture = esc_html(get_post_meta($course_post->ID, 'course_lecture', true));
        $course_links = esc_html(get_post_meta($course_post->ID, 'course_links', true));
        $people_query = new WP_Query(array('post_type' => 'people', 'order' => 'ASC', 'post_status' => 'publish'))
        ?>
        <table>
            <tr>
                <td><?php _e('Lecture', 'tsatu'); ?>:</td>
                <td>
                    <select name="course_lecture" id="course_moodle_select">
                        <option value="none"><?php _e('Not selected', 'tsatu'); ?></option>
                        <?php if ($people_query->have_posts()) :
                            while ($people_query->have_posts()) : $people_query->the_post(); ?>
                                <option
                                    value="<?php echo the_ID(); ?>" <?php selected($course_lecture, get_the_ID()); ?>><?php echo the_title(); ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php _e('Links', 'tsatu'); ?>:</td>
                <td><input type="text" size="80" name="course_links" value="<?php echo $course_lecture; ?>"/><br/>
                    <small><?php _e('Separate links with commas', 'tsatu'); ?></small>
                </td>
            </tr>
        </table>
    <?php
    }
}

if (!function_exists('add_course_fields')) {
    /**
     * Save faculty function
     */
    function add_course_fields($course_post_id, $course_post)
    {
        // Checks save status
        $is_autosave = wp_is_post_autosave($course_post_id);
        $is_revision = wp_is_post_revision($course_post_id);
        $is_valid_nonce = (isset($_POST['course_nonce']) && wp_verify_nonce($_POST['course_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
//    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
//        return;
//    }
        // Check post type for movie reviews
        if ($course_post->post_type == 'course') {
            // Store data in post meta table if present in post data
            if (isset($_POST['course_lecture']) && $_POST['course_lecture'] != '') {
                if ($_POST['course_lecture'] == 'none') {
                    delete_post_meta($course_post_id, 'course_lecture');
                } else {
                    update_post_meta($course_post_id, 'course_lecture', $_POST['course_lecture']);
                }
            }
            if (isset($_POST['course_links']) && $_POST['course_links'] != '') {
                update_post_meta($course_post_id, 'course_links', $_POST['course_links']);
            }
        }
    }

    add_action('save_post', 'add_course_fields', 10, 2);
}

if (!function_exists('course_enter_title')) {
    /**
     * Change Text Prompt on post title
     */
    function course_enter_title($input)
    {
        global $post_type;

        if (is_admin() && 'course' == $post_type)
            return __('Enter title of the course here', 'tsatu');

        return $input;
    }

    add_filter('enter_title_here', 'course_enter_title');
}

if (!function_exists('course_major_taxonomy')) {
   /**
     * Register Major Taxonomy
     */
    function course_major_taxonomy() {

        $labels = array(
            'name' => _x('Major', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Major', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Majors', 'tsatu'),
            'all_items' => __('All Majors', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Major Name', 'tsatu'),
            'add_new_item' => __('Add New Major', 'tsatu'),
            'edit_item' => __('Edit Major', 'tsatu'),
            'update_item' => __('Update Major', 'tsatu'),
            'separate_items_with_commas' => __('Separate majors with commas', 'tsatu'),
            'search_items' => __('Search Majors', 'tsatu'),
            'add_or_remove_items' => __('Add or remove majors', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used majors', 'tsatu'),
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
        register_taxonomy('course_major', array('course'), $args);
    }

    add_action('init', 'course_major_taxonomy', 0);
}

if (!function_exists('course_level_taxonomy')) {
    /**
     * Register Level Taxonomy
     */
    function course_level_taxonomy() {

        $labels = array(
            'name' => _x('Level', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Level', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Levels', 'tsatu'),
            'all_items' => __('All Levels', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Level Name', 'tsatu'),
            'add_new_item' => __('Add New Level', 'tsatu'),
            'edit_item' => __('Edit Level', 'tsatu'),
            'update_item' => __('Update Level', 'tsatu'),
            'separate_items_with_commas' => __('Separate levels with commas', 'tsatu'),
            'search_items' => __('Search Levels', 'tsatu'),
            'add_or_remove_items' => __('Add or remove levels', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used levels', 'tsatu'),
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
        register_taxonomy('course_level', array('course'), $args);
    }

    add_action('init', 'course_level_taxonomy', 0);
}

if (!function_exists('course_year_taxonomy')) {
    /**
     * Register Year Taxonomy
     */
    function course_year_taxonomy() {

        $labels = array(
            'name' => _x('Year', 'Taxonomy General Name', 'tsatu'),
            'singular_name' => _x('Year', 'Taxonomy Singular Name', 'tsatu'),
            'menu_name' => __('Years', 'tsatu'),
            'all_items' => __('All Years', 'tsatu'),
            'parent_item' => NULL,
            'parent_item_colon' => NULL,
            'new_item_name' => __('New Year Name', 'tsatu'),
            'add_new_item' => __('Add New Year', 'tsatu'),
            'edit_item' => __('Edit Year', 'tsatu'),
            'update_item' => __('Update Year', 'tsatu'),
            'separate_items_with_commas' => __('Separate years with commas', 'tsatu'),
            'search_items' => __('Search Years', 'tsatu'),
            'add_or_remove_items' => __('Add or remove years', 'tsatu'),
            'choose_from_most_used' => __('Choose from the most used years', 'tsatu'),
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
        register_taxonomy('course_year', array('course'), $args);
    }

    add_action('init', 'course_year_taxonomy', 0);
}

if (!function_exists('the_lecture')) {
   /**
     * Get the lecture
     */
    function the_lecture($course_ID) {
        $lecture_ID = esc_html( get_post_meta( $course_ID, 'course_lecture', true ) );
        $lecture_post = get_post($lecture_ID);
        return '<a href="' . get_permalink($lecture_post->ID) . '" ><div>' . $lecture_post->post_title . '</div></a>' ;
    }
}

if (!function_exists('the_course_links')) {
    /**
     * Get the course links
     */
    function the_course_links($course_ID) {
        $links = explode(',', esc_html( get_post_meta( $course_ID, 'course_links', true ) ) );
        if (!empty($links) && !is_wp_error($links)) {
            foreach ($links as $link) {
                $links_list .= '<div><a href="' . $link . '">' . $link . '</a></div>';
            }
        }
        return $links_list;
    }
}

if (!function_exists('insert_course')) {
    /**
     * Inject course archive on corresponding page
     */
    function insert_course($content)
    {
        if (get_theme_mod('course_page') == get_the_ID()) {

            ob_start();

            $query = new WP_Query(array('post_type' => 'course', 'order' => 'ASC', 'post_status' => 'publish'));
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('content', 'course'); ?>
                <?php endwhile;
            endif;

            $content .= ob_get_clean();
        }

        return $content;
    }

    add_filter('the_content', 'insert_course');
}



if (!function_exists('course_editor_content')) {
    /**
     * Set default editor content
     */
    function course_editor_content($content)
    {
        if ('course' == get_post_type()) {
            $content = '<h2>Біографія</h2>';
            return $content;
        } else {
            return $content;
        }
    }

    add_filter( 'default_content', 'course_editor_content' );
}

