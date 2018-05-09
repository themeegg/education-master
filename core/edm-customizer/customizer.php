<?php
/**
 * Education Master Theme Customizer
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_master_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'education_master_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'education_master_customize_partial_blogdescription',
		)
	);

	// Load slider customize option.
	require get_template_directory() . '/core/edm-customizer/parts/edm-customizer-slider.php';


	// Load Services
	require get_template_directory() . '/core/edm-customizer/parts/edm-customizer-services.php';

}

add_action( 'customize_register', 'education_master_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_master_customize_preview_js() {
	wp_enqueue_script( 'education_master_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'education_master_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function education_master_customize_backend_scripts() {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	wp_enqueue_style( 'education_master_admin_customizer_style', get_template_directory_uri() . '/assets/css/edm-customizer-style.css' );

	wp_enqueue_script( 'education_master_admin_customizer', get_template_directory_uri() . '/assets/js/edm-customizer-controls.js', array(
		'jquery',
		'customize-controls'
	), '20170616', true );
}

add_action( 'customize_controls_enqueue_scripts', 'education_master_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.0.0
 */
require get_template_directory() . '/core/edm-customizer/parts/edm-important-link-panel.php'; //Important Link panel
require get_template_directory() . '/core/edm-customizer/parts/edm-general-panel.php';          // General Settings
require get_template_directory() . '/core/edm-customizer/parts/edm-header-panel.php';            // Header Settings
require get_template_directory() . '/core/edm-customizer/parts/edm-additional-panel.php';       // Additional Settings
require get_template_directory() . '/core/edm-customizer/parts/edm-design-panel.php';           // Design Settings
require get_template_directory() . '/core/edm-customizer/parts/edm-footer-panel.php';           // Footer Settings
require get_template_directory() . '/core/edm-customizer/parts/edm-custom-classes.php';         // Custom Classes
require get_template_directory() . '/core/edm-customizer/parts/edm-customizer-sanitize.php';    // Customizer Sanitize
