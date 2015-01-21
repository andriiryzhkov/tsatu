<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_front_page()) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php echo the_title(); ?></h1>
        </header><!-- .entry-header -->
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', '_tk'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->