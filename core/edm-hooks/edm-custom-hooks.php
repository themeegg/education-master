<?php
/**
 * Custom hooks functions are define.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_related_posts_start' ) ) :
	function education_master_related_posts_start() {
		echo '<div class="edm-related-section-wrapper">';
	}
endif;

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_related_posts_section' ) ) :
	function education_master_related_posts_section() {
		$education_master_related_option = get_theme_mod( 'education_master_related_posts_option', 'show' );
		if( $education_master_related_option == 'hide' ) {
			return;
		}
		$education_master_related_title = get_theme_mod( 'education_master_related_posts_title', __( 'Related Posts', 'education-master' ) );
		if( !empty( $education_master_related_title ) ) {
			echo '<h2 class="edm-related-title edm-clearfix">'. esc_html( $education_master_related_title ) .'</h2>';
		}
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }
        $categories = get_the_category( $post_id );
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }
		$education_master_post_count = apply_filters( 'education_master_related_posts_count', 3 );
		
		$related_args = array(
				'no_found_rows'            	=> true,
                'update_post_meta_cache'   	=> false,
                'update_post_term_cache'   	=> false,
                'ignore_sticky_posts'      	=> 1,
                'orderby'                  	=> 'rand',
                'post__not_in'             	=> array( $post_id ),
                'category__in'				=> $category_ids,
				'posts_per_page' 		   	=> $education_master_post_count
			);
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="edm-related-posts-wrap edm-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="edm-single-post edm-clearfix">
					<div class="edm-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'education-master-block-medium' ); ?>
						</a>
					</div><!-- .edm-post-thumb -->
					<div class="edm-post-content">
						<h3 class="edm-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="edm-post-meta">
							<?php education_master_posted_on(); ?>
						</div>
					</div><!-- .edm-post-content -->
				</div><!-- .edm-single-post -->
	<?php
			}
			echo '</div><!-- .edm-related-posts-wrap -->';
		}
		wp_reset_postdata();
	}
endif;

/**
 * Related Posts end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'education_master_related_posts_end' ) ) :
	function education_master_related_posts_end() {
		echo '</div><!-- .edm-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'education_master_related_posts', 'education_master_related_posts_start', 5 );
add_action( 'education_master_related_posts', 'education_master_related_posts_section', 10 );
add_action( 'education_master_related_posts', 'education_master_related_posts_end', 15 );