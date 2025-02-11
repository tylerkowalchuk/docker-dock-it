<?php
//	namespace MMBookPlugin;
	
	/**
	 *
	 */
	class BooksWidget  extends WP_Widget{
		
		/**
		 *
		 */
		const PUBLISHED_DATE = 'publishedDate';
		
		/**
		 *
		 */
		function __construct() {
			parent::__construct(

				'BooksWidget',

				__('Recent Books', 'wpb_widget_domain'),

				array( 'description' => __( 'Widget that displays most recent books', 'wpb_widget_domain' ), )
			);
		}
		
		
		/**
		 * @param $args
		 * @param $instance
		 *
		 * @return void
		 */
		public function widget( $args, $instance ) {
	
			$title = apply_filters( 'widget_title', 'Recent Books' );
			
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
			
			$args = array(
				'post_type' => \MMBookPlugin\BookPostType::POST_TYPE,
				'orderby' => 'meta_value',
				'meta_key' => self::PUBLISHED_DATE,
				'posts_per_page'=> 3,
			);
			$query = new WP_Query( $args );
			
			
//			if($query->have_posts()){
//				echo "<ul>";
//				while($query->have_posts()){
//					$query->the_post();
//					echo '<li><a href="' .get_the_permalink() . '">' .
//					     "<br>" .  get_the_post_thumbnail() .
//					     "<br>" .  get_the_title() .
//
//					     '</a></li>';
//				}
//				echo "</ul>";
//			}
			if($query->have_posts()){
				echo '<div class="books-widget">';
				echo "<ul>";
				while($query->have_posts()){
					$query->the_post();
					echo '<li>
                <a href="' . get_the_permalink() . '">
                    <img src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">
                    ' . get_the_title() . '
                </a>
              </li>';
				}
				echo "</ul>";
				echo '</div>';
			}



//			echo $args['after_widget'];
		}
		
		/**
		 * @param $new_instance
		 * @param $old_instance
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}



	
	}
	
	/**
	 * @return void
	 */
	function books_load_widget() {
		register_widget( 'BooksWidget' );
	}
	add_action( 'widgets_init', 'books_load_widget' );
	
	
