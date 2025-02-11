<?php
namespace BooksPlugin;


/**
 * Boom Meta Class
 */
class BookMeta extends Singleton
{

    /**
     * Publisher
     */
    const MC_AUTHOR_PUBLISHER = 'authorPublisher';

    /**
     * Published date
     */
    const MC_PUBLISHED_DATE = 'authorPublishedDate';

    /**
     * Page Count
     */
    const MC_PAGE_COUNT = 'bookPageCount';

    /**
     * Price of the book
     */
    const MC_BOOK_PRICE = 'bookPrice';


    /**
     * @var
     */
    protected static $instance;

    /**
     * add functionality
     */
    protected function __construct()
    {

        add_action('admin_init', [$this, 'registerMetaBox']);

        add_action( 'save_post_' . BookPostType::POST_TYPE, [$this, 'saveInformation']);

    }

    /**
     * @return void to register book meta box
     */
    public function registerMetaBox(){

        add_meta_box(
            'book_information_meta',
            'Book Information',
            [$this, 'outputAuthorInformation'],
            BookPostType::POST_TYPE,
            'normal');
    }

    /**
     * @return void to outpot book meta box
     */
    public function outputAuthorInformation(){

        $post = get_post();

        $authorPublisher = get_post_meta($post->ID, self::MC_AUTHOR_PUBLISHER, true);

        $authorPublishedDate = get_post_meta($post->ID, self::MC_PUBLISHED_DATE, true);

        $bookPageCount = get_post_meta($post->ID, self::MC_PAGE_COUNT, true);

        $bookPrice =  get_post_meta($post->ID, self::MC_BOOK_PRICE, true);
        ?>


        <p>
            <label> Publisher: <input type="text" name="authorPublisher"  value="<?= $authorPublisher ?>"> </label>
        </p>


        <p>
            <label> Published Date: <input type="text" name="authorPublishedDate"  value="<?= $authorPublishedDate ?>"> </label>
        </p>


        <p>
            <label> Page Count: <input type="text" name="bookPageCount" value="<?= $bookPageCount ?>"> </label>
        </p>



        <p>
            <label> Price: <input type="text" name="bookPrice" value="<?= $bookPrice ?>"> </label>
        </p>

        <?php

    }

    /**
     * @return void to save book meta box
     */
    public function saveInformation(){

        //get values from the form
        $authorPublisher = sanitize_text_field($_POST['authorPublisher']);

        $authorPublishedDate = sanitize_text_field($_POST['authorPublishedDate']);

        $bookPageCount = sanitize_text_field($_POST['bookPageCount']);

        $bookPrice = sanitize_text_field($_POST['bookPrice']);

        //get the current post
        $post = get_post();


        //store meta in the database
        update_post_meta($post->ID, self::MC_AUTHOR_PUBLISHER, $authorPublisher);

        update_post_meta($post->ID, self::MC_PUBLISHED_DATE, $authorPublishedDate);

        update_post_meta($post->ID, self::MC_PAGE_COUNT, $bookPageCount);

        update_post_meta($post->ID, self::MC_BOOK_PRICE, $bookPrice);

    }


}