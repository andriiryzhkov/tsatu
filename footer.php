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
                <?php if (is_multisite() && (get_current_blog_id() != 1)) : ?>
                <div class="footer-copyright">&copy; <?php echo date("Y") ?>. <a href="<?php echo esc_url(network_site_url('/')); ?>"><?php echo get_network_bloginfo('name') ?></a>. 
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo bloginfo('name') ?></a>. <?php _e('All rights reserved.', 'tsatu'); ?></div>
                <?php else : ?>
                    <div class="footer-copyright">&copy; <?php echo date("Y") ?>. <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo bloginfo('name') ?></a>. <?php _e('All rights reserved.', 'tsatu'); ?></div>
                <?php endif; ?>
                <div class="footer-menu">
                    <a href="<?php echo network_site_url('/contact/'); ?>"><?php _e('Contact Information', 'tsatu'); ?></a>
                    <a href="<?php echo network_site_url('/sitemap/'); ?>"><?php _e('Site Map', 'tsatu'); ?></a>
                    <a href="<?php echo network_site_url('/terms/'); ?>"><?php _e('Terms of Use', 'tsatu'); ?></a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <?php if (function_exists('tsatu_slider')) {tsatu_social();} ?>
            </div>
        </div>
  </div>
  <!-- Return to Top -->
  <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>    
</footer>

<?php wp_footer(); ?>

</body>
</html>
