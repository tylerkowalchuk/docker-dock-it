<?php

/**
 * Book Plugin
 * @wordpress-plugin
 * Plugin Name:       Author Books
 * Description:       Display a list of books published by an author
 * Version:           1.0.0
 * Author:            Mariana Marlis
 * Text Domain:       book-plugin
 **/

namespace MMBookPlugin;

//unique to the namespace
const TEXT_DOMAIN = 'book-plugin';

// include class files

require_once __DIR__ . '/classes/Singleton.php';
require_once __DIR__ . '/classes/BookPostType.php';
require_once __DIR__ . '/classes/BookCategoryTaxonomy.php';
require_once __DIR__ . '/classes/BookMeta.php';
require_once __DIR__ . '/classes/BookSettings.php';
require_once __DIR__ . '/classes/BooksWidget.php';
require_once __DIR__ . '/classes/ReviewMeta.php';
require_once __DIR__ . '/classes/ReviewPostType.php';
require_once __DIR__ . '/classes/RandomReview.php';

add_action('widgets_init', function(){
	register_widget('BooksWidget');
});

//instantiate singletons
// load our class which will call the constructor
BookPostType::getInstance();
BookCategoryTaxonomy::getInstance();
BookMeta::getInstance();
BookSettings::getInstance();
ReviewPostType::getInstance();
ReviewMeta::getInstance();
RandomReview::getInstance();
//Books_Widget::getInstance();

// setup activation hooks so that when someone activates plugin we clear permalink cache

function activate_plugin(){
	//register post type (in BookPostType.php)
	BookPostType::getInstance()->registerBookPostType();
	//register post type (in BookCategoryTaxonomy.php)
	BookCategoryTaxonomy::getInstance()->registerTaxonomy();
	ReviewPostType::getInstance()->registerReviewPostType();
	
//	ReviewPostType::getInstance()->registerReviewPostType();
//	ReviewMeta::getInstance()->registerReviewMeta();
	// and flush permalink cache
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'MMBookPlugin\activate_plugin');

// Register and load the widget



