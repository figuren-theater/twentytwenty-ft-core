<?php
/**
 *	Google Analytics Tracking Code
 * 	
 *	@since		2016.12.18
 *
 */
Kirki::add_field( get_stylesheet().'_mod', array(
	'type'        => 'text',
	'label'       => esc_attr__( 'Google Analytics Tracking Code', 'juliaraab' ),
	'section'     => 'title_tagline',
	'priority'    => 50,
	'settings' => 'analytics_tracking_code',
) );