<?php
/**
 * Service Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Service_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'widget_service', 'description' => __("Service item with url", 'tsatu'));
        parent::__construct('widget_service', __('Service (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $icon = ($instance ['icon']) ? $instance ['icon'] : '';
        $url = ($instance ['url']) ? $instance ['url'] : '';

        echo $before_widget;

        /**
         * Widget Content
         */
        ?>

        <div class="service-wrapper">
            <a class="service" href="<?php echo $url; ?>">
                <span class="service-icon fa <?php echo $icon; ?>"></span>
                <div class="service-title"><?php echo $title; ?></div>
            </a>
        </div>


        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = $new_instance['icon'];
        $instance['url'] = $new_instance['url'];
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => __('Service', 'tsatu'), 'icon' => 'fa-cube', 'url' => '#'));
        $title = strip_tags($instance['title']);
        $icon = esc_attr($instance['icon']);
        $url = esc_attr($instance['url']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tsatu') ?></label>

            <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   id="<?php $this->get_field_id('title'); ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon:', 'tsatu') ?></label>

            <input type="text"
                   value="<?php echo esc_attr($instance['icon']); ?>"
                   name="<?php echo $this->get_field_name('icon'); ?>"
                   id="<?php $this->get_field_id('icon'); ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Link:', 'tsatu') ?></label>

            <input type="text" value="<?php echo esc_attr($instance['url']); ?>"
                   name="<?php echo $this->get_field_name('url'); ?>"
                   id="<?php $this->get_field_id('url'); ?>" class="widefat" />
        <p>

            <?php
        }

    }
?>