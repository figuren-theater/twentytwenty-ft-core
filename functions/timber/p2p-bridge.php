<?php
if ( ! class_exists( 'Timber' ) ) :
	return;
endif;


use Timber\Post;
use Timber\Timber;

class Connected_Posts extends Post {

	private $connected_posts;

	public function __construct( $pid = null ) {
		parent::__construct( $pid );
		
	}

	public function get_method_values() {
		$ret                  = parent::get_method_values();
		$ret['get_connected'] = $this->get_connected();
		$ret['get_related']   = $this->get_related();

		return $ret;
	}


	function get_connected_posts() {

		if ( ! $this->connected_posts ) {
			$args = array(
				'connected_type'  => $this->connection_info,
#				'connected_type'  => 'related-articles',
				'connected_items' => $this->ID,
				'nopaging'        => false,
			);

			$this->connected_posts = Timber::get_posts( $args );
		}

		return $this->connected_posts;

	}


	public function get_connected( $connection_class = null, $arguments = null ) {

		if ( ! class_exists( $connection_class ) ) {
			return null;
		}


		$arguments = $connection_class::get_arguments( $this->ID, (Array) $arguments );

		return Timber::get_posts( $arguments, Connected_Posts::class );


	}



}