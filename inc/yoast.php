<?php

// remove Locations item from breadcrumbs
add_filter( 'wpseo_breadcrumb_single_link' ,'wpseo_remove_breadcrumb_link', 10 ,2);
function wpseo_remove_breadcrumb_link( $link_output , $link ){
	$text_to_remove = 'Locations';
	if( $link['text'] == $text_to_remove ) {
		$link_output = '';
	}
	return $link_output;
}

// add Locations item from breadcrumbs
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link_locations' );
function yoast_seo_breadcrumb_append_link_locations( $links ) {
	global $post;
	if ( is_singular ('locations') ) {
		$breadcrumb[] = array(
			'url' => site_url( '/locations/' ),
			'text' => 'Locations',
		);
		array_splice( $links, 1, -2, $breadcrumb );
	}
	return $links;
}

// replace State breadcrumbs item without link
add_filter( 'wpseo_breadcrumb_single_link' ,'wpseo_just_remove_breadcrumb_link', 10 ,2);
function wpseo_just_remove_breadcrumb_link( $link_output , $link ){
	$args = array(
		'taxonomy' => 'state',
		'orderby'  => 'name',
		'hide_empty' => false,
		'order'    => 'ASC'
	);
	$terms = get_terms( $args );
	$text_to_remove = [];
	foreach ( $terms as $term ) {
		$text_to_remove[] = $term->name;
	}
	if(in_array($link['text'] , $text_to_remove )) {
		$link_output = str_replace('<a href="'.$link['url'].'">' , "</a>" , $link_output);
		return str_replace('data-wpel-link="internal"' , "" , $link_output);
	}
	return $link_output;
}

// hide City page name
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_last_item' );
function yoast_seo_breadcrumb_append_last_item( $links ) {
	global $post;
	if ( is_singular ('locations')) {
		$city = get_post_meta( get_the_ID(), 'osm_local_business_locality', true );
		$breadcrumb[] = array(
			'text' => $city,
		);
		array_splice( $links, 3, 3, $breadcrumb );
	}
	return $links;
}

// Remove Locations page (Locations archive page) and Blog page archive from breadcrumbs
add_filter( 'wpseo_breadcrumb_links', function( $links ) {
    if ( is_singular(['locations']) || is_tax('state') ) {
        unset( $links[1] );
  }
    // Rebase array keys
    $links = array_values( $links );
    // Return modified array
    return $links;
});