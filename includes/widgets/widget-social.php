<?php
/**
 * Social Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Social_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_social', 'description' => __("Social icons list", 'tsatu'));
        parent::__construct('tsatu-social', __('Social icons (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        echo '<div class="social-icons">';
        tsatu_social();
        echo '</div>';
        echo $after_widget;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    
    
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => __('Follow us', 'tsatu')));
        $title = strip_tags($instance['title']);
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tsatu') ?></label>

            <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   id="<?php $this->get_field_id('title'); ?>"
                   class="widefat" />
        </p>

        <?php
    }

}
?>