<?php
/**
 * The template for displaying course.
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?>>
        <header>
            <div class="entry-title"><h1><?php the_title(); ?></h1></div>
        </header>
        <div class="well course-info">
            <table>
                <tr>
                    <td class="head"><?php echo _x('Major', 'Taxonomy General Name', 'tsatu'); ?>:</td>
                    <td><?php echo the_terms_list(get_the_ID(), 'course_major'); ?></td>
                </tr>
                <tr>
                    <td class="head"><?php echo _x('Level', 'Taxonomy General Name', 'tsatu'); ?>:</td>
                    <td><?php echo the_terms_list(get_the_ID(), 'course_level'); ?></td>
                </tr>
                <tr>
                    <td class="head"><?php echo _x('Year', 'Taxonomy General Name', 'tsatu'); ?>:</td>
                    <td><?php echo the_terms_list(get_the_ID(), 'course_year'); ?></td>
                </tr>
                <tr>
                    <td class="head"><?php _e('Lecture:', 'tsatu'); ?></td>
                    <td><?php echo the_lecture(get_the_ID()); ?></td>
                </tr>
                <tr>
                    <td class="head"><?php _e('Links', 'tsatu'); ?>:</td>
                    <td><?php echo the_course_links(get_the_ID()); ?></td>
                </tr>
            </table>
        </div>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <footer>
            <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'tsatu'), 'after' => '</p></nav>')); ?>
        </footer>
    </article>

    <?php

    // If comments are open or we have at least one comment, load up the comment template
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>

<?php endwhile; // end of the loop. ?>

<?php get_sidebar('course'); ?>
<?php get_footer(); ?>
