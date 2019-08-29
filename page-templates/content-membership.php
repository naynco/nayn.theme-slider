<?php
/**
 * Membership Pages
 */
?>
  <div class="corporate-header">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="corporate-header-description">
            <h1><?php echo get_the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
        </div>
        <?php get_sidebar('page'); ?>        
      </div>
    </div>
  </div> 

  <?php sectionSlider('post', '', 'recent', 'Son Eklenenler', 9); ?>
