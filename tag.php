<?php
/**
 * Tag listing page
 */
get_header(); 
global $options;

$termTitle  = single_tag_title( '', false );
$termID     = get_query_var('tag_id');

// Get the tag timeline meta
$termTimeline  = get_term_meta( $termID, 'term_timeline', true);
$termCover     = get_term_meta( $termID, 'term_cover', true); 
?>

<?php if($termTimeline): // timeline page control ?>

    <header class="tag-header" style="background-image: url(<?php echo $termCover['guid']; ?>);">
        <div class="tag-header-overlay"></div>
        <div class="container tag-header-content">
            <div class="row">
                <div class="col-xl-5 col-lg-8">

                    <h1><?php echo $termTitle; ?></h1>
                    <p>
                    <?php echo tag_description($termID); ?>
                    </p>                
                </div>
            </div>
        </div>    
    </header><!-- .tag-header  -->

    <section class="timeline">
        <div id="cd-timeline" class="cd-container">    

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    

                <div class="cd-timeline-block">

                    <?php if( has_post_thumbnail() ): ?>                    
                        <div class="cd-timeline-img cd-picture">
                            <i class="fa fa-newspaper-o"></i>   
                        </div> <!-- cd-timeline-img -->
                    <?php endif; ?>

                    <div class="cd-timeline-content">
                        <div class="thumbnail">
                            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php the_post_thumbnail('timeline'); ?>
                            </a>
                        </div>

                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                            <?php echo get_the_title(); ?>
                            </a>
                        </h2>

                        <span class="cd-date"><?php echo get_the_date("H:i j F Y"); ?></span>
                        
                        <?php /*
                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php //the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="meta-link">
                            <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                            <span class="meta-link-text"><?php _e('Haberin devamı','nayn'); ?></span>
                        </a> */ ?>

                    </div> <!-- cd-timeline-content -->
                </div> <!-- cd-timeline-block -->

            <?php endwhile; endif; ?>

        </div> <!-- #cd-timeline  -->

    </section><!-- .timeline  -->

<?php else: ?>

    <header class="tag-header tag-header--simple">
        <div class="tag-header-overlay"></div>
        <div class="container tag-header-content">
            <div class="row">
                <div class="col-xl-5 col-lg-8">
                    <h1><?php echo $termTitle; ?></h1>
                    <p>
                    <?php echo tag_description($termID); ?>
                    </p>                
                </div>
            </div>
        </div>    
    </header><!-- .tag-header -->

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

<?php endif; ?>

<?php pagination($the_query->max_num_pages, "", $paged); ?>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>