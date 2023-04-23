<?php
/** If constant isn't defined on wp-config file
  * Enable or Disable Twig cache on template rendering
  */
if ( !defined('TWIG_CACHE_ENABLE') ) {
    define('TWIG_CACHE_ENABLE', false);
}

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        $class = 'notice notice-error';
        $message = sprintf(
            'Timber is not activated. Make sure you activate the plugin in <a href="%d">%d</a>', 
            esc_url( admin_url('plugins.php#timber')), 
            esc_url( admin_url('plugins.php'))
        );

        printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
    });
}