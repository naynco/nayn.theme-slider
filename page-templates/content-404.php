<?php
/**
 * 404 content
 */
global $options;
$contactPageID = $options['tsContactPage'];
?>

<div class="hero-slider single-page">
  <div class="item hero-slider-item">
    
    <div class="container-image">
      <div class="container-image-overlay"></div>
      
      <img src="<?php echo DION_THEME_URL; ?>/assets/img/404.jpg" alt="">
    </div>

    <div class="hero-slider-content single-page-content">
      <div class="container">
        <div class="row ">
          <div class="col-xl-5 col-lg-6 col-md-6 single-page-content-container"> 
            <h1><?php _e('Üzgünüz aradığınız şeyi bulamadık :(','nayn'); ?></h1>

            <div class="clearfix"></div>

            <div class="entry-content">             
              <p>Bu sayfaya yanlışlıkla eriştiyseniz, lütfen bizimle <a href="<?php echo get_page_link($contactPageID); ?>">iletişime</a> geçin ve olanları bize bildirin.</p>
              <strong>Beni buraya yönlendir:</strong>
              
              <ul class="orient-link">
                <li>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Anasayfa','star'); ?></a>
                </li>
                <li><a href="<?php echo get_page_link($contactPageID); ?>"><?php echo get_the_title($contactPageID); ?></a></li>
              </ul>          

              <div class="clearfix"></div>
            </div>                  

          </div> 
        </div> 
      </div>
    </div>
  </div> <!-- .hero-slider-item -->
</div> <!-- .hero-slider -->
<div class="clearfix"></div>