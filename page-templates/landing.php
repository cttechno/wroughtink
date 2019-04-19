<?php
/**
 * Genesis Sample.
 *
 * This file adds the landing page template to the Genesis Sample Theme.
 *
 * Template Name: Landing
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_filter( 'body_class', 'genesis_sample_landing_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function genesis_sample_landing_body_class( $classes ) {

	$classes[] = 'landing-page';
	return $classes;

}

// Removes Skip Links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

add_action( 'wp_enqueue_scripts', 'genesis_sample_dequeue_skip_links' );
/**
 * Dequeues Skip Links Script.
 *
 * @since 1.0.0
 */
function genesis_sample_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes site header elements.

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_header', 'genesis_do_nav', 12 );


add_action("genesis_header", 'do_custom_title_and_search_mobile');
add_action("genesis_header", 'do_custom_title_and_search');
add_filter( 'genesis_attr_nav-primary', 'wi_add_primary_nav_class' );
//add_action("genesis_header", 'do_custom_call_to_action');



/**
* This is the version of the header that will display when the page is at fullscreen
*/
function do_custom_title_and_search(){
	?>

		<header class= 'wi_homepage_header' style='background-image: url(" <?php echo get_theme_mod("wi_hero_background_image"); ?> ")' >
				<section class='wi_homepage_header_toprow'>
		        <span class="wi_homepage_site_logo"><?php the_custom_logo(); ?></span>
		        <span class="wi_search"><?php get_search_form(); ?></span>
		    </section>
					<?php  get_wi_nav(); ?>
	    <section class='wi-homepage-cta'>
	        <h1><?php echo get_theme_mod("wi_hero_title"); ?></h1>
					<section>
						<p><?php echo get_theme_mod("wi_hero_text"); ?></p>
					</section>
	        <a href='<?php echo get_post(get_theme_mod("wi_hero_btn_link"))->guid; ?> ' class='hero-btn'><?php echo get_theme_mod("wi_hero_btn");?> </a>
	    </section>
	</header>

		<?php
}//end do_custom_header


function do_custom_title_and_search_mobile(){
	?>

		<header class= 'wi_homepage_header_mobile'  >
			<section class='wi_homepage_header_toprow_mobile'>
					<span class="wi_homepage_site_logo"><?php the_custom_logo(); ?></span>
					<span><?php  get_wi_nav(); ?></span>
			</section>
			<section class="wi_mobile_header_image" style='background-image: url(" <?php echo get_theme_mod("wi_hero_background_image"); ?> ")' ></section>
	    <section class='wi-homepage-cta'>
	        <h1><?php echo get_theme_mod("wi_hero_title"); ?></h1>
					<section>
						<p><?php echo get_theme_mod("wi_hero_text"); ?></p>
					</section>
	        <a href='<?php echo get_post(get_theme_mod("wi_hero_btn_link"))->guid; ?> ' class='hero-btn'><?php echo get_theme_mod("wi_hero_btn");?> </a>
	    </section>
	</header>

		<?php
}//end do_custom_header

/**
* This is here to make sure that the homepage gallery does not get rendered by the genesis loop
*/
if (is_front_page()){
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	require_once get_stylesheet_directory() .  "/components/folklore/folklore_display.php";
	add_action('genesis_loop', 'wi_display_folklore');
}




add_action('genesis_loop', 'wi_shop_link_markup');

// Removes breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// // Removes footer widgets.
// remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
//
// // Removes site footer elements.
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Runs the Genesis loop.
genesis();




function wi_shop_link_markup(){
	require_once  get_stylesheet_directory() . "/components/shop_components/shop_catagory_markup.php";
	 $args = array(
		 'taxonomy' => 'product_cat',
		 'hide_empty' => true,
		 'meta_key' => 'thumbnail_id'
	 );
	$categories = get_terms($args );

	//echo print_r($categories);
	$display = "<article class='homepage-shop-link'>";
	$display .= "<h1>FIND YOUR DARKNESS</h1>";
	$display .= "<sections class='homepage-shop-link-container'>";
	echo $display;
//	echo print_r(woocommerce_get_product_subcategories());

	foreach($categories as $category){
		//get_object_vars($category) ;
		shop_catagory($category);
	}
	echo "</section>";
 	echo  "</article>";

  //echo print_r(get_theme_mod("wi_hero_background_image"));

}






function wi_get_nav_menu( $args = array() ) {

	$args = wp_parse_args(
		$args,
		array(
			'theme_location' => '',
			'container'      => '',
			'menu_class'     => 'menu genesis-nav-menu',
			'link_before'    => genesis_markup(
				array(
					'open'    => '<span %s>',
					'context' => 'nav-link-wrap',
					'echo'    => false,
				)
			),
			'link_after'     => genesis_markup(
				array(
					'close'   => '</span>',
					'context' => 'nav-link-wrap',
					'echo'    => false,
				)
			),
			'echo'           => 0,
		)
	);

	// If a menu is not assigned to theme location, abort.
	if ( ! has_nav_menu( $args['theme_location'] ) ) {
		return null;
	}

	// If genesis-accessibility for 'drop-down-menu' is enabled and the menu doesn't already have the superfish class, add it.
	if ( genesis_superfish_enabled() && false === strpos( $args['menu_class'], 'js-superfish' ) ) {
		$args['menu_class'] .= ' js-superfish';
	}

	$sanitized_location = sanitize_key( $args['theme_location'] );

	$nav = wp_nav_menu( $args );

	// Do nothing if there is nothing to show.
	if ( ! $nav ) {
		return null;
	}

	$nav_markup_open  = genesis_get_structural_wrap( 'menu-' . $sanitized_location, 'open' );
	$nav_markup_close = genesis_get_structural_wrap( 'menu-' . $sanitized_location, 'close' );

	$params = array(
		'theme_location' => $args['theme_location'],
	);

	$nav_output = genesis_markup(
		array(
			'open'    => '<nav %s>',
			'close'   => '</nav>',
			'context' => 'nav-' . $sanitized_location,
			'content' => $nav_markup_open . $nav . $nav_markup_close,
			'echo'    => false,
			'params'  => $params,
		)
	);

	$filter_location = $sanitized_location . '_nav';

	// Handle back-compat for primary and secondary nav filters.
	if ( 'primary' === $args['theme_location'] ) {
		$filter_location = 'do_nav';
	} elseif ( 'secondary' === $args['theme_location'] ) {
		$filter_location = 'do_subnav';
	}

	/**
	 * Filter the navigation markup.
	 *
	 * @since 2.1.0
	 *
	 * @param string $nav_output Opening container markup, nav, closing container markup.
	 * @param string $nav Navigation list (`<ul>`).
	 * @param array $args {
	 *     Arguments for `wp_nav_menu()`.
	 *
	 *     @type string $theme_location Menu location ID.
	 *     @type string $container Container markup.
	 *     @type string $menu_class Class(es) applied to the `<ul>`.
	 *     @type bool $echo 0 to indicate `wp_nav_menu()` should return not echo.
	 * }
	 */




	  echo genesis_markup(
 		array(
 			'open'    => '<nav %s>',
 			'close'   => '</nav>',
 			'context' => 'nav-' . $sanitized_location,
 			'content' => $nav_markup_open . $nav . $nav_markup_close,
 			'echo'    => false,
 			'params'  => $params,
 		),
		$nav,
		$args
 	);
	//return apply_filters( "genesis_header", $nav_output, $nav, $args );
}

/**
* Hooks into add_filter( 'genesis_attr_nav-primary', 'wi_add_primary_nav_class' );
* This is used to append the .wi-frontpage-nav class onto the primary navigation section.
*/
function wi_add_primary_nav_class( $attributes ) {
$attributes['class'] = $attributes['class']. ' .wi-frontpage-nav';
 return $attributes;
}


function get_wi_nav(){
	 wi_get_nav_menu( array(
							  		'theme_location' => 'primary',
							  		'menu_class'     => $class,
									));
}
