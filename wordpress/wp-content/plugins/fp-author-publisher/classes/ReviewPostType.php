<?php
namespace BooksPlugin;


/**
 * Review Post Type Class
 */
class ReviewPostType extends Singleton
{

    /**
     * review
     */
    const REVIEW_TYPE = 'review';

    /**
     * @var
     */
    protected static $instance;

    /**
     * add functionality
     */
    protected function __construct()
    {

        add_action( 'init', [$this, 'reviewPostType'], 0 );

        add_filter('the_content', [$this, 'reviewContentTemplate']);

        add_shortcode('random_review', [$this,'displayRadonReview']);
    }

    // Register Custom Post Type

    /**
     * @return void post type information
     */
    function reviewPostType() {

        $labels = array(
            'name'                  => _x( 'Reviews', 'Post Type General Name', TEXT_DOMAIN ),
            'singular_name'         => _x( 'Review', 'Post Type Singular Name', TEXT_DOMAIN ),
            'menu_name'             => __( 'Review Types', TEXT_DOMAIN ),
            'name_admin_bar'        => __( 'Review Type', TEXT_DOMAIN ),
            'archives'              => __( 'Review Archives', TEXT_DOMAIN ),
            'attributes'            => __( 'Review Attributes', TEXT_DOMAIN ),
            'parent_item_colon'     => __( 'Parent Review:', TEXT_DOMAIN ),
            'all_items'             => __( 'All Reviews', TEXT_DOMAIN ),
            'add_new_item'          => __( 'Add New Review', TEXT_DOMAIN ),
            'add_new'               => __( 'Add New', TEXT_DOMAIN ),
            'new_item'              => __( 'New Review', TEXT_DOMAIN ),
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
            'insert_into_item'      => __( 'Insert into review', TEXT_DOMAIN ),
            'uploaded_to_this_item' => __( 'Uploaded to this review', TEXT_DOMAIN ),
            'items_list'            => __( 'Reviews list', TEXT_DOMAIN ),
            'items_list_navigation' => __( 'Reviews list navigation', TEXT_DOMAIN ),
            'filter_items_list'     => __( 'Filter reviews list', TEXT_DOMAIN ),
        );
        $args = array(
            'label'                 => __( 'Review', TEXT_DOMAIN ),
            'description'           => __( 'Displays reviews published by Emily Henry', TEXT_DOMAIN ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-quote',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( static::REVIEW_TYPE, $args );

    }


    /**
     * @param $content to display
     * @return mixed|string
     */
    public function reviewContentTemplate($content){

        $postReview = get_post();
        if($postReview->post_type == self::REVIEW_TYPE){

            $reviewName = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_NAME, true);

            $reviewLocation = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_LOCATION, true);

            $reviewRating = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_RATING, true);


            $content = "
            
                <div> $content  </div>
                 <p> Name: $reviewName</p>
                 <p> Location: $reviewLocation</p>
                 <p> Rating: $reviewRating</p>
            
            
            
            ";

        }

        return $content;



    }


    /**
     * @param $randomReview to display random review
     * @return mixed|string
     */
    public function displayRadonReview($randomReview)
    {


        $query = new \WP_Query([

            'post_type' => 'review',


            'orderby' => 'rand',


            'posts_per_page' => 1,
        ]);




        if ($query->have_posts()) {



            while ($query->have_posts()) {


                $query->the_post();

                $postReview = get_post();

                $reviewName = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_NAME, true);

                $reviewLocation = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_LOCATION, true);

                $reviewRating = get_post_meta($postReview->ID, ReviewMeta::MC_REVIEW_RATING, true);

                $review = get_the_content();

                $randomReview =  "
                    
                    <div class='random-review'>
                    
                    <div class='review'>
                  <p> $review </p>
                  
                  </div>
                  
                  <div class='meta-review'>
                  <p> Name: $reviewName</p>
                  <p> Location: $reviewLocation</p>
                  <p> Rating: $reviewRating Stars</p>
                  </div>
                  </div>
            
            ";


            }


            wp_reset_postdata();


        }

        return $randomReview;

    }


}