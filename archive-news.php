<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */
	// //event fields
	// $event_date = get_field('event_date');
	// $event_hour_start = get_field('event_hour_start');
	// $event_hour_end = get_field('event_hour_end');
	// $exhibition_date_start = get_field('exhibition_date_start');
	// $exhibition_date_end = get_field('exhibition_date_end');
	// //fields per language
	// if(ICL_LANGUAGE_CODE == 'en') {
	// 	//custom fields
	// 	$event_venue_name = get_field('venue_name');
	// } else {
	// 	//custom fields
	// 	$event_venue_name = get_field('venue_name_el');
	// }

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


get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				//the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php // the query
				$wp_all_query = new WP_Query(array(
					'post_type'=>'post', 
					'post_status'=>'publish', 
                    'posts_per_page'=> 15,
                    'paged' => get_query_var( 'paged' )
                ));
                ?>
                
				<?php if ( $wp_all_query->have_posts() ) : ?>
                <?php while ( $wp_all_query->have_posts() ) : $wp_all_query->the_post(); 
                    $categories = get_the_category();
                    $category_names = array();

                ?>
                <article id="post-<?php the_ID(); ?>" class="vertical-grid">
                    <a href="<?php the_permalink()?>" class="post-thumbnail"><?php the_post_thumbnail($size = 'medium'); ?></a>
                    <div class="post-excerpt">
                        <h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
                       
                        <p class="details">
                            <span class="date"><?php felios_posted_on(); ?></span>
                            <?php $cats = get_the_category_list(', '); ?>

                            <?php if ($cats) echo ' | ' . $cats; ?>
                        </p>
                        <?php
                            $str = wpautop( get_the_content() );
                            $trimmedStr = wp_trim_words( $str, $num_words = 40, $more = null );
                        ?>
                        <?php echo $trimmedStr; ?>

                    </div>
                </article>
                
				<?php endwhile; ?>
				<?php
                $total = $wp_all_query->max_num_pages;
                // only bother with the rest if we have more than 1 page!
                if ( $total > 1 )  {
                    // get the current page
                    if ( !$current_page = get_query_var('paged') )
                        $current_page = 1;
                    // structure of "format" depends on whether we're using pretty permalinks
                    $format = empty( get_option('permalink_structure') ) ? '&page=%#%' : 'page/%#%/';
                    echo '<nav class="pagination">';
                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => $format,
                        'current' => $current_page,
                        'total' => $total,
                        'mid_size' => 4,
                        'type' => 'list'
                    ));
                    echo '</nav>';
                }
                ?>
                <?php wp_reset_postdata(); ?>

				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>	
                
                
			
		<?php  else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
