<?php


/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
	'search-form', 'gallery', 'caption',
) );


/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );


// Add Excerpts to Pages
add_post_type_support( 'page', array('excerpt') );

// Prevent Spam comments
remove_post_type_support( 'attachment', 'comments' );
remove_post_type_support( 'attachment', 'trackbacks' );


// Add feed URLs to wp_head
if ( apply_filters( 'cbstdsys_use_with_blog', true ) )
		add_theme_support('automatic-feed-links');


// Implementing Selective Refresh Support for Widgets
// @since 4.5
add_theme_support( 'customize-selective-refresh-widgets' );