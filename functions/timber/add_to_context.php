<?php

add_filter( 'timber_context', function( $context = array() ) {

	//
#	$context = array();

	// Post type
#	$context['post_type'] = get_post_type();

	// Prefix per language if Polylang is activated
	$_t_prefix  = ( function_exists('pll_current_language') ) ? pll_current_language().'_' : '';
	$context['_t_prefix'] = $_t_prefix;
	// Get un-cached stuff

	// Menu
	$context['menu'] = new stdClass();
	$context['menu']->main = new TimberMenu('main');
//	$context['menu']->utility = new TimberMenu('utility');

	// Prepare empty Array as holder for "In twig" 
	// modifications and content replacements
	$context['alternate'] = array();

	// use Timber shorthand for transients API
	// http://www.sitecrafting.com/blog/speed-up-your-wordpress-sites-with-fragment-caching-transients-api/#gist27333310
	$context_defaults_transient = TimberHelper::transient($_t_prefix.'context_defaults_transient',
		function(){

			// Media path
			$context['path_theme'] = get_template_directory_uri();
		#    $context['path_css'] = $context['path_theme'].'/web/css/';
		#    $context['path_fonts'] = $context['path_theme'].'/web/fonts/';
			$context['path_theme_assets'] = $context['path_theme'].'/assets';
		#    $context['path_js'] = $context['path_theme'].'/web/js/';

/*			// breadCrump
			if(function_exists('yoast_breadcrumb')){
				$context['breadcrumb'] = yoast_breadcrumb('<p>','</p>', false );
			}
			$context['display_breadcrumb'] = true;
*/


			// Theme
			$context['thememods'] = get_theme_mods();
			$context['app_name'] = 'app';

			// CSS class names to be set within templates, to reduce the need of (too many) separate php template-files
			$context['css']   = array();

			// cbstdsys-Options
			$context['cbstdsys_options'] = get_option('cbstdsys_options');


			// Subscribe 2 Anything widget tabs contents
			$context['subscribe']   = array();
			$context['subscribe'][] = array(
				'id' => 'rss',
				'title' => __('Subscribe via RSS','juliaraab'),
#				'content' => __('Almost antiquarian and yet not to get killed - the RSS-Feed.<ul><li><a href="'.get_feed_link().'"><span class="screen-reader-text">Feed to the posts of our </span>Blog</a></li><li><a href="'.get_feed_link('comments_rss2').'"><span class="screen-reader-text">Feed of </span>Comments</a></li></ul>','juliaraab'),
				'content' => 'Fast schon antiquarisch und doch nicht tot zu kriegen - der RSS-Feed.<ul><li><a href="'.get_feed_link().'"><span class="screen-reader-text">Feed der Beiträge im </span>Blog</a></li><li><a href="'.get_feed_link('comments_rss2').'"><span class="screen-reader-text">Feed der </span>Kommentare</a></li></ul>'
			);
			if( function_exists( 'mc4wp_get_form' ) ) {
			$context['subscribe'][] = array(
				'id' => 'mailchimp',
				'title' => __('Newsletter by Email','juliaraab'),
				'content' => '[mc4wp_form id="10021"]',
		#			'content' => '... nix .. leer.',
				'atts' => 'checked="checked"'
			);
			}
			$context['subscribe'][] = array(
				'id' => 'ical',
				'title' => __('Calendar Updates','juliaraab'),
				'content' => __('Abonnieren Sie meine Spieltermine in Ihren digitalen Kalender, mit meinem <ul><li><a href="'.eo_get_events_feed().'">iCal-Feed</a></li></ul>','juliaraab'),
			);
			$context['subscribe'][] = array(
				'id' => 'push',
				'title' => __('PUSH News','juliaraab'),
				'content' => __('... instantly on your mobile or as desktop-notifications.<br><br>Soon.','juliaraab'),
#				'atts' => 'disabled="disabled"'
			);



			return $context;
		},
		cbstdsys_prep_timber_cache_time( DAY_IN_SECONDS )
	);
	$context = array_merge($context,$context_defaults_transient);



	// Sidebar(s)
	// use Timber shorthand for transients API
	// http://www.sitecrafting.com/blog/speed-up-your-wordpress-sites-with-fragment-caching-transients-api/#gist27333310
	$widgets_transient = TimberHelper::transient($_t_prefix.'widgets_transient',
		function(){
			$context['sidebar_one']   = Timber::get_widgets('Sidebar one');
			$context['sidebar_two']   = Timber::get_widgets('Sidebar two');
			$context['sidebar_footer_local'] = Timber::get_widgets('Footer local');
			$context['sidebar_footer_logos'] = Timber::get_widgets('Footer logos');
			$context['sidebar_footer_global'] = Timber::get_widgets('Footer global');
			return $context;},
		cbstdsys_prep_timber_cache_time( DAY_IN_SECONDS )
	);
	$context = array_merge($context,$widgets_transient);


	// Quote posts for footer
	// use Timber shorthand for transients API
	// http://www.sitecrafting.com/blog/speed-up-your-wordpress-sites-with-fragment-caching-transients-api/#gist27333310
	$quotes_transient = TimberHelper::transient($_t_prefix.'quotes_transient',
		function(){
			$quotes_query_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => array( 'post-format-quote' ),
					),
				),
				'orderby' => 'rand',
				'posts_per_page' => -1,
			);
			return array(
			'quotes'=> Timber::get_posts( $quotes_query_args ),
		);},
		cbstdsys_prep_timber_cache_time( WEEK_IN_SECONDS )
	);
	$context = array_merge($context,$quotes_transient);



/* */
// TODO // DEBUG ONLY
// SWITCH ON/OFF WELCOME msg over here
#if (rand(0, 1)) {

	if ( 
		//
		! is_post_type_archive('event') 
		&&
		! is_singular('event')
	 ) {

		// HOT last post OR event for header-intro
		$hotpost_query_args = array();

		// Check for events first
#		if (rand(0, 1)) { // DEBUG ONLY
			$context['hotpost_events'] = TimberHelper::transient($_t_prefix.'hotpost_transient',
				function(){
					// .. http://docs.wp-event-organiser.com/querying-events/relative-date-formats/
					$hotpost_query_args = [
						'post_type'          => 'event', // must be set to bypass eo_get_events()-wrapper
						'suppress_filters'   => false, // must be set to bypass eo_get_events()-wrapper
						'event_end_after'    => 'now', 
						'event_start_before' => '+2 week', 
						'posts_per_page'     => -1,
					];
					return Timber::get_posts( $hotpost_query_args );},
				cbstdsys_prep_timber_cache_time( DAY_IN_SECONDS )
			);
		}
#} //  DEBUG ONLY

	#echo '<pre>'.var_export($context['hotpost']).'</pre>';


	// TODO // DEBUG ONLY
	// SWITCH ON/OFF WELCOME msg over here
#	if (rand(0, 1)) {
		// Otherwise look for sticky posts
		if ( 
			// if no events
#			empty( $context['hotpost'] )
#			||
			// no events
#			false === $context['hotpost']
#			||
			// not on blog archive pages
			! is_home()
			&&
			// not on homepage
			! is_front_page()

		) {

			$context['hotpost_sticky'] = TimberHelper::transient($_t_prefix.'sticky_posts_transient',
				function(){
					$stickies = get_option( 'sticky_posts' );
					// Make sure we have stickies to avoid unexpected output
					if ( $stickies ) {
						$hotpost_query_args = [
							'post_type'           => 'post',
							'post__in'            => $stickies,
							'posts_per_page'      => -1,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'rand'
						];
						return Timber::get_posts( $hotpost_query_args );
					}
				},
				cbstdsys_prep_timber_cache_time( DAY_IN_SECONDS )
			);


		}



		$context['hotpost'] = array();
		if ( isset($context['hotpost_events']) && is_array($context['hotpost_events']))
			$context['hotpost'] = array_merge($context['hotpost'],$context['hotpost_events']);

		if ( isset($context['hotpost_sticky']) && is_array($context['hotpost_sticky']))
			$context['hotpost'] = array_merge($context['hotpost'],$context['hotpost_sticky']);

		if (empty($context['hotpost']))
			unset($context['hotpost']);
/*
# DEBUG Output
wp_die(var_export(array( 
	'$hotpost_events count' 		=>	count($context['hotpost_events']),
	'$hotpost' 		=>	$context['hotpost']
)));*/

	// TODO // DEBUG ONLY
	// SWITCH ON/OFF WELCOME msg over here
#	} // if (rand(0, 1))



	if ( function_exists('pll_the_languages') ) {
		$context['pll'] = new stdClass;
		$context['pll']->switch = TimberHelper::transient($_t_prefix.'pll_the_languages_transient',
			function(){return pll_the_languages(array('raw'=>1));},
			cbstdsys_prep_timber_cache_time( WEEK_IN_SECONDS )
		);
	}




	return $context;
} );
