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
        // Page sidebar
        if (is_page()) {

            // Page navigation
            global $post;

            if (wp_get_post_parent_id($post->ID)) {
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                $top_ancestor_id = $ancestors[0];
            } else {
                $top_ancestor_id = $post->ID;
            }

            $title = get_the_title($top_ancestor_id);

            $out = wp_list_pages(array(
                'title_li' => '',
                'child_of' => $top_ancestor_id,
                'echo' => 0,
                'sort_column' => 'menu_order'
            ));

            if (!empty($out)) {
                echo '<aside id="tsatu-pagenav" class="widget widget_pagenav">';
                if ($title) {
                    echo '<h1 class="widget-title">' . $title . '</h1>';
                }
                echo '<ul id="pagenav">';
                echo $out;
                echo '</ul>';
                echo '</aside>';
            }

            // Page widgets
            dynamic_sidebar('sidebar-page');
        }
        // Post sidebar
        else {
            dynamic_sidebar('sidebar-default');
        }
        ?>

        <?php do_action('after_sidebar'); ?>

    </div>
    <!-- close .sidebar-padder -->

<?php endif; ?>
