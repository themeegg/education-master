<?php
/**
 * Customizer settings for Important Link Panel
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'education_master_important_link_panel_register' );

function education_master_important_link_panel_register( $wp_customize ) {

	// Theme important links started
	class Education_Master_Important_Links extends WP_Customize_Control {

		public $type = "education-master-important-links";

		public function render_content() {
			//Add Theme instruction, Support Forum, Demo Link, Rating Link
			$important_links = array(
				'view-pro'      => array(
					'link' => esc_url( 'https://themeegg.com/downloads/education-master-pro-wordpress-theme/' ),
					'text' => esc_html__( 'View Pro', 'education-master' ),
				),
				'theme-info'    => array(
					'link' => esc_url( 'https://themeegg.com/downloads/education-master/' ),
					'text' => esc_html__( 'Theme Info', 'education-master' ),
				),
				'support'       => array(
					'link' => esc_url( 'https://themeegg.com/support-forum/' ),
					'text' => esc_html__( 'Support', 'education-master' ),
				),
				'documentation' => array(
					'link' => esc_url( 'https://docs.themeegg.com/education-master/' ),
					'text' => esc_html__( 'Documentation', 'education-master' ),
				),
				'demo'          => array(
					'link' => esc_url( 'https://demo.themeegg.com/themes/education-master/' ),
					'text' => esc_html__( 'View Demo', 'education-master' ),
				),
				'rating'        => array(
					'link' => esc_url( 'https://wordpress.org/support/view/theme-reviews/education-master?filter=5' ),
					'text' => esc_html__( 'Rate this theme', 'education-master' ),
				),
			);
			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr( $important_link['text'] ) . ' </a></p>';
			}
		}

	}

	$wp_customize->add_section( 'education_master_important_links', array(
		'priority' => 1,
		'title'    => __( 'Education Master Important Links', 'education-master' ),
	) );

	/**
	 * This setting has the dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'education_master_important_links', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_master_links_sanitize',
	) );

	$wp_customize->add_control( new Education_Master_Important_Links( $wp_customize, 'important_links', array(
		'label'    => __( 'Important Links', 'education-master' ),
		'section'  => 'education_master_important_links',
		'settings' => 'education_master_important_links',
	) ) );
	// Theme Important Links Ended

}
