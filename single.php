<?php
/**
 * The Template for displaying all single posts.
 *
 */
global $options, $theCategory, $thePostID;
get_header();

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			$postFormat 	= get_post_format( get_the_ID() );

			get_template_part('page-templates/content');

			postView(get_the_ID());

		endwhile;

	endif;

get_footer(); 
?>