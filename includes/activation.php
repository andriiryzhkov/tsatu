<?php
/**
 * Theme activation
 */
if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
    wp_redirect(admin_url('themes.php?page=theme_activation_options'));
    exit;
}

function tsatu_theme_activation_options_init()
{
    register_setting(
        'tsatu_activation_options',
        'tsatu_theme_activation_options'
    );
}

add_action('admin_init', 'tsatu_theme_activation_options_init');

function tsatu_activation_options_page_capability()
{
    return 'edit_theme_options';
}

add_filter('option_page_capability_tsatu_activation_options', 'tsatu_activation_options_page_capability');

function tsatu_theme_activation_options_add_page()
{
    $tsatu_activation_options = tsatu_get_theme_activation_options();

    if (!$tsatu_activation_options) {
        add_theme_page(
            __('Theme Activation', 'tsatu'),
            __('Theme Activation', 'tsatu'),
            'edit_theme_options',
            'theme_activation_options',
            'tsatu_theme_activation_options_render_page'
        );
    } else {
        if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
            flush_rewrite_rules();
            wp_redirect(admin_url('themes.php'));
            exit;
        }
    }
}

add_action('admin_menu', 'tsatu_theme_activation_options_add_page', 50);

function tsatu_get_theme_activation_options()
{
    return get_option('tsatu_theme_activation_options');
}

function tsatu_theme_activation_options_render_page()
{ ?>
    <div class="wrap">
        <h2><?php printf(__('%s Theme Activation', 'tsatu'), wp_get_theme()); ?></h2>

        <div class="update-nag">
            <?php _e('These settings are optional and should usually be used only on a fresh installation', 'tsatu'); ?>
        </div>
        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php settings_fields('tsatu_activation_options'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Create static front page?', 'tsatu'); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Create static front page?', 'tsatu'); ?></span></legend>
                            <select name="tsatu_theme_activation_options[create_front_page]" id="create_front_page">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'tsatu'); ?></option>
                                <option value="false"><?php echo _e('No', 'tsatu'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'tsatu')); ?></p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Set default settings?', 'tsatu'); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Set default options?', 'tsatu'); ?></span></legend>
                            <select name="tsatu_theme_activation_options[set_default_options]" id="set_default_options">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'tsatu'); ?></option>
                                <option value="false"><?php echo _e('No', 'tsatu'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Change site options to default values', 'tsatu')); ?></p>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

<?php }

function tsatu_theme_activation_action()
{
    if (!($tsatu_theme_activation_options = tsatu_get_theme_activation_options())) {
        return;
    }

    if (strpos(wp_get_referer(), 'page=theme_activation_options') === false) {
        return;
    }

    if ($tsatu_theme_activation_options['create_front_page'] === 'true') {
        $tsatu_theme_activation_options['create_front_page'] = false;

        $default_pages = array(__('Home', 'tsatu'));
        $existing_pages = get_pages();
        $temp = array();

        foreach ($existing_pages as $page) {
            $temp[] = $page->post_title;
        }

        $pages_to_create = array_diff($default_pages, $temp);

        foreach ($pages_to_create as $new_page_title) {
            $add_default_pages = array(
                'post_title' => $new_page_title,
                'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            wp_insert_post($add_default_pages);
        }

        $home = get_page_by_title(__('Home', 'tsatu'));
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);

        $home_menu_order = array(
            'ID' => $home->ID,
            'menu_order' => -1
        );
        wp_update_post($home_menu_order);
    }

    if ($tsatu_theme_activation_options['set_default_options'] === 'true') {
        $tsatu_theme_activation_options['set_default_options'] = false;

        if (get_option('permalink_structure') !== '/%postname%/') {
            global $wp_rewrite;
            $wp_rewrite->set_permalink_structure('/%postname%/');
            flush_rewrite_rules();
        }
        update_option('blogdescription', '');
        update_option('default_comment_status', 'closed');
        update_option('date_format', 'd.m.Y');
        update_option('time_format', 'H:i');
        update_option('thumbnail_size_w', '0');
        update_option('thumbnail_size_h', '0');
        update_option('medium_size_w', '0');
        update_option('medium_size_h', '0');
        update_option('large_size_w', '0');
        update_option('large_size_h', '0');
    }

    update_option('tsatu_theme_activation_options', $tsatu_theme_activation_options);
}

add_action('admin_init', 'tsatu_theme_activation_action');

function tsatu_deactivation()
{
    delete_option('tsatu_theme_activation_options');
}

add_action('switch_theme', 'tsatu_deactivation');
