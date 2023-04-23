<?php 
/*******************************************************************************
 *
 *  Filters used or introduced by cbstdsys' mu-plugins
 *
 *******************************************************************************/
# List of developer user IDs, user with access all areas
#add_filter( 'cbstdsys_dev_users', create_function('$a', "return array(1);"));

# Choose language files for /WP-Admin, use 'cbstdsys-mu' or 'cbstdsys-mu-SIE'
#add_filter( 'cbstdsys_language_files', create_function('$a', "return 'cbstdsys-mu-SIE';") );

# Use Pages with comments 
add_filter( 'cbstdsys_use_pages_with_comments', '__return_true' );

# Use Blog
add_filter( 'cbstdsys_use_with_blog', '__return_true' );

# Use "Category" - taxonomy
add_filter( 'cbstdsys_use_with_categories', '__return_true' );
#add_filter( 'cbstdsys_use_with_categories', '__return_false' );

# Use "Tags" - taxonomy
add_filter( 'cbstdsys_use_with_tags', '__return_true' );

# Exclude Templates from Attributes dropdown of pages-post-type
#add_filter( 'cbstdsys_page_templates_to_exclude_from_dropdown', create_function('$a', "return array();") );

# Add default arguments to Youtube API calls, defaults to " ... array( 'feature=oembed','wmode=opaque' ) ... "
add_filter( 'cbstdsys_youtube_embed_api_args', create_function('$a', "return implode( '&amp;', array('showinfo=0','rel=0'));"));

# Use modified version of default search or switch of all related components
# Use "default", "modified" or "disabled" 
add_filter( 'cbstdsys_type_of_search', create_function('$a', "return 'default';") );

# Rename "Posts" to "Blog" for better editorial logic
add_filter( 'cbstdsys_rename_posts_menu_to', create_function('$a', "return 'Blog';") );

add_action('init', function() {
	remove_filter ( 'the_title',    'cbstdsys_fancy_amp' );
	remove_filter ( 'widget_title', 'cbstdsys_fancy_amp' );
}, 10 );