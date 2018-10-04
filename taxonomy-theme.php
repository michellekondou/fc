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
				<h1 class="page-title"><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'WORKS'; } else { echo 'ΕΡΓΑ';} ?></h1>
				<div class="collection-submenu">
					<ul class="nav nav-pills">
						<li class="dropdown">
							<a class="dropdown-toggle" role="button" data-target="drop-kind" href="#"><span><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'kind'; } else { echo 'είδος';} ?></span> <i class="icon arrow_left"></i></a>
							<ul id="menu-kind" class="dropdown-menu kind" role="menu" aria-labelledby="drop-kind" data-source="drop-kind">
								<?php if(function_exists('kindlist')) { kindlist(); } ?>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle active" data-target="drop-theme" role="button" data-toggle="dropdown" href="#"><span><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'theme'; } else { echo 'κατηγορία';} ?></span>  <i class="icon arrow_left"></i></a>
							<ul id="menu-theme" class="dropdown-menu theme open" role="menu" aria-labelledby="drop-theme" data-source="drop-theme">
								<?php if(function_exists('themelist')) { themelist(); } ?>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" id="shuffle" role="button" data-toggle="dropdown" href="#">
								<span><?php if(ICL_LANGUAGE_CODE == 'en') { echo 'shuffle'; } else { echo 'τυχαία';} ?></span>
							</a>
						</li>
					</ul>
					
					<div class="layout-switch">
						<button type="button" class="button--circle layout-switch--grid selected">[]</button>
						<button type="button" class="button--circle layout-switch--list">=</button>
					</div>
				</div>
			</header><!-- .page-header -->

			<div class="horizontal-grid visually-hidden">
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

