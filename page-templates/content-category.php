<?php
/**
 * Default content
 */
global $options, $theCategory, $thePostID;

// Get the category headline post
$categoryHeadline = get_term_meta( $theCategory[0], 'category_headline', true);

?>

<div class="hero-slider single-category-page">
  <div class="item hero-slider-item d-none d-lg-block">

    <?php 
      $categoryArgs = array(
        'cat' => $theCategory,
        'order' => 'DESC',
        'orderby' => 'date',
        'post__not_in' => array($thePostID),
        'posts_per_page' => 1
      );
      $categoryQuery = new WP_Query( $categoryArgs );

      if ( $categoryQuery->have_posts() ) :
      
      /* Start the Loop */ 
      while ( $categoryQuery->have_posts() ) : $categoryQuery->the_post(); 

      $heroPostID = get_the_ID(); ?>
    
        <div class="container-image">
          <div class="container-image-overlay"></div>
          <?php echo get_the_post_thumbnail(get_the_ID(), 'hero'); ?>
        </div>

        <div class="hero-slider-content single-category-page-content">
          <div class="container">
            <div class="row">
              
              <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-6">
                <div class="category">
                  <a href="<?php echo get_category_link($theCategory[0]); ?>">
                    <?php echo get_cat_name($theCategory[0]); ?>                
                  </a>
                </div>
                <h2>
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                    <?php echo get_the_title(); ?>
                  </a>
                </h2>

                <div class="meta slider">
                  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="meta-link">
                    <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                    <span class="meta-link-text"><?php _e('Haberin devamı','nayn'); ?></span>
                  </a>
                </div>

              </div> 
                
            </div>          
          </div>
        </div>

    <?php endwhile; endif; ?>

    <div class="hero-slider-post">
      <div class="container">
        <div class="row">

          <?php 
            $categoryArgs = array(
              'cat' => $theCategory,
              'order' => 'DESC',
              'orderby' => 'date',
              'post_type' => 'post',
              'post__not_in' => array($heroPostID, 1),
              'posts_per_page' => 4
            );
            $categoryQuery = new WP_Query( $categoryArgs );

            if ( $categoryQuery->have_posts() ) :
            
            /* Start the Loop */ 
            while ( $categoryQuery->have_posts() ) : $categoryQuery->the_post(); ?>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 hero-slider-post-item" >
              <div class="hero-slider-post-item-container" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), "hero-news"); ?>')">
                
                <div class="hero-slider-post-item-container-overlay">
                  <h3>
                    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                      <?php echo get_the_title(); ?>
                    </a>
                  </h3>
                </div>

              </div>
            </div>

          <?php endwhile; endif; ?>

        </div>
      </div>
    </div>

  </div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->
<div class="clearfix"></div>