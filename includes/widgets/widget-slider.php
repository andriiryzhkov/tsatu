<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TSATU_Slider_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_slider', 'description' => __('Add slider to the page', 'tsatu'));
        parent::__construct('widget_slider', __('Slider (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $count = ($instance['count']) ? $instance['count'] : 3;

        echo $before_widget;
        
        tsatu_slider(get_option('num_slides'), 'slider-widget');
        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['count'] = $new_instance['count'];
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('count' => 3));
        $count = esc_attr($instance['count']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>">
            <?php _e('Number of slides', 'tsatu') ?>:
            <input  type="number" value="<?php echo esc_attr($instance['count']); ?>"
                    name="<?php echo $this->get_field_name('count'); ?>"
                    id="<?php $this->get_field_id('count'); ?>"
                    class="widefat" style="width:15%;"/><br />
            </label>
        <p>
        
        <?php
    }

}
?>