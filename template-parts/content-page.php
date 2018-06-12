<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */
if ( get_post_type() == 'events' || get_post_type() == 'exhibitions'  ) {
	//event fields
	$event_date = get_field('event_date');
	$event_hour_start = get_field('event_hour_start');
	$event_hour_end = get_field('event_hour_end');
	$exhibition_date_start = get_field('exhibition_date_start');
	$exhibition_date_end = get_field('exhibition_date_end');
	//fields per language
	if(ICL_LANGUAGE_CODE == 'en') {
		//custom fields
		$event_venue_name = get_field('venue_name');
	} else {
		//custom fields
		$event_venue_name = get_field('venue_name_el');
	}

	//taxonomies
	$taxonomy_field = 'name';
	$taxonomy_list = get_post_taxonomies();
	$taxonomy_output = [];

	foreach ( $taxonomy_list as $term_obj ) {
		//get the terms
		$terms = get_the_terms( get_the_ID(), $term_obj ); 
		$term_label = $terms[0]->taxonomy;
		if ( $terms && ! is_wp_error( $terms ) ) {
			$term_name = array();
			foreach ( $terms as $term ) {
				$term_name[] = $term->$taxonomy_field;
			}
						
			$the_terms = join( ", ", $term_name );
			$term_list = $the_terms;
			array_push($taxonomy_output, $term_list);
		}
	}
}
?>
<?php if ( is_archive() ) : ?>
	<?php if ( get_post_type() == 'artists' ) : ?>
		<h3 class="artist-name">
			<a href="<?php the_permalink()?>"><?php the_title(); ?></a>
		</h3>
	<?php elseif ( get_post_type() == 'collection' ) : ?>
		
		<figure id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			<?php felios_post_thumbnail(); ?>
			<figcaption>			
				<a href="<?php the_permalink()?>"><?php the_title(); ?></a>
			</figcaption>
		</figure>

	<?php elseif ( get_post_type() == 'events' ) : ?>

		<article id="post-<?php the_ID(); ?>" class="vertical-grid">
			<a href="<?php the_permalink()?>" class="post-thumbnail"><?php the_post_thumbnail($size = 'thumbnail'); ?></a>
			<div class="post-excerpt">
				<h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
				<p class="details">
					<span class="taxonomy"><?php 
						foreach($taxonomy_output as $result) {
							echo $result . ' |';
						} 
					?>
					</span>
					<span class="date"><?php echo $event_date; ?></span>
            	</p>
				<?php 
					if(ICL_LANGUAGE_CODE == 'en') :
						$excerpt = wp_trim_words( get_field('description_en' ), $num_words = 40, $more = '...' ); 
					else :
						$excerpt = wp_trim_words( get_field('description_el' ), $num_words = 40, $more = '...' );
					endif; 
				?>
				<p><?php echo $excerpt ?></p>

			</div>

		</article>

	<?php elseif ( get_post_type() == 'exhibitions' ) : ?>

		<article id="post-<?php the_ID(); ?>" class="vertical-grid">
        	<a href="<?php the_permalink()?>" class="post-thumbnail"><?php the_post_thumbnail($size = 'thumbnail'); ?></a>
			<div class="post-excerpt">
				<h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
				<p class="details">
					<span class="taxonomy"><?php 
						foreach($taxonomy_output as $result) {
							echo $result . ' |';
						} 
					?>
					</span>
					<span class="date"><?php echo $exhibition_date_start . ' - ' . $exhibition_date_end; ?></span>
            	</p>
				<?php 
					if(ICL_LANGUAGE_CODE == 'en') :
						$excerpt = wp_trim_words( get_field('description_en' ), $num_words = 40, $more = '...' ); 
					else :
						$excerpt = wp_trim_words( get_field('description_el' ), $num_words = 40, $more = '...' );
					endif; 
				?>
				<p><?php echo $excerpt ?></p>

			</div>		
		</article>

	<?php endif; ?>
<?php elseif ( ! is_home() && ! is_front_page() ) :
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
		// ?>
		
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>
