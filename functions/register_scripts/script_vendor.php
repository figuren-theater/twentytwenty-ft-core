<?php
wp_register_script( 
	'juliaraab_vendor_js',
	get_stylesheet_directory_uri().'/assets/javascripts/vendor'.$file_min.'.js',
#	array('jquery') );
	array(),
	$version_prevent_cache,
	true
);
wp_enqueue_script('juliaraab_vendor_js');


// by-passing the global definition to not load cf7 scripts & styles
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {

	if ( 
		is_page( get_theme_mod( 'vip_contact' ) )
		||
		is_singular('event')
	)
		wpcf7_enqueue_scripts();
}

#if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
#	wpcf7_enqueue_styles();
#}

//
wp_deregister_script('wp-embed');