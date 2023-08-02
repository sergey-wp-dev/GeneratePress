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

/* Shortcode 'Get City name - Location name' */
function city_name( $atts ) {
	return get_the_title();
}
add_shortcode( 'city_name', 'city_name' );


/* Shortcode 'Get short State name' */
function state_name( $atts ) {
	if(get_field('schema_address') != ''):
		$city_region_acf = get_field('schema_address');
		$state_short_name .= $city_region_acf['schema_address_region'];
		return $state_short_name;
	endif;
}
add_shortcode( 'state_short_name', 'state_name' );

/* Shortcode 'Get user ACF image url' display user image */
function author_image( $atts ) {
	$author_id = get_the_author_meta('ID');
	$author_photo_acf = get_field('author_photo', 'user_'.$author_id);
	if($author_photo_acf != ''):
		$author_photo = '';
		$author_photo .= '<figure class="gb-block-image user-image">';
		$author_photo .= '<img decoding="async" loading="lazy" width="48" height="48" class="gb-image" src="';
		$author_photo .= $author_photo_acf;
		$author_photo .= '" alt="" title="Ellipse-16-1"></figure>';
		return $author_photo;
	endif;
}
add_shortcode( 'author_image', 'author_image' );

// create a shortcode for the Google review rating
add_shortcode( 'google_reviews', 'google_reviews' );
function google_reviews($attributes, $content = null){
	$attributes = shortcode_atts(
		array(
			'attr' => FALSE
		), $attributes);
	$google_place_id = get_field('placeid');
	if($google_place_id && !empty($google_place_id)){
		$google_reviews = '';
		$google_reviews .= '<div class="gb-container gb-container-7dbd26f9">
		<div class="gb-grid-wrapper gb-grid-wrapper-1597695a">
		<div class="gb-grid-column gb-grid-column-b956ce8e"><div class="gb-container gb-container-b956ce8e">
		<p class="gb-headline gb-headline-b3c93b6c"><span class="gb-icon"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M29.9 12.175C29.7749 11.7812 29.5337 11.4345 29.208 11.1802C28.8823 10.9259 28.4874 10.7759 28.075 10.75L20.65 10.2375L17.9 3.3C17.7499 2.918 17.4885 2.58988 17.1498 2.3581C16.811 2.12633 16.4105 2.00158 16 2C15.5896 2.00158 15.1891 2.12633 14.8503 2.3581C14.5116 2.58988 14.2502 2.918 14.1 3.3L11.3 10.275L3.92504 10.75C3.51318 10.7776 3.11907 10.9282 2.79371 11.1822C2.46835 11.4363 2.22671 11.7821 2.10004 12.175C1.96997 12.5739 1.96237 13.0026 2.07823 13.4059C2.19408 13.8092 2.42808 14.1685 2.75005 14.4375L8.42505 19.2375L6.73755 25.875C6.62079 26.324 6.6418 26.7978 6.79785 27.2347C6.95389 27.6716 7.23776 28.0515 7.61255 28.325C7.97633 28.5861 8.40976 28.7327 8.85734 28.7461C9.30493 28.7594 9.74633 28.6389 10.125 28.4L15.9875 24.6875H16.0125L22.325 28.675C22.6489 28.8854 23.0264 28.9983 23.4125 29C23.7279 28.9975 24.0384 28.9228 24.3203 28.7815C24.6022 28.6403 24.848 28.4362 25.0387 28.1851C25.2295 27.9341 25.3601 27.6426 25.4205 27.3331C25.481 27.0236 25.4697 26.7044 25.3875 26.4L23.6 19.1375L29.25 14.4375C29.572 14.1685 29.806 13.8092 29.9219 13.4059C30.0377 13.0026 30.0301 12.5739 29.9 12.175Z" fill="#00B247"/>
</svg></span><span class="gb-headline-text">Reviews</span></p>
		</div></div>
		<div class="gb-grid-column gb-grid-column-8544808d"><div class="gb-container gb-container-8544808d">';
		$google_reviews .= do_shortcode('[google-reviews-pro place_name="'.get_the_title().'" place_id='.$google_place_id.' sort=3 min_filter=4 view_mode=badge_inner place_photo="'.get_stylesheet_directory_uri().'/assets/images/google-place-placeholder.jpg" disable_user_link=true open_link=true nofollow_link=true lazy_load_img=true]');
		$google_reviews .= '</div></div></div>';
	}
	return $google_reviews;
}