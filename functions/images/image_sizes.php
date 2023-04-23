<?php

/**
 *  Returns additional custom thumbnail sizes
 *
 *  @since    2016.09.05
 */
function juliaraab_thumbnail_setup () {
	// Array of custom image sizes to add
	$custom_thumbnail_sizes = array(
	
		// overwrites media settings
		array( 'id'=>'thumbnail',			'width'=>(int)150, 'height'=>(int)150, 'crop'=>true, 'show_in_modal' => true, 'name' => __('Thumbnail') ),
		array( 'id'=>'post-thumbnail',		'width'=>(int)150, 'height'=>(int)150, 'crop'=>true, 'show_in_modal' => false, 'name' => __('Thumbnail') ),

		array( 'id'=>'logo-thumbnail-mini',	'width'=>(int)150, 'height'=>(int)0,   'crop'=>true, 'show_in_modal' => false, 'name' => __('Logo Thumbnail') ),
		array( 'id'=>'logo-thumbnail',		'width'=>(int)0,   'height'=>(int)100, 'crop'=>true, 'show_in_modal' => false, 'name' => __('Logo Thumbnail') ),

		// some defaults matching our breakpoints
		array( 'id'=>'medium-thumb',		'width'=>(int)300,	'height'=>(int)300, 'crop'=>true, 'show_in_modal' => true, 'name' => _x( 'Medium Thumb','custom-image-size', 'juliaraab' ) ),
		array( 'id'=>'medium',				'width'=>(int)300,	'height'=>(int)300, 'crop'=>false, 'show_in_modal' => true, 'name' => _x( 'Medium','custom-image-size', 'juliaraab' ) ),
		array( 'id'=>'semi',				'width'=>(int)550,	'height'=>(int)550, 'crop'=>false, 'show_in_modal' => true, 'name' => _x( 'Semi','custom-image-size', 'juliaraab' ) ),
		array( 'id'=>'normal',				'width'=>(int)875,	'height'=>(int)656, 'crop'=>false, 'show_in_modal' => true, 'name' => _x( 'Normal','custom-image-size', 'juliaraab' ) ),

		// used as site backgrounds
		array( 'id'=>'large', 				'width'=>1500, 	'height'=>0, 'crop'=>false, 'show_in_modal' => true, 'name' => __('Large') ),
		// keep this "0" to be sure, we cann upload really big images
		array( 'id'=>'full', 				'width'=>0, 	'height'=>0, 'crop'=>false, 'show_in_modal' => true, 'name' => __('Full Size') ),

	);
	return $custom_thumbnail_sizes;
}

add_action( 'after_setup_theme', function(){

	// add support for post thumbnails
	add_theme_support('post-thumbnails');

	// get custom_thumbnail-sizes ...
	$custom_thumbnail_sizes =  juliaraab_thumbnail_setup();

	// ... and update their options
	// For each new image size, run add_image_size() and update_option() to add the necessary info.
	// update_option() is good because it only updates the database if the value has changed. It also adds the option if it doesn't exist
	foreach ( $custom_thumbnail_sizes as $custom_thumbnail_size ){
			add_image_size( $custom_thumbnail_size['id'], $custom_thumbnail_size['width'], $custom_thumbnail_size['height'], $custom_thumbnail_size['crop'] );
	}

});



/**
 * Add intermediate image sizes to media gallery modal dialog
 *
 *  @since    2016.09.05
 */
function juliaraab_add_image_sizes_to_editor( $image_size_names_choose ) {

	$all_image_sizes = juliaraab_thumbnail_setup();
	$_image_size_names_choose = array();
	foreach ( $all_image_sizes as $sizes ) {

		if ( $sizes['show_in_modal'] === true ) {
			$_width = ( 0 != $sizes['width']) ? $sizes['width'] : __('flexible','juliaraab');
			$_height = ( 0 != $sizes['height']) ? $sizes['height'] : __('flexible','juliaraab');
			$_size_string = '      ('. $_width.' x '.$_height .') ';
			$_image_size_names_choose[''.$sizes['id'].''] = $sizes['name'].$_size_string;
#			$_image_size_names_choose[''.$sizes['id'].''] = $sizes['name'];
		}

	}
	return $_image_size_names_choose; 
}
add_filter( 'image_size_names_choose', 'juliaraab_add_image_sizes_to_editor', 10, 1 );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function juliaraab_calculate_image_sizes( $sizes, $size ) {

	$width = $size[0];
	$height = $size[1];
	$fallback = '(max-width: ' . $width . 'px) 97vw, ' . $width . 'px';
/*
	//Page without sidebar
	if (get_page_template_slug() === 'template-full_width.php') {
		if ($width > 910) {
			return '(max-width: 768px) 92vw, (max-width: 992px) 690px, (max-width: 1200px) 910px, 1110px';
		}
		if ($width < 910 && $width > 690) {
			return '(max-width: 768px) 92vw, (max-width: 992px) 690px, 910px';
		}
		return $fallback;
	}*/
/**/
	//
#	if ( is_archive() ) {

		// portrait images
		if ( $height > $width ) {
			// maybe TODO
		}

		// landscape-images

		// bp small
		if ($width <= 399) {
			return '(max-width: 399px) 97vw, ' . $width . 'px';
		}
		// bp medium
		if ($width <= 699) {
			return '(max-width: 399px) 97vw, (max-width: 699px) 47vw, ' . $width . 'px';
		}
		// bp normal
		if ($width <= 999) {
			return '(max-width: 399px) 97vw, (max-width: 699px) 47vw, , (max-width: 999px) 31.33333vw, ' . $width . 'px';
		}
		// bp large
		if ($width <= 1299) {
			return '(max-width: 399px) 97vw, (max-width: 699px) 47vw, , (max-width: 999px) 31.33333vw, (max-width: 1299px) 23.125vw, ' . $width . 'px';
		}
		// bp large - max-page-width
		if ($width > 1299) {
			return '(max-width: 399px) 97vw, (max-width: 699px) 47vw, , (max-width: 999px) 31.33333vw, (max-width: 1299px) 23.125vw, (min-width: 1300px) 18.2vw, ' . $width . 'px';
		}
#	}
/*	if ($width < 959 && $width > 450) {
		return '(max-width: 959px) 80vw, (max-width: 992px) 450px, 597px';
	}*/
	return $fallback;

}
add_filter( 'wp_calculate_image_sizes', 'juliaraab_calculate_image_sizes', 10 , 2 );