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

class TSATU_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{

    public function widget($args, $instance)
    {
        $cache = array();
        if (!$this->is_preview()) {
            $cache = wp_cache_get('widget_recent_posts', 'widget');
        }

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts');

        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number)
            $number = 5;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;

        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page' => $number,
            'category_name' => 'news',
            'no_found_rows' => true,
            'post_status' => 'publish',
            'ignore_sticky_posts' => false
        )));

        if ($r->have_posts()) :
            ?>
            <?php echo $args['before_widget']; ?>
            <?php if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
            <ul>
                <?php while ($r->have_posts()) : $r->the_post(); ?>
                    <li>
                        <div class="post-image <?php echo get_post_format(); ?>">
                            <a href="<?php echo the_permalink(); ?>"><?php
                                if (get_post_format() != 'quote') {
                                    if ( has_post_thumbnail() ) {
                                        echo get_the_post_thumbnail(get_the_ID(), 'tsatu-small');
                                    } else { ?>
                                        <img class="img-responsive wp-post-image" src="<?php echo get_template_directory_uri() ?>/assets/img/default-image100x100.jpg" />
                                    <?php }
                                } ?>
                            </a>
                            <?php if ($show_date) : ?>
                                <div class="post-date"><?php echo get_the_date(); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="post-content <?php echo get_post_format(); ?>">
                            <a class="post-title" href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                            <div class="post-excerpt"><?php echo the_excerpt(); ?></div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <p class="widget-link">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" rel="bookmark"><?php _e('View All News', 'tsatu'); ?></a>
            </p>
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;

        if (!$this->is_preview()) {
            $cache[$args['widget_id']] = ob_get_flush();
            wp_cache_set('widget_recent_posts', $cache, 'widget');
        } else {
            ob_end_flush();
        }
    }
}
