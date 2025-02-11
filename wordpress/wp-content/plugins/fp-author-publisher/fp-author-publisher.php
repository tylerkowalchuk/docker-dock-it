<?php
/**

 * Books Plugin
 *
 * @wordpress-plugin
 * Plugin Name: Books
 * Description: Displays publications by Emily Henry
 * Version: 1.0.0
 * Author: Megi Chkhetia
 * Text Domain: fp-author-publisher
 */
namespace BooksPlugin;


const TEXT_DOMAIN = 'fp-author-publisher';

require_once __DIR__. '/classes/Singleton.php';
require_once __DIR__ . '/classes/BookPostType.php';
require_once __DIR__ . '/classes/BookCategoryTaxonomy.php';
require_once __DIR__ . '/classes/BookMeta.php';
require_once __DIR__ . '/classes/ReviewPostType.php';
require_once __DIR__ . '/classes/ReviewMeta.php';


BookPostType::getInstance();
BookCategoryTaxonomy::getInstance();
BookMeta::getInstance();
ReviewPostType::getInstance();
ReviewMeta::getInstance();


function activate_plugin(){

    BookPostType::getInstance()->book_post_type();
    BookCategoryTaxonomy::getInstance()->registerTaxonomy();
    ReviewPostType::getInstance()->reviewPostType();

    flush_rewrite_rules();
}


register_activation_hook( __FILE__, 'BooksPlugin\activate_plugin');