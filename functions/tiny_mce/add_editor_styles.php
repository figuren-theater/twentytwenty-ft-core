<?php


add_filter( 'mce_css', 'juliaraab_mce_css' );


/**
 *	Add Editor Styles to TinyMCE
 *
 *	We do it this way, because add_editor_style()
 *	doesn't accept a URL as a param, but we want to use
 *	our custom theme.subdomain.tld
 * 	
 *	@since		2016.09.05
 *
 *	@param		string		string of CSS files to load inside TinyMCE
 *	@return		string		updated string of CSS files
 */
function juliaraab_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= get_stylesheet_directory_uri() . '/assets/styles/editor-style.css';
	return $mce_css;
}
