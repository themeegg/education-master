<?php
/**
 * Education Master Footer Settings panel at Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_footer_settings_register' );

function education_master_footer_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'education_master_footer_settings_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'education-master' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Widget Area Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'education_master_footer_widget_section',
        array(
            'title'		=> esc_html__( 'Widget Area', 'education-master' ),
            'panel'     => 'education_master_footer_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_footer_widget_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'education_master_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new Education_Master_Customize_Switch_Control(
        $wp_customize,
            'education_master_footer_widget_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Footer Widget Section', 'education-master' ),
                'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'education-master' ),
                'section'   => 'education_master_footer_widget_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'education-master' ),
                    'hide'  => esc_html__( 'Hide', 'education-master' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Field for Image Radio
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'footer_widget_layout',
        array(
            'default'           => 'column_three',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Education_Master_Customize_Control_Radio_Image(
        $wp_customize,
        'footer_widget_layout',
            array(
                'label'    => esc_html__( 'Footer Widget Layout', 'education-master' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'education-master' ),
                'section'  => 'education_master_footer_widget_section',
                'choices'  => array(
	                    'column_four' => array(
	                        'label' => esc_html__( 'Columns Four', 'education-master' ),
	                        'url'   => '%s/assets/images/footer-4.png'
	                    ),
	                    'column_three' => array(
	                        'label' => esc_html__( 'Columns Three', 'education-master' ),
	                        'url'   => '%s/assets/images/footer-3.png'
	                    ),
	                    'column_two' => array(
	                        'label' => esc_html__( 'Columns Two', 'education-master' ),
	                        'url'   => '%s/assets/images/footer-2.png'
	                    ),
	                    'column_one' => array(
	                        'label' => esc_html__( 'Column One', 'education-master' ),
	                        'url'   => '%s/assets/images/footer-1.png'
	                    )
	            ),
	            'priority' => 10
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Bottom Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'education_master_footer_bottom_section',
        array(
            'title'		=> esc_html__( 'Bottom Section', 'education-master' ),
            'panel'     => 'education_master_footer_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'education_master_copyright_text',
        array(
            'default'    => __( 'Education Master', 'education-master' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'education_master_copyright_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Copyright Text', 'education-master' ),
            'section'   => 'education_master_footer_bottom_section',
            'priority'  => 5
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'education_master_copyright_text',
            array(
                'selector' => 'span.edm-copyright-text',
                'render_callback' => 'education_master_customize_partial_copyright',
            )
    );
     /**
     * Parallax footer
     *
     * @since 1.0.7
     */

    $wp_customize->add_setting(
        'education_master_parallax_footer',
        array(
            'default'    => '',
            'sanitize_callback' => 'esc_url'
            )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'education_master_parallax_footer',
            array(
                'label'      => __('Upload Parallax image', 'education-master' ),
                'section'    => 'education_master_footer_bottom_section',
                'settings'   => 'education_master_parallax_footer',
            )
        )   
    );
}