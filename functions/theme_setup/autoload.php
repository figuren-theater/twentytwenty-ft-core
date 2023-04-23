<?php
/**
 ** Load after setup theme


// Send admin notices if Timber isn't installed
if( !class_exists('Timber') ) {
	add_action( 'admin_notices', function(){
		$class = 'notice notice-error';
		$message = sprintf(
			'Timber is not activated. Make sure you activate the plugin in <a href="%d">%d</a>', 
			esc_url( admin_url('plugins.php#timber')), 
			esc_url( admin_url('plugins.php'))
		);

		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
	});
}

add_action('init', function(){
	require_once('body_class.php');
}, 100);
 **/
// Load textdomain
add_action('after_setup_theme', function(){
	require_once('textdomain.php');
	require_once('share-theme-mods-from-ROOT.php');
});