<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package Nystery Themes
 * @subpackage Education Master
 * @since 1.0.8
 */

 add_action( 'add_meta_boxes', 'education_master_post_meta_options' );

 if( ! function_exists( 'education_master_post_meta_options' ) ):
 function  education_master_post_meta_options() {
    add_meta_box(
                'education_master_post_meta',
                esc_html__( 'Post Meta Options', 'education-master' ),
                'education_master_post_meta_callback',
                'post',
                'normal',
                'high'
            );
 }
 endif;

$education_master_post_sidebar_options = array(
    'default-sidebar' => array(
                    'id'		=> 'post-defalut-sidebar',
                    'value'     => 'default_sidebar',
                    'label'     => __( 'Default Sidebar', 'education-master' ),
                    'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
                ),
    'left-sidebar' => array(
                    'id'		=> 'post-right-sidebar',
                    'value'     => 'left_sidebar',
                    'label'     => __( 'Left sidebar', 'education-master' ),
                    'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
                ),
    'right-sidebar' => array(
                    'id'		=> 'post-left-sidebar',
                    'value' => 'right_sidebar',
                    'label' => __( 'Right sidebar', 'education-master' ),
                    'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
                ),
    'no-sidebar' => array(
                    'id'		=> 'post-no-sidebar',
                    'value'     => 'no_sidebar',
                    'label'     => __( 'No sidebar Full width', 'education-master' ),
                    'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
                ),
    'no-sidebar-center' => array(
                    'id'		=> 'post-no-sidebar-center',
                    'value'     => 'no_sidebar_center',
                    'label'     => __( 'No sidebar Content Centered', 'education-master' ),
                    'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
                )
);

/**
 * Callback function for post option
 */
if( ! function_exists( 'education_master_post_meta_callback' ) ):
	function education_master_post_meta_callback() {
		global $post, $education_master_post_sidebar_options;

        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value = empty( $get_post_meta_identity ) ? 'edm-metabox-info' : $get_post_meta_identity;

		wp_nonce_field( basename( __FILE__ ), 'education_master_post_meta_nonce' );
?>
		<div class="edm-meta-container edm-clearfix">
			<ul class="edm-meta-menu-wrapper">
				<li class="edm-meta-tab <?php if( $post_identity_value == 'edm-metabox-info' ) { echo 'active'; } ?>" data-tab="edm-metabox-info"><span class="dashicons dashicons-clipboard"></span><?php _e( 'Information', 'education-master' ); ?></li>
				<li class="edm-meta-tab <?php if( $post_identity_value == 'edm-metabox-sidebar' ) { echo 'active'; } ?>" data-tab="edm-metabox-sidebar"><span class="dashicons dashicons-exerpt-view"></span><?php _e( 'Sidebars', 'education-master' ); ?></li>
			</ul><!-- .edm-meta-menu-wrapper -->
			<div class="edm-metabox-content-wrapper">

				<!-- Info tab content -->
				<div class="edm-single-meta active" id="edm-metabox-info">
					<div class="content-header">
						<h4><?php _e( 'About Metabox Options', 'education-master' ) ;?></h4>
					</div><!-- .content-header -->
					<div class="meta-options-wrap"><?php esc_html_e( 'In this section we have lots of features which make your post unique and completely different.', 'education-master' ); ?></div><!-- .meta-options-wrap  -->
				</div><!-- #edm-metabox-info -->

				<!-- Sidebar tab content -->
				<div class="edm-single-meta" id="edm-metabox-sidebar">
					<div class="content-header">
						<h4><?php _e( 'Available Sidebars', 'education-master' ) ;?></h4>
						<span class="section-desc"><em><?php _e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'education-master' ); ?></em></span>
					</div><!-- .content-header -->
					<div class="edm-meta-options-wrap">
						<div class="buttonset">
							<?php
			                   	foreach ( $education_master_post_sidebar_options as $field ) {
			                    	$education_master_post_sidebar = get_post_meta( $post->ID, 'edm_single_post_sidebar', true );
			                ?>
			                    	<input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo $field['value']; ?>" name="edm_single_post_sidebar" <?php checked( $field['value'], $education_master_post_sidebar ); if( empty( $education_master_post_sidebar ) && $field['value'] == 'default_sidebar' ){ echo "checked='checked'";}  ?> />
			                    	<label for="<?php echo esc_attr( $field['id'] ); ?>">
			                    		<span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
			                    		<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
			                    	</label>

			                <?php } ?>
						</div><!-- .buttonset -->
					</div><!-- .meta-options-wrap  -->
				</div><!-- #edm-metabox-sidebar -->

            <div class="clear"></div>
            <input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
		</div><!-- .edm-meta-container -->
<?php
	}
endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.8
 */
add_action( 'save_post', 'education_master_save_post_meta' );

if( ! function_exists( 'education_master_save_post_meta' ) ):

function education_master_save_post_meta( $post_id ) {

    global $post, $edm_allowed_textarea;

    // Verify the nonce before proceeding.
    $education_master_post_nonce   = isset( $_POST['education_master_post_meta_nonce'] ) ? $_POST['education_master_post_meta_nonce'] : '';
    $education_master_post_nonce_action = basename( __FILE__ );

    //* Check if nonce is set...
    if ( ! isset( $education_master_post_nonce ) ) {
        return;
    }

    //* Check if nonce is valid...
    if ( ! wp_verify_nonce( $education_master_post_nonce, $education_master_post_nonce_action ) ) {
        return;
    }

    //* Check if user has permissions to save data...
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    //* Check if not an autosave...
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }

    //* Check if not a revision...
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    /**
     * Post sidebar
     */
    $post_sidebar = get_post_meta( $post_id, 'edm_single_post_sidebar', true );
    $stz_post_sidebar = sanitize_text_field( $_POST['edm_single_post_sidebar'] );

    if ( $stz_post_sidebar && $stz_post_sidebar != $post_sidebar ) {
        update_post_meta ( $post_id, 'edm_single_post_sidebar', $stz_post_sidebar );
    } elseif ( '' == $stz_post_sidebar && $post_sidebar ) {
        delete_post_meta( $post_id,'edm_single_post_sidebar', $post_sidebar );
    }

    /**
     * post meta identity
     */
    $post_identity = get_post_meta( $post_id, 'post_meta_identity', true );
    $stz_post_identity = sanitize_text_field( $_POST[ 'post_meta_identity' ] );

    if ( $stz_post_identity && '' == $stz_post_identity ){
        add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
    }elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {
        update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );
    } elseif ( '' == $stz_post_identity && $post_identity ) {
        delete_post_meta( $post_id, 'post_meta_identity', $post_identity );
    }
}
endif;
