<?php
/**
 *	Copyright Note
 *
 * 	
 *	@since		2016.08.28
 *
 */
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'text',
	'label'       => esc_attr__( 'Copyright Note', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 30,
	'settings' => 'copyright_note',
	'default'  => '&copy; ' . esc_attr__( 'All Rights reserved', 'juliaraab' ) . ' ' . esc_attr( get_bloginfo( 'name', 'display' ) ),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.site-copyright-license',
			'function' => 'html',
		),
	),
) );