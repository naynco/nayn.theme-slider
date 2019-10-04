<?php
/**
 * Default hero content
 */
global $options; ?>

<?php 

$args = array(
        'post_type' => 'post',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 5,
        'meta_query' =>  array(array(
                                      'key'     => 'post_headline',
                                      'value'   => 1)),
    );

$the_query = new WP_Query( $args ); ?>

<div class="hero-slider owl-ca rousel">
  <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
    <div class="item hero-slider-item">
      
      <div class="container-image">
        <div class="container-image-overlay"></div>
        <img src="<?php echo DION_THEME_URL; ?>/assets/img/image.png">
      </div>

      <div class="hero-slider-content">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <h2>
                <a href="#">
                  Guardians Of The Galaxy Vol. 3 2020 Yılında Vizyona Girecek
                </a>
              </h2>
              <div class="meta slider">
                <a href="#" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                  <span class="meta-link-text"><?php _e('Haberin devamı','nayn'); ?></span>
                </a>
                <div href="" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-clock-o"></i></span>
                  <span class="meta-link-text"><?php _e('10:45 22 Şubat 18','nayn'); ?></span>
                </div>
                <a href="#" class="meta-link">
                  <span class="meta-link-icon"><i class="fa fa-user-o"></i></span>
                  <span class="meta-link-text"><?php _e('Yıldız Çayır','nayn'); ?></span>
                </a>
              </div>              
            </div> 
          </div>          
        </div>
      </div>
      <div class="hero-slider-post">
        <div class="container">
          <div class="row">
            <?php for($i=1; $i<=4; $i++): ?>
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 hero-slider-post-item" >
                <div class="hero-slider-post-item-container" style="background-image: url('<?php echo DION_THEME_URL; ?>/assets/img/sample.jpg')">
                  
                  <div class="hero-slider-post-item-container-overlay">
                    <h3>
                      <a href="#">
                        YouTube’dan sundance film festivali’ne özel 6 saniyelik masallar 
                      </a>
                    </h3>
                  </div>

                </div>
              </div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->