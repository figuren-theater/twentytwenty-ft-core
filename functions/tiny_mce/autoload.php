<?php

/**
 * TinyMCE Modification
 *
 * @package juliaraab
 * 
 * @see 	https://shellcreeper.com/complete-guide-to-style-format-drop-down-in-wp-editor/
 * @see 	http://wordpress.itsprite.com/wordpresstinymce-adding-css-to-format-dropdown/
 */

add_action( 'admin_init', function(){
	require_once('before_init.php');
	require_once('add_buttons.php');
	require_once('add_editor_styles.php');
});
