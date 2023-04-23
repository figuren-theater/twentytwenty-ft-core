<?php 
// auto-include all shortcodes 
// from files starting with 'shortcode.'
foreach ( glob( dirname( __FILE__ ) . '/shortcode.*.php' ) as $file )
	require_once( $file );