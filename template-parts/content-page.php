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
  
if ( has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ));
	$image_s = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail');
	$image_m = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
	$image_l = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
	$thumb_id = get_post_thumbnail_id();
} 

//language variables
if(ICL_LANGUAGE_CODE == 'en') {
    //custom fields
	$artist = get_field('artist');
	
} else {
    //custom fields
    $artist = get_field('artist_el');
}

$dimensions = get_field('dimensions'); 
if($dimensions) {
	$d_float = str_replace(",",".",$dimensions);
	$d_float = mb_convert_case($dimensions, MB_CASE_LOWER, "UTF-8");//convert X to x
	$d_arr = preg_split( "/(x|χ)/", $d_float);//split dimensions array on either el or en x
	//var_dump($d_arr);
	if(count($d_arr) > 1) {
		if($d_arr[1]) {
			$work_width = floatval($d_arr[1]);
		} else {
			$work_width = null;
		}
		if($d_arr[0]) {
			$work_height = floatval($d_arr[0]);
		} else {
			$work_height = null;
		}
	} 
}

?>
<?php if ( is_archive() ) : ?>
	<?php if ( get_post_type() == 'artists' ) : ?>
		<?php
			// Check the current letter is the same that the first of the title
			$artist_extra = isset($a_arr[2]) ? ' ' . $a_arr[2] : '';
			if($alpha_letter != $letter_)
			{
				echo ($alpha_letter != '') ? '' : '';
				$alpha_letter = $letter_;
				echo '<h4>'.$letter_.'</h4>';  
			}
			echo '<h3 class="artist-name"><a href="'.get_permalink().'">'. $artist_first_name . $artist_extra . '  ' . $artist_last_name . '</a></h3>';
		?>	
	<?php endif; ?>
	<?php if ( get_post_type() == 'collection' ) : ?>
		<figure id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
			<a 
				class="post-thumbnail<?php 
				if($dimensions) {
					if(isset($work_height) && isset($work_width)) {
						if( $work_width > $work_height ) {
							echo ' landscape';
							if( $work_width >= 150 ) {
								echo ' large';
							} else if ( $work_width <= 30 ) {
								echo ' small';
							} else {
								echo ' medium';
							}
						} else if($work_width === $work_height){
							echo ' square';
							if( $work_height >= 150 || $work_width >= 150 ) {
								echo ' large';
							} else if ( $work_height <= 30 ||  $work_width <= 30 ) {
								echo ' small';
							} else {
								echo ' medium';
							}
						} else{
							echo ' portrait';
							if( $work_height >= 150 ) {
								echo ' large';
							} else if ( $work_height <= 30 ) {
								echo ' small';
							} else {
								echo ' medium';
							}
						} 
				} } ?>" href="<?php the_permalink(); ?>">
				<img 
					data-mobile-height="<?php echo $image_l[2]; ?>"
					data-srcset="<?php echo $image_l[0]; ?> 600w, <?php echo $image_m[0]; ?> 400w"
					data-ie="<?php echo $image_l[0]; ?>"
					data-sizes="(max-width: 767px) and (min-width: 490px) 600px, 400px"
					src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
					class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
					alt="<?php the_title(); ?>">
				<noscript>
					<img 
						data-srcset="<?php echo $image_l[0]; ?> 400w"
						sizes="400px"
						src="<?php echo $image_l[0]; ?>"
						class="attachment-post-thumbnail size-post-thumbnail wp-post-image no-js-thumb">
				</noscript>
				
			</a>
			<?php endif; ?>
			<figcaption>			
				<p class="work-caption__artist">
				<?php if( $artist ): ?>
					<?php foreach( $artist as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); 
					$artist_name = get_the_title();
					$a_arr = explode(" ",$artist_name);
					$artist_first_name = isset($a_arr[1]) ? $a_arr[1] : '';
					$artist_last_name = isset($a_arr[0]) ? $a_arr[0] : '';
					?>
						<a href="<?php the_permalink(); ?>" class="artist-name"><?php echo $artist_first_name . '  ' . $artist_last_name;  ?></a>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
				</p>
				<p class="work-caption__title">
					<a href="<?php the_permalink()?>"><?php the_title(); ?></a>
				</p>
				<p class="work-caption__date"><?php the_field('year'); ?></p>
				<p class="work-caption__dimensions">
				<?php 
					$dimensions = get_field('dimensions'); 
					if($dimensions) {
						echo $dimensions;
						if(isset($work_height) && isset($work_width)) {
							if( $work_width > $work_height ) {
								echo ' landscape';
								if( $work_width >= 150 ) {
									echo ' large';
								} else if ( $work_width <= 30 ) {
									echo ' small';
								} else {
									echo ' medium';
								}
							} else if($work_width === $work_height){
								echo ' square';
								if( $work_height >= 150 || $work_width >= 150 ) {
									echo ' large';
								} else if ( $work_height <= 30 ||  $work_width <= 30 ) {
									echo ' small';
								} else {
									echo ' medium';
								}
							} else{
								echo ' portrait';
								if( $work_height >= 150 ) {
									echo ' large';
								} else if ( $work_height <= 30 ) {
									echo ' small';
								} else {
									echo ' medium';
								}
							} 
						}
					}
				?>
				</p>
			</figcaption>
		</figure>

	<?php elseif ( get_post_type() == 'events' ) : ?>

		<article id="post-<?php the_ID(); ?>" class="vertical-grid">
			<a href="<?php the_permalink()?>" class="post-thumbnail"><?php the_post_thumbnail($size = 'medium'); ?></a>
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
        	<a href="<?php the_permalink()?>" class="post-thumbnail"><?php the_post_thumbnail($size = 'medium'); ?></a>
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

