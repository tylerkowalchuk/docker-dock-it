<?php
	
	namespace MMBookPlugin;
	
	use RecipePlugin\RecipeSettings;
	
	class BookPostType extends Singleton {
		const POST_TYPE = 'book';
		
		protected static $instance;
		
		protected function __construct() {
			add_action( 'init', [ $this, 'registerBookPostType' ], 0 );
			add_filter( 'the_content', [ $this, 'bookContentTemplate' ] );
		}
		
		
		public function registerBookPostType() {
			
			$labels = array(
				'name'                  => _x( 'Books', 'Post Type General Name', TEXT_DOMAIN ),
				'singular_name'         => _x( 'Book', 'Post Type Singular Name', TEXT_DOMAIN ),
				'menu_name'             => __( 'Books', TEXT_DOMAIN ),
				'name_admin_bar'        => __( 'Book', TEXT_DOMAIN ),
				'archives'              => __( 'Book Archives', TEXT_DOMAIN ),
				'attributes'            => __( 'Book Attributes', TEXT_DOMAIN ),
				'parent_item_colon'     => __( 'Parent Book:', TEXT_DOMAIN ),
				'all_items'             => __( 'All Books', TEXT_DOMAIN ),
				'add_new_item'          => __( 'Add New Book', TEXT_DOMAIN ),
				'add_new'               => __( 'Add New', TEXT_DOMAIN ),
				'new_item'              => __( 'New Book', TEXT_DOMAIN ),
				'edit_item'             => __( 'Edit Book', TEXT_DOMAIN ),
				'update_item'           => __( 'Update Book', TEXT_DOMAIN ),
				'view_item'             => __( 'View Book', TEXT_DOMAIN ),
				'view_items'            => __( 'View Books', TEXT_DOMAIN ),
				'search_items'          => __( 'Search Book', TEXT_DOMAIN ),
				'not_found'             => __( 'Not found', TEXT_DOMAIN ),
				'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
				'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
				'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
				'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
				'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
				'insert_into_item'      => __( 'Insert into book', TEXT_DOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this book', TEXT_DOMAIN ),
				'items_list'            => __( 'Books list', TEXT_DOMAIN ),
				'items_list_navigation' => __( 'Books list navigation', TEXT_DOMAIN ),
				'filter_items_list'     => __( 'Filter books list', TEXT_DOMAIN ),
			);
			$args   = array(
				'label'               => __( 'Book', TEXT_DOMAIN ),
				'description'         => __( 'Author Books', TEXT_DOMAIN ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-book',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => 'books',
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'show_in_rest'        => true,
			);
			register_post_type( static::POST_TYPE, $args );
			
		}
		
		public function bookContentTemplate($content) {
			$post = get_post();
			if ( $post->post_type == self::POST_TYPE ) {
				
				$publisher = get_post_meta($post->ID, BookMeta::PUBLISHER, true);
				$publishedDate = get_post_meta($post->ID, BookMeta::PUBLISHED_DATE, true);
				$series = get_post_meta($post->ID, BookMeta::SERIES, true);
				$genre = get_post_meta($post->ID, BookMeta::GENRE, true);
				$pageCount = get_post_meta($post->ID, BookMeta::PAGE_COUNT, true);
				$language = get_post_meta($post->ID, BookMeta::LANGUAGE, true);
				$price = get_post_meta($post->ID, BookMeta::PRICE, true);
				$synopsis = get_post_meta($post->ID, BookMeta::SYNOPSIS, true);

				
				$content = 	"
                        <div>$content</div>
                     <h3 class='border-bottom'>Reviews</h3>";

				
				$query = new \WP_Query([
					'meta_key' => ReviewMeta::BOOK_NAME,
					'meta_value' => $post->ID,
					'post_type'=>ReviewPostType::POST_TYPE,
				
				]);
				
				if ( $query->have_posts() ) {
					$content .= '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						$content .= '<li>
<a href="' . get_the_permalink() . '">' . esc_html( get_the_title() ) . get_the_content() .' </a>
</li>';
					}
					$content .= '</ul>';
				}else{
					'<p>' . $content.= 'Book has no reviews' . '</p>';
				}
				wp_reset_postdata();

		?>
				
				<?php
				
				if (get_option(BookSettings::SHOW_PUBLISHER)){
					$content .= "<strong>Publisher:</strong> $publisher" . "<br>";
				}
				
				if (get_option(BookSettings::SHOW_PUBLISHED_DATE)){
					$content .= "<strong>Publication Date:</strong> " . wp_date( get_option( 'date_format' ), strtotime($publishedDate) ) ."<br>";
				}
				
				if (get_option(BookSettings::SHOW_SERIES)){
					$content .= "<strong>Series:</strong> $series". "<br>";
				}
				
				if (get_option(BookSettings::SHOW_GENRE)){
					$content .= "<strong>Genre:</strong> $genre". "<br>";
				}
				
				if (get_option(BookSettings::SHOW_PAGE_COUNT)){
					$content .= "<strong>Page Count:</strong> $pageCount" ."<br>";
				}
				
				if (get_option(BookSettings::SHOW_LANGUAGE)){
					$content .= "<strong>Language:</strong> $language" ."<br>";
				}
				
				if (get_option(BookSettings::SHOW_PRICE)){
					$content .= "<strong>Price:</strong> $$price" ."<br><br>";
				}
				
				if (get_option(BookSettings::SHOW_SYNOPSIS)){
					$content .= "<strong>Synopsis:</strong> $synopsis<br>";
				}

				
			}
			return $content ;
			
			
		}
		

	}