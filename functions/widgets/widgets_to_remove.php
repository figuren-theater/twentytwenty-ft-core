<?php
# Widgets to remove
function filter_cbstdsys_remove_unused_widgets ( ) {


	unregister_widget('WP_Widget_Recent_Comments');
#	unregister_widget('PLL_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Calendar');
#	unregister_widget('PLL_Widget_Calendar');
	unregister_widget('WP_Widget_Recent_Posts');
#	unregister_widget('PLL_Widget_Recent_Posts');

#	unregister_widget('EO_Events_Agenda_Widget');
#	unregister_widget('EO_Calendar_Widget');
#	unregister_widget('EO_Widget_Categories');
#	unregister_widget('EO_Widget_Venues');

#	unregister_widget('ShariffWidget');
#	unregister_widget('WYLWidget');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('GADWP_Frontend_Widget');


#	unregister_widget('PLL_Widget_Languages');

#	unregister_widget( 'EO_Events_Agenda_Widget' ); // Event Organiser Agenda, Events grouped by date  
#	unregister_widget( 'p2p' ); 

}
#add_action( 'widgets_init', 'filter_cbstdsys_remove_unused_widgets' );

#			'WP_Widget_RSS',

// must be outside of 'widgets_init' to work properly ;)
/*add_filter( 
	'cbstdsys_widgets_to_remove', 
	create_function('$a', 
		"return array(
			'WP_Widget_Recent_Comments',
			'WP_Widget_Calendar',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Search',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Nav_Menu_Widget',
			'WP_Widget_Archives',
			'WP_Widget_Pages',
			'WP_Widget_Categories' );"
	)
);*/
