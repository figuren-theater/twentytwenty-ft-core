<?php
// Filters used or introduced by cbstdsys' mu-plugins
#require_once('cbstdsys_filters.php');

// 
#require_once('theme_functions.php');

if ( is_admin()) {
	// auto-include all custom plugin extensions
	// from files starting with 'plugin.extension.'
	foreach ( glob( dirname( __FILE__ ) . '/admin.*.php' ) as $file )
		require_once( $file );
}