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
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				//the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				<?php if ( get_post_type() == 'collection' ) : ?>
				<ul class="nav nav-pills">
					<li class="dropdown">
						<a class="dropdown-toggle" id="drop-kind" role="button" data-toggle="dropdown" href="#"><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'kind'; } else { echo 'είδος';} ?> <b class="caret"></b></a>
						<ul id="menu-kind" class="dropdown-menu kind" role="menu" aria-labelledby="drop-kind">
							<?php if(function_exists('kindlist')) { kindlist(); } ?>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" id="drop-theme" role="button" data-toggle="dropdown" href="#"><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'theme'; } else { echo 'θέμα';} ?> <b class="caret"></b></a>
						<ul id="menu-theme" class="dropdown-menu theme" role="menu" aria-labelledby="drop-theme">
							<?php if(function_exists('themelist')) { themelist(); } ?>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" id="shuffle" role="button" data-toggle="dropdown" href="#">
							<?php if(ICL_LANGUAGE_CODE == 'en') { echo 'shuffle'; } else { echo 'ανακάτεμα';} ?>
						</a>
					</li>
				</ul>
				<?php endif; ?>
			</header><!-- .page-header -->

			<div class="horizontal-grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile; 
			?>
			</div><!-- .horizontal-grid -->
			<?php felios_numeric_posts_nav(); ?>
			
		<?php  else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
