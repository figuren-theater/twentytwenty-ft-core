<?php

/* ==========================================================================
 *	Remove metaboxes created by plugins
 *
 *	Removes unused or useless metaboxes,
 *  some default ones and some, added by plugins
 * 	
 *	@since		2018.02.08
 *
   ========================================================================== */
function juliaraab_remove_metaboxes(){

	// Only run if the user-role is lower than super-admin
	if ( ! current_user_can( 'manage_network' ) ) { 
		$post_types = get_post_types( array( 'public' => true ), 'names' ); 

		foreach ( $post_types as $post_type ) {
			// Remove "BJ Lazy Load" Metabox from post_editing
#			remove_meta_box( 'bj_lazy_load_skip_post', $post_type, 'side' );
			// remove default custom fields
			remove_meta_box('postcustom', $post_type, 'normal');
			// Remove "Shariff Wrapper" metabox
			remove_meta_box('shariff_metabox', $post_type, 'side');
			// Remove "Content Aware Sidebars" metabox
			remove_meta_box('cas-content-sidebars', $post_type, 'side');
			// Remove "Video Thumbnails"
#			remove_meta_box( 'video_thumbnail', $post_type, 'side' );
			// Remove "Imported from" keyring-services taxonomy
#			remove_meta_box( 'keyring_servicesdiv', $post_type, 'side' );
			// Remove "IWP Featherlight Options" JS + CSS Load-Switcher, handled by Theme
#			remove_meta_box( 'wp_featherlight_options', $post_type, 'side' );

		}
	}
}
add_action( 'do_meta_boxes', 'juliaraab_remove_metaboxes' );

