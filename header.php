<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>><?php
 /**
     * Website Preloader
     *
     * @since 1.0.7
     */
$preloader = get_theme_mod('education_master_preloader');
if($preloader){ ?>
	<div class = "body_preloader">
		<div id="spinnerC" class="spinner-wrapper">
			<div class="spinner" style="">
				<img class="img-responsive" src="<?php echo esc_url($preloader); ?>">
			</div>
		</div>
	</div><?php 
}
?>
<?php
/**
 * education_master_before_page hook
 *
 * @since 1.0.0
 */
do_action( 'education_master_before_page' );
?>

<div id="page" class="site">
	<?php
	$education_master_notice_option = get_theme_mod( 'education_master_notice_option', 'show' );
	if ( $education_master_notice_option == 'show' && is_front_page() ) {

		/**
		 * education_master_top_header hook
		 *
		 * @hooked - education_master_notice_section_start - 5
		 * @hooked - education_master_notice_content - 10
		 * @hooked - education_master_notice_section_end - 15
		 *
		 * @since 1.0.0
		 */
		do_action( 'education_master_notice_section' );
	}

	$education_master_top_header_option = get_theme_mod( 'education_master_top_header_option', 'show' );
	if ( $education_master_top_header_option == 'show' ) {

		/**
		 * education_master_top_header hook
		 *
		 * @hooked - education_master_top_header_start - 5
		 * @hooked - education_master_top_left_section - 10
		 * @hooked - education_master_top_right_section - 15
		 * @hooked - education_master_top_header_end - 20
		 *
		 * @since 1.0.0
		 */
		do_action( 'education_master_top_header' );
	}
	?>

	<?php
	/**
	 * education_master_header_section hook
	 *
	 * @hooked - education_master_header_section_start - 5
	 * @hooked - education_master_header_logo_ads_section_start - 10
	 * @hooked - education_master_site_branding_section - 15
	 * @hooked - education_master_header_ads_section - 20
	 * @hooked - education_master_header_logo_ads_section_end - 25
	 * @hooked - education_master_primary_menu_section - 30
	 * @hooked - education_master_header_section_end - 35
	 *
	 * @since 1.0.0
	 */
	do_action( 'education_master_header_section' );
	?>


	<div id="content" class="site-content">
		<?php
		if ( ! is_page_template( 'templates/template-home.php' ) ){
		?>
		<div class="edm-container">
			<?php } ?>
