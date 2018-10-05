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
    $by_delimiter = 'x';
} else {
    //custom fields
    $select_material = get_field('select_material_el');
    $description = get_field('description_el');
    $artist = get_field('artist_el');
    $by_delimiter = 'X';
}

$taxonomy_field = 'name';
$taxonomy_list = get_post_taxonomies();
$taxonomy_output = [];

foreach ( $taxonomy_list as $term_obj ) {
    //get the terms
    $terms = get_the_terms( get_the_ID(), $term_obj ); 
    if ( $terms && ! is_wp_error( $terms ) ) {
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
}

if ( has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
    $thumb_id = get_post_thumbnail_id();
    
    $image_src = $image[0];
    $image_width = $image[1];
    $image_height = $image[2];
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

<article 
    id="post-<?php the_ID(); ?>"
    class="collection ">
    <div class="artwork<?php 
    if($dimensions) {
        if(isset($work_height) && isset($work_width)) {
            if( $work_width > $work_height ) {
                echo ' landscape';
            } else{
                echo ' portrait';
            } 
        } 
} ?>">
        <figure class="thumbnail">
            <?php felios_post_thumbnail(); ?>
        </figure>

        <div class="detail-container">
            <section class="artwork-details">
                <h3>
                    <?php if( $artist ): ?>
                        <?php foreach( $artist as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post); ?>
                            <a href="<?php the_permalink(); ?>" class="artist-name"><?php the_title(); ?></a>
                        <?php endforeach; ?>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>
                </h3>
                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                <p><?php the_field('year'); ?></p>
                <p><?php echo $select_material; ?></p>
                <?php if( have_rows('dimensions_fields') ) : ?>
                    <?php while ( have_rows('dimensions_fields') ) : the_row(); ?> 
                    <?php
                        $height = get_sub_field('height');
                        $width = get_sub_field('width');
                        $depth = get_sub_field('depth');
                        $diameter = get_sub_field('diameter');
                        $free_text = get_sub_field('free_text');
                    ?>
                    <p>
                    <?php if(ICL_LANGUAGE_CODE == 'en') {
                        if($height) { echo $height; } if($width) { echo ' ' . $by_delimiter . ' ' . $width; } if($depth) { echo ' ' . $by_delimiter . ' ' . $depth; } if($diameter) { echo ' ' . $by_delimiter . ' ' . $diameter; } if($free_text) { echo  ' ' . $free_text; }
                    } else {
                        $height_with_comma = str_replace(".",",", $height);
                        $width_with_comma = str_replace(".",",", $width);
                        $depth_with_comma = str_replace(".",",", $depth);
                        $diameter_with_comma = str_replace(".",",", $diameter);
                        if($height) { echo $height_with_comma; } if($width) { echo ' ' . $by_delimiter . ' ' . $width_with_comma; } if($depth) { echo ' ' . $by_delimiter . ' ' . $depth_with_comma; } if($diameter) { echo ' ' . $by_delimiter . ' ' . $diameter_with_comma; } if($free_text) { echo  ' ' . $free_text; }
                    } ?>
                    </p>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php echo $description; ?> 
            </section> 
        </div>
    </div>
    <section class="gallery">
            <?php
            // check if the repeater field has rows of data
            if( have_rows('gallery') ): ?>
            <div class="horizontal-grid">
                <?php 
                // loop through the rows of data
                while ( have_rows('gallery') ) : the_row(); ?>

                    <?php 
                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $title_el = get_sub_field('title_el');
                    $year = get_sub_field('year');
                    $dimensions = get_sub_field('dimensions');
                    if(ICL_LANGUAGE_CODE == 'en') {
                        $material = get_sub_field('select_material');
                    } else {
                        $material = get_sub_field('select_material_el');   
                    }
                    $size = 'medium'; // (thumbnail, medium, large, full or custom size)
                    //var_dump($image);
                    if( $image ): ?>
						
                        <figure class="magnifiable">
                            <a class="post-thumbnail<?php 
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
                            } } ?>" data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
                                <img 
                                    data-mobile-height="<?php echo $image['sizes']["medium-height"]; ?>"
                                    data-srcset="<?php echo $image['sizes']["medium"]; ?> 600w, <?php echo $image['sizes']["medium"]; ?> 400w"
                                    data-ie="<?php echo $image['sizes']["medium"]; ?>"
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
                            <?php if( $title ) : ?>
                                <figcaption>
                                    <h3>
                                    <?php if( $artist ): ?>
                                        <?php foreach( $artist as $post): // variable must be called $post (IMPORTANT) ?>
                                        <?php setup_postdata($post); ?>
                                            <a href="<?php the_permalink(); ?>" class="artist-name"><?php the_title(); ?></a>
                                        <?php endforeach; ?>
                                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                                    <?php endif; ?>
                                    </h3>
                                    <h2><?php echo $title; ?></h2>
                                    <p><?php echo $year; ?></p>
                                    <p><?php echo $material; ?></p>
                                    <?php if( have_rows('dimensions') ) : ?>
                                    <?php while ( have_rows('dimensions') ) : the_row(); ?> 
                                    <?php
                                        $height = get_sub_field('height');
                                        $width = get_sub_field('width');
                                        $depth = get_sub_field('depth');
                                        $diameter = get_sub_field('diameter');
                                        $free_text = get_sub_field('free_text');
                                    ?>
                                    <p>
                                    <?php if(ICL_LANGUAGE_CODE == 'en') {
                                        if($height) { echo $height; } if($width) { echo ' ' . $by_delimiter . ' ' . $width; } if($depth) { echo ' ' . $by_delimiter . ' ' . $depth; } if($diameter) { echo ' ' . $by_delimiter . ' ' . $diameter; } if($free_text) { echo  ' ' . $free_text; }
                                    } else {
                                        $height_with_comma = str_replace(".",",", $height);
                                        $width_with_comma = str_replace(".",",", $width);
                                        $depth_with_comma = str_replace(".",",", $depth);
                                        $diameter_with_comma = str_replace(".",",", $diameter);
                                        if($height) { echo $height_with_comma; } if($width) { echo ' ' . $by_delimiter . ' ' . $width_with_comma; } if($depth) { echo ' ' . $by_delimiter . ' ' . $depth_with_comma; } if($diameter) { echo ' ' . $by_delimiter . ' ' . $diameter_with_comma; } if($free_text) { echo  ' ' . $free_text; }
                                    } ?>
                                    </p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                </figcaption>
                            <?php endif; ?>
                        </figure>
                        
                    <?php endif; ?>

                <?php endwhile; ?>
                </div>
           <?php endif; ?>

        </section>
    
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'felios' ),
                'after'  => '</div>',
            ) );
        ?>


	
</article><!-- #post-<?php the_ID(); ?> -->
<?php
    get_template_part('template-parts/photoswipe');
?>

<script src="<?php echo esc_url( site_url( '/' ) . 'wp-content/themes/felios/src/js/photoswipe.js' ); ?>"></script>
