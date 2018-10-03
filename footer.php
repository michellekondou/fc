<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package felios
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'felios' ) ); ?>">
				<i class="icon logo-outlined" title="<?php bloginfo( 'name' ); ?>"></i>
			</a>
			<p>Copyright © 2018 Felios Collection. All right reserved. Designed by thinking.</p>
			<nav>
				<i class="icon facebook"></i>
				<i class="icon newsletter"></i>
				<svg class="icon svg-arrow_right">
                    <use xlink:href="#svg-arrow_right" />
                </svg>
			</nav>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
