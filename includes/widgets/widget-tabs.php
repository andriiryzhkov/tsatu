<?php
/**
 * Tabs Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Tabs_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_tabs', 'description' => __('Add tabs to the page', 'tsatu'));
        parent::__construct('tsatu-tabs', __('Tabs', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        $tab_nav = '';
        $tab_content = '';

        $query = new WP_Query(array('post_type' => 'tab', 'cat' => 'home', 'order' => 'ASC', 'post_status' => 'publish'));
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $tab_active = (esc_html(get_post_meta(get_the_ID(), 'tab_active', true)) == 'on') ? 'active' : '';
                $tab_nav .= '<li class="'. $tab_active .'"><a href="#' . get_the_ID() . '" data-toggle="tab">' . get_the_title() . '</a></li>';
                $tab_content .= '<div class="tab-pane ' . $tab_active . '" id="' . get_the_ID() . '">'
                        . get_the_content()
                        . '</div>';
            }
        } ?>

        <div class="row">
            <ul id="tabs" class="nav nav-tabs nav-justified" data-tabs="tabs">
                <?php echo $tab_nav; ?>
            </ul>
            <div id="widget-tab-content" class="tab-content col-md-9">
                <?php echo $tab_content; ?>
            </div>
        </div>

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