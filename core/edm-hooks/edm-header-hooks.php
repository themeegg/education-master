<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_top_header_start' ) ) :
	function education_master_top_header_start() {
		echo '<div class="edm-top-header-wrap">';
		echo '<div class="edm-container">';
	}
endif;

/**
 * Top header left section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_top_left_section' ) ) :
	function education_master_top_left_section() {
		$education_master_date_option = get_theme_mod( 'education_master_top_date_option', 'show' );
		?>
		<div class="edm-top-left-section-wrapper">
			<?php
			if ( $education_master_date_option == 'show' ) {
				echo '<div class="date-section">' . esc_html( date_i18n( 'l, F d, Y' ) ) . '</div>';
			}
			?>

			<?php if ( has_nav_menu( 'education_master_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'education_master_top_menu',
						'menu_id'        => 'top-menu',
						'depth'          => 1
					) );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .edm-top-left-section-wrapper -->
		<?php
	}
endif;

/**
 * Top header right section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_top_right_section' ) ) :
	function education_master_top_right_section() {
		?>
		<div class="edm-top-right-section-wrapper">
			<?php
			$education_master_top_social_option = get_theme_mod( 'education_master_top_social_option', 'show' );
			if ( $education_master_top_social_option == 'show' ) {
				education_master_social_media();
			}
			?>
		</div><!-- .edm-top-right-section-wrapper -->
		<?php
	}
endif;

/**
 * Top header end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_top_header_end' ) ) :
	function education_master_top_header_end() {
		echo '</div><!-- .edm-container -->';
		echo '</div><!-- .edm-top-header-wrap -->';
	}
endif;

/**
 * Managed functions for top header hook
 *
 * @since 1.0.0
 */
add_action( 'education_master_top_header', 'education_master_top_header_start', 5 );
add_action( 'education_master_top_header', 'education_master_top_left_section', 10 );
add_action( 'education_master_top_header', 'education_master_top_right_section', 15 );
add_action( 'education_master_top_header', 'education_master_top_header_end', 20 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * header section start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_header_section_start' ) ) :
	function education_master_header_section_start() {
		$education_master_header_style_option = get_theme_mod( 'education_master_header_style_option', 'default' );
		echo '<header id="masthead" class="site-header ' . esc_attr( $education_master_header_style_option ) . '" role="banner">';
	}
endif;

/**
 * header logo and ads section start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_header_logo_ads_section_start' ) ) :
	function education_master_header_logo_ads_section_start() {
		echo '<div class="edm-logo-section-wrapper">';
		echo '<div class="edm-container">';
	}
endif;

/**
 * site branding section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_site_branding_section' ) ) :
	function education_master_site_branding_section() {
		?>
		<div class="site-branding">
			<?php if ( function_exists( 'the_custom_logo' ) ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php }
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				                          rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				                         rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
			endif; ?>
		</div><!-- .site-branding -->
		<?php
	}
endif;

/**
 * header ads area
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_header_ads_section' ) ) :
	function education_master_header_ads_section() {
		?>
		<div class="edm-header-banner-area">
			<?php
			if ( is_active_sidebar( 'education_master_header_banner_area' ) ) {
				dynamic_sidebar( 'education_master_header_banner_area' );
			}
			?>
		</div><!-- .edm-header-banner-area -->
		<?php
	}
endif;

/**
 * header logo and ads section end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_header_logo_ads_section_end' ) ) :
	function education_master_header_logo_ads_section_end() {
		echo '</div><!-- .edm-container -->';
		echo '</div><!-- .edm-logo-section-wrapper -->';
	}
endif;

/**
 * header primary menu section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_primary_menu_section' ) ) :
	function education_master_primary_menu_section() {
		?>
		<div id="edm-menu-wrap" class="edm-header-menu-wrapper">
			<div class="edm-header-menu-block-wrap">
				<div class="edm-container">
					<?php
					if ( get_theme_mod( 'education_master_header_style_option', 'default' ) == 'default' ) {
						education_master_site_branding_section();
					} ?>
					<div class="edm-navigation">
						<a href="javascript:void(0)" class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </a>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php wp_nav_menu( array(
								'theme_location' => 'education_master_primary_menu',
								'menu_id'        => 'primary-menu'
							) );
							?>
						</nav><!-- #site-navigation -->

						<?php
						$education_master_search_icon_option = get_theme_mod( 'education_master_search_icon_option', 'show' );
						if ( $education_master_search_icon_option == 'show' ) {
							?>
							<div class="edm-header-search-wrapper">
								<span class="search-main"><i class="fa fa-search"></i></span>
								<div class="search-form-main edm-clearfix">
									<?php get_search_form(); ?>
								</div>
							</div><!-- .edm-header-search-wrapper -->
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- .edm-header-menu-wrapper -->
		<?php
	}
endif;

/**
 * header section end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_header_section_end' ) ) :
	function education_master_header_section_end() {
		echo '</header><!-- .site-header -->';
	}
endif;

/**
 * Managed functions for notice section
 *
 * @since 1.0.0
 */
add_action( 'education_master_header_section', 'education_master_header_section_start', 5 );
if ( get_theme_mod( 'education_master_header_style_option', 'default' ) !== 'default' ) {
	add_action( 'education_master_header_section', 'education_master_header_logo_ads_section_start', 10 );
	add_action( 'education_master_header_section', 'education_master_site_branding_section', 15 );
	add_action( 'education_master_header_section', 'education_master_header_ads_section', 20 );
	add_action( 'education_master_header_section', 'education_master_header_logo_ads_section_end', 25 );
}
add_action( 'education_master_header_section', 'education_master_primary_menu_section', 30 );
add_action( 'education_master_header_section', 'education_master_header_section_end', 35 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Notice section start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_notice_section_start' ) ) :
	function education_master_notice_section_start() {
		echo '<div class="edm-notice-wrapper">';
		echo '<div class="edm-container">';
		echo '<div class="edm-notice-block edm-clearfix">';
	}
endif;

/**
 * Notice content area
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_notice_content' ) ) :
	function education_master_notice_content() {
		$education_master_notice_caption = get_theme_mod( 'education_master_notice_caption', __( 'Notices', 'education-master' ) );
		?>
		<span class="notice-caption"><?php echo esc_html( $education_master_notice_caption ); ?></span>
		<div class="notice-content-wrapper">
			<?php
			$education_master_notice_cat_id = apply_filters( 'education_master_notice_cat_id', null );
			$notice_args                    = array(
				'cat'            => $education_master_notice_cat_id,
				'posts_per_page' => '5'
			);
			$notice_query                   = new WP_Query( $notice_args );
			if ( $notice_query->have_posts() ) {
				echo '<ul id="newsNotice" class="cS-hidden">';
				while ( $notice_query->have_posts() ) {
					$notice_query->the_post();
					?>
					<li>
						<div class="news-notice-title"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					</li>
					<?php
				}
				echo '</ul>';
			}
			?>
		</div><!-- .notice-content-wrapper -->
		<?php
	}
endif;

/**
 * Notice section end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_notice_section_end' ) ) :
	function education_master_notice_section_end() {
		echo '</div><!-- .edm-notice-block -->';
		echo '</div><!-- .edm-container -->';
		echo '</div><!-- .edm-notice-wrapper -->';
	}
endif;

/**
 * Managed functions for notice section
 *
 * @since 1.0.0
 */
add_action( 'education_master_notice_section', 'education_master_notice_section_start', 5 );
add_action( 'education_master_notice_section', 'education_master_notice_content', 10 );
add_action( 'education_master_notice_section', 'education_master_notice_section_end', 15 );

