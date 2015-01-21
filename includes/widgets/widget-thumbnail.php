<?php
/**
 * Thumbnail Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Thumbnail_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'widget_thumbnail', 'description' => __("Thumbnail for current post or page", 'tsatu'));
        parent::__construct('widget_thumbnail', __('Thumbnail (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);

        echo $before_widget;

        if (is_single() && has_post_thumbnail() && get_post_type() != 'faculty') {
            echo '<div class="widget-thumbnail">';
            echo get_the_post_thumbnail(get_the_ID(), 'tsatu-single');
            echo '</div>';
        }

        echo $after_widget;
    }

}
?>