<?php # -*- coding: utf-8 -*-

namespace Figuren_Theater\Coresites;
#wp_die('angekommen');
/**
 * All of this is based on twentytwentys naming of theme_mods
 */
add_action('init', __NAMESPACE__.'\\share_theme_mods_from_ROOT');
function share_theme_mods_from_ROOT(){

	// Jump out if 'ROOT' at https://figuren.theater
	if ( is_main_site() )
		return;

	// theme mods, that need to be original 
	// from the current site and 
	// not modified by any kind of defaults
	$ft_local_important_mods = array_flip( array(
		# typicall twentytwenty theme_mods
		# commented out, what should be synced

#		'accent_accessible_colors',
#		'accent_hue',
#		'accent_hue_active',
#		'background_color',
		'blog_content',
		'custom_css_post_id',
		'custom_logo',
#		'enable_header_search',
#		'header_footer_background_color',
		'nav_menu_locations',
#		'retina_logo',
#		'show_author_bio',
	) );

#	$ptheme = get_template_directory();
	$ctheme = get_stylesheet_directory();
	$theme_slug = basename($ctheme);
	$mods_slug = "theme_mods_{$theme_slug}";
#	$opts_slug = "pre_get_options_{$mods_slug}";
	$opts_slug = "option_{$mods_slug}";

	// get global theme_mods delivered by ROOT
	$ft_all_mods = get_blog_option( 1, $mods_slug);
	$ft_local_mods = get_theme_mods();

	// Remove 'important local settings' 
	// from global theme_mods delivered by ROOT 
	$ft_important_mods = array_diff_key($ft_all_mods, $ft_local_important_mods);

	//
	$ft_merged_mods = array_merge($ft_local_mods,$ft_important_mods);

	// by '' 
	add_filter( $opts_slug, function($_options) use ($ft_merged_mods){
		if (is_array($ft_merged_mods) && !empty($ft_merged_mods))
			$_options = $ft_merged_mods;

		return $_options;
	} );

}