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
    //relationship key
    $artist_key = 'artist';
    //custom fields
    $artist_biography = get_field('biography');
    $artist_press =get_field('press');
    $artist_address = get_field('address');

} else {
    //relationship key
    $artist_key = 'artist_el';
    //custom fields
    $artist_biography = get_field('biography_el');
    $artist_press = get_field('press_el');
    $artist_address = get_field('address_el');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php felios_post_thumbnail(); ?>

	<div class="entry-content">

        <?php //if( $artist_address || the_field('email') || the_field('website') ): ?>
        <section class="contact-details">
            <h2><?php _e( 'Contact Details', 'felios-textdomain' ); ?></h2>
            <p><?php the_field('email'); ?></p>
            <p><?php the_field('website'); ?></p>
            <?php echo $artist_address; ?>
        </section>
        <?php //endif; ?>
 
        <?php 

        /*
        *  Query posts for a relationship value.
        *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
        */

        $collection = get_posts(array(
            'post_type' => 'collection',  
            'meta_query' => array(
                array(
                    'key' => $artist_key, // name of custom field
                    'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                    'compare' => 'LIKE'
                )
            )
        ));
        ?>
        <?php if( $collection ): ?>
        <section class="artworks-list">
            <h2><?php _e( 'Artworks', 'felios-textdomain' ); ?></h2>
                <div class="horizontal-grid">
                <?php foreach( $collection as $item ): ?>
                    <?php //the_post_thumbnail($item->ID); ?>
                    <a href="<?php echo get_permalink( $item->ID ); ?>">
                    <figure>
                        <?php echo get_the_post_thumbnail( $item->ID, 'medium', array( 'class' => 'test' ) ); ?>
                        <figcaption><?php echo get_the_title( $item->ID ); ?></figcaption>
                    </figure>
                    </a>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                </div>  
        </section>
        <?php endif; ?>

        <?php if ( $artist_biography ) : ?>
        <section class="biography">
            <h2><?php _e( 'Biography', 'felios-textdomain' ); ?></h2>
            <?php echo $artist_biography; ?>
        </section>
        <?php endif; ?>

        <?php if ( $artist_press ) : ?>
        <section class="press">
            <h2><?php _e( 'Press', 'felios-textdomain' ); ?></h2>
            <?php echo $artist_press; ?>
        </section>
        <?php endif; ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'felios' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
