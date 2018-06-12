<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */

//field variables
//common
$exhibition_date_start = get_field('exhibition_date_start');
$exhibition_date_end = get_field('exhibition_date_end');
$exhibition_gallery = get_field('gallery');

if(ICL_LANGUAGE_CODE == 'en') {
    //custom fields
    $exhibition_description = get_field('description_en');
    $exhibition_venue_name = get_field('venue_name');
    $exhibition_venue_address = get_field('venue_address');
    $exhibition_organized_by = get_field('organized_by');
    $exhibition_sponsors = get_field('sponsors');
} else {
    //custom fields
    $exhibition_description = get_field('description_el');
    $exhibition_venue_name = get_field('venue_name_el');
    $exhibition_venue_address = get_field('venue_address_el');
    $exhibition_organized_by = get_field('organized_by_el');
    $exhibition_sponsors = get_field('sponsors_el');
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
        <div class="event-details">
            <?php echo $exhibition_description; ?>
            <?php echo $exhibition_venue_name; ?>
            <?php echo $exhibition_venue_address; ?>
            <?php echo $exhibition_organized_by; ?>
            <?php echo $exhibition_sponsors; ?>
            <?php echo $exhibition_date_start; ?>
            <?php echo $exhibition_date_end; ?>
            <?php 
            $images = get_field('gallery');
            $size = 'medium'; // (thumbnail, medium, large, full or custom size)

            if( $images ): ?>
                <div class="horizontal-grid">
                    <?php foreach( $images as $image ): ?>
                        <figure>
                            <?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
                        </figure>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
