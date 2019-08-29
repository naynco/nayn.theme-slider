<?php
/**
 * Template Name: Zaman Tüneli Ters
 */
get_header();

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part('page-templates/page-timeline-desc');

		endwhile;

	endif;
get_footer();
