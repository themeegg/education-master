<?php

// Add slider to the theme.
add_action( 'education_master_service_section', 'education_master_service_section', 10 );

// Slider details.

if ( ! function_exists( 'education_master_service_section' ) ) :
	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider details.
	 */
	function education_master_service_section() {
		$services_number = absint( edm_get_number_of_services() );

		?>
		<div class="edm-container">
			<div class="edm-service-container">
				<?php
				for ( $i = 1; $i <= $services_number; $i ++ ) {
					$page_id            = education_master_get_option( 'service_page_' . $i );
					$service_background = education_master_get_option( 'service_background_' . $i );
					$service_icon       = education_master_get_option( 'service_icon_' . $i );
					if ( ! empty( $page_id ) ) {

						$post = get_post( $page_id );
						?><?php
						$featured_slider_status = education_master_get_option( 'featured_slider_status' ); 

						?>
						<div class="edm-single-service edm-service-col-<?php echo esc_attr( $services_number ); ?>" style="<?php if($featured_slider_status == 'home-page'){echo '';}else{echo 'margin-top:64px;';} ?>">
							<div class="edm-service-wrapper"
							     style="background-color:<?php echo esc_attr( $service_background ); ?>">
								<div class="icon_alignment">
									<i class="<?php echo esc_attr( $service_icon ); ?>"></i>

								</div> <!-- align icons -->
								<div class="service-content">
									<h3 class="service-title"><a
											href="<?php echo get_permalink( $post->ID ) ?>"><?php echo esc_html( $post->post_title ); ?></a>
									</h3>
									<p><?php echo education_master_the_excerpt( apply_filters( 'education_master_filter_service_length', 50 ), $post ); ?></p>

								</div>
								<div style="clear:both"></div>
							</div>
							<div style="clear:both"></div>
						</div>
					<?php }
				} ?>
			</div>
		</div>
		<?php

	}
endif;
