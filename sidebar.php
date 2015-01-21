<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The sidebar containing the main widget area.
 *
 * @package tsatu
 */
?>
<?php if (tsatu_display_sidebar()) : ?>

    </div><!-- close .main-content-inner -->

    <div class="sidebar">

        <?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
        <div class="sidebar-padder">

            <?php do_action('before_sidebar'); ?>

            <?php
            if (is_page()) {
                dynamic_sidebar('sidebar-page');
            } else {
                dynamic_sidebar('sidebar-default');
            }
            ?>

            <?php do_action('after_sidebar'); ?>

        </div><!-- close .sidebar-padder -->

    <?php endif; ?>
