<?php
function parent_theme_enqueue_styles() {

#	$file_min = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

##	$version_prevent_cache = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? time() : false;



	wp_deregister_style( 'twentytwenty-style' );
#	$style_css = '/style' . $file_min.'.css';
	$style_css = '/style.css';
	$template_css_url = get_template_directory_uri() . $style_css;
	$template_css_dir = get_template_directory() . $style_css;
	// register template styles
	wp_register_style(
		'twentytwenty-style',
		$template_css_url,
		array('wp-block-library'),
		filemtime( $template_css_dir ),
		'all'
	);
	wp_enqueue_style( 'twentytwenty-style' );
	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );


	$style_css_url = get_stylesheet_directory_uri() . $style_css;
	$style_css_dir = get_stylesheet_directory() . $style_css;
	// register parent styles
	wp_register_style(
		'twentytwenty-child-style',
		$style_css_url,
		array( 'twentytwenty-style' ),
		filemtime( $style_css_dir ),
		'all'
	);


	wp_deregister_style( 'twentytwenty-print-style' );
	$print_css = '/print.css';
#	$style_css = '/print' . $file_min.'.css';
	$print_style_css_url = get_template_directory_uri() . $print_css;
	$print_style_css_dir = get_template_directory() . $print_css;
	// register parent styles
	wp_register_style(
		'twentytwenty-print-style',
		$print_style_css_url,
		array( 'twentytwenty-style' ),
		filemtime( $print_style_css_dir ),
		'print'
	);
	wp_dequeue_style( 'twentytwenty-print-style' );



	// wp_dequeue_style( 'wp-block-library' );
}
add_action('wp_enqueue_scripts', 'parent_theme_enqueue_styles', 11 );



function ft_footer_styles() {

	// wp_enqueue_style( 'wp-block-library' );

#	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );
#	wp_add_inline_style( 'global-styles', twentytwenty_get_customizer_css( 'front-end' ) );

	// wp_enqueue_style( 'twentytwenty-style' );
	// // Add output of Customizer settings as inline style.
	// wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	wp_enqueue_style( 'twentytwenty-child-style' );
	wp_enqueue_style( 'twentytwenty-print-style' );
};
add_action( 'wp_footer', 'ft_footer_styles',1 );





add_action( 'wp_enqueue_scripts', function(){

#	$file_min = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

#	$version_prevent_cache = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? time() : false;

	remove_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );
	add_action( 'wp_footer', 'twentytwenty_register_scripts' );

}, 9 );

/*
add_action( 'wp_print_footer_scripts', function(){

#	$file_min = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? '' : '.min';

#	$version_prevent_cache = ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) ? time() : false;

	wp_enqueue_script( 'twentytwenty-js' );


});*/

