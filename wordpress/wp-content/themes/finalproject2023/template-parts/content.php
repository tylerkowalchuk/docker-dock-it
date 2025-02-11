<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emily_Henry
 */
get_header();
?>

<div class="wrapper">



    <div class="thumbnail">
        <?php finalproject2023_post_thumbnail(); ?>
    </div>


	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'finalproject2023' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'finalproject2023' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->




</div>

<footer class="entry-footer">

</footer><!-- .entry-footer -->