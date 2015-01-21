<?php
/*
 * Template Name: Full Page
 */

/**
 * The template for displaying full pages.
 *
 * @package tsatu
 */
get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part('content', 'page'); ?>

        <?php

        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
