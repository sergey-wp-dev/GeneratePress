<?php

//disabled posts loop and pagination on custom locations archive page 
add_action('wp',function(){
	if ( is_post_type_archive('locations') || is_singular('locations') ) {
		remove_action( 'generate_after_loop', 'generate_do_post_navigation' );
		add_filter( 'generate_has_default_loop', '__return_false' );
	}
});

/**
 * Include Yoast settings and functionality file
 */
$yoast_setup = get_stylesheet_directory() . '/inc/yoast.php';
if ( is_readable( $yoast_setup ) ) {
	require_once $yoast_setup;
}