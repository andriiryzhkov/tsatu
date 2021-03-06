<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

        <?php
        if (!is_home() && !is_front_page()) :
            get_template_part('content', 'social');
        endif;
        ?>

        <?php

        // If comments are open or we have at least one comment, load up the comment template
        if ((COMMENTS <> 0) && (comments_open() || get_comments_number())) :
            comments_template();
        endif;
        ?>

    <?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
