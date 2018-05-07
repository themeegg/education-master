<?php
/**
 * Education Master Additional Settings panel at Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_additional_settings_register' );

function education_master_additional_settings_register( $wp_customize ) {

	/**
	 * Add Additional Settings Panel
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_panel(
		'education_master_additional_settings_panel',
		array(
			'priority'       => 20,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Additional Settings', 'education-master' ),
		)
	);

	/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	 * Social Icons Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
		'education_master_social_icons_section',
		array(
			'title'    => esc_html__( 'Social Icons', 'education-master' ),
			'panel'    => 'education_master_additional_settings_panel',
			'priority' => 5,
		)
	);

	/**
	 * Repeater field for social media icons
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'social_media_icons',
		array(
			'sanitize_callback' => 'education_master_sanitize_repeater',
			'default'           => json_encode( array(
				array(
					'social_icon_class' => 'fa fa-facebook-f',
					'social_icon_url'   => '',
				)
			) )
		)
	);
	$wp_customize->add_control( new Education_Master_Repeater_Controler(
			$wp_customize,
			'social_media_icons',
			array(
				'label'                            => __( 'Social Media Icons', 'education-master' ),
				'section'                          => 'education_master_social_icons_section',
				'settings'                         => 'social_media_icons',
				'priority'                         => 5,
				'education_master_box_label'       => __( 'Social Media Icon', 'education-master' ),
				'education_master_box_add_control' => __( 'Add Icon', 'education-master' )
			),
			array(
				'social_icon_class' => array(
					'type'        => 'social_icon',
					'label'       => __( 'Social Media Logo', 'education-master' ),
					'description' => __( 'Choose social media icon.', 'education-master' )
				),
				'social_icon_url'   => array(
					'type'        => 'url',
					'label'       => __( 'Social Icon Url', 'education-master' ),
					'description' => __( 'Enter social media url.', 'education-master' )
				)
			)
		)
	);
	/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	 * Widget Settings
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
		'education_master_widget_settings_section',
		array(
			'title'    => esc_html__( 'Widget Settings', 'education-master' ),
			'panel'    => 'education_master_additional_settings_panel',
			'priority' => 15,
		)
	);

	/**
	 * Switch option for category link at widget title
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_widget_cat_link_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_widget_cat_link_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Category Link', 'education-master' ),
				'description' => esc_html__( 'Enable/Disable option for category link for widget title in block layout widget.', 'education-master' ),
				'section'     => 'education_master_widget_settings_section',
				'choices'     => array(
					'show' => esc_html__( 'Enable', 'education-master' ),
					'hide' => esc_html__( 'Disable', 'education-master' )
				),
				'priority'    => 5,
			)
		)
	);

	/**
	 * Switch option for category color at widget title
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_widget_cat_color_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_widget_cat_color_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Category Color', 'education-master' ),
				'description' => esc_html__( 'Enable/Disable option for category color for widget title in block layout widget.', 'education-master' ),
				'section'     => 'education_master_widget_settings_section',
				'choices'     => array(
					'show' => esc_html__( 'Enable', 'education-master' ),
					'hide' => esc_html__( 'Disable', 'education-master' )
				),
				'priority'    => 10,
			)
		)
	);

}
