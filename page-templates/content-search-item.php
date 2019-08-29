<?php
/**
 * Content search item
 */                                    
$postCategories = get_the_category(); 
?>

<div class="popular-widget-box">
    <div class="row">
      <div class="popular-widget-image col-md-3 col-xs-3">
        <img src="<?php the_post_thumbnail_url("77x65"); ?>" alt="<?php echo get_the_title(); ?>" class="img-responsive">
      </div>
      <div class="popular-widget-description col-md-9 col-xs-9">
        <h4>
          <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </h4>
        <h5>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> / 
                <?php if ( ! empty( $postCategories ) ):?>
                    <strong>
                        <a href="<?php echo get_category_link($postCategories[0]->term_taxonomy_id); ?>">
                            <?php echo esc_html( $postCategories[0]->name ); ?>
                        </a>
                    </strong>
                <?php endif; ?>
            </h5>
      </div>
    </div>
</div><!-- .popular-widget -->