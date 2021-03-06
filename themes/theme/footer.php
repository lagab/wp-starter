<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-starter
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<?php get_template_part( 'template-parts/footer-widgets' ); ?>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'theme' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'theme' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'theme' ), 'theme', '<a href="http://ladislas-gabriel.fr">lagab</a>' );
					?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
