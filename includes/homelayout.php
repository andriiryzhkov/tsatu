<?php

/**
 * Customizabale front page widget areas
 *
 * @package   tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme activation
 */
if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  
    //Add widget areas initial values
    for ($wa = 1; $wa <= 5; $wa++) {
        add_option('tsatu_columns_' . $wa, 1);
        for ($cl = 1; $cl <= 6; $cl++) {
            add_option('tsatu_home_area_' . $wa . '_' . $cl, 5);
        }
    }
}

function tsatu_homelayout_customize_register($wp_customize) {

    $widget_areas_names = array(
        __('One', 'tsatu'),
        __('Two', 'tsatu'),
        __('Three', 'tsatu'),
        __('Four', 'tsatu'),
        __('Five', 'tsatu')
    );
    
    // Front Page
    $wp_customize->add_panel('front_page_panel', array(
        'priority' => 107,
        'title' => __('Front Page', 'tsatu')
    ));

    $wp_customize->add_section('general_widget_areas', array(
        'title' => __('General', 'tsatu'),
        'priority' => 5,
        'panel' => 'front_page_panel',
    ));

    $wp_customize->add_setting('tsatu_show_widget_areas', array(
        'default' => 0,
        'type' => 'option',
        'capability' => 'manage_options',
    ));

    $wp_customize->add_control('tsatu_show_widget_areas', array(
        'label' => __('Show customizable widget areas on Front Page', 'tsatu'),
        'section' => 'general_widget_areas',
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('tsatu_page_content', array(
        'default' => 0,
        'type' => 'option',
        'capability' => 'manage_options',
    ));

    $wp_customize->add_control('tsatu_page_content', array(
        'label' => __('Remove content of the static page', 'tsatu'),
        'section' => 'general_widget_areas',
        'type' => 'checkbox'
    ));

    for ($widget_area = 1; $widget_area <= 5; $widget_area++) {

        $wp_customize->add_section('widget_area_' . $widget_area, array(
            'priority' => $widget_area * 10,
            'title' => sprintf(__('Widget Area %s', 'tsatu'), $widget_areas_names[$widget_area - 1]),
            'panel' => 'front_page_panel'
        ));

        $wp_customize->add_setting('tsatu_columns_' . $widget_area, array(
            'default' => 0,
            'type' => 'option',
            'capability' => 'manage_options',
        ));

        $wp_customize->add_control('tsatu_columns_' . $widget_area, array(
            'label' => __('Number of columns', 'tsatu'),
            'priority' => 5,
            'section' => 'widget_area_' . $widget_area,
            'type' => 'select',
            'choices' => array(1, 2, 3, 4, 5, 6),
        ));

        for ($col = 1; $col <= 6; $col++) {

            $wp_customize->add_setting('tsatu_home_area_' . $widget_area . '_' . $col, array(
                'default' => 5,
                'type' => 'option',
                'capability' => 'manage_options',
            ));

            $wp_customize->add_control('tsatu_home_area_' . $widget_area . '_' . $col, array(
                'label' => sprintf(__('Widget Area %1$s - %2$s/6', 'tsatu'), $widget_areas_names[$widget_area - 1], $col),
                'priority' => $col * 10,
                'section' => 'widget_area_' . $widget_area,
                'type' => 'select',
                'choices' => array('1/12', '2/12', '3/12', '4/12', '5/12', '6/12', '7/12', '8/12', '9/12', '10/12', '11/12', '12/12'),
            ));
        }
    }

    $wp_customize->get_setting('tsatu_columns_1')->transport = 'postMessage';
    $wp_customize->get_setting('tsatu_columns_2')->transport = 'postMessage';
    $wp_customize->get_setting('tsatu_columns_3')->transport = 'postMessage';
    $wp_customize->get_setting('tsatu_columns_4')->transport = 'postMessage';
    $wp_customize->get_setting('tsatu_columns_5')->transport = 'postMessage';

}

add_action('customize_register', 'tsatu_homelayout_customize_register');

/**
 * Register home widget areas
 */
function tsatu_homelayout_generate() {

    $widget_areas_names = array(
        __('One', 'tsatu'),
        __('Two', 'tsatu'),
        __('Three', 'tsatu'),
        __('Four', 'tsatu'),
        __('Five', 'tsatu')
    );

    if (get_option('tsatu_show_widget_areas')) {

        for ($wa = 1; $wa <= 5; $wa++) {

            $col_n = get_option('tsatu_columns_' . $wa) + 1;

            for ($cl = 1; $cl <= $col_n; $cl++) {

                register_sidebar(array(
                  'name'          => sprintf(__('Front Page Area %1$s - %2$s/%3$s', 'tsatu'), $widget_areas_names[$wa - 1], $cl, $col_n),
                  'id'            => 'sidebar-home-' . $wa . '-' . $cl,
                  'before_widget' => '<section class="widget %1$s %2$s">',
                  'after_widget'  => '</section>',
                  'before_title'  => '<h3>',
                  'after_title'   => '</h3>',
                ));

            }

        }
    
    }
  
}
add_action('widgets_init', 'tsatu_homelayout_generate');


function insert_homelayout($content)
{
    if (is_front_page() && !is_home() && (get_option('page_on_front') == get_the_ID()) && get_option('tsatu_show_widget_areas')) {
        
        ob_start();

        echo '<section class="home-section">';

        for ($wa = 1; $wa <= 5; $wa++) {

            if (!get_option('tsatu_columns_' . $wa)) {
                $col_n = 1;
            } else {
                $col_n = get_option('tsatu_columns_' . $wa) + 1;
            }
            echo '<div class="row home-area-' . $wa . '">';

            for ($cl = 1; $cl <= $col_n; $cl++) {

                if (!get_option('tsatu_home_area_' . $wa . '_' . $cl)) {
                    $col_width = 6;
                } else {
                    $col_width = (get_option('tsatu_home_area_' . $wa . '_' . $cl) + 1);
                }
                echo '<div class="col-md-' . $col_width . '">';
                dynamic_sidebar(sanitize_title('sidebar-home-' . $wa . '-' . $cl));
                echo '</div>';
            }
            echo '<div class="clear"></div></div>';

        }
        echo '</section>';

        if (get_option('tsatu_page_content')) {
            $content = ob_get_clean();
        } else {
            $content .= ob_get_clean();
        }
    }

    return $content;
}

add_filter('the_content', 'insert_homelayout');
