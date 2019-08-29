<?php
/**
 * Default hero content
 */
global $options; 

$postCustomNews     = get_post_meta(get_the_ID(), 'post_custom_news');
$postCustomHeadline = get_post_meta(get_the_ID(), 'post_headline');

$args = array(
        'p'               => $postCustomHeadline[0]['ID'],
        'post_type'       => 'post',
        'order'           => 'DESC',
        'orderby'         => 'date',
        'posts_per_page'  => 1
    );

$the_query = new WP_Query( $args ); ?>

<div class="hero-slider template-bag">

  <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    // Get the author info
    $authorID = get_the_author_meta('ID');
    $authorDisplayName= get_the_author_meta('display_name', $authorID);
    $authorProfileURL = get_author_posts_url( $authorID, get_the_author_meta( 'user_nicename', $authorID ) );
    ?>

    <div class="item hero-slider-item">      
      <div class="container-image">
        <div class="container-image-overlay"></div>
        <?php if( has_post_thumbnail() ){ the_post_thumbnail('hero'); } ?>
      </div>

      <div class="hero-slider-content">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12">
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
                <div class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-clock-o"></i></span>
                  <span class="meta-link-text"><?php echo get_the_date("H:i j F Y"); ?></span>
                </div>
                <a href="<?php echo $authorProfileURL; ?>" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-user-o"></i></span>
                  <span class="meta-link-text"><?php the_author(); ?></span>
                </a>
              </div>

            </div> 
          </div>          
        </div>
      </div>

      <div class="hero-slider-post">
        <div class="container">
          <div class="row">

            <?php foreach ($postCustomNews as $post): ?>

              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 hero-slider-post-item" >
                <div class="hero-slider-post-item-container" style="background-image: url('<?php echo get_the_post_thumbnail_url($post['ID'], "hero-news"); ?>')">
                  
                  <div class="hero-slider-post-item-container-overlay">
                    <h3>
                      <a href="<?php the_permalink($post['ID']); ?>" title="<?php echo $post['post_title']; ?>">
                        <?php echo $post['post_title'];?>
                      </a>
                    </h3>
                  </div>

                </div>
              </div>

            <?php endforeach; ?>

          </div>
        </div>
      </div>

    </div> <!-- .hero-slider-item -->

  <?php endwhile; endif; ?>

</div> <!-- .hero-slider -->
