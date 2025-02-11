<?php
	
	namespace MMBookPlugin;
	
	use MMBookPlugin\Singleton;
	
	class ReviewPostType extends Singleton {
		
		/**
		 *
		 */
		const POST_TYPE = 'review';
		/**
		 * @var
		 */
		protected static $instance;
		
		/**
		 *
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'registerReviewPostType' ), 0 );
			add_filter('the_content', array($this, 'reviewContentTemplate'));
		}
		
		
		/**
		 * @return void
		 */
		public function registerReviewPostType() {
			$labels = array(
				'name'                  => _x( 'Reviews', 'Post Type General Name', TEXT_DOMAIN ),
				'singular_name'         => _x( 'Review', 'Post Type Singular Name', TEXT_DOMAIN ),
				'menu_name'             => __( 'Reviews', TEXT_DOMAIN ),
				'name_admin_bar'        => __( 'Review', TEXT_DOMAIN ),
				'archives'              => __( 'Review Archives', TEXT_DOMAIN ),
				'attributes'            => __( 'Review Attributes', TEXT_DOMAIN ),
				'parent_item_colon'     => __( 'Parent Review:', TEXT_DOMAIN ),
				'all_items'             => __( 'All Reviews', TEXT_DOMAIN ),
				'add_new_item'          => __( 'Add New Review', TEXT_DOMAIN ),
				'add_new'               => __( 'Add New', TEXT_DOMAIN ),
				'new_item'              => __( 'NewReview', TEXT_DOMAIN ),
				'edit_item'             => __( 'Edit Review', TEXT_DOMAIN ),
				'update_item'           => __( 'Update Review', TEXT_DOMAIN ),
				'view_item'             => __( 'View Review', TEXT_DOMAIN ),
				'view_items'            => __( 'View Reviews', TEXT_DOMAIN ),
				'search_items'          => __( 'Search Review', TEXT_DOMAIN ),
				'not_found'             => __( 'Not found', TEXT_DOMAIN ),
				'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
				'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
				'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
				'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
				'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
				'insert_into_item'      => __( 'Insert into Review', TEXT_DOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this Review', TEXT_DOMAIN ),
				'items_list'            => __( 'Review list', TEXT_DOMAIN ),
				'items_list_navigation' => __( 'Reviews list navigation', TEXT_DOMAIN ),
				'filter_items_list'     => __( 'Filter Reviews list', TEXT_DOMAIN ),
			);
			$args   = array(
				'label'               => __( 'Review', TEXT_DOMAIN ),
				'description'         => __( 'Author\'s Reviews', TEXT_DOMAIN ),
				'labels'              => $labels,
				'supports'            => array(
					'title',
					'editor',
					'thumbnail',
					'comments',
					'revisions',
					'custom-fields',
					'page-attributes',
					'post-formats'
				),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-testimonial',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'show_in_rest'        => true,
			);
			register_post_type( self::POST_TYPE, $args );
		}
		
		/**
		 * @param $content
		 *
		 * @return mixed|string
		 */
		public function reviewContentTemplate( $content ) {
			$post = get_post();
			
			if ( $post->post_type == self::POST_TYPE ) {
				$bookId = get_post_meta( $post->ID, ReviewMeta::BOOK_NAME, true ); //gets the book ID
				$bookName = get_the_title($bookId); //pulls the book according to its ID
				$bookImage = get_the_post_thumbnail($bookId, 'medium');
				$reviewer = get_post_meta( $post->ID, ReviewMeta::REVIEWER, true );
				$reviewerLocation = get_post_meta( $post->ID, ReviewMeta::REVIEWER_LOCATION, true );
				$bookRating = get_post_meta( $post->ID, ReviewMeta::BOOK_RATING, true );
				
				?>
				
			
				<?php
				
				
				$content = '
						    <div class="review">
                <div class="book-image">' . $bookImage . '</div>
                <h3>' . esc_html($bookName) . '</h3>
                <strong>Book Rating:</strong> ' . $bookRating . '<br>
                <strong>By:</strong> ' . esc_html($reviewer) . '<br>
                <strong>Location:</strong> ' . esc_html($reviewerLocation) . '<br><br>
                <strong>Review:</strong> ' . $content . '
            </div>
                           
							 ';
	
			}
		
			//regardless of post type return this content
			return $content;
		}
		
	}