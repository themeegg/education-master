<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function education_master_body_classes( $classes ) {

	global $post;
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	/**
	 * Sidebar option for post/page/archive
	 *
	 * @since 1.0.0
	 */
	if ( 'post' === get_post_type() ) {
		$sidebar_meta_option = get_post_meta( $post->ID, 'edm_single_post_sidebar', true );
	}

	if ( 'page' === get_post_type() ) {
		$sidebar_meta_option = get_post_meta( $post->ID, 'edm_single_post_sidebar', true );
	}

	if ( is_home() ) {
		$home_id             = get_option( 'page_for_posts' );
		$sidebar_meta_option = get_post_meta( $home_id, 'edm_single_post_sidebar', true );
	}

	if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
		$sidebar_meta_option = 'default_sidebar';
	}
	$archive_sidebar      = get_theme_mod( 'education_master_archive_sidebar', 'right_sidebar' );
	$post_default_sidebar = get_theme_mod( 'education_master_default_post_sidebar', 'right_sidebar' );
	$page_default_sidebar = get_theme_mod( 'education_master_default_page_sidebar', 'right_sidebar' );

	if ( $sidebar_meta_option == 'default_sidebar' ) {
		if ( is_single() ) {
			if ( $post_default_sidebar == 'right_sidebar' ) {
				$classes[] = 'right-sidebar';
			} elseif ( $post_default_sidebar == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $post_default_sidebar == 'no_sidebar' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $post_default_sidebar == 'no_sidebar_center' ) {
				$classes[] = 'no-sidebar-center';
			}
		} elseif ( is_page() && ! is_page_template( 'templates/home-template.php' ) ) {
			if ( $page_default_sidebar == 'right_sidebar' ) {
				$classes[] = 'right-sidebar';
			} elseif ( $page_default_sidebar == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $page_default_sidebar == 'no_sidebar' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $page_default_sidebar == 'no_sidebar_center' ) {
				$classes[] = 'no-sidebar-center';
			}
		} elseif ( $archive_sidebar == 'right_sidebar' ) {
			$classes[] = 'right-sidebar';
		} elseif ( $archive_sidebar == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $archive_sidebar == 'no_sidebar' ) {
			$classes[] = 'no-sidebar';
		} elseif ( $archive_sidebar == 'no_sidebar_center' ) {
			$classes[] = 'no-sidebar-center';
		}
	} elseif ( $sidebar_meta_option == 'right_sidebar' ) {
		$classes[] = 'right-sidebar';
	} elseif ( $sidebar_meta_option == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $sidebar_meta_option == 'no_sidebar' ) {
		$classes[] = 'no-sidebar';
	} elseif ( $sidebar_meta_option == 'no_sidebar_center' ) {
		$classes[] = 'no-sidebar-center';
	}

	/**
	 * option for web site layout
	 */
	$education_master_website_layout = esc_attr( get_theme_mod( 'education_master_site_layout', 'edm_fullwidth_layout' ) );

	if ( ! empty( $education_master_website_layout ) ) {
		$classes[] = $education_master_website_layout;
	}

	/**
	 * Class for archive
	 */
	if ( is_archive() ) {
		$education_master_archive_layout = get_theme_mod( 'education_master_archive_layout', 'classic' );
		if ( ! empty( $education_master_archive_layout ) ) {
			$classes[] = 'archive-' . esc_attr( $education_master_archive_layout );
		}
	}

	$enable_preloader= get_theme_mod('education_master_preloader');
    if($enable_preloader){
        $classes[] = "body_preloader";
    }
	return $classes;
}

add_filter( 'body_class', 'education_master_body_classes' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for Education Master.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_fonts_url' ) ) :
	function education_master_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'education-master' ) ) {
			$fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Signika, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Signika font: on or off', 'education-master' ) ) {
			$fonts[] = 'Signika:400italic,700italic,300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'education_master_admin_scripts' );

function education_master_admin_scripts( $hook ) {

	global $education_master_version;

	if ( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
		return;
	}

	wp_enqueue_script( 'jquery-ui-button' );

	wp_enqueue_script( 'education-master-admin-script', get_template_directory_uri() . '/assets/js/edm-admin-scripts.js', array( 'jquery' ), esc_attr( $education_master_version ), true );

	wp_enqueue_style( 'education-master-admin-style', get_template_directory_uri() . '/assets/css/edm-admin-style.css', array(), esc_attr( $education_master_version ) );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function education_master_scripts() {

	global $education_master_version;

	wp_enqueue_style( 'education-master-fonts', education_master_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/assets/vendor/lightslider/css/lightslider.min.css', array(), '1.1.6' );

	wp_enqueue_style( 'education-master-style', get_stylesheet_uri(), array(), esc_attr( $education_master_version ) );

	wp_enqueue_style( 'education-master-main', get_template_directory_uri() . '/assets/css/education-master.css', array(), esc_attr( $education_master_version ) );

	wp_enqueue_style( 'education-master-responsive-style', get_template_directory_uri() . '/assets/css/edm-responsive.css', array(), '1.0.0' );

	$refine_output_css = education_master_dynamic_styles();

	wp_add_inline_style( 'education-master-main', $refine_output_css );

	wp_enqueue_script( 'education-master-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $education_master_version ), true );

	$menu_sticky_option = get_theme_mod( 'education_master_menu_sticky_option', 'show' );
	if ( $menu_sticky_option == 'show' ) {
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/vendor/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );

		wp_enqueue_script( 'edm-sticky-menu-setting', get_template_directory_uri() . '/assets/vendor/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
	}
	$education_master_feature_slider_status = education_master_get_option( 'featured_slider_status' );

	if ( $education_master_feature_slider_status !== 'disabled' ) {
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/assets/vendor/cycle2/js/jquery.cycle2.js', array( 'jquery' ), '2.1.6', true );
	}

	wp_enqueue_script( 'education-master-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $education_master_version ), true );

	wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/vendor/lightslider/js/lightslider.min.js', array( 'jquery' ), '1.1.6', true );

	wp_enqueue_script( 'jquery-ui-tabs' );

	wp_enqueue_script( 'education-master-custom-script', get_template_directory_uri() . '/assets/js/edm-custom-scripts.js', array( 'jquery' ), esc_attr( $education_master_version ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'education_master_scripts' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'education_master_social_media' ) ):
	function education_master_social_media() {
		$get_social_media_icons  = get_theme_mod( 'social_media_icons', '' );
		$get_decode_social_media = json_decode( $get_social_media_icons );
		if ( ! empty( $get_decode_social_media ) ) {
			echo '<div class="edm-social-icons-wrapper">';
			foreach ( $get_decode_social_media as $single_icon ) {
				$icon_class = $single_icon->social_icon_class;
				$icon_url   = $single_icon->social_icon_url;
				if ( ! empty( $icon_url ) ) {
					echo '<span class="social-link"><a href="' . esc_url( $icon_url ) . '" target="_blank"><i class="' . esc_attr( $icon_class ) . '"></i></a></span>';
				}
			}
			echo '</div><!-- .edm-social-icons-wrapper -->';
		}
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */
if ( ! function_exists( 'education_master_categories_lists' ) ):
	function education_master_categories_lists() {
		$education_master_categories       = get_categories( array( 'hide_empty' => 1 ) );
		$education_master_categories_lists = array();
		foreach ( $education_master_categories as $category ) {
			$education_master_categories_lists[ $category->term_id ] = $category->name;
		}

		return $education_master_categories_lists;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category dropdown
 *
 * @return array();
 */
if ( ! function_exists( 'education_master_categories_dropdown' ) ):
	function education_master_categories_dropdown() {
		$education_master_categories            = get_categories( array( 'hide_empty' => 1 ) );
		$education_master_categories_lists      = array();
		$education_master_categories_lists['0'] = esc_html__( 'Select Category', 'education-master' );
		foreach ( $education_master_categories as $category ) {
			$education_master_categories_lists[ $category->term_id ] = $category->name;
		}

		return $education_master_categories_lists;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function education_master_css_strip_whitespace( $css ) {
	$replace = array(
		"#/\*.*?\*/#s" => "",  // Strip C style comments.
		"#\s\s+#"      => " ", // Strip excess whitespace.
	);
	$search  = array_keys( $replace );
	$css     = preg_replace( $search, $replace, $css );

	$replace = array(
		": "  => ":",
		"; "  => ";",
		" {"  => "{",
		" }"  => "}",
		", "  => ",",
		"{ "  => "{",
		";}"  => "}", // Strip optional semicolons.
		",\n" => ",", // Don't wrap multiple selectors.
		"\n}" => "}", // Don't wrap closing braces.
		"} "  => "}\n", // Put each rule on it's own line.
	);
	$search  = array_keys( $replace );
	$css     = str_replace( $search, $replace, $css );

	return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_hover_color' ) ) :
	function education_master_hover_color( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color = hexdec( $color ); // Convert to decimal
			$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Dynamic style about template
 *
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'education_master_dynamic_styles' );

if ( ! function_exists( 'education_master_dynamic_styles' ) ) :
	function education_master_dynamic_styles() {

		$get_categories                    = get_categories( array( 'hide_empty' => 0 ) );
		$education_master_theme_color      = get_theme_mod( 'education_master_theme_color', '#294a70' );
		$education_master_theme_dark_color = education_master_hover_color( $education_master_theme_color, '-50' );

		$education_master_site_title_option = get_theme_mod( 'education_master_site_title_option', 'true' );
		$education_master_site_title_color  = get_theme_mod( 'education_master_site_title_color', '#294a70' );

		$output_css = '';

		$output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.edm-top-header-wrap,.edm-header-menu-wrapper,#site-navigation ul.sub-menu, #site-navigation ul.children,.edm-header-menu-wrapper::before, .edm-header-menu-wrapper::after,.edm-header-search-wrapper .search-form-main .search-submit,.education_master_slider .lSAction > a:hover,.education_master_default_tabbed ul.widget-tabs li,.edm-full-width-title-nav-wrap .carousel-nav-action .carousel-controls:hover,.education_master_social_media .social-link a,.edm-archive-more .edm-button:hover,.error404 .page-title,#edm-scrollup,.education_master_featured_slider .slider-posts .lSAction > a:hover { background: " . esc_attr( $education_master_theme_color ) . "}\n";

		if ( $education_master_theme_color != '#294a70' ) {

			$output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.edm-slide-content-wrap .post-title a:hover,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#top-footer .widget li:hover:before,.education_master_featured_posts .edm-single-post .edm-post-content .edm-post-title a:hover,.education_master_fullwidth_posts .edm-single-post .edm-post-title a:hover,.education_master_block_posts .layout3 .edm-primary-block-wrap .edm-single-post .edm-post-title a:hover,.education_master_featured_posts .layout2 .edm-single-post-wrap .edm-post-content .edm-post-title a:hover,.page-header, .edm-post-meta span:hover,.edm-post-meta span a:hover,.education_master_featured_posts .layout2 .edm-single-post-wrap .edm-post-content .edm-post-meta span:hover,.education_master_featured_posts .layout2 .edm-single-post-wrap .edm-post-content .edm-post-meta span a:hover,.edm-post-title.small-size a:hover,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.edm-post-meta span:hover, .edm-post-meta span a:hover, .education_master_featured_posts .edm-single-post-wrap .edm-post-content .edm-post-meta span:hover, .education_master_featured_posts .edm-single-post-wrap .edm-post-content .edm-post-meta span a:hover,.education_master_featured_slider .featured-posts .edm-single-post .edm-post-content .edm-post-title a:hover { color: " . esc_attr( $education_master_theme_color ) . "}\n";
			$output_css .= ".edm-timeline .date{ background-color: " . esc_attr( $education_master_theme_dark_color ) . "}\n";
			$output_css .= ".edm-timeline .date, .edm-timeline .timeline-img, .edm-timeline a, .edm-timeline .timeline::before, .edm-timeline a:hover, .edm-timeline a:active, .edm-timeline a:focus{ background-color: " . esc_attr( $education_master_theme_dark_color ) . "}\n";
			$output_css .= ".edm-testimonials .edm-testimonial-item .edm-testimonial-title{ color: " . esc_attr( $education_master_theme_color ) . "}\n";
			$output_css .= ".slick-dots li.slick-active button{ background-color: " . esc_attr( $education_master_theme_color ) . "}\n";
			$output_css .= ".edm-testimonials .edm-testimonial-item:before, .edm-team-item .edm-team-title,
			 .education_master_carousel .carousel-posts.layout2 .edm-single-post .edm-post-title a
			{ color: " . esc_attr( $education_master_theme_dark_color ) . "}\n";


			$output_css .= ".edm-header-menu-block-wrap::before, .edm-header-menu-block-wrap::after { border-right-color: " . esc_attr( $education_master_theme_dark_color ) . "}\n";

			$output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.edm-archive-more .edm-button:hover { border-color: " . esc_attr( $education_master_theme_color ) . "}\n";

			$output_css .= ".comment-list .comment-body,.edm-header-search-wrapper .search-form-main { border-top: " . esc_attr( $education_master_theme_color ) . "}\n";

			$output_css .= ".edm-header-search-wrapper .search-form-main:before { border-bottom: " . esc_attr( $education_master_theme_color ) . "}\n";

			$output_css .= "@media (max-width: 768px) { #site-navigation,.main-small-navigation li.current-menu-item > .sub-toggle i { background: " . esc_attr( $education_master_theme_color ) . " !important } }\n";

		}

		if ( $education_master_site_title_option == 'false' ) {
			$output_css .= ".site-title, .site-description {
                            position: absolute;
                            clip: rect(1px, 1px, 1px, 1px);
                        }\n";
		} else {
			$output_css .= ".site-title a, .site-description {
                            color:" . esc_attr( $education_master_site_title_color ) . ";
                        }\n";
		}

		$refine_output_css = education_master_css_strip_whitespace( $output_css );

		return $refine_output_css;

	}
endif;

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_get_sidebar' ) ):
	function education_master_get_sidebar() {
		global $post;

		if ( 'post' === get_post_type() ) {
			$sidebar_meta_option = get_post_meta( $post->ID, 'edm_single_post_sidebar', true );
		}

		if ( 'page' === get_post_type() ) {
			$sidebar_meta_option = get_post_meta( $post->ID, 'edm_single_post_sidebar', true );
		}

		if ( is_home() ) {
			$set_id              = get_option( 'page_for_posts' );
			$sidebar_meta_option = get_post_meta( $set_id, 'edm_single_post_sidebar', true );
		}

		if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
			$sidebar_meta_option = 'default_sidebar';
		}

		$archive_sidebar      = get_theme_mod( 'education_master_archive_sidebar', 'right_sidebar' );
		$post_default_sidebar = get_theme_mod( 'education_master_default_post_sidebar', 'right_sidebar' );
		$page_default_sidebar = get_theme_mod( 'education_master_default_page_sidebar', 'right_sidebar' );

		if ( $sidebar_meta_option == 'default_sidebar' ) {
			if ( is_single() ) {
				if ( $post_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $post_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( is_page() ) {
				if ( $page_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $page_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $archive_sidebar == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $archive_sidebar == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $sidebar_meta_option == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $sidebar_meta_option == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/*------------------------------------------------------------------------------------------------*/
/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_font_awesome_social_icon_array' ) ) :
	function education_master_font_awesome_social_icon_array() {
		return array(
			"fa fa-facebook-square",
			"fa fa-facebook-f",
			"fa fa-facebook",
			"fa fa-facebook-official",
			"fa fa-twitter-square",
			"fa fa-twitter",
			"fa fa-yahoo",
			"fa fa-google",
			"fa fa-google-wallet",
			"fa fa-google-plus-circle",
			"fa fa-google-plus-official",
			"fa fa-instagram",
			"fa fa-linkedin-square",
			"fa fa-linkedin",
			"fa fa-pinterest-p",
			"fa fa-pinterest",
			"fa fa-pinterest-square",
			"fa fa-google-plus-square",
			"fa fa-google-plus",
			"fa fa-youtube-square",
			"fa fa-youtube",
			"fa fa-youtube-play",
			"fa fa-vimeo",
			"fa fa-vimeo-square",
		);
	}
endif;
