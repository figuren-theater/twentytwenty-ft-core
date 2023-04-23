<?php
/**
 * Template Name: f.t GEO /in/
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

// ugly hack to make LocateAndFilter maps filterable
global $ft_geo_in;
#$ft_geo_in = true;

#setup_postdata( get_post( 390 ) );
get_header();
?>

<main id="site-content" role="main" style="margin-bottom:-200px">

	<?php echo do_shortcode( ' [LocateAndFilter_map map_id=389]' ); ?>
	<?php #echo do_shortcode( ' [LocateAndFilter_navlist map_id=389]' ); ?>

	<?php
/*
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}
*/
	?>

</main><!-- #site-content -->

<?php #get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>


<?php #rewind_posts(); ?>