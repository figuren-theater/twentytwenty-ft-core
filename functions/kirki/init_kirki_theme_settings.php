<?php

/**
 *	Kirki Configuration
 *
 *	When you create a project in Kirki, 
 *	the first thing you have to do is create a configuration. 
 *	Configurations allow each project to use a different setup 
 *	and act as identifiers so it’s important you create one. 
 *	Fields that belong to your configuration will inherit 
 *	your config properties.
 * 	
 *	@since		2016.08.01
 *
 *	@param		capability		any valid WordPress capability. See the WordPress Codex for details.
 *	@param		option_type		can be either option or theme_mod.
 *	@param		option_name		If you’re using options instead of theme mods then you can use this to specify an option name. All your fields will then be saved as an array under that option in the WordPress database.
 *	@param		disable_output	Set to true if you don’t want Kirki to automatically output any CSS for your config (defaults to false).
 */
Kirki::add_config( get_stylesheet().'_mod', array(
	'capability'	=> 'edit_theme_options',
	'option_type'	=> 'theme_mod',
) );


/**
 *	Kirki Section
 *
 *	Sections are wrappers for fields, a way to group multiple fields together. 
 *	All fields must belong to a section, no field can be an orphan. 
 *	To see how to create Sections using the WordPress Customizer API 
 *	please take a look at the docs.
 *
 *	The Kirki::add_section() method is nothing more than a wrapper 
 *	for the WordPress customizer API and therefore follows 
 *	the exact same syntax. 
 *
 *	More information on WordPress Customizer Sections can be found 
 *	on the WordPress Codex.
 *
 *	@see		https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections
 * 	
 *	@since		version
 *
 *	@param		{type}		description
 *	@return		{type}		description
 */
Kirki::add_section( get_stylesheet().'_mod'.'_bricks', array(
	'title'				=> __( 'Text Blocks','figuren-theater' ),
	'description'		=> sprintf(
		__( 'Specific content building-bricks for %s.','figuren-theater' ),
		get_bloginfo('name' )
	),
#	'panel'				=> '', // Not typically needed.
	'priority'			=> 160,
	'capability'		=> 'edit_theme_options',
#	'theme_supports'	=> '', // Rarely needed.
) );

Kirki::add_section( get_stylesheet().'_mod'.'_design', array(
	'title'				=> __( 'Design','figuren-theater' ),
	'description'		=> __( 'Visual elements that could affect your global webdesign.','figuren-theater' ),
#	'panel'				=> '', // Not typically needed.
	'priority'			=> 160,
	'capability'		=> 'edit_theme_options',
#	'theme_supports'	=> '', // Rarely needed.
) );


// Rename default sections and change its descriptions
function juliaraab_rename_customizer_stuff () {

	global $wp_customize;

	$wp_customize->get_section( 'static_front_page' )->title = __( 'Important Pages', 'figuren-theater' );

	#$wp_customize->get_section( 'header_image' )->description = __( 'New Description', 'figuren-theater' );
	
}
add_action('customize_controls_init','juliaraab_rename_customizer_stuff');




add_action( 'customize_register', 'juliaraab_remove_css_section', 15 );
/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * @param $wp_customize WP_Customize_Manager
 */
function juliaraab_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}