<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _s
 */
global $options;
?>

  <footer>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="copyright"><?php _e('© 2019 Nayn.Co | Tüm Hakları Saklıdır.','nayn'); ?></div> 
            <?php //wp_nav_menu( array( 'theme_location' => 'footer-section' ) ); ?>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 text-center d-none d-sm-none d-md-block d-lg-block d-xl-block">
            <a class="download" href="http://onelink.to/gw69ua" target="_blank"><i class="fa fa-mobile"></i></a>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <ul class="social-media">
              <?php if ($options['smFacebook']): ?> 
                <li><a href="<?php echo $options['smFacebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <?php endif; ?>

              <?php if ($options['smTwitter']): ?> 
                <li><a href="<?php echo $options['smTwitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
              <?php endif; ?>

              <?php if ($options['smInstagram']): ?> 
                <li><a href="<?php echo $options['smInstagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>

</body>
</html>
