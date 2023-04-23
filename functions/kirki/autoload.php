<?php
require_once('check_kirki_loaded.php');
require_once('init_kirki_theme_settings.php');

// auto-include all theme_mod settings 
// from files starting with 'kirki_thememod_'
foreach ( glob( dirname( __FILE__ ) . '/kirki_thememod_*.php' ) as $file )
	require_once( $file );