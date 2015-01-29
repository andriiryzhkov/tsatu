<?php

/**
 * Theme Customizer
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tsatu_customize_register($wp_customize) {

    //Abbreviation
    $wp_customize->add_setting('abbr', array(
        'default' => '',
    ));

    $wp_customize->add_control('abbr', array(
        'label'   => __('Abbreviation', 'tsatu'),
        'section' => 'title_tagline',
        'type'    => 'text'
    ));

    // Slider on front page
    $wp_customize->add_section( 'slider_section' , array(
                    'title'      => __( 'Slider', 'tsatu' ),
                    'priority'   => 105,
    ) );

    $wp_customize->add_setting( 'show_slider' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'show_slider', array(
                    'label'      => __( 'Show slider on front page', 'tsatu' ),
                    'section'    => 'slider_section',
                    'type'       => 'checkbox'
    ) );

    $wp_customize->add_setting( 'num_slides' , array(
                    'default'    => 3,
    ) );

    $wp_customize->add_control( 'num_slides', array(
                    'label'      => __( 'Number of slides', 'tsatu' ),
                    'section'    => 'slider_section',
                    'type'       => 'number'
    ) );

    // Social Icons
    $wp_customize->add_section( 'social_section' , array(
                    'title'      => __( 'Solial Icons', 'tsatu' ),
                    'description'=> __( 'Enter links to accounts in social networks. If you do not use a certain network, leave the field empty.', 'tsatu' ),
                    'priority'   => 115,
    ) );

    $wp_customize->add_setting( 'social_facebook' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_facebook', array(
                    'label'      => __( 'Facebook', 'tsatu' ),
                    'priority'   => 10,
                    'section'    => 'social_section',
                    'type'       => 'text'
    ) );

    $wp_customize->add_setting( 'social_vk' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_vk', array(
                    'label'      => __( 'VKontakte', 'tsatu' ),
                    'priority'   => 20,
                    'section'    => 'social_section',
                    'type'       => 'text'
    ) );

    $wp_customize->add_setting( 'social_twitter' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_twitter', array(
                    'label'      => __( 'Twitter', 'tsatu' ),
                    'priority'   => 30,
                    'section'    => 'social_section',
                    'type'       => 'text'
    ) );

    $wp_customize->add_setting( 'social_googleplus' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_googleplus', array(
                    'label'      => __( 'Google+', 'tsatu' ),
                    'priority'   => 40,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_youtube' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_youtube', array(
                    'label'      => __( 'Youtube', 'tsatu' ),
                    'priority'   => 50,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_vimeo' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_vimeo', array(
                    'label'      => __( 'Vimeo', 'tsatu' ),
                    'priority'   => 60,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_linkedin' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_linkedin', array(
                    'label'      => __( 'LinkedIn', 'tsatu' ),
                    'priority'   => 70,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_pinterest' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_pinterest', array(
                    'label'      => __( 'Pinterest', 'tsatu' ),
                    'priority'   => 80,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_rss' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_rss', array(
                    'label'      => __( 'RSS', 'tsatu' ),
                    'priority'   => 90,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_tumblr' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_tumblr', array(
                    'label'      => __( 'Tumblr', 'tsatu' ),
                    'priority'   => 100,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_flickr' , array(
                    'default'   => '',
    ) );

    $wp_customize->add_control( 'social_flickr', array(
                    'label'      => __( 'Flickr', 'tsatu' ),
                    'priority'   => 110,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_instagram' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_instagram', array(
                    'label'      => __( 'Instagram', 'tsatu' ),
                    'priority'   => 120,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_dribbble' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_dribbble', array(
                    'label'      => __( 'Dribbble', 'tsatu' ),
                    'priority'   => 130,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_skype' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_skype', array(
                    'label'      => __( 'Skype', 'tsatu' ),
                    'priority'   => 140,
                    'section'    => 'social_section',
                    'type'       => 'text'
    ) );

    $wp_customize->add_setting( 'social_foursquare' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_foursquare', array(
                    'label'      => __( 'Foursquare', 'tsatu' ),
                    'priority'   => 150,
                    'section'    => 'social_section',
                    'type' 	     => 'text'
    ) );

    $wp_customize->add_setting( 'social_soundcloud' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_soundcloud', array(
                    'label'      => __( 'SoundCloud', 'tsatu' ),
                    'priority'   => 160,
                    'section'    => 'social_section',
                    'type' 		 => 'text'
    ) );

    $wp_customize->add_setting( 'social_github' , array(
                    'default'    => '',
    ) );

    $wp_customize->add_control( 'social_github', array(
                    'label'      => __( 'GitHub', 'tsatu' ),
                    'priority'   => 170,
                    'section'    => 'social_section',
                    'type'       => 'text'
    ) );
    
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}

add_action('customize_register', 'tsatu_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
//function tsatu_customize_preview_js() {
//    wp_enqueue_script('tsatu_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), false, true);
//}
//
//add_action('customize_preview_init', 'tsatu_customize_preview_js');
