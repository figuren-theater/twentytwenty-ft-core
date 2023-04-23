<?php
/**
 *	Contact Information
 *
 *	Used within microdata and for SEO stuff, in meta tags and also as content blocks
 * 	
 *	@since		2016.09.03
 *
 */
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'text',
	'label'       => esc_attr__( 'Email', 'juliaraab' ),
	'description' => esc_attr__( 'Central emailaddress used whenever possible on the whole site.', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 20,
	'settings'    => 'central_email',
	'default'     => get_bloginfo('admin_email' ),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#toggle-panel-mail h3 a',
			'function' => 'html',
		),
	),
) );

Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'text',
	'label'       => esc_attr__( 'Phone', 'juliaraab' ),
	'description' => esc_attr__( 'Central telephone-number used whenever possible on the whole site.', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 10,
	'settings'    => 'central_phone',
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#toggle-panel-phone h3 a',
			'function' => 'html',
		),
	),
) );


/***************** juliaraab | specific stuff ********************/

/*
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'textarea',
	'label'       => esc_attr__( 'Email Overlay', 'juliaraab' ),
	'description' => esc_attr__( 'Content between your emailaddress and the mailform, inside of the "Email" Overlay.', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 20,
	'settings'    => 'email_bytext',
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#toggle-panel-mail h3 + p',
			'function' => 'html',
		),
	),
) );

Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'select',
	'label'       => esc_attr__( 'Mini-Form', 'juliaraab' ),
	'description' => esc_attr__( 'Choose the Form you prepared for the "Email" Overlay.', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 20,
	'settings'    => 'cf7_overlay_form',
	'multiple'    => 0,
	'choices'     => Kirki_Helper::get_posts( array( 'post_type' => 'wpcf7_contact_form', 'numberposts' => 5 ) ),
) );

Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'textarea',
	'label'       => esc_attr__( 'Phone Overlay', 'juliaraab' ),
	'description' => esc_attr__( 'Content below your phonenumber, inside of the "Email" Overlay.', 'juliaraab' ),
	'section'     => get_stylesheet().'_mod'.'_bricks',
	'priority'    => 10,
	'settings'    => 'phone_bytext',
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#toggle-panel-phone h3 + p',
			'function' => 'html',
		),
	),
) );*/