<?php
$modernizr_url = get_stylesheet_directory_uri() . '/assets/javascripts/vendor/modernizr';

wp_register_script( 'juliaraab_modernizr', $modernizr_url . $file_min.'.js' );
wp_enqueue_script('juliaraab_modernizr', false, array(), false, false);
