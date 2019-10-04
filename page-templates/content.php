<?php
/**
 * Default content
 */
global $options, $theCategory, $thePostID;

// Get the author info
$authorID = get_the_author_meta('ID');
$postCategories   = get_the_category();
$theCategory      = array();
$authorDisplayName= get_the_author_meta('display_name', $authorID);
$authorProfileURL = get_author_posts_url( $authorID, get_the_author_meta( 'user_nicename', $authorID ) );
$thePostID        = get_the_ID();
$show_author      = get_post_meta($thePostID,'show_author',false);

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
        <div class="row">
          <div class="col-xl-5 col-lg-7 col-md-8 offset-md-2 col-sm-12 single-page-content-container">
            <div class="category">
              <?php echo get_the_category_list( _x( ' ', '', 'nayn' ) ); ?>
            </div>
            <h1><?php echo get_the_title(); ?></h1>

            <div class="meta meta-post">
              <div href="" class="meta-link">
                <span class="meta-link-icon"><i class="fa fa-clock-o"></i></span>
                <span class="meta-link-text"><?php the_date("H:i j F Y"); ?></span>
              </div>
              <?php if($show_author){ ?>
              <a href="<?php echo $authorProfileURL; ?>" class="meta-link">
                <span class="meta-link-icon"><i class="fa fa-user-o"></i></span>
                <span class="meta-link-text"><?php the_author(); ?></span>
              </a>
              <?php } ?> 
            </div>

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

      <div class="post-prev">
        <?php next_post_link( '%link', '<i class="fa fa-angle-left"></i>'); ?>
      </div>

      <div class="post-next">
        <?php previous_post_link( '%link', '<i class="fa fa-angle-right"></i>'); ?>
      </div>
      
    </div>
  </div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->
<div class="clearfix"></div>

<?php get_template_part('page-templates/content-category'); ?>
