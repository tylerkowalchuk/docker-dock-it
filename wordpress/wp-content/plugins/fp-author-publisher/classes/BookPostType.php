<?php
namespace BooksPlugin;


/**
 * Book Post Type Class
 */
class BookPostType extends Singleton
{

    /**
     * post tyoe book
     */
    const POST_TYPE = 'book';
    /**
     * @var
     */
    protected static $instance;

    /**
      functionality
     */
    protected function __construct()
    {

        add_action( 'init', [$this, 'book_post_type'], 0 );

        add_filter('the_content', [$this, 'bookContentTemplate']);

    }

    // Register Custom Post Type

    /**
     * @return void post type information
     */
    public function book_post_type() {

        $labels = array(
            'name'                  => _x( 'Books', 'Post Type General Name', TEXT_DOMAIN ),
            'singular_name'         => _x( 'Book', 'Post Type Singular Name', TEXT_DOMAIN ),
            'menu_name'             => __( 'Books', TEXT_DOMAIN ),
            'name_admin_bar'        => __( 'Book', TEXT_DOMAIN ),
            'archives'              => __( 'Book Archives', TEXT_DOMAIN ),
            'attributes'            => __( 'Book Attributes', TEXT_DOMAIN ),
            'parent_item_colon'     => __( 'Parent Book :', TEXT_DOMAIN ),
            'all_items'             => __( 'All Books', TEXT_DOMAIN ),
            'add_new_item'          => __( 'Add New Book', TEXT_DOMAIN ),
            'add_new'               => __( 'Add New', TEXT_DOMAIN ),
            'new_item'              => __( 'New Book', TEXT_DOMAIN ),
            'edit_item'             => __( 'Edit Book', TEXT_DOMAIN ),
            'update_item'           => __( 'Update Book', TEXT_DOMAIN ),
            'view_item'             => __( 'View Book', TEXT_DOMAIN ),
            'view_items'            => __( 'View Books', TEXT_DOMAIN ),
            'search_items'          => __( 'Search Book', TEXT_DOMAIN ),
            'not_found'             => __( 'Not found', TEXT_DOMAIN ),
            'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
            'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
            'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
            'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
            'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
            'insert_into_item'      => __( 'Insert into book', TEXT_DOMAIN ),
            'uploaded_to_this_item' => __( 'Uploaded to this book', TEXT_DOMAIN ),
            'items_list'            => __( 'Books list', TEXT_DOMAIN ),
            'items_list_navigation' => __( 'Books list navigation', TEXT_DOMAIN ),
            'filter_items_list'     => __( 'Filter books list', TEXT_DOMAIN ),
        );
        $args = array(
            'label'                 => __( 'Book', TEXT_DOMAIN ),
            'description'           => __( 'Displays publications by Emily Henry', TEXT_DOMAIN ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields'  ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-book',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( static::POST_TYPE, $args );

    }

    /**
     * @param $content
     * @return mixed|string to display boop post
     */
    public function bookContentTemplate($content){


        $post = get_post();
        if($post->post_type == self::POST_TYPE) {

            $authorPublisher = get_post_meta($post->ID, BookMeta::MC_AUTHOR_PUBLISHER, true);

            $authorPublishedDate = get_post_meta($post->ID, BookMeta::MC_PUBLISHED_DATE, true);

            $bookPageCount = get_post_meta($post->ID, BookMeta::MC_PAGE_COUNT, true);

            $bookPrice = get_post_meta($post->ID, BookMeta::MC_BOOK_PRICE, true);

            $content = "
                        <div> $content </div>
                        <div class='book-information'>
                        <div class='book-info'>
                        <h3> Book Information </h3>
                        <p> Author Publisher: $authorPublisher </p>
                        <p> Published Date: $authorPublishedDate</p>
                        <p> Page Count: $bookPageCount</p>
                        <p> Book Price: $bookPrice</p>
                        </div>
                        ";





            $query = new \WP_Query([

                    'meta_key'=> 'reviewBook',
                    'meta_value' => $post->ID,
                    'post_type' => 'review',



                ]



            );

            if ($query->have_posts()) {

                $content .= '<div class="review-info">';
                $content .= '<h2> Reviews</h2>';
                while ($query->have_posts()) {
                    $query->the_post();
                    $content .= '<h4> '  . esc_html(get_the_title())  .'</h4>' .'<p >' . apply_filters( 'the_content', get_the_content()). '</p>';

                }
                $content .= '</div>';
                $content .= '</div>';
            } else {
                esc_html_e('Sorry, no posts matched your criteria.');
            }


            // Restore original Post Data.
            wp_reset_postdata();

        }
        return $content;

    }







}