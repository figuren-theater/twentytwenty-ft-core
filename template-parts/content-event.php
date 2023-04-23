<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	if ( ! is_search() ) {
#		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {


	# if is a one-timer and LIVE
	# or on-demand 
	if ( has_term( 'live', 'event-category' ) ) {
		$stream_type = 'live';
		$stream_headline = __('Livestream ab', 'figuren-theater');
		$stream_button = __('Livestream ansehen', 'figuren-theater');

	} elseif ( has_term( 'on-demand', 'event-category' ) ) {
		$stream_type = 'on-demand';
		$stream_headline = __('Abruf verfügbar', 'figuren-theater');
		$stream_button = __('Stream ansehen', 'figuren-theater');

	}


	// future only
	$s_date  = eo_get_next_occurrence_of($post->ID);
	if (!$s_date) {
		// already started
		$s_date  = eo_get_current_occurrence_of($post->ID);
	}

	// HOT FIX to prevent php fatal errors on past stream-events
	if (false !== $s_date) {
		$s_date_start  = $s_date['start']->format( 'c' );
		$s_date_end    = $s_date['end']->format( 'c' );

		$stream_date      = wp_date( get_option( 'date_format' ), strtotime( $s_date_start ) );
		$stream_date .= ' '.wp_date( get_option( 'time_format' ), strtotime( $s_date_start ) );

		if ('on-demand' == $stream_type) {
			$stream_date .= "<br>";
			$stream_date .= 'bis '.wp_date( get_option( 'date_format' ), strtotime( $s_date_end ) );
			$stream_date .= ' ' . wp_date( get_option( 'time_format' ), strtotime( $s_date_end ) );
		}
	} else {
		$stream_headline = __('Nicht mehr verfügbar', 'figuren-theater');
	}


	$stream_author = $post->_ft_streams_author;
	$stream_name = $stream_author['name'];

	$stream_url = $post->ft_streams_url;


	$stream_social_links = array();
	$stream_name_links = get_post_meta( $post->ID, 'ft_streams_urls', true );;

	//
	if ($stream_name_links) {
		foreach ($stream_name_links as $stream_social_link) {

			$svg = TwentyTwenty_SVG_Icons::get_social_link_svg( $stream_social_link );
			if ( empty( $svg ) ) {
				$svg = twentytwenty_get_theme_svg( 'link' );
			}
			$stream_social_links[] = '<li><a href="'.$stream_social_link.'">'.$svg.'</a></li>';

		}
	}

     //Inside the loop
     $stream_google_link = esc_url(ft_streams_get_add_to_google_link());

     if (has_post_thumbnail()) {
     	$stream_block_cover_class = join(' ',array('has-accent-background-color','has-parallax'));
     	$stream_block_cover_style = 'style="background-image:url('.get_the_post_thumbnail_url( $post, 'full').')"';
     } else {
     	$stream_block_cover_class = join(' ',array('has-background-background-color'));
     	$stream_block_cover_style = '';
     }

?>
<?php if (has_post_thumbnail()) : ?>
<!-- wp:cover {"overlayColor":"background","align":"full"} -->
<div class="wp-block-cover alignfull has-background-dim <?php echo $stream_block_cover_class ?>" <?php echo $stream_block_cover_style ?>>
<div class="wp-block-cover__inner-container">

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"backgroundColor":"background"} -->
<div class="wp-block-group has-background-background-color has-background"><div class="wp-block-group__inner-container"><!-- wp:heading -->
<?php endif; ?>


						<!-- wp:heading -->
						<h2><?php echo $stream_headline ?></h2>
						<!-- /wp:heading -->

<?php // HOT FIX to prevent php fatal errors on past stream-events ?>
<?php if ( $s_date ) : ?>
						<!-- wp:paragraph -->
						<p class="has-text-align-right has-larger-font-size"><?php echo $stream_date ?></p>
						<!-- /wp:paragraph -->
<?php // HOT FIX to prevent php fatal errors on past stream-events ?>
<?php endif; ?>

						<!-- wp:heading {"level":3} -->
						<h3>angeboten von</h3>
						<!-- /wp:heading -->

						<!-- wp:paragraph -->
						<p class="has-text-align-right has-larger-font-size"><?php echo $stream_name ?></p>
						<!-- /wp:paragraph -->


						<nav aria-label="Social-Media-Links" class="has-text-align-right has-larger-font-size">

							<ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">
							<?php echo join('',$stream_social_links); ?>
							</ul><!-- .footer-social -->

						</nav>

<?php if (has_post_thumbnail()) : ?>

</div></div>
<!-- /wp:group -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

</div></div>
<!-- /wp:cover -->

<?php endif; ?>


<?php // HOT FIX to prevent php fatal errors on past stream-events ?>
<?php if ( $s_date ) : ?>

<!-- wp:buttons {"className":"has-text-align-right"} -->
<div class="wp-block-buttons alignwide aligncenter">
	<!-- wp:button -->
	<div class="wp-block-button is-style-outline">
		<a class="wp-block-button__link" href="<?php echo $stream_google_link ?>">in Google Kalender speichern</a>
	</div>
	<!-- /wp:button -->
	<!-- wp:button -->
	<div class="wp-block-button">
		<a class="wp-block-button__link" href="<?php echo $stream_url ?>"><?php echo $stream_button; ?></a>
	</div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<?php // HOT FIX to prevent php fatal errors on past stream-events ?>
<?php endif; ?>


<?php

				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

<?php 

# iCal ABO

# get this from here
# https://www.figuren.test/wp-admin/edit.php?post_type=wp_block
# use with figuren.test
#reblex_display_block(232);
# use with figuren.theater
reblex_display_block(216);

 ?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
#		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

#		if ( is_single() ) {

#			get_template_part( 'template-parts/entry-author-bio' );

#		}
		?>

	</div><!-- .section-inner -->

	<?php
/*
	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}*/

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
