<?php
if ( ! class_exists( 'Timber' ) ) :
	return;
endif;


use Timber\Post;
use Timber\Timber;

class Related_Productions extends Post {

	private $connected_posts;
/*
	public function __construct( $pid = null ) {
		global $wp_query;
		parent::__construct( $pid );
		p2p_type( 'related_productions' )->each_connected( &$GLOBALS['wp_query'], array(), 'Related_Productions' );
	}*/

	public function get_productions_or_events() {
		return p2p_type( 'related_productions' )->get_connected( $this->ID );
	}

}