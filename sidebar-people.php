<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The sidebar for people custom type
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

        <h3 class="sidebar-title"><?php _ex('People', 'Post Type General Name', 'tsatu'); ?></h3>

        <?php
        $query = new WP_Query(array('post_type' => 'people', 'order' => 'ASC', 'post_status' => 'publish'));
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                if (get_the_title() != '')
                    echo '<div class="people-item"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
            }
        }
        ?>

        <?php do_action('after_sidebar'); ?>

    </div>
    <!-- close .sidebar-padder -->

<?php endif; ?>
