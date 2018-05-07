<?php
/**
 * Education Master custom function and work related to widgets.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_master_widgets_init() {

	/**
	 * Register right sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'education-master' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register left sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'education-master' ),
		'id'            => 'education_master_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home top section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Top Home Area (Full Width)', 'education-master' ),
		'id'            => 'education_master_home_top_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="edm-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Middle Home Area', 'education-master' ),
		'id'            => 'education_master_home_middle_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="edm-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle aside area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar( Middle part ) ', 'education-master' ),
		'id'            => 'education_master_home_middle_aside_area',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="edm-block-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home bottom section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Home Area', 'education-master' ),
		'id'            => 'education_master_home_bottom_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="edm-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register 4 different footer area
	 *
	 * @since 1.0.0
	 */
	register_sidebars( 4, array(
		'name'          => esc_html__( 'Footer %d', 'education-master' ),
		'id'            => 'education_master_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'education-master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'education_master_widgets_init' );

//Load required file for widgets
require get_template_directory() . '/core/edm-widgets/edm-cta.php';
require get_template_directory() . '/core/edm-widgets/edm-widget-fields.php';
require get_template_directory() . '/core/edm-widgets/edm-featured-posts.php';
require get_template_directory() . '/core/edm-widgets/edm-block-posts.php';
require get_template_directory() . '/core/edm-widgets/edm-carousel.php';
require get_template_directory() . '/core/edm-widgets/edm-social-media.php';
require get_template_directory() . '/core/edm-widgets/edm-recent-posts.php';
require get_template_directory() . '/core/edm-widgets/edm-default-tabbed.php';
