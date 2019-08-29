<?php
/**
 * Category listing page
 */
get_header(); 
global $options;
$singleCategory   = single_cat_title( '', false );
$singleCategoryID = get_cat_ID($singleCategory);

// Get the category headline post
$categoryHeadline = get_term_meta( 10143, 'category_headline', true);

?>

<div class="hero-slider category-page">
  <div class="item hero-slider-item">
    
    <div class="container-image">
      <div class="container-image-overlay"></div>
      <?php echo get_the_post_thumbnail($categoryHeadline['ID'], 'hero'); ?>
    </div>

    <div class="hero-slider-content category-page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-6">
            <?php the_archive_title( '<h1>', '</h1>' ); ?>
          </div> 
        </div>          
      </div>
    </div>

    <div class="hero-slider-post">
      <div class="container">
        <div class="row">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 hero-slider-post-item" >
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

<?php pagination($the_query->max_num_pages, "", $paged); ?>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>