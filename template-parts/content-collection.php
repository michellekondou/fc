<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */

//language variables
if(ICL_LANGUAGE_CODE == 'en') {
    //custom fields
    $select_material = get_field('select_material');
    $description = get_field('description');
    $artist = get_field('artist');
} else {
    //custom fields
    $select_material = get_field('select_material_el');
    $description = get_field('description_el');
    $artist = get_field('artist_el');
}

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
        $term_list = $term_label . ': ' . $the_terms;
        array_push($taxonomy_output, $term_list);
    }
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <a href="<?php the_permalink()?>">
			<?php the_title(); ?>
		</a>
    </header><!-- .entry-header -->
    
    <figure class="thumbnail">
        <?php felios_post_thumbnail(); ?>
    </figure>
	
	<div class="entry-content">
        <div class="artwork-details">
            <p><?php the_field('catalogue_number'); ?></p>
            <p><?php the_field('year'); ?></p>
            <p><?php the_field('dimensions'); ?></p>
            <?php echo $description; ?>
            <p><?php echo $select_material; ?></p>
            <p>
            <?php if( $artist ): ?>
                <?php foreach( $artist as $post): // variable must be called $post (IMPORTANT) ?>
                <?php setup_postdata($post); ?>
                    <a href="<?php the_permalink(); ?>" class="artist-name"><?php the_title(); ?></a>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
            </p>
            <p class="kind">
                <?php 
                  foreach($taxonomy_output as $result) {
                        echo $result, '<br>';
                    } 
                ?>
            </p>
        </div>
    
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'felios' ),
                'after'  => '</div>',
            ) );
        ?>
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
