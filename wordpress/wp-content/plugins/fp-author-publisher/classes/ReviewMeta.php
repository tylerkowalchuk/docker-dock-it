<?php

namespace BooksPlugin;


/**
 * Review Meta Class
 */
class ReviewMeta extends Singleton
{

    /**
     * Review Name
     */
    const MC_REVIEW_NAME = 'reviewName';

    /**
     * Location
     */
    const MC_REVIEW_LOCATION = 'reviewLocation';

    /**
     * Review Rating
     */
    const MC_REVIEW_RATING = 'reviewRating';

    /**
     * Book ID
     */
    const MC_REVIEW_BOOK = 'reviewBook';


    /**
     * @var
     */
    protected static $instance;

    /**
     * add functionality
     */
    protected function __construct()
    {

        add_action('admin_init', [$this, 'registerReviewMetaBox']);



        add_filter('save_post_' . ReviewPostType::REVIEW_TYPE, [$this, 'saveReview']);

    }

    /**
     * @return void function for review meta box
     */
    public function registerReviewMetaBox(){

        add_meta_box(
            'review_meta',
            'Review',
            [$this, 'outputReview'],
            ReviewPostType::REVIEW_TYPE,
            'normal');
    }

    /**
     * @return void to output review
     */
    public function outputReview(){

        $postReview = get_post();


        $reviewName = get_post_meta($postReview->ID, self::MC_REVIEW_NAME, true);

        $reviewLocation = get_post_meta($postReview->ID, self::MC_REVIEW_LOCATION, true);

        $reviewRating = get_post_meta($postReview->ID, self::MC_REVIEW_RATING, true);

        $reviewBook = get_post_meta($postReview->ID, self::MC_REVIEW_BOOK, true);



        ?>




        <p> <label> Name: <input type="text" name="reviewName" value="<?= $reviewName ?>">  </label> </p>

                <p> <label> Location<input type="text" name="reviewLocation" value="<?= $reviewLocation ?>">  </label></p>

                <p> <label> Rating <br>



                        <input type="radio" name="reviewRating" value="1 Star" <?= $reviewRating === "1 Star" ? 'checked' : '' ?> /> 1 Star <br>
                        <input type="radio" name="reviewRating" value="2 Stars" <?= $reviewRating === "2 Stars" ? 'checked' : '' ?> />  2 Stars <br>
                        <input type="radio" name="reviewRating" value="3 Stars" <?= $reviewRating === "3 Stars" ? 'checked' : '' ?> />   3 Stars <br>
                        <input type="radio" name="reviewRating" value="4 Stars" <?= $reviewRating === "4 Stars" ? 'checked' : '' ?> />  4 Stars <br>
                        <input type="radio" name="reviewRating" value="5 Stars" <?= $reviewRating === "5 Stars" ? 'checked' : '' ?> />  5 Stars <br>

                    </label></p>

                <p> <label name="reviewBook" value="<?= $reviewBook ?>">Book

                        <?php

                        wp_dropdown_pages(array(
                                'post_type' => 'book',
                                'name'=> 'reviewBook' ,
                                'id' => self::MC_REVIEW_BOOK ,
                                'selected'=> $reviewBook,
                                'show_option_none' => '__Select a Book__'

                        ))


                        ?>



                    </label></p>




        <?php
    }


    /**
     * @return void to sanitize and update review meta
     */
    public function saveReview(){

        $reviewName = sanitize_text_field($_POST['reviewName']);

        $reviewLocation = sanitize_text_field($_POST['reviewLocation']);

        $reviewRating= sanitize_text_field($_POST['reviewRating']);

        $reviewBook = sanitize_text_field($_POST['reviewBook']);



        $postReview = get_post();


        update_post_meta($postReview->ID, self::MC_REVIEW_NAME, $reviewName);

        update_post_meta($postReview->ID, self::MC_REVIEW_LOCATION,$reviewLocation );

        update_post_meta($postReview->ID, self::MC_REVIEW_RATING, $reviewRating);

        update_post_meta($postReview->ID, self::MC_REVIEW_BOOK, $reviewBook );



    }


}


