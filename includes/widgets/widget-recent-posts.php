<?php
/**
 * Recent Posts Widget
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class TSATU_Recent_Posts_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_posts', 'description' => __('Recent post from some category', 'tsatu'));
        parent::__construct('widget_recent_posts', __('Recent Posts (TSATU)', 'tsatu'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $category = ($instance['category']) ? $instance['category'] : __('Category', 'tsatu');
        $columns = ($instance['columns']) ? $instance['columns'] : 2;
        $rows = ($instance['rows']) ? $instance['rows'] : 4;
        $featured = ($instance['featured']) ? $instance['featured'] : 0;
        $col_width = 0;

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */
        ?>

        <!-- popular posts -->
        <div class="recent-posts-wrapper">

            <?php
            $featured_args = array(
                'posts_per_page' => $columns * $rows,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => get_category($instance['category'])->slug
            );

            $featured_query = new WP_Query($featured_args);

            if ($featured_query->have_posts()) :
                global $more;
                $more = 0;

                for ($post_row = 1; $post_row <= $rows; $post_row++) : ?>
                    <div class="row">
                        <?php for ($post_col = 1; $post_col <= $columns; $post_col++) :
                            if ($featured_query->have_posts()) :
                                if (!(($post_col > 1) && ($post_col <= $featured) && ($post_row == 1)) &&  (get_the_content() != '')) :
                                    if (($post_col == 1) && ($post_row == 1) && ($featured > 0) ) :
                                        $col_width = $featured * 12 / $columns;
                                    else :
                                        $col_width = 12 / $columns;
                                    endif;
                                    $featured_query->the_post(); ?>
                                    <!-- post -->
                                    <div class="news col-md-<?php echo $col_width; ?> col-sm-<?php echo $col_width; ?>">
                                        <div class="news-image <?php echo get_post_format(); ?>">
                                            <a href="<?php echo get_permalink(); ?>"><?php
                                                if (get_post_format() != 'quote') {
                                                    echo get_the_post_thumbnail(get_the_ID(), 'tsatu-posts');
                                                }
                                                ?></a>
                                        </div>
                                        <div class="news-content">
                                            <a class="title" href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                            <span class="date"><?php echo date_i18n( 'j F Y', get_the_date('U')); ?></span>
                                            <span class="excerpt"><?php echo the_excerpt(); ?></span>
                                        </div>
                                    </div><!-- end post -->
                                <?php endif;
                            else : ?>
                                </div>
                                <?php break 2;
                            endif;
                        endfor; ?>
                    </div>
                <?php endfor; 
            endif;
            wp_reset_query();
            ?>
            <p class="widget-link">
                <a href="<?php echo '/category/' . get_category($instance['category'])->slug . '/' ?>" rel="bookmark"><?php _e('View All News', 'tsatu'); ?></a>
            </p>


        </div> <!-- end posts wrapper -->

        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = $new_instance['category'];
        if ($new_instance['columns'] > 4) {
            $instance['columns'] = 4;
        } elseif ($new_instance['columns'] < 1) {
            $instance['columns'] = 1;
        } else {
            $instance['columns'] = $new_instance['columns'];
        }
        if ($new_instance['rows'] > 10) {
            $instance['rows'] = 10;
        } elseif ($new_instance['rows'] < 1) {
            $instance['rows'] = 1;
        } else {
            $instance['rows'] = $new_instance['rows'];
        }
        if ($new_instance['featured'] > $instance['columns']) {
            $instance['featured'] = $instance['columns'];
        } elseif ($new_instance['featured'] < 0) {
            $instance['featured'] = 0;
        } else {
            $instance['featured'] = $new_instance['featured'];
        }
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '[:uk]Останні новини[:en]Recent News', 'category' => '', 'featured' => 2, 'columns' => 2, 'rows' => 4));
        $title = strip_tags($instance['title']);
        $category = esc_attr($instance['category']);
        $columns = esc_attr($instance['columns']);
        $rows = esc_attr($instance['rows']);

        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'tsatu') ?></label>

            <input  type="text" value="<?php echo esc_attr($instance['title']); ?>"
                    name="<?php echo $this->get_field_name('title'); ?>"
                    id="<?php $this->get_field_id('title'); ?>"
                    class="widefat" />
        </p>

        <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'tsatu') ?>:
        <?php wp_dropdown_categories(array('name' => $this->get_field_name("category"), 'selected' => $instance["category"])); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('featured'); ?>">
            <?php _e('Columns for featured post', 'tsatu') ?>:
            <input  type="number" value="<?php echo esc_attr($instance['featured']); ?>"
                    name="<?php echo $this->get_field_name('featured'); ?>"
                    id="<?php $this->get_field_id('featured'); ?>"
                    class="widefat" style="width:15%;"/><br />
                <small><?php _e( 'Set "0" to disable featured post.', 'tsatu'); ?></small>
            </label>
        <p>
        <p>
            <label for="<?php echo $this->get_field_id('columns'); ?>">
            <?php _e('Number of columns', 'tsatu') ?>:
            <input  type="number" value="<?php echo esc_attr($instance['columns']); ?>"
                    name="<?php echo $this->get_field_name('columns'); ?>"
                    id="<?php $this->get_field_id('columns'); ?>"
                    class="widefat" style="width:15%;"/>
            </label>
        <p>
        <p>
            <label for="<?php echo $this->get_field_id('rows'); ?>">
            <?php _e('Number of rows', 'tsatu') ?>:
            <input  type="number" value="<?php echo esc_attr($instance['rows']); ?>"
                    name="<?php echo $this->get_field_name('rows'); ?>"
                    id="<?php $this->get_field_id('rows'); ?>"
                    class="widefat" style="width:15%;"/>
            </label>
        <p>

    <?php
    }

}
