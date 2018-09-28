<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_footer_start' ) ) :
	function education_master_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
		/**
 		* parallax footer
 		*
 		* @since 1.0.7
 		*/
		$parallax_footer = get_theme_mod('education_master_parallax_footer');
		if($parallax_footer) { ?>
			<div class="parallax" style='background-image: url("<?php echo esc_url($parallax_footer); ?>"); '>
			<div class="parallax-content"><?php  
		} 
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_footer_widget_section' ) ) :
	function education_master_footer_widget_section() {
		get_sidebar( 'footer' );
		$parallax_footer = get_theme_mod('education_master_parallax_footer');
		if($parallax_footer) { ?>
			?>  </div> </div> <?php
		}
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_bottom_footer_start' ) ) :
	function education_master_bottom_footer_start() {
		echo '<div class="bottom-footer edm-clearfix">';
		echo '<div class="edm-container">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_footer_site_info_section' ) ) :
	function education_master_footer_site_info_section() {
?>
		<div class="site-info">
			<span class="edm-copyright-text">
				<?php
					$education_master_copyright_text = get_theme_mod( 'education_master_copyright_text', __( 'Education Master', 'education-master' ) );
					echo esc_html( $education_master_copyright_text );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
				$education_master_author_url = 'https://themeegg.com/';
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'education-master' ), 'Education Master', '<a href="'. esc_url( $education_master_author_url ).'" rel="designer" target="_blank">ThemeEgg</a>' );
			?>
		</div><!-- .site-info -->
<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer menu
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_footer_menu_section' ) ) :
	function education_master_footer_menu_section() {
?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'depth' => 1, 'theme_location' => 'education_master_footer_menu', 'menu_id' => 'footer-menu' ) );
			?>
		</nav><!-- #site-navigation -->
<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_bottom_footer_end' ) ) :
	function education_master_bottom_footer_end() {
		echo '</div><!-- .edm-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_footer_end' ) ) :
	function education_master_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */

if( ! function_exists( 'education_master_go_top' ) ) :
	function education_master_go_top() {
		echo '<div id="edm-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'education_master_footer', 'education_master_footer_start', 5 );
add_action( 'education_master_footer', 'education_master_footer_widget_section', 10 );
add_action( 'education_master_footer', 'education_master_bottom_footer_start', 15 );
add_action( 'education_master_footer', 'education_master_footer_site_info_section', 20 );
add_action( 'education_master_footer', 'education_master_footer_menu_section', 25 );
add_action( 'education_master_footer', 'education_master_bottom_footer_end', 30 );
add_action( 'education_master_footer', 'education_master_footer_end', 35 );
add_action( 'education_master_footer', 'education_master_go_top', 40 );
