<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emily_Henry
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.typekit.net/rgj4noo.css">
    <link rel="stylesheet" href="https://use.typekit.net/rgj4noo.css">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>

</head>



<div id="page" class="site">


    <header class="new-header">



        <p>
            <a href="https://mchkhetia.bitlampsites.com/wpd/final-project/">

            <img src="<?= get_stylesheet_directory_uri()?>" height="" width="" alt="Emily Henry">

            </a>
        </p>

        <nav class="new-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                )
            );
            ?>



        </nav>


    </header>


</div> <!---class site--->
	</header><!-- #masthead -->
</html>