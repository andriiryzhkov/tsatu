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

?>

    <!-- Course -->
    <article <?php post_class(); ?>>
        <div class="row">
            <div class="col-md-12">
                <header>
                    <div class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
                </header>
            </div>
        </div>
    </article>
    <!-- End Course -->