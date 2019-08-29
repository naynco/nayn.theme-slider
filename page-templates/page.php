<?php
/**
 * Default page
 */
global $options, $theCategory;

// Get the author info
$authorID = get_the_author_meta('ID');
$postCategories   = get_the_category();
$theCategory      = array();
$authorDisplayName= get_the_author_meta('display_name', $authorID);
$authorProfileURL = get_author_posts_url( $authorID, get_the_author_meta( 'user_nicename', $authorID ) );

foreach ($postCategories as $category) {
  $theCategory[] = $category->term_id;
}

?>

<div class="hero-slider single-page">
  <div class="item hero-slider-item">
    
    <div class="container-image">
      <div class="container-image-overlay"></div>
      <?php the_post_thumbnail('hero'); ?>
    </div>

    <div class="hero-slider-content single-page-content">
      <div class="container">
        <div class="row ">
          <div class="col-xl-5 col-lg-6 col-md-6 single-page-content-container">
            
            <h1><?php echo get_the_title(); ?></h1>

            <div class="clearfix"></div>

            <div class="entry-content">
              <?php the_content(); ?>
              <div class="clearfix"></div>
            </div>

            <div class="entry-tag">
              <?php echo get_the_tag_list('',', '); ?>
            </div>          

          </div> 
        </div> 
      </div>
    </div>
  </div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->
<div class="clearfix"></div>