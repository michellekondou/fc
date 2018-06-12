<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */
$news_gallery = get_field('gallery');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>
	</header><!-- .entry-header -->

	<?php felios_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		// wp_link_pages( array(
		// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'felios' ),
		// 	'after'  => '</div>',
		// ) );
		?>
		
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
