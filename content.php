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
                    if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail(get_the_ID(), 'tsatu-medium', array('class' => "img-responsive"));
                    } else { ?>
                        <img class="img-responsive wp-post-image" src="<?php echo get_template_directory_uri() ?>/assets/img/default-image330x195.jpg" />
                    <?php }
                }
                ?>
            </a>
            <div class="entry-date"><?php echo get_the_date(); ?></div>
        </div>
        <div class="col-md-8">
            <header>
                <div class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></div>
            </header>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
            <!--<p><a class="btn btn-primary btn-sm" href="<?php //the_permalink(); ?>">Read More <i class="fa fa-angle-double-right margin-left-5"></i></a></p>-->
        </div>
    </div>
</article>