<?php

// auto-include all custom plugin extensions
// from files starting with 'plugin.extension.'
foreach ( glob( dirname( __FILE__ ) . '/plugin.extension.*.php' ) as $file )
	require_once( $file );