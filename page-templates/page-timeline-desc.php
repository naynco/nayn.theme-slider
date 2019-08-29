<?php
/**
 * Default hero content
 */
get_header(); 
global $options; 

$timelineMetaBox = array_reverse(get_post_meta( $post->ID, 'timeline_box', true )); 
?>

<header class="tag-header" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>);">
    <div class="tag-header-overlay"></div>
    <div class="container tag-header-content">
        <div class="row">
            <div class="col-xl-5 col-lg-8">
                <h1><?php echo get_the_title(); ?></h1>
                <p>
                <?php echo get_the_content(); ?>
                </p>                
            </div>
        </div>
    </div>    
</header><!-- .tag-header  -->

<section class="timeline">
    <div id="cd-timeline" class="cd-container">  

        <?php 
            foreach ($timelineMetaBox as $time) {
                //print_r($time);
                getTimelineBox($time); 
            }
        ?>
        <?php ?>

            

    </div> <!-- #cd-timeline  -->

</section><!-- .timeline  -->
