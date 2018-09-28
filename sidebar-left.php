<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

if ( !is_active_sidebar( 'education_master_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" style="">
	<?php dynamic_sidebar( 'education_master_left_sidebar' ); ?>
</aside><!-- #secondary -->
