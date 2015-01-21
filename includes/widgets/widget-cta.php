<?php
/**
 * Social Widget
 * 
 * Based on plugin CTA Widget v1.1 (http://www.boomvisibility.com/) by Charlie Strickler 
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_CTA_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_cta jumbotron', 'description' => __('Add a Call to action box', 'tsatu'));
        parent::__construct('widget_cta', __('Call to Action (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $text = apply_filters('widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);
        $buttontext = apply_filters('widget_buttontext', empty($instance['buttontext']) ? '' : $instance['buttontext'], $instance);
        $buttonurl = apply_filters('widget_buttonurl', empty($instance['buttonurl']) ? '' : $instance['buttonurl'], $instance);
        $imageurl = apply_filters('widget_imageurl', empty($instance['imageurl']) ? '' : $instance['imageurl'], $instance);
        echo $before_widget;
        ?>						
        <?php if (!empty($imageurl)) : ?>		
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" class="img-responsive"/>
                </div>
                <div class="col-md-8">
        <?php else : ?>		
                <div class="col-md-12">
        <?php endif; ?>		
        <?php if (!empty($title)) {
            echo "<h1>" . $title . "</h1>";
        } ?>
                <p><?php echo!empty($instance['filter']) ? wpautop($text) : $text; ?></p>
                <p><a href="<?php echo $buttonurl; ?>" class="btn btn-primary btn-lg"><?php echo $buttontext; ?></a></p>
            </div>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['imageurl'] = $new_instance['imageurl'];
        $instance['buttonurl'] = $new_instance['buttonurl'];
        $instance['buttontext'] = $new_instance['buttontext'];
        if (current_user_can('unfiltered_html'))
            $instance['text'] = $new_instance['text'];
        else
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text']))); // wp_filter_post_kses() expects slashed	
        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('imageurl' => '', 'title' => '', 'text' => '', 'buttontext' => '', 'buttonurl' => ''));
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        $buttontext = esc_textarea($instance['buttontext']);
        $imageurl = esc_textarea($instance['imageurl']);
        $buttonurl = esc_textarea($instance['buttonurl']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('imageurl'); ?>"><?php _e('Image URL:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('imageurl'); ?>" name="<?php echo $this->get_field_name('imageurl'); ?>" type="text" value="<?php echo esc_attr($imageurl); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Call text:', 'tsatu'); ?></label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Button Text:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo esc_attr($buttontext); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('buttonurl'); ?>"><?php _e('Button URL:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('buttonurl'); ?>" name="<?php echo $this->get_field_name('buttonurl'); ?>" type="text" value="<?php echo esc_attr($buttonurl); ?>" /></p>

        <?php
    }

}