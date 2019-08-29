<?php
/**
 * The template for displaying Search Results pages.
 */
get_header();
global $options;
$contactPageID = $options['tsContactPage'];

?>
<section class="not-found">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 not-found-page">

      			<div class="row">
	                <div class="popular-widget col-md-12 col-sm-12 col-xs-12">
	                	<?php get_search_form(); ?>
						<h3><?php printf( __( 'Arama sonucu: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
	                	<?php 
	                		if ( have_posts() ):

								/* Start the Loop */
								while ( have_posts() ) : the_post(); 	
									get_template_part( 'page-templates/content-search-item' );
					        	endwhile;
							else:
								get_template_part( 'page-templates/content-search-not-found' );
							endif; 
						?>
	                </div>
              	</div>
	            <ul class="orient-link">
		          	<li><strong>Beni buraya yönlendir:</strong></li>
		          	<li>
		            	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Anasayfa','star'); ?></a>
		          	</li>
		          	<li><a href="<?php echo get_page_link($contactPageID); ?>"><?php echo get_the_title($contactPageID); ?></a></li>
		        </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<?php get_footer(); ?>