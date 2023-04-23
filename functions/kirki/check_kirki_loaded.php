<?php
if ( ! class_exists( 'Kirki' ) ) {
    add_action( 'admin_notices', function() 
    {
        sprintf(
            '<div class="error"><p>Kirki not activated. Make sure you activate the plugin in <a href="%d">%d</a></p></div>', 
            esc_url(admin_url('plugins.php#kirki')), 
            esc_url( admin_url('plugins.php'))
        );
    });
}