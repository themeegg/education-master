<?php
/**
 * EDM: Block Posts
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'widgets_init', 'education_master_register_block_widget' );

function education_master_register_block_widget() {
	register_widget( 'Education_Master_Block_Posts' );
}

class Education_Master_Block_Posts extends WP_widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'education_master_block_posts edm-clearfix',
			'description' => __( 'Displays block posts from selected category in different layouts.', 'education-master' )
		);
		parent::__construct( 'education_master_block_posts', __( 'Block Posts', 'education-master' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		$education_master_categories_dropdown = education_master_categories_dropdown();

		$fields = array(

			'block_title' => array(
				'education_master_widgets_name'        => 'block_title',
				'education_master_widgets_title'       => __( 'Block title', 'education-master' ),
				'education_master_widgets_description' => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'education-master' ),
				'education_master_widgets_field_type'  => 'text'
			),

			'block_cat_id' => array(
				'education_master_widgets_name'          => 'block_cat_id',
				'education_master_widgets_title'         => __( 'Block Category', 'education-master' ),
				'education_master_widgets_default'       => 0,
				'education_master_widgets_field_type'    => 'select',
				'education_master_widgets_field_options' => $education_master_categories_dropdown
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

		$education_master_block_title  = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
		$education_master_block_cat_id = empty( $instance['block_cat_id'] ) ? '' : $instance['block_cat_id'];
		$education_master_style        = empty( $instance['style'] ) ? 'layout3' : $instance['style'];

		$widget_title_args = array(
			'title'  => $education_master_block_title,
			'cat_id' => $education_master_block_cat_id
		);

		echo $before_widget;
		?>
		<div class="edm-block-wrapper block-posts edm-clearfix <?php echo esc_attr( $education_master_style ); ?>">
			<?php
			if ( ! empty( $education_master_block_title ) ) {
				do_action( 'education_master_widget_title', $widget_title_args );
			}
			?>
			<div class="edm-block-posts-wrapper">
				<?php
				switch ( $education_master_style ) {
					case 'layout2':
						education_master_block_second_layout_section( $education_master_block_cat_id );
						break;

					case 'layout3':
						education_master_block_box_layout_section( $education_master_block_cat_id );
						break;

					case 'layout4':
						education_master_block_alternate_grid_section( $education_master_block_cat_id );
						break;

					default:
						education_master_block_default_layout_section( $education_master_block_cat_id );
						break;
				}
				?>
			</div><!-- .edm-block-posts-wrapper -->
		</div><!--- .edm-block-wrapper -->
		<?php
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
