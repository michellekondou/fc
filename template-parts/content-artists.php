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
    $solo_exhibitions = get_field('select_solo_exhibitions');
    $group_exhibitions = '';

} else {
    //relationship key
    $artist_key = 'artist_el';
    //custom fields
    $artist_biography = get_field('biography_el');
    $artist_press = get_field('press_el');
    $artist_address = get_field('address_el');
}

$artist_name = get_the_title();
$a_arr = explode(" ",$artist_name);
$artist_first_name = isset($a_arr[1]) ? $a_arr[1] : '';
$artist_last_name = isset($a_arr[0]) ? $a_arr[0] : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="artist-bio">
        <header class="entry-header">
            <h1 class="entry-title"><?php echo $artist_first_name . '  ' . $artist_last_name;  ?></h1>
        </header><!-- .entry-header -->
        
         <figure class="artist-photo">
            <div class="placeholder"></div>
         </figure>
         <article class="artist-text">
             <?php if ( $artist_biography ) : ?>
            <div class="body-text">
                <?php echo $artist_biography; ?>
            </div>
            <?php endif; ?>
         </article>   
    </div>

	<div class="entry-content">
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
                    'key' => $artist_key, // name of custom field
                    'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                    'compare' => 'LIKE',

                )
            )
        ));
        ?>
        <?php if( $collection ): ?>
        <section class="artworks-list">
            <?php 
                $i = 0;
                foreach( $collection as $post ): ?>
                <?php setup_postdata($post); ?>
                <?php $i++; ?>
                <?php if($i === 1) : ?>
                <?php 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                    $image_s = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail');
                    $image_m = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
                    $image_ml = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large');
                    $image_l = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
                    $thumb_id = get_post_thumbnail_id();
                    $postThumbnailHeight_l = $image[2];
                    $postThumbnailHeight_p = $image_ml[1];
                    $dimensions = get_field('dimensions');
                    $year = get_field('year');
                    $description = get_field('description');

                    if(ICL_LANGUAGE_CODE == 'en') {
                        $material = get_field('select_material');
                    } else {
                        $material = get_field('select_material_el');   
                    }
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
                     if($dimensions) : ?>
                    <?php if(isset($work_height) && isset($work_width)) : ?>
                        <?php if( $work_width > $work_height ) : ?>
                        <div class="artwork landscape">
                            <div class="magnifiable">
                                <figure class="thumbnail post-thumbnail">
                                <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>">
                                    <img
                                        data-mobile-width="<?php echo $image_l[1]; ?>"
                                        data-mobile-height="<?php echo $image_l[2]; ?>"
                                        data-srcset="<?php echo $image_l[0]; ?> 1110w, 
                                                    <?php echo $image_ml[0]; ?> 768w,
                                                    <?php echo $image_m[0]; ?> 330w,
                                                    <?php echo $image_s[0]; ?> 200w"
                                        data-sizes="(max-width: 320px) 280px, 
                                                    (min-width: 480px) 330px, 
                                                    (max-width: 767px) 720px,
                                                    (min-width: 768px) 1110px"
                                        data-ie="<?php echo $image_l[0]; ?>"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
                                        alt="<?php the_title(); ?>">
                                    </a>
                                </figure>
                            </div>
                        <?php else : ?>
                        <div class="artwork portrait">
                            <div class="magnifiable">
                                <figure class="thumbnail post-thumbnail">
                                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>">
                                    <img
                                        data-mobile-width="<?php echo $image_ml[1]; ?>"
                                        data-mobile-height="<?php echo $image_ml[2]; ?>"
                                        data-srcset="<?php echo $image_ml[0]; ?> 768w,
                                                    <?php echo $image_m[0]; ?> 330w,
                                                    <?php echo $image_s[0]; ?> 200w"
                                        data-sizes="(max-width: 320px) 280px, 
                                                    (min-width: 480px) 330px, 
                                                    (max-width: 767px) 720px,
                                                    (min-width: 768px) 540px"
                                        data-ie="<?php echo $image_ml[0]; ?>"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
                                        alt="<?php the_title(); ?>">
                                        <noscript>
                                            <img 
                                                data-srcset="<?php echo $image_ml[0]; ?> 768w,"
                                                sizes="(max-width: 768px) 720px,"
                                                src="<?php echo $image_ml[0]; ?>"
                                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image no-js-thumb">
                                        </noscript>
                                    </a>
                                </figure>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php else : ?>
                        <div class="artwork portrait">
                            <div class="magnifiable">
                                <figure class="thumbnail post-thumbnail">
                                    <a data-size="<?php echo $image[1].'x'.$image[2] ?>" href="<?php echo $image[0]; ?>" title="<?php echo the_title(); ?>">
                                    <img
                                        data-mobile-width="<?php echo $image_ml[1]; ?>"
                                        data-mobile-height="<?php echo $image_ml[2]; ?>"
                                        data-srcset="<?php echo $image_ml[0]; ?> 768w,
                                                    <?php echo $image_m[0]; ?> 330w,
                                                    <?php echo $image_s[0]; ?> 200w"
                                        data-sizes="(max-width: 320px) 280px, 
                                                    (min-width: 480px) 330px, 
                                                    (max-width: 767px) 720px,
                                                    (min-width: 768px) 540px"
                                        data-ie="<?php echo $image_ml[0]; ?>"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
                                        alt="<?php the_title(); ?>">
                                        <noscript>
                                            <img 
                                                data-srcset="<?php echo $image_ml[0]; ?> 768w,"
                                                sizes="(max-width: 768px) 720px,"
                                                src="<?php echo $image_ml[0]; ?>"
                                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image no-js-thumb">
                                        </noscript>
                                    </a>
                                    <figcaption class="visually-hidden"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></figcaption>
                                </figure>
                            </div>
                        <?php endif; ?>
                            <div class="detail-container">
                                <section class="artwork-details">
                                <h3>
                                    <a href="<?php the_permalink(); ?>" class="artist-name">
                                        <?php echo $artist_first_name . '  ' . $artist_last_name;  ?>
                                    </a>
                                </h3>
                                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                <p><?php echo $year; ?></p>
                                <p><?php echo $material; ?></p>
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
                <?php endif; ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                <div class="main-carousel" data-flickity='{ "cellAlign": "center", "pageDots": false, "lazyLoad": true, "imagesLoaded": true, "autoPlay": 6000, "pauseAutoPlayOnHover": false, "arrowShape": "M0,28.1 33.2,0 33.2,24.4 70,24.4 70,31.8 33.2,31.8 33.2,56.2 z" }'>
                <?php
                $i = 0; 
                foreach( $collection as $post ): ?>
                <?php setup_postdata($post); ?>
                <?php $i++; ?>
                <?php if($i > 1) : ?>
                <?php 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                    $image_s = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail');
                    $image_m = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium');
                    $image_ml = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large');
                    $image_l = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');
                    $thumb_id = get_post_thumbnail_id();
                    $postThumbnailHeight_l = $image[2];
                    $postThumbnailHeight_p = $image_ml[1];
                    $dimensions = get_field('dimensions');
                    $year = get_field('year');
                    $description = get_field('description');

                    if(ICL_LANGUAGE_CODE == 'en') {
                        $material = get_field('select_material');
                    } else {
                        $material = get_field('select_material_el');   
                    }
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
                     }  ?>
                    <figure class="">
                        <a class="post-thumbnail <?php 
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
                        } } ?>" href="<?php echo get_permalink( $post->ID ); ?>">
                            <img
                                data-mobile-width="<?php echo $image_m[1]; ?>"
                                data-mobile-height="<?php echo $image_m[2]; ?>"
                                data-srcset="<?php echo $image_m[0]; ?> 330w,
                                            <?php echo $image_s[0]; ?> 200w"
                                data-sizes="(max-width: 320px) 280px,
                                            330px"
                                data-ie="<?php echo $image_m[0]; ?>"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
                                alt="<?php the_title(); ?>">
                        </a>
                        <figcaption><?php echo get_the_title( $post->ID ); ?></figcaption>
                    </figure>
              
                <?php endif; ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                </div>
            </div>  
        </section>
        <?php endif; ?>

        <?php if ( $artist_biography ) : ?>
        <!-- <section class="biography">
            <h2><?php //_e( 'Biography', 'felios-textdomain' ); ?></h2>
           
            
            <?php if($solo_exhibitions) : ?>
            <h3>Solo Exhibitions</h3>
            <ul>
                <?php foreach ($solo_exhibitions as $se) : ?>
                <li><?php echo $se; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if($group_exhibitions) : ?>
            <h3>Group Exhibitions</h3>
            <ul>
                <?php foreach ($group_exhibitions as $ge) : ?>
                <li><?php echo $ge; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </section> -->
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
<?php
    get_template_part('template-parts/photoswipe');
?>
<script src="<?php echo esc_url( site_url( '/' ) . 'wp-content/themes/felios/src/js/flickity.pkgd.min.js' ); ?>"></script>
