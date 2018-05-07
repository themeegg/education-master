<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="edm-article-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
	</div><!-- .edm-article-thumb -->

	<div class="edm-archive-post-content-wrapper">

		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) :
			?>
					<div class="entry-meta">
						<?php education_master_inner_posted_on(); ?>
					</div><!-- .entry-meta -->
			<?php
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();
				$education_master_archive_read_more_text = get_theme_mod( 'education_master_archive_read_more_text', __( 'Continue Reading', 'education-master' ) );
			?>
			<span class="edm-archive-more"><a href="<?php the_permalink(); ?>" class="edm-button"><?php echo esc_html( $education_master_archive_read_more_text ); ?></a></span>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php education_master_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .edm-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
