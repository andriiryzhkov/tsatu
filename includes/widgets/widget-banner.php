<?php
/**
 * Banner Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Banner_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_banner', 'description' => __('Add banners to the page', 'tsatu'));
        parent::__construct('widget_banner', __('Banner (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        ?>        						

        <?php $query = new WP_Query(array('post_type' => 'banner', 'order' => 'ASC', 'post_status' => 'publish'));
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                global $more;
                $more = 0; ?>
                <a href="<?php echo esc_html( get_post_meta( get_the_ID(), 'banner_url', true ) ); ?>" target="_blank">
                    <div class="banner-item">
                        <?php if ((function_exists('has_post_thumbnail')) && ( has_post_thumbnail() )) 
                            echo get_the_post_thumbnail();
                        if (get_the_title() != '')
                            echo '<div class="banner-title">' . get_the_title() . '</div>'; ?>
                    </div>
                </a>
            <?php endwhile;
                endif; ?>

        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'columns' => 4));
        $title = strip_tags($instance['title']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tsatu'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <?php
    }

}