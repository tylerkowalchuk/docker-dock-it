<?php
	
	namespace MMBookPlugin;
	
	class BookSettings extends Singleton {
//		const SHOW_BOOK_NAME = 'showBookName';
		/**
		 *
		 */
		const SHOW_PUBLISHER = 'showPublisher';
		/**
		 *
		 */
		const SHOW_PUBLISHED_DATE = 'showPublishedDate';
		/**
		 *
		 */
		const SHOW_SYNOPSIS = 'showSynopsis';
		/**
		 *
		 */
		const SHOW_LANGUAGE = 'showLanguage';
		/**
		 *
		 */
		const SHOW_PRICE = 'showPrice';
		/**
		 *
		 */
		const SHOW_PAGE_COUNT = 'showPageCount';
		/**
		 *
		 */
		const SHOW_SERIES = 'showSeries';
		/**
		 *
		 */
		const SHOW_GENRE = 'showGenre';
		/**
		 *
		 */
		const SHOW_REVIEW = 'review';
		/**
		 *
		 */
		const SHOW_REVIEWER = 'showReviewer';
		/**
		 *
		 */
		const SETTINGS_GROUP = 'books';
		
		/**
		 * @var
		 */
		protected static $instance;
		
		/**
		 *
		 */
		public function __construct() {
			add_action( 'admin_init', [ $this, 'registerSetting' ] );
			add_action( 'admin_menu', [ $this, 'addMenuPages' ] );
		}
		
		

		/**
		 * @return void
		 */
		public function registerSetting() {
//			register_setting( self::SETTINGS_GROUP, self::SHOW_BOOK_NAME );
			register_setting( self::SETTINGS_GROUP, self::SHOW_PUBLISHER );
			register_setting( self::SETTINGS_GROUP, self::SHOW_PUBLISHED_DATE );
			register_setting( self::SETTINGS_GROUP, self::SHOW_SYNOPSIS );
			register_setting( self::SETTINGS_GROUP, self::SHOW_LANGUAGE );
			register_setting( self::SETTINGS_GROUP, self::SHOW_PRICE );
			register_setting( self::SETTINGS_GROUP, self::SHOW_PAGE_COUNT );
			register_setting( self::SETTINGS_GROUP, self::SHOW_SERIES );
			register_setting( self::SETTINGS_GROUP, self::SHOW_GENRE );
			register_setting( self::SETTINGS_GROUP, self::SHOW_REVIEW );
			register_setting( self::SETTINGS_GROUP, self::SHOW_REVIEWER );

			$this->addFields();
		}
		
		/**
		 * @return void
		 */
		public function addMenuPages() {
			add_menu_page(
				'Menu Settings',
				'Book Settings',
				'edit_pages',
				'book_menu_page',
				function () {
					echo "This is the page Content";
				},
				'dashicons-admin-settings',
				'25'
			);
			
			add_submenu_page(
				'edit.php?post_type=book',
				'Book Plugin Settings',
				'Settings',
				'manage_options',
				'book_submenu_settings',
				[ $this, 'settingsPage' ],
				99
			);
		}
		
		/**
		 * @return void
		 */
		public function settingsPage() {

			//setup page so user can configure book settings
			?>
            <div class="wrap">
                <h2>Book Settings</h2>
                <p>Configure features of this plugin</p>
                
                <form method="post" action="options.php">
                    <!--This needs to match what is in register_settings() -->
					<?php settings_fields( self::SETTINGS_GROUP); ?>
					<?php do_settings_sections( 'book' ); ?>
					<?php submit_button( 'Save Changes' ); ?>
                </form>
            </div>
			<?php
		}
		
		/**
		 * @return void
		 */
		public function addFields() {
			add_settings_section(
				'book_general',
				'General Book Settings',
				function () {
				},
				'book'
			);

            // Show publisher
			add_settings_field(
				self::SHOW_PUBLISHER,
				'Show Publisher',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_PUBLISHER ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_PUBLISHER ?>"
                           name="<?= self::SHOW_PUBLISHER ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);

			add_settings_field(
				self::SHOW_PUBLISHED_DATE,
				'Show Published Date',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_PUBLISHED_DATE ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_PUBLISHED_DATE ?>"
                           name="<?= self::SHOW_PUBLISHED_DATE ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
            
            // SHOW SYNOPSIS
				add_settings_field(
				self::SHOW_SYNOPSIS,
				'Show Synopsis',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_SYNOPSIS ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_SYNOPSIS?>"
                           name="<?= self::SHOW_SYNOPSIS ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
                
                //SHOW LANGUAGE
			add_settings_field(
				self::SHOW_LANGUAGE,
				'Show Language',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_LANGUAGE ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_LANGUAGE?>"
                           name="<?= self::SHOW_LANGUAGE ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
            
            //show price
			add_settings_field(
				self::SHOW_PRICE,
				'Show Price',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_PRICE ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_PRICE?>"
                           name="<?= self::SHOW_PRICE ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
            
            //Show PageCount
			add_settings_field(
				self::SHOW_PAGE_COUNT,
				'Show Page Count',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_PAGE_COUNT ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_PAGE_COUNT?>"
                           name="<?= self::SHOW_PAGE_COUNT ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
            
            // show Series
			add_settings_field(
				self::SHOW_SERIES,
				'Show Series',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_SERIES ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_SERIES?>"
                           name="<?= self::SHOW_SERIES ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
            
            // Show Genre
			add_settings_field(
				self::SHOW_GENRE,
				'Show Genre',
				function () {
					//make the field sticky
					$checked = get_option( self::SHOW_GENRE ) ? 'checked' : '';
					?>
                    <input type="checkbox"
                           id="<?= self::SHOW_GENRE?>"
                           name="<?= self::SHOW_GENRE ?>"
						<?= $checked ?>
                    >
					<?php
				},
				'book',
				'book_general'
			);
			
			
   
			
			
		}
	}