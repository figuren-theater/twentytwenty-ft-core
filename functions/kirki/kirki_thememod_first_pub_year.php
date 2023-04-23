<?php
/**
 *	Year of first publishing
 *
 * 	
 *	@since		2016.08.28
 *
 */
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'number',
	'label'       => esc_attr__( 'Year of first publishing', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'settings'    => 'first_pub_year',
	'priority'    => 30,
	'default'     => date('Y'),
	'choices'     => array(
		'min'     => 1973,
		'max'     => date('Y'),
		'step'    => 1,
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.site-copyright-date',
			'function' => 'html',
		),
	),
) );