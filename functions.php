<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


//add child pages shortcode
function show_childpages_shortcode() {

    // a shortcode should just return the content not echo html
    // so we start to create an object, and on the end we return it
    // if we dont do this the shortcode will be displayed in the top of the content
    ob_start();

    // only start if we are on a single page
    if ( is_page() ) {

        // get the ID of the current (parent) page
        $current_page_id = get_the_ID();

        // get all the children of the current page
        $child_pages = get_pages( array( 
            'child_of' => $current_page_id,  
        ) );

        // start only if we have some childpages
        if ($child_pages) {

            // if we have some children, display a list wrapper
            echo '<ul class="childpages">';

            // loop trough each childpage 
            foreach ($child_pages as $child_page) {

                $page_id    = $child_page->ID; // get the ID of the childpage
                $page_link  = get_permalink( $page_id ); // returns the link to childpage
                $page_img   = get_the_post_thumbnail( $page_id, 'large' ); // returns the featured image <img> element
                $page_title = $child_page->post_title; // returns the title of the child page
				$location   = get_field( 'location', $page_id );

                ?>

                <li class="childpage-<?php echo $page_id; ?>">

                    <a href="<?php echo $page_link; ?>">
						<?php echo $page_img; //display featured image ?>
                        <h4><?php echo $page_title; ?></h4>
						<span><?php echo $location; ?></span>

                    </a>

                </li>

                <?php

            }//END foreach ($child_pages as $child_page)

            echo '</ul>';

        }//END if ($child_pages)    

    }//END if (is_page())

    // return the object
    return ob_get_clean();

}
add_shortcode( 'show_childpages', 'show_childpages_shortcode' );

//ACF data out of the loop by calling for current postID
function acf_trail_forks() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$trail_id = the_field('trail_forks', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $trail_id;
}
add_shortcode( 'call_trail', 'acf_trail_forks' );

function acf_url() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$trail_id = the_field('trail_forks_url', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $trail_id;
}
add_shortcode( 'call_url', 'acf_url' );

function acf_location() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$location = the_field('location', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $location;
}
add_shortcode( 'call_location', 'acf_location' );

function acf_event_date() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$event_date = the_field('event_date', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $event_date;
}
add_shortcode( 'call_event_date', 'acf_event_date' );

function acf_event_location() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$event_location = the_field('event_location', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $event_location;
}
add_shortcode( 'call_event_location', 'acf_event_location' );

function acf_event_link() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$event_link = the_field('event_link', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $event_link;
}
add_shortcode( 'call_event_link', 'acf_event_link' );



function acf_event_registration_link() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$event_registration_link = the_field('eventregistrationn_link', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $event_registration_link;
}
add_shortcode( 'call_event_registration_link', 'acf_event_registration_link' );

function acf_facebook_event_page() {
	ob_start();
    // get the ID of the current (parent) page
    $current_page_id = get_the_ID();
	//use it to get the trail_id
	$facebook_event_page = the_field('facebook_event_page', $current_page_id);
	return ob_get_clean();
	//return the variable
	return $facebook_event_page;
}
add_shortcode( 'call_facebook_event_page', 'acf_facebook_event_page' );


