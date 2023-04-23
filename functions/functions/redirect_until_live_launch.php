<?php
/**
 *  Redirect public users to XING until Live-Launch
 *
 *  @since    2016.10.13
 *
 */

function figurentheater_redirect_public_users() {

	// only redirect users LIVE
#	if ( 'local' === WP_ENVIRONMENT_TYPE )
#		return;

	if ( false === is_user_logged_in() ) {

		// get settings via customizer
		$theme_mods = get_theme_mods();
		if ( "1" === $theme_mods['hide_website'] )
			$url = esc_url( $theme_mods['hide_website_url'] );
		else
			return;

		// fallback
		if ( empty( $url ) )
			$url = 'http://juliaraab.de/thema/figurentheater';

		if ( wp_redirect( $url ) ) {
			exit;
		}
	}
}
add_action('template_redirect', 'figurentheater_redirect_public_users');