<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Widget Title
 *
 * @since 1.0.0
 */
add_action( 'education_master_widget_title', 'education_master_widget_title_callback' );
if ( ! function_exists( 'education_master_widget_title_callback' ) ) :
	function education_master_widget_title_callback( $education_master_title_args ) {
		$education_master_block_title     = $education_master_title_args['title'];
		$education_master_block_cat_id    = $education_master_title_args['cat_id'];
		$education_master_title_cat_link  = get_theme_mod( 'education_master_widget_cat_link_option', 'show' );
		$education_master_title_cat_color = get_theme_mod( 'education_master_widget_cat_color_option', 'show' );
		if ( $education_master_title_cat_color == 'show' ) {
			$title_class = 'edm-title edm-cat-' . $education_master_block_cat_id;
		} else {
			$title_class = 'edm-title';
		}

		if ( ! empty( $education_master_block_cat_id ) && $education_master_title_cat_link == 'show' ) {
			$education_master_blcok_cat_link = get_category_link( $education_master_block_cat_id );
			echo '<h2 class="edm-block-title"><a href="' . esc_url( $education_master_blcok_cat_link ) . '"><span class="' . esc_attr( $title_class ) . '">' . esc_html( $education_master_block_title ) . '</span></a></h2>';
		} else {
			echo '<h2 class="edm-block-title"><span class="' . esc_attr( $title_class ) . '">' . esc_html( $education_master_block_title ) . '</span></h2>';
		}
	}
endif;


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_block_default_layout_section' ) ) :
	function education_master_block_default_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$education_master_post_count = apply_filters( 'education_master_block_default_posts_count', 6 );
		$block_args                  = array(
			'cat'            => $cat_id,
			'posts_per_page' => absint( $education_master_post_count ),
		);
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="edm-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif ( $post_count == 2 ) {
					echo '<div class="edm-secondary-block-wrap">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="edm-single-post edm-clearfix">
					<div class="edm-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count == 1 ) {
								the_post_thumbnail( 'education-master-slider-medium' );
							} else {
								the_post_thumbnail( 'education-master-block-thumb' );
							}
							?>
						</a>
					</div><!-- .edm-post-thumb -->
					<div class="edm-post-content">
						<h3 class="edm-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
						<?php if ( $post_count == 1 ) { ?>
							<div class="edm-post-excerpt"><?php the_excerpt(); ?></div>
						<?php } ?>
					</div><!-- .edm-post-content -->
				</div><!-- .edm-single-post -->
				<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .edm-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .edm-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Second Layout
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'education_master_block_second_layout_section' ) ) :
	function education_master_block_second_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$education_master_post_count = apply_filters( 'education_master_block_second_layout_posts_count', 6 );
		$block_args                  = array(
			'cat'            => $cat_id,
			'posts_per_page' => absint( $education_master_post_count ),
		);
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="edm-primary-block-wrap">';
				} elseif ( $post_count == 3 ) {
					echo '<div class="edm-secondary-block-wrap">';
				}
				if ( $post_count <= 2 ) {
					$title_size = 'large-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="edm-single-post edm-clearfix">
					<div class="edm-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count <= 2 ) {
								the_post_thumbnail( 'education-master-slider-medium' );
							} else {
								the_post_thumbnail( 'education-master-block-thumb' );
							}
							?>
						</a>
					</div><!-- .edm-post-thumb -->
					<div class="edm-post-content">
						<h3 class="edm-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
						<?php if ( $post_count <= 2 ) { ?>
							<div class="edm-post-excerpt"><?php the_excerpt(); ?></div>
						<?php } ?>
					</div><!-- .edm-post-content -->
				</div><!-- .edm-single-post -->
				<?php
				if ( $post_count == 2 ) {
					echo '</div><!-- .edm-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .edm-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Box Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_block_box_layout_section' ) ) :
	function education_master_block_box_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$education_master_post_count = apply_filters( 'education_master_block_box_posts_count', 4 );
		$block_args                  = array(
			'cat'            => $cat_id,
			'posts_per_page' => absint( $education_master_post_count ),
		);
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="edm-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif ( $post_count == 2 ) {
					echo '<div class="edm-secondary-block-wrap edm-clearfix">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="edm-single-post">
					<div class="edm-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count == 1 ) {
								the_post_thumbnail( 'full' );
							} else {
								the_post_thumbnail( 'education-master-block-medium' );
							}
							?>
						</a>
					</div><!-- .edm-post-thumb -->
					<div class="edm-post-content">
						<h3 class="edm-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
					</div><!-- .edm-post-content -->
				</div><!-- .edm-single-post -->
				<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .edm-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .edm-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block alternate grid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_block_alternate_grid_section' ) ) :
	function education_master_block_alternate_grid_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$education_master_post_count = apply_filters( 'education_master_block_alternate_grid_posts_count', 3 );
		$block_args                  = array(
			'cat'            => $cat_id,
			'posts_per_page' => absint( $education_master_post_count ),
		);
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				?>
				<div class="edm-alt-grid-post edm-single-post edm-clearfix">
					<div class="edm-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'education-master-alternate-grid' ); ?>
						</a>
					</div><!-- .edm-post-thumb -->
					<div class="edm-post-content">
						<h3 class="edm-post-title small-size"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
						<div class="edm-post-excerpt"><?php the_excerpt(); ?></div>
					</div><!-- .edm-post-content -->
				</div><!-- .edm-single-post -->
				<?php
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'education_master_carousel_layout_section' ) ) :
	function education_master_carousel_layout_section( $education_master_block_args, $education_master_style ) {
		$education_master_block_query = new WP_Query( $education_master_block_args );
		if ( $education_master_block_query->have_posts() ) {
			echo '<ul id="blockCarousel" class="cS-hidden">';
			while ( $education_master_block_query->have_posts() ) {
				$education_master_block_query->the_post();
				if ( $education_master_style === 'layout1' ) {
					?>
					<li class="edm-carousel-list <?php echo esc_attr( $education_master_style ) ?>">
						<div class="edm-single-post edm-clearfix">
							<div class="edm-post-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'education-master-carousel-portrait' ); ?>
								</a>
							</div><!-- .edm-post-thumb -->
							<div class="edm-post-content">
								<?php education_master_post_categories_list(); ?>
								<h3 class="edm-post-title small-size"><a
										href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
							</div><!-- .edm-post-content -->
						</div><!-- .edm-single-post -->
					</li>
					<?php
				} else if ( $education_master_style === 'layout2' ) {
					?>
					<li class="edm-carousel-list <?php echo esc_html( $education_master_style ) ?>">
						<div class="edm-single-post edm-clearfix">
							<div class="edm-post-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'education-master-carousel-blog' ); ?>
								</a>
							</div><!-- .edm-post-thumb -->
							<div class="edm-post-content">
								<?php //education_master_post_categories_list(); ?>
								<h3 class="edm-post-title small-size"><a
										href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
								<div class="edm-post-excerpt"><?php echo education_master_the_excerpt(50); ?></div>
							</div><!-- .edm-post-content -->
						</div><!-- .edm-single-post -->
					</li>
					<?php
				}
			}
			echo '</ul>';
		}

		wp_reset_postdata();
	}
endif;
