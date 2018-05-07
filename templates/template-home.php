<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

get_header();

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Top Section Area
 *
 * @since 1.0.0
 */
do_action( 'education_master_slider_section' );
do_action( 'education_master_service_section' );
?>

<?php

if ( is_active_sidebar( 'education_master_home_top_section_area' ) ) {
	?>
	<div class="edm-home-top-section edm-clearfix">
		<?php dynamic_sidebar( 'education_master_home_top_section_area' ); ?>
	</div><!-- .edm-home-top-section -->
	<?php
}
?>
<div class="edm-container">
<?php
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Middle Section Area
 *
 * @since 1.0.0
 */
if ( is_active_sidebar( 'education_master_home_middle_section_area' ) ) {
	?>
	<div class="edm-home-middle-section edm-clearfix">
		<div class="middle-primary">
			<?php dynamic_sidebar( 'education_master_home_middle_section_area' ); ?>
		</div><!-- .middle-primary -->
		<div class="middle-aside">
			<?php dynamic_sidebar( 'education_master_home_middle_aside_area' ); ?>
		</div><!-- .middle-aside -->
	</div><!-- .edm-home-middle-section -->
	<?php
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Bottom Section Area
 *
 * @since 1.0.0
 */
if ( is_active_sidebar( 'education_master_home_bottom_section_area' ) ) {
	?>
	<div class="edm-home-bottom-section">
		<?php dynamic_sidebar( 'education_master_home_bottom_section_area' ); ?>
	</div><!-- .edm-home-bottom-section -->
	<?php
}

get_footer();
