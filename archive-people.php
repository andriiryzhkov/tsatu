<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div class="content-padder">

        <?php if (have_posts()) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php post_type_archive_title(); ?>
                </h1>
            </header><!-- .page-header -->

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'people'); ?>

            <?php endwhile; ?>

            <?php //tsatu_posts_navigation(); ?>

        <?php else : ?>

            <?php get_template_part('content', 'none'); ?>

        <?php endif; ?>

</div><!-- .content-padder -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
