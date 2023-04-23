<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the tiny_content-elements.css stylesheet.
 *
 *  It is not possible to have several conditional $content_width based on template
 *  http://wordpress.stackexchange.com/a/6500
 */
if ( ! isset( $content_width ) )
		$content_width = 960; // max avaiable space
