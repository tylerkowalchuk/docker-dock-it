<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package  Neve-child
 */
	

//
//	get_sidebar( 'book-sidebar' );
	
	if ( ! is_active_sidebar( 'RecentBooks' ) ) {
		return;
	}
?>

<aside id="secondary" class="widget-area col-12 col-md-3">
	<?php dynamic_sidebar( 'RecentBooks' ); ?>
</aside><!-- #secondary -->
