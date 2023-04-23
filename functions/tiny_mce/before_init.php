<?php

/**
 * Add styles/classes to the "Styles" drop-down
 *
 * Icons available: https://github.com/tinymce/tinymce/blob/master/js/tinymce/skins/lightgray/Icons.less#L51
 *
 */


#add_filter('before_init', function( $settings ) {
add_filter('tiny_mce_before_init', function( $settings ) {


	$new_formats = array(
/*
		array(
			'title' => __('Layout', 'juliaraab'),
				'items' => array(
					array(
							'title'    => '50% width (centred)',
							'selector' => '*',
							'classes'  => 'width-50-percent',
							'wrapper'  => true
					),
					array(
						'title' => __('Boxed','juliaraab'),
						'block' => 'div',
						'classes' => 'boxed',
						'wrapper' => true
					),
			)
		),*/
		array(
			'title' => __('Headings', 'juliaraab'),
				'items' => array(
/*                  array(
						'title' => __('Heading 1','juliaraab'),
						'format' => 'h1',
					),*/
					array(
						'title' => __('Heading 2','juliaraab'),
						'format' => 'h2',
					),
					array(
						'title' => __('Heading 3','juliaraab'),
						'format' => 'h3',
					),
					array(
						'title' => __('Heading 4','juliaraab'),
						'format' => 'h4',
					),
					array(
						'title' => __('Heading 5','juliaraab'),
						'format' => 'h5',
					),
					array(
						'title' => __('Heading 6','juliaraab'),
						'format' => 'h6',
					),
			)
		),


		array(
			'title' => __('Blocks', 'juliaraab'),
				'items' => array(
					array(
						'title' => __('Paragraph','juliaraab'),
						'format' => 'p',
					),
					array(
						'title' => __('Preformatted','juliaraab'),
						'format' => 'pre',
						'icon'  => 'code',
					),
			)
		),

		array(
			'title' => __('Highlights', 'juliaraab'),
			'items' => array(
				array(
					'title'   => __('Mark','juliaraab'),
					'inline'  => 'mark',
				),
				array(
					'title'   => __('Success','juliaraab'),
					'inline'  => 'span',
					'classes' => 'alert-success',
				),
				array(
					'title'   => __('Info','juliaraab'),
					'inline'  => 'span',
					'classes' => 'alert-info',
				),
				array(
					'title'   => __('Warn','juliaraab'),
					'inline'  => 'span',
					'classes' => 'alert-warning',
				),
				array(
					'title'   => __('Important','juliaraab'),
					'inline'  => 'span',
					'classes' => 'alert-important',
				),
				array(
					'title'   => __('Reduced','juliaraab'),
					'inline'  => 'span',
					'classes' => 'alert-dimmed',
				),
			)
		),

		array(
			'title' => __('Links', 'juliaraab'),
			'items' => array(
/*				array(
					'title'    => __('Read more','juliaraab'),
					'selector' => 'a',
					'classes'  => 'read-more',
					'icon'     => 'anchor',
				),*/
				array(
					'title'    => __('Button','juliaraab'),
					'selector' => 'a',
					'classes'  => 'button',
					'icon'     => 'anchor',
				),
/*				array(
					'title'    => __('Lightbox Preview','juliaraab'),
					'selector' => 'a',
					'classes'  => 'button',
					'icon'     => 'anchor',
					'attributes' => array(
						'data-featherlight' => 'iframe',
					),
				),*/
			)
		),

		array(
			'title'   => 'Alignment',
			'items' => array(
				array(
					'title'   => __('Left','juliaraab'),
					'block'   => 'p',
					'classes' => 'alignleft',
					'icon'    => 'alignleft',
				),
				array(
					'title'   => __('Center','juliaraab'),
					'block'   => 'p',
					'classes' => 'aligncenter',
					'icon'    => 'aligncenter',
				),
				array(
					'title'   => __('Right','juliaraab'),
					'block'   => 'p',
					'classes' => 'alignright',
					'icon'    => 'alignright',
				),
				array(
					'title'   => __('Justify','juliaraab'),
					'block'   => 'p',
					'classes' => 'alignjustify',
					'icon'    => 'alignjustify',
				),
			),
		),
/*
		array(
			'title'   => 'Inline',
			'items' => array(
/*
				array(
					'title'   => __('Bold','juliaraab'),
					'format'  => 'bold',
					'icon'    => 'bold',
				),
				array(
					'title'   => __('Italic','juliaraab'),
					'format'  => 'italic',
					'icon'    => 'italic',
				),
				array(
					'title'   => __('Underline','juliaraab'),
					'format'  => 'underline',
					'icon'    => 'underline',
				),
				array(
					'title'   => __('Strikethrough','juliaraab'),
					'format'  => 'strikethrough',
					'icon'    => 'strikethrough',
				),
				array(
					'title'   => __('Superscript','juliaraab'),
					'format'  => 'superscript',
					'icon'    => 'superscript',
				),
				array(
					'title'   => __('Subscript','juliaraab'),
					'format'  => 'subscript',
					'icon'    => 'subscript',
				),
* /
				array(
					'title'   => __('Vars','juliaraab'),
					'format'  => 'var',
					'icon'    => 'code',
				),
			),
		),
*/
	);


	/**
	* The proper way to add style drop down (and play nice with other plugin) 
	* is to check if “style_formats” is enabled and merge it
	*/

	/* Check if custom "style_formats" is enabled */
	if( isset( $settings['style_formats'] ) ){

		/* Get old style_format config */
		$old_formats = json_decode( $settings['style_formats'] );

		/* Merge it with our own */
		$new_formats = array_merge( $new_formats, $old_formats );
	}
	$settings['style_formats'] = json_encode( $new_formats );
	
	// Note: The default styles can be added to the formats dropdown by adding 
	// $settings['style_formats_merge'] = true; into »fb_mce_before_init()«.
	// $settings['style_formats_merge'] = true;




	// unset the preview styles
	// Apply editor-styles.css to the formats-dropdown, 
	// so all our styles will look, like they should
	unset($settings['preview_styles']);


	return $settings;
} );
