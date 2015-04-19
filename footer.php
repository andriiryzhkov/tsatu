<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>
</div><!-- close .*-inner (main-content-inner or sidebar, depending if sidebar is used) -->
</div><!-- close .container -->
</div><!-- close .main-content -->

<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <?php dynamic_sidebar('sidebar-footer-1'); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php dynamic_sidebar('sidebar-footer-2'); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php dynamic_sidebar('sidebar-footer-3'); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php dynamic_sidebar('sidebar-footer-4'); ?>
            </div>
        </div>
    </div>
</div>
<footer class="footer-info" role="contentinfo">
    <div class="container ">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <?php if (is_main_site()) : ?>
                    <div class="footer-copyright">&copy; <?php echo date("Y") ?>. <a
                            href="<?php echo tsatu_home_url(); ?>"><?php echo bloginfo('name') ?></a>. <?php _e('All rights reserved.', 'tsatu'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-copyright">&copy; <?php echo date("Y") ?>. <a
                            href="<?php echo tsatu_home_url(1); ?>"><?php echo get_network_bloginfo('name') ?></a>.
                        <a href="<?php echo tsatu_home_url(); ?>"><?php echo bloginfo('name') ?></a>. <?php _e('All rights reserved.', 'tsatu'); ?>
                    </div>
                <?php endif; ?>
                <div class="footer-menu">
                    <nav class="navbar navbar-inverse navbar-footer">
                        <div id="footer-navbar" role="navigation">
                            <?php if (is_multisite() && (get_current_blog_id() != 1)) {
                                switch_to_blog(1);
                            }
                            if (has_nav_menu('footer')) :
                                wp_nav_menu(array(
                                    'theme_location' => 'footer',
                                    'depth' => 1,
                                    'walker' => new TSATU_Nav_Walker(),
                                    'menu_class' => 'nav navbar-nav'
                                ));
                            endif;
                            if (is_multisite()) {
                                restore_current_blog();
                            } ?>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 footer-social">
                <?php if (function_exists('tsatu_slider')) {
                    tsatu_social();
                } ?>
            </div>
        </div>
    </div>
    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top" title="<?php _e('Back to top', 'tsatu'); ?>"><i
            class="fa fa-chevron-up"></i></a>
</footer>

<?php wp_footer(); ?>

</body>
</html>
