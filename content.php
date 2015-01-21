<?php
/**
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row">
            <div class="col-md-4 entry-image <?php echo get_post_format(); ?>">
                <a href="<?php echo get_permalink(); ?>"><?php
                    if (get_post_format() != 'quote') {
                        echo get_the_post_thumbnail(get_the_ID(), 'tsatu-single', array('class' => "img-responsive"));
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-8">
                <header>
                    <div class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></div>
                    <?php //get_template_part('templates/entry-meta'); ?>
                </header>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
                <!--<p><a class="btn btn-primary btn-sm" href="<?php //the_permalink(); ?>">Read More <i class="fa fa-angle-double-right margin-left-5"></i></a></p>-->
            </div>
        </div>
    </article>