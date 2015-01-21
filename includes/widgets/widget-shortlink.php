<?php
/**
 * Shortlink Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Shortlink_Widget extends WP_Widget {

    public function __construct() {
            $widget_ops = array('classname' => 'widget_shortlink', 'description' => __( 'Shortlink', 'tsatu') );
            parent::__construct('widget_shortlink', __( 'Shortlink (TSATU)', 'tsatu'), $widget_ops);
    }


    function widget($args, $instance) {
        extract($args);
        $title = ($instance ['title']) ? $instance ['title'] : __('Shortlink Title', 'tsatu');
        $icon = ($instance ['icon']) ? $instance ['icon'] : __('Icon', 'tsatu');
        $link = ($instance ['link']) ? $instance ['link'] : __('Link', 'tsatu');

        echo $before_widget;

        /**
         * Widget Content
         */
        ?>

        <div class="shortlink-wrapper">
            <a class="shortlink" href="<?php echo $link; ?>">
                <span class="shortlink-icon"><i class="fa <?php echo $icon; ?>"></i></span>
                <span class="shortlink-title"><?php echo $title; ?></span>
            </a>
        </div>


        <?php
        echo $after_widget;
    }

    function form($instance) {
        if (!isset($instance ['title']))
            $instance ['title'] = __('Shortlink', 'tsatu');
        if (!isset($instance ['icon']))
            $instance ['icon'] = 'fa-exclamation-triangle';
        if (!isset($instance ['link']))
            $instance ['link'] = '#';
        ?>

        <!-- service 1 -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'tsatu') ?></label>

            <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   id="<?php $this->get_field_id('title'); ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon', 'tsatu') ?></label>

            <input type="text"
                   value="<?php echo esc_attr($instance['icon']); ?>"
                   name="<?php echo $this->get_field_name('icon'); ?>"
                   id="<?php $this->get_field_id('icon'); ?>" class="widefat" />
            <br />
            <small><a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><?php _e( 'Name of Font Awesome icon.' , 'tsatu'); ?></a></small>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'tsatu') ?></label>

            <input type="text" value="<?php echo esc_attr($instance['link']); ?>"
                   name="<?php echo $this->get_field_name('link'); ?>"
                   id="<?php $this->get_field_id('link'); ?>" class="widefat" />
        <p>

        <?php
    }

}
?>