<?php
/**
 * File to sanitize customizer field
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/**
 * Sanitize checkbox value
 *
 * @since 1.0.1
 */
function education_master_sanitize_checkbox( $input ) {
	//returns true if checkbox is checked
	return ( ( isset( $input ) && 'true' == $input ) ? 'true' : 'false' );
}

/**
 * Sanitize repeater value
 *
 * @since 1.0.0
 */
function education_master_sanitize_repeater( $input ) {
	$input_decoded = json_decode( $input, true );

	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxes => $box ) {
			foreach ( $box as $key => $value ) {
				$input_decoded[ $boxes ][ $key ] = wp_kses_post( $value );
			}
		}

		return json_encode( $input_decoded );
	}

	return $input;
}

/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function education_master_sanitize_site_layout( $input ) {
	$valid_keys = array(
		'edm_fullwidth_layout'   => __( 'Full Width Style', 'education-master' ),
		'edm_boxed_width_layout' => __( 'Box Style', 'education-master' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * switch option (show/hide)
 *
 * @since 1.0.0
 */
function education_master_sanitize_switch_option( $input ) {
	$valid_keys = array(
		'show' => __( 'Show', 'education-master' ),
		'hide' => __( 'Hide', 'education-master' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_customize_register()
 *
 * @return void
 */
function education_master_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_customize_register()
 *
 * @return void
 */
function education_master_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_footer_settings_register()
 *
 * @return void
 */
function education_master_customize_partial_copyright() {
	return get_theme_mod( 'education_master_copyright_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_design_settings_register()
 *
 * @return void
 */
function education_master_customize_partial_related_title() {
	return get_theme_mod( 'education_master_related_posts_title' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_design_settings_register()
 *
 * @return void
 */
function education_master_customize_partial_archive_more() {
	return get_theme_mod( 'education_master_archive_read_more_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Education Master 1.0.1
 * @see education_master_header_settings_register()
 *
 * @return void
 */
function education_master_customize_partial_notice_caption() {
	return get_theme_mod( 'education_master_notice_caption' );
}

if ( ! function_exists( 'education_master_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function education_master_is_featured_slider_active( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'education_master_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function education_master_is_featured_slider_active( $control ) {

		if ( 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'education_master_is_featured_slider_caption_active' ) ) :

	/**
	 * Check if featured slider caption is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function education_master_is_featured_slider_caption_active( $control ) {

		if ( true === $control->manager->get_setting( 'theme_options[featured_slider_enable_caption]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;


if ( ! function_exists( 'education_master_is_featured_page_slider_active' ) ) :

	/**
	 * Check if featured page slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function education_master_is_featured_page_slider_active( $control ) {

		if (
			'featured-page' === $control->manager->get_setting( 'theme_options[featured_slider_type]' )->value()
			&& 'disabled' !== $control->manager->get_setting( 'theme_options[featured_slider_status]' )->value()
		) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'education_master_is_image_in_archive_active' ) ) :

	/**
	 * Check if image in archive is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function education_master_is_image_in_archive_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'theme_options[archive_image]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
/**
 * Sanitization functions.
 *
 * @package Business_Style
 */

if ( ! function_exists( 'education_master_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 *
	 * @return mixed Sanitized value.
	 */
	function education_master_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;
if ( ! function_exists( 'education_master_sanitize_select_liberal' ) ) :

	/**
	 * Sanitize select, quite liberal than other select sanitization.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 *
	 * @return mixed Sanitized value.
	 */
	function education_master_sanitize_select_liberal( $input, $setting ) {

		// Escape value.
		$input = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;
if ( ! function_exists( 'education_master_sanitize_number_range' ) ) :

	/**
	 * Sanitize number range.
	 *
	 * @since 1.0.0
	 *
	 * @see absint() https://developer.wordpress.org/reference/functions/absint/
	 *
	 * @param int $input Number to check within the numeric range defined by the setting.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 *
	 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise, the setting default.
	 */
	function education_master_sanitize_number_range( $input, $setting ) {

		// Ensure input is an absolute integer.
		$input = absint( $input );

		// Get the input attributes associated with the setting.
		$atts = $setting->manager->get_control( $setting->id )->input_attrs;

		// Get min.
		$min = ( isset( $atts['min'] ) ? $atts['min'] : $input );

		// Get max.
		$max = ( isset( $atts['max'] ) ? $atts['max'] : $input );

		// Get Step.
		$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

		// If the input is within the valid range, return it; otherwise, return the default.
		return ( $min <= $input && $input <= $max && is_int( $input / $step ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'education_master_sanitize_dropdown_pages' ) ) :

	/**
	 * Sanitize dropdown pages.
	 *
	 * @since 1.0.0
	 *
	 * @param int $page_id Page ID.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 *
	 * @return int|string Page ID if the page is published; otherwise, the setting default.
	 */
	function education_master_sanitize_dropdown_pages( $page_id, $setting ) {

		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );

	}

endif;


// sanitization of links
function education_master_links_sanitize() {
	return false;
}
