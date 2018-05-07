<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
$education_master_footer_widget_option = get_theme_mod( 'education_master_footer_widget_option', 'show' );

if( $education_master_footer_widget_option == 'hide' ) {
    return;
}

if( !is_active_sidebar( 'education_master_footer_sidebar' ) &&
	!is_active_sidebar( 'education_master_footer_sidebar-2' ) &&
    !is_active_sidebar( 'education_master_footer_sidebar-3' ) &&
    !is_active_sidebar( 'education_master_footer_sidebar-4' ) ) {
	   return;
}
$education_master_footer_layout = get_theme_mod( 'footer_widget_layout', 'column_three' );
?>
<div id="top-footer" class="footer-widgets-wrapper footer_<?php echo esc_attr( $education_master_footer_layout ); ?> edm-clearfix">
    <div class="edm-container">
        <div class="footer-widgets-area edm-clearfix">
            <div class="edm-footer-widget-wrapper edm-column-wrapper edm-clearfix">
          		<div class="edm-footer-widget wow fadeInLeft" data-wow-duration="0.5s">
          			<?php
              			if ( !dynamic_sidebar( 'education_master_footer_sidebar' ) ):
              			endif;
          			?>
          		</div>
      		    <?php if( $education_master_footer_layout != 'column_one' ){ ?>
                <div class="edm-footer-widget wow fadeInLeft" data-woww-duration="1s">
          		    <?php
          			if ( !dynamic_sidebar( 'education_master_footer_sidebar-2' ) ):
          			endif;
          			?>
          		</div>
                <?php } ?>
                <?php if( $education_master_footer_layout == 'column_three' || $education_master_footer_layout == 'column_four' ){ ?>
                <div class="edm-footer-widget wow fadeInLeft" data-wow-duration="1.5s">
                    <?php
                    if ( !dynamic_sidebar( 'education_master_footer_sidebar-3' ) ):
                    endif;
                    ?>
                </div>
                <?php } ?>
                <?php if( $education_master_footer_layout == 'column_four' ){ ?>
                <div class="edm-footer-widget wow fadeInLeft" data-wow-duration="2s">
                    <?php
                    if ( !dynamic_sidebar( 'education_master_footer_sidebar-4' ) ):
                    endif;
                    the_tags()
                    ?>
                </div>
                <?php } ?>
            </div><!-- .edm-footer-widget-wrapper -->
        </div><!-- .footer-widgets-area -->
    </div><!-- .edm-container -->
</div><!-- .footer-widgets-wrapper -->
