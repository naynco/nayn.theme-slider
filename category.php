<?php
/**
 * Category listing page
 */
get_header(); 
global $options;
$termTitle    = single_cat_title( '', false );
$termID       = get_cat_ID($termTitle);

// Get the tag timeline meta
$termTimeline  = get_term_meta( $termID, 'term_timeline', true);
$termCover     = get_term_meta( $termID, 'term_cover', true); ?> 

<?php if($termCover): // timeline page control ?>

  <header class="tag-header" style="background-image: url(<?php echo $termCover['guid']; ?>);">
    <div class="tag-header-overlay"></div>
    <div class="container tag-header-content">
        <div class="row">
            <div class="col-xl-5 col-lg-8">
              <h1><?php echo $termTitle; ?></h1>
              <p>
                <?php echo category_description($termID); ?>
              </p>                
            </div>
        </div>
    </div>    
  </header><!-- .tag-header  -->

<?php else: ?>

  <header class="tag-header tag-header--simple">
    <div class="tag-header-overlay"></div>
    <div class="container tag-header-content">
      <div class="row">
        <div class="col-xl-5 col-lg-8">
          <h1><?php echo $termTitle; ?></h1>
          <p>
            <?php echo category_description($termID); ?>
          </p>                
        </div>
      </div>
    </div>    
  </header><!-- .tag-header -->

<?php endif; ?>

  <section class="post-list">
    <div class="container">
      <div class="row">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 post-item" >
          <div class="post-item-container" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), "hero-news"); ?>')">                        
            <div class="post-item-container-overlay">
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
  </section><!-- .post-list -->

  <?php pagination($the_query->max_num_pages, "", $paged); ?>
  <?php wp_reset_postdata(); ?>

<?php get_footer(); ?>