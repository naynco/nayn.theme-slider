<?php
/**
 * Default hero content
 */
global $options; 

$args = array(
        'post_type'       => array('page', 'post'),
        'order'           => 'DESC',
        'orderby'         => 'date',
        'posts_per_page'  => $options['tsHomeSliderCount'],
        'meta_query'      =>  array(array(
                                      'key'     => 'post_headline',
                                      'value'   => 1)),
    );

$the_query = new WP_Query( $args ); ?>
<?php if (get_query_var('view')=='list'){ ?>
  <div class="hero-slider single-page">

<div class="item hero-slider-item">
  <div class="container-image">
    <div class="container-image-overlay"></div>
    
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=">

  </div>
  <div class="hero-slider-content single-page-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
        <div class="list-group bg-transparent">
        <?php
            if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

            // Get the author info
            $authorID = get_the_author_meta('ID');
            $authorDisplayName= get_the_author_meta('display_name', $authorID);
            $authorProfileURL = get_author_posts_url($authorID, get_the_author_meta('user_nicename', $authorID));
            ?>
          <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action bg-transparent">
            <div class="d-flex w-100">
              <small class="text-danger"><?php echo get_the_date("H:i"); ?></small>
              <span class="ml-2"><?php echo get_the_title(); ?></span>
            </div>
          </a>

            <?php endwhile; endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->
<div class="clearfix"></div>
<?php } else if (get_query_var('view')=='slider'){ ?>
<div class="hero-slider theme-slider template-home owl-carousel">

  <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
   
    // Get the author info
    $authorID = get_the_author_meta('ID');
    $authorDisplayName= get_the_author_meta('display_name', $authorID);
    $authorProfileURL = get_author_posts_url($authorID, get_the_author_meta('user_nicename', $authorID));
    ?>

    <div class="item hero-slider-item" data-thumb="<?php echo get_the_title(); ?>">      
      <div class="container-image">
        <?php if (has_post_thumbnail()): ?>
          <a class="container-image-effect show-mobile" href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <?php the_post_thumbnail('hero'); ?>
          </a>
          <div class="container-image-effect show-desktop">
            <?php the_post_thumbnail('hero'); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="hero-slider-content">
        <div class="container">
          <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-xs-12">
              <h2>
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php echo get_the_title(); ?>
                </a>
              </h2>

              <div class="meta slider">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                  <span class="meta-link-text"><?php _e('Haberin devamı', 'nayn'); ?></span>
                </a>
                <div class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-clock-o"></i></span>
                  <span class="meta-link-text"><?php echo get_the_date("H:i j F Y"); ?></span>
                </div>
                <?php /*
                <a href="<?php echo $authorProfileURL; ?>" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-user-o"></i></span>
                  <span class="meta-link-text"><?php the_author(); ?></span>
                </a> */ ?>
              </div>

            </div> 
          </div>          
        </div>
      </div>
    </div> <!-- .hero-slider-item -->

  <?php endwhile; endif; ?>

</div> <!-- .hero-slider -->
<?php } ?>

<?php
 
if ( is_active_sidebar( 'custom-widget' ) ) : ?>
    <?php dynamic_sidebar( 'custom-widget' ); ?>
<?php endif; ?>
