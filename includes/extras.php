<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tsatu_body_classes($classes)
{
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    return $classes;
}

add_filter('body_class', 'tsatu_body_classes');

if (version_compare($GLOBALS['wp_version'], '4.1', '<')) :
    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */
    function tsatu_wp_title($title, $sep)
    {
        if (is_feed()) {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if (($paged >= 2 || $page >= 2) && !is_404()) {
            $title .= " $sep " . sprintf(__('Page %s', 'tsatu'), max($paged, $page));
        }

        return $title;
    }

    add_filter('wp_title', 'tsatu_wp_title', 10, 2);

    /**
     * Title shim for sites older than WordPress 4.1.
     *
     * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function tsatu_render_title()
    {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
    }

    add_action('wp_head', 'tsatu_render_title');
endif;

/**
 * Login Logo
 */
function tsatu_login_logo()
{
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/login-logo.png);
            padding-bottom: 20px;
        }
    </style>
<?php
}

add_action('login_enqueue_scripts', 'tsatu_login_logo');

/**
 * Returns related posts.
 */
function tsatu_related_posts()
{
    $post = get_post();

    $args = array(
        'posts_per_page' => 3,
        'ignore_sticky_posts' => true,
        'post__not_in' => array($post->ID),
    );

    // Get posts from the same category.
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = array_shift($categories);
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $category->term_id,
            ),
        );
    }

    $related_posts = new WP_Query($args);
    if ($related_posts->have_posts()) : ?>
        <div class="related-posts">
            <h3 class="related-posts-title"><?php _e('Read more', 'tsatu'); ?></h3>

            <div class="row">
                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <div class="col-md-4">
                        <article id="post-<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-image">
                                        <?php the_post_thumbnail('tsatu-mini'); ?>
                                    </div>
                                <?php endif; ?>
                                <header>
                                    <div class="entry-title"><a href="<?php the_permalink(); ?>"
                                                                title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'tsatu'), the_title_attribute('echo=0'))); ?>"
                                                                rel="bookmark"><?php the_title(); ?></a></div>
                                </header>
                            </a>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif;
}

if (!function_exists('tsatu_slider')) {
    /**
     * Featured image slider, displayed on front page for static page and blog
     */
    function tsatu_slider($count = 3, $id = 'slider')
    {

        $query = new WP_Query(array('post_type' => 'slide', 'posts_per_page' => $count));
        if ($query->have_posts()) :
            echo '<div id="' . $id . '" class="flexslider">';
            echo '<ul class="slides">';
            while ($query->have_posts()) : $query->the_post();
                global $more;
                $more = 0;
                echo '<li>';
                if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                    echo get_the_post_thumbnail();
                }
                echo '<div class="flex-caption">';
                echo '<a href="' . esc_html(get_post_meta(get_the_ID(), 'slide_url', true)) . '">';
                if (get_the_title() != '') {
                    echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
                }
                if (get_the_excerpt() != '') {
                    echo '<div class="excerpt">' . get_the_excerpt() . '</div>';
                }
                echo '</a>';
                echo '</div>';

                echo '</li>';
            endwhile;
            echo '</ul>';
            echo '</div>';
        endif;
    }

}

if (!function_exists('tsatu_social')) {
    /**
     * Display social links in footer and widgets if enabled
     */
    function tsatu_social()
    {
        $services = array(
            'facebook' => 'Facebok',
            'vk' => 'VKontakte',
            'twitter' => 'Twitter',
            'googleplus' => 'Google+',
            'youtube' => 'Youtube',
            'vimeo' => 'Vimeo',
            'linkedin' => 'LinkedIn',
            'pinterest' => 'Pinterest',
            'rss' => 'RSS',
            'tumblr' => 'Tumblr',
            'flickr' => 'Flickr',
            'instagram' => 'Instagram',
            'dribbble' => 'Dribbble',
            'skype' => 'Skype',
            'foursquare' => 'Foursquare',
            'soundcloud' => 'SoundCloud',
            'github' => 'GitHub'
        );

        echo '<div class="social-icons">';

        foreach ($services as $service => $name) :

            $active[$service] = get_theme_mod('social_' . $service);
            if ($active[$service]) {
                echo '<a href="' . esc_url($active[$service]) . '" title="' . __('Follow us on ', 'tsatu') . $name . '" class="' . $service . '" target="_blank"><i class="social_icon fa fa-' . $service . '"></i></a>';
            }

        endforeach;
        echo '</div>';
    }

}


if (!function_exists('the_terms_list')) {
    /**
     * Returns list of terms for custom taxonomy
     */
    function the_terms_list($post_id, $taxonomy)
    {
        $terms = get_the_terms($post_id, $taxonomy);
        $terms_list = '';
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $terms_list .= '<div>' . $term->name . '</div>';
            }
        }
        return $terms_list;
    }
}


if (!function_exists('get_network_bloginfo')) {
    /**
     * Gets the bloginfo for the site in multisite setup
     */
    function get_network_bloginfo($show)
    {
        if (is_multisite()) {
            switch_to_blog(1);
            $output = get_bloginfo($show);
            restore_current_blog();
        } else {
            $output = get_bloginfo($show);
        }
        return $output;
    }
}

if (!function_exists('tsatu_home_url')) {
    /**
     * Display the home page url in current language (Polylang)
     */
    function tsatu_home_url($blog_id = null) {

        if (!function_exists('pll_home_url'))
            return esc_url(get_home_url( $blog_id, '/' ));

        if (!is_multisite() || ($blog_id == null))
            return esc_url(pll_home_url());

        switch_to_blog($blog_id);
        $url = pll_home_url();
        restore_current_blog();

        return esc_url($url);
    }
}


if (!function_exists('tsatu_taxonomy_filter_restrict_manage_posts')) {
    /**
     * Filter the request to just give posts for the given taxonomy, if applicable
     */
    function tsatu_taxonomy_filter_restrict_manage_posts()
    {
        global $typenow;

        // If you only want this to work for your specific post type,
        // check for that $type here and then return.
        // This function, if unmodified, will add the dropdown for each
        // post type / taxonomy combination.

        $post_types = get_post_types(array('_builtin' => false));

        if (in_array($typenow, $post_types)) {
            $filters = get_object_taxonomies($typenow);
            $filters = array_diff($filters, array('language'));

            foreach ($filters as $tax_slug) {
                $tax_terms = get_terms($tax_slug);
                if ( !empty( $tax_terms ) && !is_wp_error( $tax_terms ) ) {
                    $tax_obj = get_taxonomy($tax_slug);
                    wp_dropdown_categories(array(
                        'show_option_all' => sprintf(__('Show All %s', 'tsatu'), $tax_obj->label),
                        //'show_option_all' => __('Show All ', 'tsatu' ) . $tax_obj->label,
                        'taxonomy' => $tax_slug,
                        'name' => $tax_obj->name,
                        'orderby' => 'name',
                        'selected' => $_GET[$tax_slug],
                        'hierarchical' => $tax_obj->hierarchical,
                        'show_count' => false,
                        'hide_empty' => true
                    ));
                }
            }
        }
    }

    add_action('restrict_manage_posts', 'tsatu_taxonomy_filter_restrict_manage_posts');
}

if (!function_exists('tsatu_taxonomy_filter_post_type_request')) {
    /**
     * Add a filter to the query
     */
    function tsatu_taxonomy_filter_post_type_request($query)
    {
        global $pagenow, $typenow;

        if ('edit.php' == $pagenow) {
            $filters = get_object_taxonomies($typenow);
            foreach ($filters as $tax_slug) {
                $var = &$query->query_vars[$tax_slug];
                if (isset($var)) {
                    $term = get_term_by('id', $var, $tax_slug);
                    $var = $term->slug;
                }
            }
        }
    }

    add_filter('parse_query', 'tsatu_taxonomy_filter_post_type_request');
}


//if (function_exists('pll_default_language')) {
//    /**
//     * Display the default language post if the translation does not exists (Polylang)
//     */
//    add_filter('pre_get_posts', 'get_default_language_posts');
//    function get_default_language_posts($query)
//    {
//        if ($query->is_main_query() && function_exists('pll_default_language') && !is_admin()) {
//            $terms = get_terms('post_translations'); //polylang stores translated post IDs in a serialized array in the description field of this custom taxonomy
//            $defLang = pll_default_language(); //default lanuage of the blog
//            $curLang = pll_current_language(); //current selected language requested on the broswer
//            $filterPostIDs = array();
//            foreach ($terms as $translation) {
//                $transPost = unserialize($translation->description);
//                //if the current language is not the default, lets pick up the default language post
//                if ($defLang != $curLang) $filterPostIDs[] = $transPost[$defLang];
//            }
//            if ($defLang != $curLang) {
//                $query->set('lang', $defLang . ',' . $curLang);  //select both default and current language post
//                $query->set('post__not_in', $filterPostIDs); // remove the duplicate post in the default language
//            }
//        }
//        return $query;
//    }
//}

//if (function_exists('pll_default_language')) {
//    /**
//     * Set preferred admin language (Polylang)
//     */
//    add_filter('pll_admin_preferred_language', 'my_preferred_language');
//    function my_preferred_language($lang)
//    {
//        global $polylang;
//        return $polylang->model->get_language(pll_default_language());
//    }
//}

