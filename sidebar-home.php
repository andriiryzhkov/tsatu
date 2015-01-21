<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package tsatu
 */
?>
    </div><!-- close .main-content-inner -->

    <div class="sidebar">

        <?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
        <div class="sidebar-padder">

            <?php do_action('before_sidebar'); ?>

            <?php dynamic_sidebar('sidebar-default'); ?>

            <?php do_action('after_sidebar'); ?>

        </div><!-- close .sidebar-padder -->