<div class="hero-slider single-page">
  <div class="item hero-slider-item">
    
    <div class="container-image">
      <div class="container-image-overlay"></div>
      
      <?php
      if (has_post_thumbnail()) {
          the_post_thumbnail('hero');
      } else { ?>
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=">
      <?php } ?>
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