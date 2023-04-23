<?php
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Components functions and definitions.
 * can be found in the functions folder
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package		WordPress
 * @subpackage	figuren-theater
 * @since		2016.08.09
 */

require_once('functions/autoload.php');



// add_action( 'wp_head', 'ft_enable_geo_2_twentytwenty_post_meta', 100 );
add_action( 'twentytwenty_end_of_post_meta_list', 'ft_add_geo_2_twentytwenty_post_meta', 10, 3 );

	function ft_enable_geo_2_twentytwenty_post_meta(){

		add_filter('twentytwenty_post_meta_location_single_bottom', function ($metas) {
			return array(
				'tags', // default
				'ft_geo', // NEW
			);
		} );


	}

	function ft_add_geo_2_twentytwenty_post_meta( $post_id, $post_meta, $location )
	{

		/**?>
		<script>
		    console.log(<?php echo json_encode(array( $post_id, $post_meta, $location )); ?>);
		</script>
		<?php*/


		if ('single-top' !== $location)
			return;

		// #var_export( $post_id, $post_meta, $location );


		// var_export($feature);


		// Tags.
		// if ( in_array( 'ft_geo', $post_meta, true ) && get_the_terms( $post_id, 'ft_geolocation' ) ) {
		// if ( get_the_terms( $post_id, 'ft_geolocation' ) ) {
		$_geo_terms = wp_get_post_terms( $post_id, 'ft_geolocation', array( 'orderby' => 'term_id' ) );
		if ( $_geo_terms && !empty( $_geo_terms ) )
		{
			// $has_meta = true;
			?>
			<li class="post-tags meta-wrapper">
				<span class="meta-icon">
					<span class="screen-reader-text"><?php _e( 'Location', 'twentytwenty' ); ?></span>
					<?php twentytwenty_the_theme_svg( 'arrow-down' ); ?>
				</span>
				<span class="meta-text">
					<?php echo implode(', ', ft_links_from_term_objs($_geo_terms)); ?>
				</span>
			</li>
			<?php

		}
	}
	function ft_links_from_term_objs($terms)
	{
		$links = [];

		foreach ( $terms as $term ) {
			$link = get_term_link( $term, 'ft_geolocation' );
			if ( is_wp_error( $link ) ) {
				return $link;
			}
			$links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
		}
		return $links;
	}