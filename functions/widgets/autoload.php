<?php
if( ! defined( 'ABSPATH' ) ) exit;
/*
require_once('sidebars_init.php');
require_once('widgets_to_remove.php');

// auto-include all custom widgets
// from files starting with 'class.widget.'
foreach ( glob( dirname( __FILE__ ) . '/../../widgets/class.widget.*.php' ) as $file )
	require_once( $file );
*/

add_action( 'widgets_init', 'ft__register_sidebars' );
function ft__register_sidebars() {
	/* Register the 'utility' sidebar. */
	register_sidebar(
		array(
			'id' => 'utility',
			'name' => __( 'utility' ),
			'description' => __( 'after main Content' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

}