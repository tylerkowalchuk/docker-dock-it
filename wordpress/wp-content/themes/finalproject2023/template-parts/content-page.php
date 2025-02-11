<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emily_Henry
 */
get_header();
?>
<div class="wrapper">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php finalproject2023_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'finalproject2023' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</div>


		</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
