<?php
/**
 * EDM: Banner Ads
 *
 * Widget show the banner ads of different size
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'widgets_init', 'education_master_register_cta_widget' );

function education_master_register_cta_widget() {
	register_widget( 'Education_Master_CTA' );
}

class Education_Master_CTA extends WP_widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'education_master_cta',
			'description' => __( 'Call to action widget', 'education-master' )
		);
		parent::__construct( 'education_master_cta', __( 'CTA', 'education-master' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		$fields = array(

			'title' => array(
				'education_master_widgets_name'       => 'title',
				'education_master_widgets_title'      => __( 'Title', 'education-master' ),
				'education_master_widgets_field_type' => 'text'
			),

			'cta_heading' => array(
				'education_master_widgets_name'       => 'cta_heading',
				'education_master_widgets_title'      => __( 'CTA Heading', 'education-master' ),
				'education_master_widgets_field_type' => 'text'
			),

			'cta_background' => array(
				'education_master_widgets_name'       => 'cta_background',
				'education_master_widgets_title'      => __( 'Select background image', 'education-master' ),
				'education_master_widgets_field_type' => 'upload',
			),
			'is_parallax'    => array(
				'education_master_widgets_name'       => 'is_parallax',
				'education_master_widgets_title'      => __( 'Enable parallax', 'education-master' ),
				'education_master_widgets_field_type' => 'checkbox'
			),
			'description'    => array(
				'education_master_widgets_name'       => 'description',
				'education_master_widgets_title'      => __( 'Description', 'education-master' ),
				'education_master_widgets_field_type' => 'text'
			),
			'button_url'     => array(
				'education_master_widgets_name'       => 'button_url',
				'education_master_widgets_title'      => __( 'Button Link', 'education-master' ),
				'education_master_widgets_field_type' => 'url'
			),
			'button_text'    => array(
				'education_master_widgets_name'       => 'button_text',
				'education_master_widgets_title'      => __( 'Button Text', 'education-master' ),
				'education_master_widgets_field_type' => 'text'
			),

			'button_target' => array(
				'education_master_widgets_name'       => 'button_target',
				'education_master_widgets_title'      => __( 'Open in new tab', 'education-master' ),
				'education_master_widgets_field_type' => 'checkbox'
			),

		);

		return $fields;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		if ( empty( $instance ) ) {
			return;
		}

		$education_master_title          = empty( $instance['title'] ) ? '' : $instance['title'];
		$education_master_cta_heading    = empty( $instance['cta_heading'] ) ? '' : $instance['cta_heading'];
		$education_master_cta_background = empty( $instance['cta_background'] ) ? '' : $instance['cta_background'];
		$education_master_is_parallax    = empty( $instance['is_parallax'] ) ? '' : true;
		$education_master_description    = empty( $instance['description'] ) ? '' : $instance['description'];
		$education_master_button_url     = empty( $instance['button_url'] ) ? '' : $instance['button_url'];
		$education_master_button_text    = empty( $instance['button_text'] ) ? '' : $instance['button_text'];
		$education_master_button_target  = empty( $instance['button_target'] ) ? '_self' : '_blank';

		echo $before_widget;

		if ( ! empty( $education_master_cta_background ) ) {
			?>
			<div class="edm-cta-wrapper">
				<?php
				if ( ! empty( $education_master_title ) ) {
					echo $before_title . esc_html( $education_master_title ) . $after_title;
				}
				$cta_css = ! empty( $education_master_cta_background ) ? 'background-image:url(\'' . $education_master_cta_background . '\');' : '';
				?>

				<div class="edm-cta-content <?php echo esc_attr( $education_master_is_parallax ) ? 'parallax' : ''; ?>"
				     style="<?php echo esc_attr( $cta_css ) ?>">
					<?php
					if ( ! empty( $education_master_cta_heading ) ) {
						?><h3 class="edm-cta-heading"><?php echo esc_html( $education_master_cta_heading ) ?></h3>
						<?php
					}
					?>
					<p><?php echo esc_html( $education_master_description ); ?></p>
					<?php
					if ( ! empty( $education_master_button_url ) ) {
						?>
						<a class="button button-primary cta-button" href="<?php echo esc_url( $education_master_button_url ); ?>"
						   target="<?php echo esc_attr( $education_master_button_target ); ?>"><?php echo esc_html( $education_master_button_text ) ?></a>
						<?php
					}
					?>
				</div>
			</div><!-- .edm-ads-wrapper -->
			<?php
		}
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see     WP_Widget::update()
	 *
	 * @param   array $new_instance Values just sent to be saved.
	 * @param   array $old_instance Previously saved values from database.
	 *
	 * @uses    education_master_widgets_updated_field_value()     defined in edm-widget-fields.php
	 *
	 * @return  array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			extract( $widget_field );

			// Use helper function to get updated field values
			$instance[ $education_master_widgets_name ] = education_master_widgets_updated_field_value( $widget_field, $new_instance[ $education_master_widgets_name ] );
		}

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see     WP_Widget::form()
	 *
	 * @param   array $instance Previously saved values from database.
	 *
	 * @uses    education_master_widgets_show_widget_field()       defined in edm-widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			// Make array elements available as variables
			extract( $widget_field );
			$education_master_widgets_field_value = ! empty( $instance[ $education_master_widgets_name ] ) ? wp_kses_post( $instance[ $education_master_widgets_name ] ) : '';
			education_master_widgets_show_widget_field( $this, $widget_field, $education_master_widgets_field_value );
		}
	}
}
