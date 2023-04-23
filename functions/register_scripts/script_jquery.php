<?php


/**
 * Remove the migrate script from the list of jQuery dependencies.
 *
 * @since 1.0.0
 * @see   https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php#L23
 *
 * @param WP_Scripts $scripts WP_Scripts scripts object. Passed by reference.
 */
function juliaraab_dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'juliaraab_dequeue_jquery_migrate' );

/**
 * Move jQuery to the footer. 
 */
function wpse_173601_enqueue_scripts() {
	wp_scripts()->add_data( 'jquery', 'group', 1 );
	wp_scripts()->add_data( 'jquery-core', 'group', 1 );
	wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'wpse_173601_enqueue_scripts' );

//wp_deregister_script('jquery'); // needed for Shariff
// wp_register_script('jquery',  get_stylesheet_directory_uri().'/web/js/vendors/jquery-1.11.3.min.js', false, '');
// wp_enqueue_script('jquery');
