<?php

// Add specific CSS class by filter
add_filter( 'body_class', 'juliaraab_filter_body_class' );
function juliaraab_filter_body_class( $classes ) {

	global $post;

/*	// add 'class-name' to the $classes array
	if( is_post_type_archive('event') ) : //set conditionals
		$classes[] = 'list';
		if (($key = array_search('archive', $classes)) !== false) {
			unset($classes[$key]);
		}
	endif;*/

	if ( is_singular() ) {
		// if post has thumbnail attached
		if( has_post_thumbnail( $post->ID ) )
				$classes[] = 'has-thumb';
	}

	return $classes; //returns the regular CSS classes
}