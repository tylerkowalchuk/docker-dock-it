<?php

namespace MMBookPlugin;

use MMBookPlugin\Singleton;

class RandomReview {

	/**
	 * Static property to hold our singleton instance
	 *
	 */
	protected static $instance = false; //to follow the singleton pattern more accurately should be private

	/**
	 * This is our constructor
	 *
	 * @return void
	 */
	private function __construct() {

//         add_action('wp_enqueue_scripts', 'wpd_sandbox_scripts');

		// this will look for a function in this object/class
//        add_shortcode('author-block', array( $this, 'authorShortCode')); //same thing as the line below.
//		add_shortcode( 'author-block', [ $this, 'randomReviewShortCode' ] );
		add_shortcode( 'random-review', [ $this, 'randomReviewShortCode' ] );

	}

	private function __clone() {
	}

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * returns it.
	 *
	 * @return
	 */

	public static function getInstance() {
		if ( ! self::$instance ) //self refers to the class where the function is written in, as in:
			//AuthorBlock::$instance = new AuthorBlock();
			//static::$instance = new static(); // another way
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	// create the shortcode method and registering it
	//shortcode: in WordPress is [random-review]
	public function randomReviewShortCode( $attributes ) {


		$query = new \WP_Query( [
			'post_type'     => 'review',
			'orderby'       => 'rand',
			'post_per_page' => 1

		] );
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();

				// Get the book ID associated with this review
				$bookId = get_post_meta(get_the_ID(), ReviewMeta::BOOK_NAME, true);

				// Get the book's title and featured image
				$bookTitle = get_the_title($bookId);
				$bookImage = get_the_post_thumbnail($bookId, 'medium'); // Adjust size if needed

				// Get the review's rating
				$bookRating = get_post_meta(get_the_ID(), ReviewMeta::BOOK_RATING, true);
				$ratingDisplay = !empty($bookRating) ? '<div class="rating-stars">' . str_repeat('⭐', intval($bookRating)) . '</div>' : '';


				// Build the HTML content
				$output = '<div class="review-card">';
				$output .= $ratingDisplay; // Stars at the top right
				$output .= '<div class="review-content">';
				$output .= '<div class="book-section">';
				$output .= '<div class="book-title"><h3>' . esc_html($bookTitle) . '</h3></div>';
				$output .= '<div class="book-image">' . $bookImage . '</div>';
				$output .= '</div>';
				$output .= '<div class="speech-bubble">' . get_the_content() . '</div>';
				$output .= '</div>';
				$output .= '</div>';



				return $output;
			}
		}
		return '<p>No reviews found.</p>';

//		if ( $query->have_posts() ) {
//			while ( $query->have_posts() ) {
//				$query->the_post();
//
//				return '<p>' . esc_html( get_the_title() ) . '</p>' . get_the_content();
////				return print_r(get_post_meta(get_the_ID()));.
//			}
//
//
//		}
	}

	/**
	 * @param $face
	 *
	 * @return string|void
	 */
	public function hasFacebook( $face ) {
		if ( $face ) {
			return "<a href=$face><svg xmlns='http://www.w3.org/2000/svg' height='50px' viewBox='0 0 512 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#636669;} svg{padding: 5px;}</style><path d='M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z'/></svg>";
		}

	}

	/**
	 * @param $insta
	 *
	 * @return string|void
	 */
	public function hasInstagram( $insta ) {
		if ( $insta ) {
			return "<a href=$insta><svg xmlns='http://www.w3.org/2000/svg' height='50px' viewBox='0 0 448 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#636669;}</style><path d='M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z'/></svg>";
		}
	}
}


//loads/runs the plugin

