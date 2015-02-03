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

    <!-- People -->
<div class="col-md-6">
    <article <?php post_class(); ?>>
        <div class="row">
            <div class="col-md-4 entry-image <?php echo get_post_format(); ?>">
                <a href="<?php echo get_permalink(); ?>">
                    <?php //echo get_the_post_thumbnail(get_the_ID(), 'tsatu-single', array('class' => "img-responsive")); ?>
                    <?php if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => "img-responsive"));
                    } else { ?>
                        <img class="img-responsive wp-post-image" src="<?php echo get_template_directory_uri() ?>/assets/img/nophoto.jpg" />
                    <?php } ?>

                    </a>
            </div>
            <div class="col-md-8">
                <header>
                    <div class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
                </header>
                <div class="entry-summary">
                    <?php echo the_terms_list( get_the_ID(), 'people_position' ); ?> 
                    <?php echo the_terms_list( get_the_ID(), 'people_degree' ); ?>
                    <a href="mailto:<?php echo esc_attr( get_post_meta( get_the_ID(), 'people_email', true ) ); ?>"><?php echo esc_attr( get_post_meta( get_the_ID(), 'faculty_email', true ) ); ?></a>
                </div>
            </div>
        </div>
    </article>
</div>
