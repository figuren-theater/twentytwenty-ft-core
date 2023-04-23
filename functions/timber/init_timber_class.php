<?php


Timber::$dirname = array('components');

class AtomicTimberSite extends TimberSite {

	function __construct() {

#		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		parent::__construct();
	}


	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
#		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new AtomicTimberSite();


add_filter('timber_post_get_meta', function($customs, $pid, $this){
	
	$_post_type = get_post_type( $pid );

	// get attachment post_meta used @ the download-widget
	if ( 'attachment' === $_post_type) {
		$customs['meta'] = wp_prepare_attachment_for_js( $pid );



	// get venue data used per event
	} elseif ( 'event' === $_post_type ) {

		// "Event Organiser" Plugin active?
		if ( ! function_exists( 'eo_get_venue' ) )
			return $customs;

		// Is there any location added ?
		if ( ! (int) $_venue_id = eo_get_venue( $pid ) )
			return $customs;

		// setup return 
		$customs['venue'] = array();
		$customs['venue']['id'] = $_venue_id;

		// venue term meta, we want to get
		$_venue_meta = array('address','name','link');

		foreach ($_venue_meta as $key) {
			// call Plugin specific fns to get "special" eo_term_meta
			$_temp = call_user_func( 'eo_get_venue_'.$key, $_venue_id );
			// Anything ?, OK!
			if ( ! empty($_temp) )
				$customs['venue'][$key] = $_temp;
		}

		// also grab the "CMB2 appended" term_image
		// that is normally part of the "PRO" Version
		//
		// call WP default fn to get "standard" term_meta
		$_temp = get_term_meta( $_venue_id, 'client_logo_id', true );
		// Anything ?, OK!
		if ( ! empty($_temp) )
			$customs['venue']['image'] = $_temp;

/*
		// Add to google Calendar Link, using the (event) post->ID
		$_temp = eo_get_add_to_google_link( $pid );
		// Anything ?, OK!
		if ( ! empty($_temp) ) {
			$customs['add_2_google'] = array();
			$customs['add_2_google']['link'] = $_temp;
			$customs['add_2_google']['text'] = sprintf(
				__('Add to Google %s','juliaraab'),
				sprintf(
					'<span class="screen-reader-text">%s</span>',
					_x('Calendar','Add to Google ... %s','juliaraab')
				)
			);
		}
*/
	}
	return $customs;
}, 10, 3 );

