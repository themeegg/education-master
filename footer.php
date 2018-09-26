<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */
?>

		</div><!-- .edm-container -->
	</div><!-- #content -->

	<?php
	
	    do_action( 'education_master_footer' );
	/*if($parallax_footer){ ?>
	</div></div>
	}
	*/?>
</div><!-- #page -->
<?php
	/**
     * education_master_after_page hook
     *
     * @since 1.0.0
     */
    do_action( 'education_master_after_page' );
?>

<?php wp_footer(); ?>

</body>
</html>
