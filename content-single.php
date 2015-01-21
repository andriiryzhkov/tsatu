<?php
/**
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>
    <article <?php post_class(); ?>>
        <header>
            <div class="page-header"><h1><?php the_title(); ?></h1></div>
		<div class="entry-meta">
			<?php tsatu_posted_on(); ?>
		</div><!-- .entry-meta -->
        </header>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        
        <?php wp_link_pages(array('before' => '<footer><div class="page-nav"><p>' . __('Pages:', 'tsatu'), 'after' => '</p></div></footer>')); ?>
        
    </article>