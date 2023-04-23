<?php


wp_register_style(
	'juliaraab_load_css',
	get_stylesheet_directory_uri().'/assets/styles/load'.$file_min.'.css',
	false,
	$version_prevent_cache,
	'all'
);
wp_enqueue_style('juliaraab_load_css');



wp_register_style(
	'juliaraab_main_css',
	get_stylesheet_directory_uri().'/assets/styles/main'.$file_min.'.css',
	array('juliaraab_load_css'),
	$version_prevent_cache,
	'all'
);

wp_register_style(
	'juliaraab_main_halunken_css',
	get_stylesheet_directory_uri().'/assets/styles/main_halunken'.$file_min.'.css',
	array('juliaraab_load_css'),
	$version_prevent_cache,
	'all'
);

// TODO IS_ DEBUG
if ( is_tag('stadtfuehrung') || has_tag('stadtfuehrung') ) {
	wp_enqueue_style('juliaraab_main_halunken_css');
} else {
	wp_enqueue_style('juliaraab_main_css');
}






