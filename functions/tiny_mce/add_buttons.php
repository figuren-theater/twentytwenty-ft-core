<?php


add_filter( 'mce_buttons', 'juliaraab_tinymce_button_eraser');
add_filter( 'mce_buttons_2', 'juliaraab_tinymce_button_eraser');
/**
 * Removes the all but the formatting button from the post editor.
 *
 * @since    2016.09.05
 *
 * @param    array    $buttons    The current array buttons including the kitchen sink.
 * @return   array                The updated array of buttons that exludes the kitchen sink.
 */
function juliaraab_tinymce_button_eraser( $buttons ) {

	$invalid_buttons = array(
			'underline',
			'alignleft',
			'aligncenter',
			'alignright',
			'alignjustify',
			'forecolor',
//			'|',
			'pastetext',
//			'pasteword',
//			'removeformat',
//			'charmap',
			'outdent',
			'indent',
			'hr',
//			'undo',
//			'redo',
//			'wp_help'
		);
#fb($buttons);


	foreach ( $buttons as $button_key => $button_value ) {
		if ( in_array( $button_value, $invalid_buttons ) ) {
			unset( $buttons[ $button_key ] );
		}
	}

	return $buttons;
}


// second Button row
add_filter( 'mce_buttons_2', 'juliaraab_mce_editor_buttons_2' );
function juliaraab_mce_editor_buttons_2( $buttons ) {

	array_splice( $buttons, 1, 0, 'styleselect' );

	// remove default formats dropdown with p, h1-h6 and pre
	$formatselect = array_search( 'formatselect', $buttons );
	if ( FALSE !== $formatselect ) {
		foreach ( $buttons as $key => $value ) {
			if ( 'formatselect' === $value )
				unset( $buttons[$key] );
		}
	}

	return $buttons;
}
