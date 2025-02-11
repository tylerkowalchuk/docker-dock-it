<?php
	
	namespace MMBookPlugin;
	
	use MMBookPlugin\Singleton;
	
	/**
	 *
	 */
	class ReviewMeta extends Singleton {
		
		
		/**
		 *
		 */
		const BOOK_NAME = 'book';
		
		/**
		 *
		 */
		const REVIEW = 'review';
		/**
		 *
		 */
		const REVIEWER = 'reviewer';
		/**
		 *
		 */
		const REVIEWER_LOCATION = 'reviewerLocation';
		/**
		 *
		 */
		const BOOK_RATING = 'bookRating';
		
		/**
		 * @var
		 */
		protected static $instance;
		
		/**
		 *
		 */
		public function __construct() {
			add_action('admin_init', [$this, 'registerMetaBox']);
//			add_action('admin_init', [$this, 'outputReviews']);
			add_action('admin_init', [$this, 'saveReviews']);
			
			
			// tell Wordpress when to call SaveDirections()
			// call our function when wordpress is trying to save a Book
			// Wordpress is only calling this when it's saving a Book
			add_action('save_post_' . ReviewPostType::POST_TYPE, [$this, 'saveReviews']);
		
		}
		
		// function that adds the form to all of the books
		
		/**
		 * @return void
		 */
		public function registerMetaBox(){
			// attaches outputDirections to a specific post type
			// 'book_directions_meta' is how I'm going to reference it later on
			add_meta_box('review_reviews_meta',
				'Review',
				[$this,'outputReviews'],
				ReviewPostType::POST_TYPE,
				'normal'
			);
			
		}
		
		// function that outputs the metaBox()
		
		/**
		 * @return void
		 */
		public function outputReviews(){
			//get current post and meat to make the form sticky
			$post = get_post();
			
			//make the form sticky.
			// true in this case just tells php to return the value instead of an array.
			$book = get_post_meta($post->ID, self::BOOK_NAME,true);
			$bookRating = get_post_meta($post->ID, self::BOOK_RATING, true);
			$reviewer = get_post_meta($post->ID, self::REVIEWER, true);
			$reviewerLocation = get_post_meta($post->ID, self::REVIEWER_LOCATION, true);
			$review = get_post_meta($post->ID, self::REVIEW, true);
			
		
   
			?>
 
                <!--Dropdown of books-->
                <p>
                 
                    <label for="book">Book: </label>
                    <select name="book" id="book">
                      <?php $query = new \WP_Query([
				        'post_type'=>'book',
                          'posts_per_page'=> -1
                          
	                     
                      ]);
//	             var_dump($query->have_posts());
//                 die();
			while($query->have_posts()){
				$query->the_post(); ?>
<!--                    --><?php //echo '<option>' . the_title() . '</option>' ?>
                <option value="<?=the_ID()?>" <?=$book == get_the_ID() ? 'selected' : '' ?>><?=get_the_title()?></option>
				
				<?php
			        }
                      ?>
                    </select>
                    </label>
                </p>
                

<!--                <p>-->
<!--                    <label for="bookRating">Book Rating:</label>-->
<!--                    <select id="bookRating" name="bookRating" value="--><?//$bookRating?><!--">-->
<!--                        <option value="1">&#11088;</option>-->
<!--                        <option value="2">&#11088; &#11088;</option>-->
<!--                        <option value="3">&#11088; &#11088; &#11088;</option>-->
<!--                        <option value="4">&#11088; &#11088; &#11088; &#11088;</option>-->
<!--                        <option value="5">&#11088; &#11088; &#11088; &#11088; &#11088;</option>-->
<!---->
<!--                    </select>-->
<!--                </p>-->
            <p>
                <label for="bookRating">Book Rating:</label>
                <select id="bookRating" name="bookRating">
                    <option value="1" <?= $bookRating == 1 ? 'selected' : '' ?>>&#11088;</option>
                    <option value="2" <?= $bookRating == 2 ? 'selected' : '' ?>>&#11088; &#11088;</option>
                    <option value="3" <?= $bookRating == 3 ? 'selected' : '' ?>>&#11088; &#11088; &#11088;</option>
                    <option value="4" <?= $bookRating == 4 ? 'selected' : '' ?>>&#11088; &#11088; &#11088; &#11088;</option>
                    <option value="5" <?= $bookRating == 5 ? 'selected' : '' ?>>&#11088; &#11088; &#11088; &#11088; &#11088;</option>
                </select>
            </p>


            <p>
				<label>Reviewer: <input type="text" name="reviewer" id="reviewer" value="<?=$reviewer?>"></label>
			</p>
			<p>
				<label>Reviewer Location: <input type="text" name="reviewerLocation" id="reviewer-location" value="<?=$reviewerLocation?>"></label>
	

   
			<?php
			
		}
		
	
		// Save data from form in the database after submitted
		// field names should match the name of the input in tne form
		
		/**
		 * @return void
		 */
		public function saveReviews(){
			$book = sanitize_text_field($_POST['book']);
            $bookRating = sanitize_text_field($_POST['bookRating']);
			$reviewer = sanitize_text_field($_POST['reviewer']);
			$reviewerLocation = sanitize_text_field($_POST['reviewerLocation']);
			$review = sanitize_text_field($_POST['review']);

			// get current post
			$post = get_post();

			//store meta in the database
			update_post_meta($post->ID, self::BOOK_NAME, $book);
			update_post_meta($post->ID, self::BOOK_RATING, $bookRating);
			update_post_meta($post->ID, self::REVIEWER, $reviewer);
			update_post_meta($post->ID, self::REVIEWER_LOCATION, $reviewerLocation);
			update_post_meta($post->ID, self::REVIEW, $review);


		}
	}
	