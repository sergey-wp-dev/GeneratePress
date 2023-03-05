<?php

// create a shortcode for showing ACF field with name ZIP code on single locations
add_shortcode( 'business_region', 'business_region' );
function business_region($attributes, $content = null){
	$attributes = shortcode_atts(
		array(
			'attr' => FALSE
		), $attributes);
	$output = '';
	if(get_field('osm_local_business_region') != ''):
		$output .= get_field('osm_local_business_region');
	endif;
	return $output;
}