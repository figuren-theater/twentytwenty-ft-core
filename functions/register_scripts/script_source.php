<?php

wp_register_script( 
	'juliaraab_main_js',
	get_stylesheet_directory_uri().'/assets/javascripts/source'.$file_min.'.js',
#	array('jquery','juliaraab_vendor_js') );
	array('juliaraab_vendor_js'),
	$version_prevent_cache,
	true
);
wp_enqueue_script('juliaraab_main_js');


/*wp_register_script( 'cookieconsent',
#	'//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js',
	get_stylesheet_directory_uri().'/assets/javascripts/seps/cookieconsent.3.0.0'.$file_min.'.js',
	array(),
	'1.0.9',
	true
);*/
#if ( ! isset( $_COOKIE['cookieconsent_dismissed'] ) )
#	wp_enqueue_script( 'cookieconsent' );
