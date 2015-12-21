<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('tsatu_posts_navigation')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function tsatu_posts_navigation() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation posts-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php _e('Posts navigation', 'tsatu'); ?></h2>
            <ul class="pager">

                <?php if (get_next_posts_link()) : ?>
                    <li class="nav-previous previous"><?php next_posts_link(__('Older posts', 'tsatu')); ?></li>
                <?php endif; ?>

                <?php if (get_previous_posts_link()) : ?>
                    <li class="nav-next next"><?php previous_posts_link(__('Newer posts', 'tsatu')); ?></li>
                <?php endif; ?>

            </ul><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('tsatu_post_navigation')) :

    /**
     * Display navigation to next/previous post when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function tsatu_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php _e('Post navigation', 'tsatu'); ?></h2>
            <div class="nav-links">
                <?php
                previous_post_link('<div class="nav-previous">%link</div>', '%title');
                next_post_link('<div class="nav-next">%link</div>', '%title');
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('tsatu_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function tsatu_posted_on() {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr(get_the_date('c')),
		esc_html( date_i18n('j.m.Y', get_the_time('U')))
	);

        $posted_on = '<i class="fa fa-calendar"></i> ' . $time_string;

        //$byline = '<i class="fa fa-pencil"></i> <span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>';

        //echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
        echo '<span class="posted-on">' . $posted_on . '</span>';
    }

endif;

if (!function_exists('tsatu_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function tsatu_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(__(', ', 'tsatu'));
            if ($categories_list && tsatu_categorized_blog()) {
                printf('<span class="cat-links">' . __('Posted in %1$s', 'tsatu') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', __(', ', 'tsatu'));
            if ($tags_list) {
                printf('<span class="tags-links">' . __('Tagged %1$s', 'tsatu') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(__('Leave a comment', 'tsatu'), __('1 Comment', 'tsatu'), __('% Comments', 'tsatu'));
            echo '</span>';
        }

        edit_post_link(__('Edit', 'tsatu'), '<span class="edit-link">', '</span>');
    }

endif;

if (!function_exists('tsatu_archive_title')) :

    /**
     * Shim for `the_archive_title()`.
     *
     * Display the archive title based on the queried object.
     *
     * @param string $before Optional. Content to prepend to the title. Default empty.
     * @param string $after  Optional. Content to append to the title. Default empty.
     */
    function tsatu_archive_title($before = '', $after = '') {
        if (is_category()) {
            $title = single_cat_title('', false);
            //$title = sprintf(__('Category: %s', 'tsatu'), single_cat_title('', false));
        } elseif (is_tag()) {
            $title = sprintf(__('Tag: %s', 'tsatu'), single_tag_title('', false));
        } elseif (is_author()) {
            $title = sprintf(__('Author: %s', 'tsatu'), '<span class="vcard">' . get_the_author() . '</span>');
        } elseif (is_year()) {
            $title = sprintf(__('Year: %s', 'tsatu'), get_the_date(_x('Y', 'yearly archives date format', 'tsatu')));
        } elseif (is_month()) {
            $title = sprintf(__('Month: %s', 'tsatu'), get_the_date(_x('F Y', 'monthly archives date format', 'tsatu')));
        } elseif (is_day()) {
            $title = sprintf(__('Day: %s', 'tsatu'), get_the_date(_x('j F Y', 'daily archives date format', 'tsatu')));
        } elseif (is_tax('post_format')) {
            if (is_tax('post_format', 'post-format-aside')) {
                $title = _x('Asides', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                $title = _x('Galleries', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-image')) {
                $title = _x('Images', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-video')) {
                $title = _x('Videos', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                $title = _x('Quotes', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-link')) {
                $title = _x('Links', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-status')) {
                $title = _x('Statuses', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                $title = _x('Audio', 'post format archive title', 'tsatu');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                $title = _x('Chats', 'post format archive title', 'tsatu');
            }
        } elseif (is_post_type_archive()) {
            $title = sprintf(__('Archives: %s', 'tsatu'), post_type_archive_title('', false));
        } elseif (is_tax()) {
            $tax = get_taxonomy(get_queried_object()->taxonomy);
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf(__('%1$s: %2$s', 'tsatu'), $tax->labels->singular_name, single_term_title('', false));
        } else {
            $title = __('Archives', 'tsatu');
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters('get_the_archive_title', $title);

        if (!empty($title)) {
            echo $before . $title . $after;
        }
    }

endif;

if (!function_exists('tsatu_archive_description')) :

    /**
     * Shim for `the_archive_description()`.
     *
     * Display category, tag, or term description.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the description. Default empty.
     * @param string $after  Optional. Content to append to the description. Default empty.
     */
    function tsatu_archive_description($before = '', $after = '') {
        $description = apply_filters('get_the_archive_description', term_description());

        if (!empty($description)) {
            /**
             * Filter the archive description.
             *
             * @see term_description()
             *
             * @param string $description Archive description to be displayed.
             */
            echo $before . $description . $after;
        }
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tsatu_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('tsatu_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
                ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('tsatu_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so tsatu_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so tsatu_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in tsatu_categorized_blog.
 */
function tsatu_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('tsatu_categories');
}

add_action('edit_category', 'tsatu_category_transient_flusher');
add_action('save_post', 'tsatu_category_transient_flusher');
