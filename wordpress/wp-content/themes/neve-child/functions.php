<?php
	/**
	 * Neve-child Theme functions and definitions
	 *
	 * @link https://developer.wordpress.org/themes/basics/theme-functions/
	 *
	 * @package neve-child
	 * @since 1.0.0
	 */
	
	/**
	 * Define Constants
	 */
	
	
	define('CHILD_THEME_NEVE_CHILD_FINAL_VERSION', '1.0.0');
	
	/**
	 * Enqueue styles
	 */
	
	add_action('wp_enqueue_scripts', 'neveChild_enqueue_styles');
function neveChild_enqueue_styles()
{
    $parenthandle = 'neve'; // This is 'neve-style' for the Neve theme.
    $theme = wp_get_theme();
    wp_enqueue_style($parenthandle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get('Version')
    );
    wp_enqueue_style('neve-child',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version') // This only works if you have Version defined in the style header.
    );



}
	function wpd_neveChild_widgets_init() {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'RecentBooks', 'neve-child' )),
				'id'            => 'recent-books',
				'description'   => esc_html__( 'Add widgets here.', 'neve-child' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		
	}
	add_action('widgets_init', 'wpd_neveChild_widgets_init');
	
	function neve_child_new_single_page_layout() {
		echo '<div class="nv-thumb-wrap">';
		echo get_the_post_thumbnail(
			null,
			'neve-blog'
		);
		echo '</div>';
		echo '<div class="nv-content-wrap entry-content">';
		the_content();
		
		do_action( 'neve_before_page_comments' );
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		
		echo '</div>';
		do_action( 'neve_do_pagination', 'single' );
	}
	function neve_child_replace_current_single_page_layout() {
		remove_all_actions( 'neve_do_single_page' );
		add_action( 'neve_do_single_page','neve_child_new_single_page_layout' );
	}
	add_action( 'init', 'neve_child_replace_current_single_page_layout' );


