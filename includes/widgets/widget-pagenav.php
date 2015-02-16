<?php
/**
 * Pages Navigation Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Pagenav_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'widget_pagenav', 'description' => __('List of correspoding pages', 'tsatu'));
        parent::__construct('tsatu-pagenav', __('Pages Navigation', 'tsatu'), $widget_ops);
    }

    public function widget($args, $instance) {
        extract($args);

        $exclude = empty($instance['exclude']) ? '' : $instance['exclude'];
        global $post;

        if (wp_get_post_parent_id($post->ID)) {
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            $top_ancestor_id = $ancestors[0];
        } else {
            $top_ancestor_id = $post->ID;
        }

        $title = get_the_title($top_ancestor_id);

        $out = wp_list_pages(array(
            'title_li' => '',
            'child_of' => $top_ancestor_id,
            'echo' => 0,
            'sort_column' => 'menu_order'
                ));

        if (!empty($out)) {
            echo $args['before_widget'];
            if ($title) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            ?>
            <ul id="pagenav">
                <?php echo $out; ?>
            </ul>
            <?php
            echo $args['after_widget'];
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['exclude'] = strip_tags($new_instance['exclude']);

        return $instance;
    }

    public function form($instance) {
        //Defaults
        $instance = wp_parse_args((array) $instance, array('exclude' => ''));
        $exclude = esc_attr($instance['exclude']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Exclude:'); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
            <br />
            <small><?php _e('Page IDs, separated by commas.'); ?></small>
        </p>
        <?php
    }

}
