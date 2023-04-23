<?php
/**
 * Template Name: Blog
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage figuren-theater
 * @since 1.0
 */
/**
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

#	if ( ! is_home() ) {
#		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
#	}

	if ( $archive_title || $archive_subtitle ) {
		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	}

/**/
$page_for_posts_id 		= get_option('page_for_posts');
$page_for_posts_content = get_post_field( 'post_content', $page_for_posts_id );
if ( $page_for_posts_content ) : 

/** START :: copied from template-parts/content.php */
?>
<article <?php post_class('', $page_for_posts_id); ?> id="post-<?php esc_html_e( $page_for_posts_id ) ?>">

	<div class="post-inner thin">

		<div class="entry-content">

			<?php
			echo apply_filters( 'the_content', $page_for_posts_content );
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

		?>

	</div><!-- .section-inner -->

</article><!-- .post -->
<?php
/** END :: copied from template-parts/content.php */
endif;


	#DISABLED to prevent content from dripping, but this will not be enough ...

#	if ('local' === WP_ENVIRONMENT_TYPE) {
		
	

		if ( have_posts() ) {

			$i = 0;

			while ( have_posts() ) {
				$i++;
				if ( $i > 1 ) {
					echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
				}
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			}
		}

		?>

		<?php get_template_part( 'template-parts/pagination' ); ?>

<?php # } # DISABLED to prevent content from dripping, but this will not be enough ... ?>

</main><!-- #site-content -->

<?php
get_footer();
