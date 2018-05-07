<?php
/**
 * Define custom fields for widgets
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

function education_master_widgets_show_widget_field( $instance = '', $widget_field = '', $edm_widget_field_value = '' ) {

	$education_master_widgets_field_type    = '';
	$education_master_widgets_title         = '';
	$education_master_widgets_name          = '';
	$education_master_widgets_default       = '';
	$education_master_widgets_row           = '';
	$education_master_widgets_field_options = array();
	extract( $widget_field );

	switch ( $education_master_widgets_field_type ) {

		/**
		 * Text field
		 */
		case 'text' :
			?>
			<p>
				<span class="field-label"><label
						for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
				<input class="widefat"
				       id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
				       type="text" value="<?php echo esc_html( $edm_widget_field_value ); ?>"/>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>
			</p>
			<?php
			break;

		/**
		 * URL field
		 */
		case 'url' :
			?>
			<p>
				<span class="field-label"><label
						for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
				<input class="widefat"
				       id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
				       type="text" value="<?php echo esc_url( $edm_widget_field_value ); ?>"/>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>
			</p>
			<?php
			break;

		/**
		 * Number field
		 */
		case 'number' :
			if ( empty( $edm_widget_field_value ) ) {
				$edm_widget_field_value = $education_master_widgets_default;
			}
			?>
			<p>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label>
				<input name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
				       type="number" step="1" min="1"
				       id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				       value="<?php echo esc_html( $edm_widget_field_value ); ?>" class="small-text"/>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>
			</p>
			<?php
			break;

		/**
		 * Textarea field
		 */
		case 'textarea' :
			?>
			<p>
				<span class="field-label"><label
						for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
				<textarea class="widefat" rows="<?php echo absint( $education_master_widgets_row ); ?>"
				          id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				          name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"><?php echo esc_textarea( $edm_widget_field_value ); ?></textarea>
			</p>
			<?php
			break;

		/**
		 * Checkbox field
		 */
		case 'checkbox' :
			?>
			<p>
				<input id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				       name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
				       type="checkbox" value="1" <?php checked( '1', $edm_widget_field_value ); ?>/>
				<label
					for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>
			</p>
			<?php
			break;

		/**
		 * Select field
		 */
		case 'select' :
			if ( empty( $edm_widget_field_value ) ) {
				$edm_widget_field_value = $education_master_widgets_default;
			}

			?>
			<p>
				<span class="field-label"><label
						for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
				<select name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
				        id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
				        class="widefat">
					<?php foreach ( $education_master_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr( $athm_option_name ); ?>"
						        id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $edm_widget_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
					<?php } ?>
				</select>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>
			</p>
			<?php
			break;

		/**
		 * Multiple checkboxes field
		 */
		case 'multicheckboxes':
			?>
			<p><span
					class="field-label"><label><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
			</p>

			<?php
			foreach ( $education_master_widgets_field_options as $athm_option_name => $athm_option_title ) {
				if ( isset( $edm_widget_field_value[ $athm_option_name ] ) ) {
					$edm_widget_field_value[ $athm_option_name ] = 1;
				} else {
					$edm_widget_field_value[ $athm_option_name ] = 0;
				}

				?>
				<p>
					<input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"
					       name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) . '[' . $athm_option_name . ']' ); ?>"
					       type="checkbox"
					       value="1" <?php checked( '1', $edm_widget_field_value[ $athm_option_name ] ); ?>/>
					<label
						for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
				</p>
				<?php
			}
			if ( isset( $education_master_widgets_description ) ) {
				?>
				<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php
			}
			break;

		/**
		 * Selector field
		 */
		case 'selector':
			if ( empty( $edm_widget_field_value ) ) {
				$edm_widget_field_value = $education_master_widgets_default;
			}
			?>
			<p><span class="field-label"><label
						class="field-title"><?php echo esc_html( $education_master_widgets_title ); ?></label></span>
			</p>
			<?php
			echo '<div class="selector-labels">';
			foreach ( $education_master_widgets_field_options as $option => $val ) {
				$class = ( $edm_widget_field_value == $option ) ? 'selector-selected' : '';
				echo '<label class="' . $class . '" data-val="' . esc_attr( $option ) . '">';
				echo '<img src="' . esc_url( $val ) . '"/>';
				echo '</label>';
			}
			echo '</div>';
			echo '<input data-default="' . esc_attr( $edm_widget_field_value ) . '" type="hidden" value="' . esc_attr( $edm_widget_field_value ) . '" name="' . esc_attr( $instance->get_field_name( $education_master_widgets_name ) ) . '"/>';
			break;

		/**
		 * Upload field
		 */
		case 'upload':
			$image = $image_class = "";
			if ( $edm_widget_field_value ) {
				$image       = '<img src="' . esc_url( $edm_widget_field_value ) . '" style="max-width:100%;"/>';
				$image_class = ' hidden';
			}
			?>
			<div class="attachment-media-view">

				<p><span class="field-label"><label
							for="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"><?php echo esc_html( $education_master_widgets_title ); ?>
							:</label></span></p>

				<div class="placeholder<?php echo esc_attr( $image_class ); ?>">
					<?php esc_html_e( 'No image selected', 'education-master' ); ?>
				</div>
				<div class="thumbnail thumbnail-image">
					<?php echo $image; ?>
				</div>

				<div class="actions edm-clearfix">
					<button type="button"
					        class="button edm-delete-button align-left"><?php _e( 'Remove', 'education-master' ); ?></button>
					<button type="button"
					        class="button edm-upload-button alignright"><?php _e( 'Select Image', 'education-master' ); ?></button>

					<input name="<?php echo esc_attr( $instance->get_field_name( $education_master_widgets_name ) ); ?>"
					       id="<?php echo esc_attr( $instance->get_field_id( $education_master_widgets_name ) ); ?>"
					       class="upload-id" type="hidden" value="<?php echo esc_url( $edm_widget_field_value ) ?>"/>
				</div>

				<?php if ( isset( $education_master_widgets_description ) ) { ?>
					<br/>
					<em><?php echo wp_kses_post( $education_master_widgets_description ); ?></em>
				<?php } ?>

			</div><!-- .attachment-media-view -->
			<?php
			break;
	}
}

function education_master_widgets_updated_field_value( $widget_field, $new_field_value ) {

	$education_master_widgets_field_type = '';

	extract( $widget_field );

	if ( $education_master_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	} elseif ( $education_master_widgets_field_type == 'textarea' ) {

		$edm_widgets_allowed_tags = array(
			'p'      => array(),
			'em'     => array(),
			'strong' => array(),
			'a'      => array(
				'href' => array(),
			),
		);

		return wp_kses( $new_field_value, $edm_widgets_allowed_tags );
	} elseif ( $education_master_widgets_field_type == 'url' ) {
		return esc_url_raw( $new_field_value );
	} elseif ( $education_master_widgets_field_type == 'select' ) {
		$is_multiple = isset( $education_master_widgets_field_multiple ) && $education_master_widgets_field_multiple ? true : false;
		if ( $is_multiple ) {
			$array = array_map( 'sanitize_text_field', wp_unslash( $new_field_value ) );

			return array_map( 'wp_kses_post', $array );
		} else {
			return wp_kses_post( sanitize_text_field( $new_field_value ) );
		}
	} elseif ( $education_master_widgets_field_type == 'multicheckboxes' ) {
		return wp_kses_post( $new_field_value );
	} else {

		return wp_kses_post( sanitize_text_field( $new_field_value ) );
	}
}
