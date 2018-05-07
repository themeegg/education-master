<?php
/**
 * Education Master Design Settings panel at Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_design_settings_register' );

function education_master_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'Education_Master_Customize_Control_Radio_Image' );

	/**
     * Add Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'education_master_design_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Design Settings', 'education-master' ),
	    )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'education_master_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive Settings', 'education-master' ),
            'panel'     => 'education_master_design_settings_panel',
            'priority'  => 5,
        )
    );      

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Education_Master_Customize_Control_Radio_Image(
        $wp_customize,
        'education_master_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'education-master' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'education-master' ),
                'section'  => 'education_master_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_archive_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Education_Master_Customize_Control_Radio_Image(
        $wp_customize,
        'education_master_archive_layout',
            array(
                'label'    => esc_html__( 'Archive Layouts', 'education-master' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'education-master' ),
                'section'  => 'education_master_archive_settings_section',
                'choices'  => array(
                        'classic' => array(
                            'label' => esc_html__( 'Classic', 'education-master' ),
                            'url'   => '%s/assets/images/archive-layout1.png'
                        ),
                        'grid' => array(
                            'label' => esc_html__( 'Grid', 'education-master' ),
                            'url'   => '%s/assets/images/archive-layout2.png'
                        )
                ),
                'priority' => 10
            )
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_archive_read_more_text',
        array(
            'default'      => __( 'Continue Reading', 'education-master' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'education_master_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'education-master' ),
            'description'  	=> __( 'Enter read more button text for archive page.', 'education-master' ),
            'section'   	=> 'education_master_archive_settings_section',
            'priority'  	=> 15
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'education_master_archive_read_more_text',
            array(
                'selector' => '.edm-archive-more > a',
                'render_callback' => 'education_master_customize_partial_archive_more',
            )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'education_master_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'education-master' ),
            'panel'     => 'education_master_design_settings_panel',
            'priority'  => 10,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Education_Master_Customize_Control_Radio_Image(
        $wp_customize,
        'education_master_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'education-master' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'education-master' ),
                'section'  => 'education_master_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'education_master_post_settings_section',
        array(
            'title'     => esc_html__( 'Post Settings', 'education-master' ),
            'panel'     => 'education_master_design_settings_panel',
            'priority'  => 15,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Education_Master_Customize_Control_Radio_Image(
        $wp_customize,
        'education_master_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'education-master' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'education-master' ),
                'section'  => 'education_master_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'education-master' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_related_posts_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'education_master_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new Education_Master_Customize_Switch_Control(
        $wp_customize,
            'education_master_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'education-master' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'education-master' ),
                'section'   => 'education_master_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'education-master' ),
                    'hide'  => esc_html__( 'Hide', 'education-master' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_related_posts_title',
        array(
            'default'    => __( 'Related Posts', 'education-master' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'education_master_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'education-master' ),
            'section'   => 'education_master_post_settings_section',
            'priority'  => 15
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'education_master_related_posts_title',
            array(
                'selector' => 'h2.edm-related-title',
                'render_callback' => 'education_master_customize_partial_related_title',
            )
    );
}