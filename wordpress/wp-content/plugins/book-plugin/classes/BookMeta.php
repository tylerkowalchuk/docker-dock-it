<?php
	namespace MMBookPlugin;
	/**
	 *
	 */
	class BookMeta extends Singleton {
		
		// These are the fields (KEYS) that will be stored in the database and output in the form
		// These names need to be unique to WordPress
		
		
		/**
		 * Book publisher name
		 */
		const PUBLISHER = 'publisher';
		/**
		 * Book publication date
		 */
		const PUBLISHED_DATE = 'publishedDate';
		/**
		 * Book synopsis
		 */
		const SYNOPSIS = 'synopsis';
		/**
		 * Book language
		 */
		const LANGUAGE = 'language';
		/**
		 * Book Price
		 */
		const PRICE = 'price';
		/**
		 * Book Page count
		 */
		const PAGE_COUNT = 'pageCount';
		/**
		 * Series book belongs to
		 */
		const SERIES = 'series';
		/**
		 * Book genre
		 */
		const GENRE = 'genre';
		
		
		/**
		 * @var create new instance
		 */
		protected static $instance;
		
		/**
		 * register metabox
		 */
		public function __construct() {
		add_action('admin_init', [$this, 'registerMetaBox']);

        

        add_action('save_post_' . BookPostType::POST_TYPE, [$this, 'saveDirections']);
		
		}


		/**
		 * @return void
		 */
		public function registerMetaBox(){
			// attaches outputDirections to a specific post type
			// 'book_directions_meta' is how I'm going to reference it later on
		add_meta_box('book_reviews_meta',
					 'Description',
					  [$this,'outputDirections'],
					  BookPostType::POST_TYPE,
					  'normal'
		);
		
		}
		

		/**
		 * @return void
		 */
		public function outputDirections(){
            //get current post and meat to make the form sticky
            $post = get_post();
			
            //make the form sticky.
            // true in this case just tells php to return the value instead of an array.
            
			$publisher = get_post_meta($post->ID, self::PUBLISHER, true);
			$publishedDate = get_post_meta($post->ID, self::PUBLISHED_DATE, true);
			$series = get_post_meta($post->ID, self::SERIES, true);
			$genre = get_post_meta($post->ID, self::GENRE, true);
			$pageCount = get_post_meta($post->ID, self::PAGE_COUNT, true);
			$language = get_post_meta($post->ID, self::LANGUAGE, true);
			$price = get_post_meta($post->ID, self::PRICE, true);
			$synopsis = get_post_meta($post->ID, self::SYNOPSIS, true);

   
		?>

        <div class="container"
            <p>
                <label>Publisher: <input type="text" name="publisher" id="publisher" value="<?=$publisher?>"></label>
            </p>
            
            <p>
                <label>Date of Publication: <input type="date" name="publishedDate" id="publishedDate" value="<?=$publishedDate?>"></label>
            </p>

            <p>
                <label>Series: <input type="text" name="series" id="series" value="<?=$series?>"></label>
            </p>
            
            <p>
                <label>Genre: <input type="text" name="genre" id="genre" value="<?=$genre?>"></label>
            </p>
            
            <p>
                <label>Page Count: <input type="number" name="pageCount" id="pageCount" min="0" max="1000" value="<?=$pageCount?>"></label>
            </p>
            
            <p>
                <label>Language: <input type="text" name="language" id="language" value="<?=$language?>"></label>
            </p>
     
            <p>
                <label>Price: $<input type="number" name="price" id="price" placeholder="$" min="0" max="1000" step="0.01" value="<?=$price?>"></label>
            </p>
			
            <p>
                <label for="synopsis">Synopsis: </label>
            </p>
            <p>
                <textarea name="synopsis" id="synopsis" cols="30" rows="10" ><?=$synopsis?></textarea>
                
            </p>
      
<!--            <p>-->
<!--                <label>Book Name: <input type="text" name="book" id="book" value="--><?php //=$book?><!--"></label>-->
<!--            </p>-->
          
            </div>
		<?php
		}

		
		/**
		 * @return void
		 */
		public function saveDirections(){
            $publisher = sanitize_text_field($_POST['publisher']);
            $publishedDate = sanitize_text_field($_POST['publishedDate']);
	        $series = sanitize_text_field($_POST['series']);
	        $genre = sanitize_text_field($_POST['genre']);
	        $pageCount = sanitize_text_field($_POST['pageCount']);
	        $language = sanitize_text_field($_POST['language']);
	        $price = sanitize_text_field($_POST['price']);
	        $synopsis = sanitize_text_field($_POST['synopsis']);

   
            
            // get current post
            $post = get_post();
            
            //store meta in the database
            
            update_post_meta($post->ID, self::PUBLISHER, $publisher);
	        update_post_meta($post->ID, self::PUBLISHED_DATE, $publishedDate);
	        update_post_meta($post->ID, self::SERIES, $series);
	        update_post_meta($post->ID, self::GENRE, $genre);
	        update_post_meta($post->ID, self::PAGE_COUNT, $pageCount);
	        update_post_meta($post->ID, self::LANGUAGE, $language);
	        update_post_meta($post->ID, self::PRICE, $price);
	        update_post_meta($post->ID, self::SYNOPSIS, $synopsis);

         
	        
	        
	        
	        
	        
	        
	        
	        
        }
        
		

	}