<?php



/**
 *	Set default link type to “file” for image galleries
 *
 *	Filter to verride the gallery shortcode link attribute with:
 * 	
 *	@since		2015.12.08
 *	@see		http://wordpress.stackexchange.com/a/206693/20992
 *
 *	@param		{type}		description
 *	@return		{type}		description
 */
function juliaraab_gallery_default_type_set_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
}
add_filter( 'media_view_settings', 'juliaraab_gallery_default_type_set_link');


/**
 * Hide the 'Attachment Page' option for the link-to part.
 *
 * @see		http://wordpress.stackexchange.com/a/173027/20992
 */
add_action( 'print_media_templates', function(){
	echo '
		<style>       
			.post-php select.link-to option[value="post"],
			.post-php select[data-setting="link"] option[value="post"] 
			{ display: none; }
		</style>';
});



/**
 * Adds two fields for credits to any media file: name and URL.
 *
 * Based on the clear tutorial by Andy Blackwell:
 * @link http://net.tutsplus.com/?p=13076
 *
 * @author "Thomas Scholz"
 *
 */
$juliaraab_Media_Artist = new Toscho_Media_Artist(
	array (
		'artist_name' => array (
			'public' => 'juliaraab_credit_name',
			'hidden' => '_juliaraab_credit_name',
			'label'  => __('Author Name','juliaraab'),
		),
		'artist_url' => array (
			'public' => 'juliaraab_credit_url',
			'hidden' => '_juliaraab_credit_url',
			'label'  => __('Author URL','juliaraab'),
		),
	),
	__( 'Image:','juliaraab')
);


/**
 * Filters the [caption] shortcode
 *
 * @since 3.6.0
 * @since 4.4.0 Added the `$shortcode` parameter.
 *
 * @param array  $out       The output array of shortcode attributes.
 * @param array  $pairs     The supported attributes and their defaults.
 * @param array  $atts      The user defined shortcode attributes.
 * @param string $shortcode The shortcode name.
 */
#add_filter( 'shortcode_atts_caption', 'juliaraab_add_media_artist_to_caption', 10, 3 );
function juliaraab_add_media_artist_to_caption ( $out, $pairs, $atts ) {
	fb(array($out, $pairs, $atts, $shortcode));
	return '';
#	return $out;
}

#add_action( 'init', create_function( '$a', "add_filter( 'shortcode_atts_caption', 'juliaraab_add_media_artist_to_caption', 10, 3 );"));



function juliaraab_add_toschos_mediacredit_to_image_title( $html, $id , $alt, $title, $align, $size ){
#fb('##########################  here we are');
		$credit = get_post_meta( $id, '_juliaraab_credit_name', true );
		if ( !empty( $credit ) ) {
				$credit = sprintf(
					' %$1s %$2s',
					__( 'Image:','juliaraab'),
					$credit
				);
				if (!empty( $title )) {
					$html = str_replace( 'title="'.$title.'"', 'title="'.$title.$credit.'"', $html );
				} else {
					$html = str_replace( 'src="', 'title="'.$title.$credit.'" src="', $html );
				}
				
		}
		return $html;
}
#add_filter( 'get_image_tag', 'cbstdsys_add_alt_attr_if_is_empty_for_image_tag', 10, 6 );
