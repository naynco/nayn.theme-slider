<?php
/**
 * Template Name: Slayt
 */
get_header();

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part('page-templates/page-home');

		endwhile;

	endif;
get_footer();