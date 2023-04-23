<?php 

/*******************************************************************************
 *
 *  "Contact form 7" Plugin related Shortcodes
 *
 *******************************************************************************/
class cbstdsys_cf7_shortcodes {
	public static function cf7_default_footer( $atts, $content = '', $shortcode_name ) {

		$return  = '';
		$return .= '<p>Alle Felder mit<span class="highlight"> Sternchen* </span>sind Pflichtfelder.</p>';

		if ( $privacy_page = get_post( get_theme_mod('vip_privacy') ) ) {
			$return .= '<p><a href="'.get_permalink( $privacy_page->ID ).'">'.__('Privacy','juliaraab').'</a></p>';
		}

		$return  = '<div class="cf7_default_footer">'.$return.'</div>';
		return $return;
	}
}
add_shortcode( 'cf7_default_footer', array( 'cbstdsys_cf7_shortcodes', 'cf7_default_footer' ) );
