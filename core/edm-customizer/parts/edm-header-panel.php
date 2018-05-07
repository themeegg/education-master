<?php
/**
 * Education Master Header Settings panel at Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_header_settings_register' );

function education_master_header_settings_register( $wp_customize ) {

	/**
	 * Add General Settings Panel
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_panel(
		'education_master_header_settings_panel',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Header Settings', 'education-master' ),
		)
	);

	/*-----------------------------------------------------------------------------------------------------------------------*/

	/**
	 * Top Header Section
	 */
	$wp_customize->add_section(
		'education_master_top_header_section',
		array(
			'title'    => __( 'Top Header Section', 'education-master' ),
			'priority' => 5,
			'panel'    => 'education_master_header_settings_panel'
		)
	);

	/**
	 * Switch option for Top Header
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_top_header_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_top_header_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Top Header Section', 'education-master' ),
				'description' => esc_html__( 'Show/Hide option for top header section.', 'education-master' ),
				'section'     => 'education_master_top_header_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'education-master' ),
					'hide' => esc_html__( 'Hide', 'education-master' )
				),
				'priority'    => 5,
			)
		)
	);

	/**
	 * Switch option for Current Date
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_top_date_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_top_date_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Current Date', 'education-master' ),
				'description' => esc_html__( 'Show/Hide option for current date at top header section.', 'education-master' ),
				'section'     => 'education_master_top_header_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'education-master' ),
					'hide' => esc_html__( 'Hide', 'education-master' )
				),
				'priority'    => 10,
			)
		)
	);

	/**
	 * Switch option for Social Icon
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_top_social_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_top_social_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Social Icons', 'education-master' ),
				'description' => esc_html__( 'Show/Hide option for social media icons at top header section.', 'education-master' ),
				'section'     => 'education_master_top_header_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'education-master' ),
					'hide' => esc_html__( 'Hide', 'education-master' )
				),
				'priority'    => 15,
			)
		)
	);
	/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	 * Header Section
	 */
	$wp_customize->add_section(
		'education_master_header_option_section',
		array(
			'title'    => __( 'Header Option', 'education-master' ),
			'priority' => 10,
			'panel'    => 'education_master_header_settings_panel'
		)
	);

	/**
	 * Switch option for Home Icon
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_menu_sticky_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_menu_sticky_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Sticky Menu', 'education-master' ),
				'description' => esc_html__( 'Enable/Disable option for sticky menu.', 'education-master' ),
				'section'     => 'education_master_header_option_section',
				'choices'     => array(
					'show' => esc_html__( 'Enable', 'education-master' ),
					'hide' => esc_html__( 'Disable', 'education-master' )
				),
				'priority'    => 5,
			)
		)
	);
	/**
	 * Switch option for Search Icon
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_search_icon_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_search_icon_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Search Icon', 'education-master' ),
				'description' => esc_html__( 'Show/Hide option for search icon at primary menu.', 'education-master' ),
				'section'     => 'education_master_header_option_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'education-master' ),
					'hide' => esc_html__( 'Hide', 'education-master' )
				),
				'priority'    => 15,
			)
		)
	);

	// Education Master Header Style
	$wp_customize->add_setting( 'education_master_header_style_option',
		array(
			'default'           => 'default',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'education_master_sanitize_select',
		)
	);
	$wp_customize->add_control( 'education_master_header_style_option',
		array(
			'type'        => 'select',
			'label'       => esc_html__( 'Header design style', 'education-master' ),
			'description' => esc_html__( 'Change design of header syle (ie. center logo etc)', 'education-master' ),
			'section'     => 'education_master_header_option_section',
			'priority'    => 16,
			'choices'     => education_master_get_header_style_design(),
		)
	);

	/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	 * Notice Section
	 */
	$wp_customize->add_section(
		'education_master_notice_section',
		array(
			'title'    => __( 'Notice Section', 'education-master' ),
			'priority' => 15,
			'panel'    => 'education_master_header_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'education_master_notice_option',
		array(
			'default'           => 'show',
			'sanitize_callback' => 'education_master_sanitize_switch_option',
		)
	);
	$wp_customize->add_control( new Education_Master_Customize_Switch_Control(
			$wp_customize,
			'education_master_notice_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Notice Option', 'education-master' ),
				'description' => esc_html__( 'Hide/show notice board section.', 'education-master' ),
				'section'     => 'education_master_notice_section',
				'choices'     => array(
					'show' => esc_html__( 'Show', 'education-master' ),
					'hide' => esc_html__( 'Hide', 'education-master' )
				),
				'priority'    => 5,
			)
		)
	);

	/**
	 * Text field for notice caption
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_setting(
		'education_master_notice_caption',
		array(
			'default'           => __( 'Notices', 'education-master' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'education_master_notice_caption',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Notice Caption', 'education-master' ),
			'section'  => 'education_master_notice_section',
			'priority' => 10
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'education_master_notice_caption',
		array(
			'selector'        => '.notice-caption',
			'render_callback' => 'education_master_customize_partial_notice_caption',
		)
	);
}
