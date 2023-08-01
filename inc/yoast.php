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