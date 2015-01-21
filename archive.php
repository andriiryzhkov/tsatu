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
                <?php
                tsatu_archive_title('<h1 class="page-title">', '</h1>');
                tsatu_archive_description('<div class="taxonomy-description">', '</div>');
                ?>
            </header><!-- .page-header -->

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part('content', get_post_format());
                ?>

            <?php endwhile; ?>

            <?php tsatu_posts_navigation(); ?>

        <?php else : ?>

            <?php get_template_part('content', 'none'); ?>

        <?php endif; ?>

</div><!-- .content-padder -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
