<?php
/**
 * The template for displaying all single posts.
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
        <div class="entry-content">
            <div class="row">
                <div class="col-md-4">
                    <?php if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => "img-responsive"));
                    } else { ?>
                        <img class="img-responsive wp-post-image" src="<?php echo get_template_directory_uri() ?>/assets/img/nophoto.jpg" />
                    <?php } ?>

                </div>
                <div class="col-md-8">
                    <div class="well people-info">
                        <table>
                            <tr>
                                <td class="head"><?php echo _x('Position', 'Taxonomy Singular Name', 'tsatu'); ?>:</td>
                                <td width="100%"><?php echo the_terms_list(get_the_ID(), 'people_position'); ?></td>
                            </tr>
                            <tr>
                                <td class="head"><?php echo _x('Degree', 'Taxonomy Singular Name', 'tsatu'); ?>:</td>
                                <td><?php echo the_terms_list(get_the_ID(), 'people_degree'); ?></td>
                            </tr>
                            <tr>
                                <td class="head"><?php echo _x('Title', 'Taxonomy Singular Name', 'tsatu'); ?>:</td>
                                <td><?php echo the_terms_list(get_the_ID(), 'people_title'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php if (get_post_meta( get_the_ID(), 'people_office', true ) != '') : ?>
                                        <div class="people-contacts"><i class="fa fa-building"></i><?php echo esc_attr( get_post_meta( get_the_ID(), 'people_office', true ) ); ?></div>
                                    <?php endif; ?>
                                    <?php if (get_post_meta( get_the_ID(), 'people_phone', true ) != '') : ?>
                                        <div class="people-contacts"><i class="fa fa-phone"></i><?php echo esc_attr( get_post_meta( get_the_ID(), 'people_phone', true ) ); ?></div>
                                    <?php endif; ?>
                                    <?php if (get_post_meta( get_the_ID(), 'people_email', true ) != '') : ?>
                                        <div class="people-contacts"><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr( get_post_meta( get_the_ID(), 'people_email', true ) ); ?>"><?php echo esc_attr( get_post_meta( get_the_ID(), 'people_email', true ) ); ?></a></div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="2"><?php echo esc_attr( get_post_meta( get_the_ID(), 'people_moodle', true ) ); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
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

<?php get_sidebar('people'); ?>
<?php get_footer(); ?>
