<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */

?>
<?php if ( is_archive() ) : ?>
	<?php if ( get_post_type() == 'artists' ) : ?>

		<p>
			<a href="<?php the_permalink()?>"><?php the_title(); ?></a>
		</p>

	<?php elseif ( get_post_type() == 'collection' ) : ?>
		
		<figure id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			<?php felios_post_thumbnail(); ?>
			<figcaption>			
				<a href="<?php the_permalink()?>"><?php the_title(); ?></a>
			</figcaption>
		</figure>

	<?php elseif ( get_post_type() == 'events' ) : ?>

		<article id="post-<?php the_ID(); ?>" class="vertical-grid">
        	<a href="<?php the_permalink()?>"><?php the_post_thumbnail($size = 'thumbnail'); ?></a>
			<h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
		</article>

	<?php elseif ( get_post_type() == 'exhibitions' ) : ?>

		<article id="post-<?php the_ID(); ?>" class="vertical-grid">
        	<a href="<?php the_permalink()?>"><?php the_post_thumbnail($size = 'thumbnail'); ?></a>
			<h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
		</article>

	<?php endif; ?>
<?php else : ?>
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

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'felios' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>
