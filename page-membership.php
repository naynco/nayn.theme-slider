<?php
/**
 * Membership
 *
 */
global $options;
get_header();

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part('page-templates/page-membership');

			postView(get_the_ID());

		endwhile;

	endif;

get_footer(); 
?>
