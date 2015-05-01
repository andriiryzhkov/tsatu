<?php
/**
 * The template part for displaying social buttons.
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

<div class="social-likes" data-url="<?php echo get_permalink(); ?>" data-title="<?php the_title(); ?>">
    <div class="facebook" title="<?php _e('Share link on Facebook', 'tsatu'); ?>">Facebook</div>
    <div class="twitter" data-via="TaurianSAU" title="<?php _e('Share link on Twitter', 'tsatu'); ?>">Twitter</div>
    <div class="vkontakte" title="<?php _e('Share link on VKontakte', 'tsatu'); ?>">Вконтакте</div>
    <div class="plusone" title="<?php _e('Share link on Google+', 'tsatu'); ?>">Google+</div>
    <div class="pinterest" title="<?php _e('Share link on Pinterest', 'tsatu'); ?>" data-media="<?php echo wp_get_attachment_url(get_the_post_thumbnail(get_the_ID(), 'tsatu-large')); ?>">Pinterest</div>
</div>
