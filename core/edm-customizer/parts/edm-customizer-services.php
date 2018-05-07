<?php
/**
 * Theme Options related to Services
 *
 * @package Education_Master
 */

$default = education_master_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'edm_services_panel',
	array(
		'title'      => __( 'Services', 'education-master' ),
		'priority'   => 101,
		'capability' => 'edit_theme_options',
	)
);

// Service Type Section.
$wp_customize->add_section( 'edm_section_theme_services_setting',
	array(
		'title'      => __( 'Services Settings', 'education-master' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'edm_services_panel',
	)
);

$services_number = edm_get_number_of_services();

if ( $services_number > 0 ) {
	$priority_number = 1;
	for ( $i = 1; $i <= $services_number; $i ++ ) {
		$wp_customize->add_setting( "theme_options[services_page_heading_$i]",
			array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new Education_Master_Heading_Controls( $wp_customize, "theme_options[services_page_heading_$i]",
				array(
					'label'    => __( 'Service', 'education-master' ) . ' #' . $i,
					'section'  => 'edm_section_theme_services_setting',
					'settings' => "theme_options[services_page_heading_$i]",
					'priority' => ++ $priority_number,
				)
			)
		);


		$wp_customize->add_setting( "theme_options[service_page_$i]",
			array(
				'default'           => isset( $default[ 'service_page_' . $i ] ) ? $default[ 'service_page_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'education_master_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "theme_options[service_page_$i]",
			array(
				'label'    => __( 'Select Page', 'education-master' ),
				'section'  => 'edm_section_theme_services_setting',
				'type'     => 'dropdown-pages',
				'priority' => ++ $priority_number,
			)
		);

		$wp_customize->add_setting( "theme_options[service_background_$i]",
			array(
				'default'           => isset( $default[ 'service_background_' . $i ] ) ? $default[ 'service_background_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				"theme_options[service_background_$i]",
				array(
					'label'    => __( 'Background Color', 'education-master' ),
					'section'  => 'edm_section_theme_services_setting',
					'settings' => "theme_options[service_background_$i]",
					'priority' => ++ $priority_number,

				) )
		);

		// Setting featured_slider_enable_overlay.
		$wp_customize->add_setting( "theme_options[service_icon_$i]",
			array(
				'default'           => isset( $default[ 'service_icon_' . $i ] ) ? $default[ 'service_icon_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( "theme_options[service_icon_$i]",
			array(
				'label'    => __( 'Service ICON (font awesome icon)', 'education-master' ),
				'section'  => 'edm_section_theme_services_setting',
				'type'     => 'text',
				'priority' => ++ $priority_number,
			)
		);

	} // End for loop.
}
