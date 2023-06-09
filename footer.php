<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<?php if( is_active_sidebar( 'utility' ) ) { ?>
	<div id="utility" class="sidebar">
	<?php dynamic_sidebar( 'utility' ); ?>
	</div> 
<?php } ?>



<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							<?php if ( \Figuren_Theater\is_ft_core_site('mein') ) { bloginfo( 'name' ); } else { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							<?php } ?>
						</p><!-- .footer-copyright -->

						<p class="powered-by-wordpress">
							<?php $pbl = sprintf(
								__('made with %1$s and %2$s in Halle (Saale) by %3$s'),
								'<a href="'.esc_url( __( 'https://wordpress.org/', 'twentytwenty' ) ).'">WordPress</a>',
								'<a href="'.esc_url( __( 'https://soundcloud.com/fromhallewithlove', 'twentytwenty' ) ).'">❤️</a>',
								'<a href="'.esc_url( __( 'https://meta.figuren.theater/crew/', 'twentytwenty' ) ).'">lovely people</a>'
							) ?>
							<?php echo ( \Figuren_Theater\is_ft_core_site('mein') ) ? strip_tags($pbl) : $pbl; ?>
						</p><!-- .powered-by-wordpress -->

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
