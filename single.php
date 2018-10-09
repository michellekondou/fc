<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package felios
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$artist = get_field('artist');
			$artwork_id = $post->ID;
			get_template_part( 'template-parts/content', get_post_type() );

			//the_post_navigation();
			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php if( $artist ): ?>
			<?php foreach( $artist as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
				<?php 

					/*
					*  Query posts for a relationship value.
					*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
					*/

					$collection = get_posts(array(
						'post_type' => 'collection', 
						'posts_per_page' => -1, 
						'meta_query' => array(
							array(
								'key' => 'artist', // name of custom field
								'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
								'compare' => 'LIKE',

							)
						)
					));
					$arr = [];
					?>
					<?php if( $collection ): ?>

					<?php foreach( $collection as $item ): ?>
						<?php 
							$id = $item->ID;
							array_push($arr, $id); 
						?>
					<?php endforeach; ?>
					
						<?php 
							$args = array(
								'post_type' => 'collection',
								'orderby' => 'date',
								'post__in' => $arr,
								'no_found_rows'     => true,
								'suppress_filters'  => true,
							);

							$q = new WP_Query( $args );
							
							foreach($q->posts as $key => $value) {
								
								if($value->ID == $artwork_id){
									if(!empty($q->posts[$key - 1]->ID)) {
										$nextID = $q->posts[$key - 1]->ID;
									} else {
										$nextID = null;
									}
									if(!empty($q->posts[$key + 1]->ID)) {
										$prevID = $q->posts[$key + 1]->ID;
									} else {
										$prevID = null;
									}
									
									break;
								}
							} 
						?>
						<div class="post-navigation">
							<?php if(!empty($prevID)) : ?>
								<span class="nav-previous">
									<a href="<?= get_the_permalink($prevID) ?>" rel="prev">
										<i class="icon arrow_right"></i>
									</a>
								</span>
							<?php endif; ?>
							<?php if(!empty($nextID)) : ?>
								<span class="nav-next">
									<a href="<?= get_the_permalink($nextID) ?>" rel="next">
										<i class="icon arrow_left"></i>
									</a>
								</span>
							<?php endif; ?>
						</div>		
				<?php endif; ?>
			<?php endforeach; ?>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
