<?php


/**
 * Register Sidebars with widgetized areas
 *
 * @since   2016.09.05
 * @source	Twenty Ten 1.0
 * @uses 	register_sidebar
 */
function juliaraab_sidebars_init() {

	$parent_less_sidebars =array(
		array(__( 'Sidebar one', 'juliaraab' ),'sidebar-one-widget-area', __( 'This sidebar is shown on singular views only. And very prominent before all content/post related stuff comes.', 'juliaraab' ), 2 ),
		array(__( 'Sidebar two', 'juliaraab' ),'sidebar-two-widget-area', __( 'The sidebar widget area', 'juliaraab' ), 2 ),
	);
	foreach ($parent_less_sidebars as $sidebar) {
		register_sidebar(array(
			'name'=> $sidebar[0],
			'id'  => $sidebar[1],
			'description' => $sidebar[2],
			'before_widget' => '<article id="%1$s" class="widget %2$s widget-sidebar-'.$sidebar[3].'"><div class="container">',
			'after_widget' => '</div></article>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}


	$real_sidebars = array(
		array(__( 'Footer local', 'juliaraab' ),'footer-local-widget-area', __( 'The footer widget area', 'juliaraab' )),
		array(__( 'Footer logos', 'juliaraab' ),'footer-logos-widget-area', __( 'The footer widget area', 'juliaraab' )),
		array(__( 'Footer global', 'juliaraab' ),'footer-global-widget-area', __( 'The footer widget area', 'juliaraab' ))
	);
	foreach ($real_sidebars as $sidebar) {
		register_sidebar(array(
			'name'=> $sidebar[0],
			'id'  => $sidebar[1],
			'description' => $sidebar[2],
			'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container">',
			'after_widget' => '</div></article>',
			'before_title' => '<h5>',
			'after_title' => '</h5>'
		));
	}

}
add_action( 'widgets_init', 'juliaraab_sidebars_init' );