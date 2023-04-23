<?php 


/**
 * Automatically add IDs to headings such as <h2> and </h3> ONLY
 * http://jeroensormani.com/automatically-add-ids-to-your-headings/
 */
function juliaraab_auto_id_headings( $content ) {
	$content = preg_replace_callback( '/(\<h[2-3](.*?))\>(.*)(<\/h[2-3]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$heading_link = '<a href="#' . sanitize_title( $matches[3] ) . '"></a>';
			$matches[0] = $matches[1] . $matches[2] . ' class="heading-auto-linked" id="' . sanitize_title( $matches[3] ) . '">' . $heading_link . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );
	return $content;
}
add_filter( 'the_content', 'juliaraab_auto_id_headings' );


