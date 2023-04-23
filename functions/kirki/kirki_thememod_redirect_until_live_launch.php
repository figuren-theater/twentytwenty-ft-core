<?php
/**
 *	Redirect public users to URL until Live-Launch
 *
 *	@since		2016.10.13
 *
 */
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'toggle',
	'label'       => esc_attr__( 'Hide Website', 'juliaraab' ),
	'description' => esc_attr__( 'Redirect not logged in users to some URL and hide the real -this-  website.', 'juliaraab' ),
//	'section'     => get_stylesheet().'_mod'.'_bricks',
	'section'     => 'title_tagline',
	'priority'    => 1,
	'settings'    => 'hide_website',
	'default'     => '1',
) );

Kirki::add_field( get_stylesheet().'_mod', array(
	'type'     => 'text',
	'label'    => esc_attr__( 'Redirect URL', 'juliaraab' ),
	'section'  => 'title_tagline',
	'priority' => 1,
	'settings' => 'hide_website_url',
	'default'  => 'http://',
	'active_callback'  => array(
		array(
			'setting'  => 'hide_website',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );