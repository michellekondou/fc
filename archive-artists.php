<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package felios
 */

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
			<div class="columns">
			<?php
			/* Start the Loop */
			
			
				
			$alpha_letter = '';
			while ( have_posts() ) :
				the_post();
				$artist_name = get_the_title();
				$a_arr = explode(" ",$artist_name);
				$artist_first_name = $a_arr[1];
				$artist_last_name = $a_arr[0];
				
				
				$letter = mb_substr( $artist_last_name, 0, 1, 'UTF-8' );
				$letter_ = mb_convert_case($letter, MB_CASE_UPPER, "UTF-8");
				echo '<section class="letter-en-'. $letter_ .'">';
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', 'page' );
				include(locate_template('template-parts/content-page.php'));
				echo '</section>';

			endwhile; ?>
			</div>

			<?php felios_numeric_posts_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
