<?php
/**
 * Education Master General Settings panel at Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_general_settings_register' );

function education_master_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'education_master_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'education_master_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'education_master_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';
    $wp_customize->get_section( 'static_front_page' )->panel = 'education_master_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'education_master_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'education-master' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color option for theme
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_theme_color',
        array(
            'default'     => '#294a70',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'education_master_theme_color',
            array(
                'label'      => __( 'Theme Color', 'education-master' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

    /**
     * Title Color
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
        'education_master_site_title_color',
        array(
            'default'     => '#294a70',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'education_master_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'education-master' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'education_master_website_layout_section',
        array(
            'title'         => __( 'Website Layout', 'education-master' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'education-master' ),
            'priority'      => 55,
            'panel'         => 'education_master_general_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'education_master_site_layout',
        array(
            'default'           => 'edm_fullwidth_layout',
            'sanitize_callback' => 'education_master_sanitize_site_layout',
        )
    );
    $wp_customize->add_control(
        'education_master_site_layout',
        array(
            'type' => 'radio',
            'priority'    => 5,
            'label' => __( 'Site Layout', 'education-master' ),
            'section' => 'education_master_website_layout_section',
            'choices' => array(
	            'edm_fullwidth_layout'   => __( 'Full Width Style', 'education-master' ),
	            'edm_boxed_width_layout' => __( 'Box Style', 'education-master' )
            ),
        )
    );
/*------------------------------------------------------------------------------------------*/
 /**
     * Preloader for website
     *
     * @since 1.0.7
     */
    $wp_customize->add_section(
        'education_master_wesbsite_preloader_section',
        array(
            'title'         => __( 'Preloader for Website', 'education-master' ),
            'description'   => __( 'Choose a Image For Website Preloader', 'education-master' ),
            'priority'      => 55,
            'panel'         => 'education_master_general_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'education_master_preloader',
        array( 
            'default'           => '',
            'sanitize_callback' => 'esc_url',
        )
    );
    
    $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'education_master_preloader',
               array(
                   'label'      => __('Upload preloader image', 'education-master' ),
                   'section'    => 'education_master_wesbsite_preloader_section',
                   'settings'   => 'education_master_preloader',
                )
            )    
    );
/*------------------------------------------------------------------------------------------*/

    /**
     * Title and tagline checkbox
     *
     * @since 1.0.1
     */
    $wp_customize->add_setting(
        'education_master_site_title_option',
        array(
            'default' => 'true',
            'sanitize_callback' => 'education_master_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'education_master_site_title_option',
        array(
            'label' => esc_html__( 'Display Site Title and Tagline', 'education-master' ),
            'section' => 'title_tagline',
            'type' => 'checkbox'
        )
    );

}
