<?php

if ( ! function_exists( 'education_master_get_image_alignment_options' ) ) :

	/**
	 * Returns image alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_image_alignment_options() {

		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'education-master' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'education-master' ),
			'center' => esc_html_x( 'Center', 'alignment', 'education-master' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'education-master' ),
		);

		return $choices;

	}

endif;

if ( ! function_exists( 'education_master_get_slider_caption_alignment_options' ) ) :

	/**
	 * Returns slider caption alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_slider_caption_alignment_options() {

		$choices = array(
			'left'   => esc_html_x( 'Left', 'alignment', 'education-master' ),
			'center' => esc_html_x( 'Center', 'alignment', 'education-master' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'education-master' ),
		);

		return $choices;

	}

endif;

if ( ! function_exists( 'education_master_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'transition effect', 'education-master' ),
			'fadeout'    => _x( 'fadeout', 'transition effect', 'education-master' ),
			'none'       => _x( 'none', 'transition effect', 'education-master' ),
			'scrollHorz' => _x( 'scrollHorz', 'transition effect', 'education-master' ),
		);
		$output  = apply_filters( 'education_master_filter_featured_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_master_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_featured_slider_content_options() {

		$choices = array(
			'home-page' => esc_html__( 'Home Page', 'education-master' ),
			'disabled'  => esc_html__( 'Disabled', 'education-master' ),
		);
		$output  = apply_filters( 'education_master_filter_featured_slider_content_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_master_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_featured_slider_type() {

		$choices = array(
			'featured-page' => __( 'Featured Pages', 'education-master' ),
		);
		$output  = apply_filters( 'education_master_filter_featured_slider_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_master_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int $min Min.
	 * @param int $max Max.
	 *
	 * @return array Options array.
	 */
	function education_master_get_numbers_dropdown_options( $min = 1, $max = 4 ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i ++ ) {
				$output[ $i ] = $i;
			}
		}

		return $output;

	}

endif;
if ( ! function_exists( 'education_master_get_header_style_design' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_master_get_header_style_design() {

		$choices = array(
			'default' => __( 'Default (No header Banner style)', 'education-master' ),
			'center'  => __( 'Center Align', 'education-master' ),
			'left'    => __( 'Left Align', 'education-master' ),
		);
		$output  = apply_filters( 'education_master_header_style_design', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;
