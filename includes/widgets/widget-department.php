<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class TSATU_Department_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_department well', 'description' => __('Add a department welcome screen', 'tsatu'));
        parent::__construct('tsatu-department', __('Department Welcome', 'tsatu'), $widget_ops);
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
        <div class="row">
            <div class="col-md-9">
                <?php if (!empty($title)) : ?>
                    <h2><?php echo $title; ?></h2>
                <?php endif; ?>		
                <p><?php echo!empty($instance['filter']) ? wpautop($text) : $text; ?></p>
                <p><a href="<?php echo $buttonurl; ?>" class="btn btn-primary btn-lg"><?php echo $buttontext; ?></a></p>
            </div>
            <div class="col-md-3">
                <img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" class="img-responsive"/>
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
        $instance = wp_parse_args((array) $instance, array('imageurl' => '', 
            'title' => '[:uk]Вітаємо на сайті нашої кафедри![:en]Welcome to our department!', 
            'text' => '[:uk]Вітання українською[:en]Welcome in English', 
            'buttontext' => '[:uk]Дізнайся більше про кафедру[:en]Find out more about the department', 
            'buttonurl' => '#'));
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        $imageurl = esc_textarea($instance['imageurl']);
        $buttontext = esc_textarea($instance['buttontext']);
        $buttonurl = esc_textarea($instance['buttonurl']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('imageurl'); ?>"><?php _e('Image URL:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('imageurl'); ?>" name="<?php echo $this->get_field_name('imageurl'); ?>" type="text" value="<?php echo esc_attr($imageurl); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Welcome text:', 'tsatu'); ?></label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Button Text:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo esc_attr($buttontext); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('buttonurl'); ?>"><?php _e('Button URL:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('buttonurl'); ?>" name="<?php echo $this->get_field_name('buttonurl'); ?>" type="text" value="<?php echo esc_attr($buttonurl); ?>" /></p>

        <?php
    }

}