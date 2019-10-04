<?php
/**
* theme constants
*/

define('DION_THEME_SLUG','dion');
define('DION_THEME_URL',get_stylesheet_directory_uri());
define('DION_THEME_DIR',get_stylesheet_directory());
define('DION_COMPONENTS_URL',get_stylesheet_directory_uri().'/components');


/**
 * Get theme options 
 */
global $options;
$options = get_option('dionOpt');

/*
function dionOpt($key, $applyContentFilter = false){
    global $dionOpt;

    if (isset($options[$key])) {

        $content = $options[$key];
        if ($applyContentFilter && is_string($content)) {
            return apply_filters('the_content', $content);
        }
        return $content;
    }
}
print_r($options);
*/


if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

require DION_THEME_DIR.'/inc/vendor/autoload.php';

//setting up the theme
Dion\ThemeSetup::getInstance();
Dion\DashboardSetup::getInstance();

//add_filter('redux/options/dionOpt/sections', 'dynamic_section');

global $reduxConfig;
$reduxConfig = new Dion\Admin\ReduxConfig();

//start ajax
Dion\Ajax::hooks();

//example usage of ajax class
Dion\Ajax::register('tester-event',function(){

	$success = 'successful request';
	$fail = 'failed request';

	update_option( 'dion-ajax-test', date('H:i:s') );

	if($_POST['success'] == 'yes') {

		wp_send_json_error($fail);
	} else {
		wp_send_json_success($fail);

	}
	
});

add_action('admin_init',function(){
    return;

    $content = file_get_contents(DION_THEME_DIR.'/pods.json');

    //$content =   json_decode($content);

    echo class_exists( 'Pods_Migrate_Packages' );
    if ( class_exists( 'Pods_Migrate_Packages' ) ) {

        $import = Pods_Migrate_Packages::import( $content ,false);

    } else {


        $classpath = WP_PLUGIN_DIR.'/pods/components/Migrate-Packages/Migrate-Packages.php';


        include_once($classpath);

        $import = Pods_Migrate_Packages::import( $content ,false);
    }


});

function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Widget Area',
        'id'            => 'custom-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
 
}
add_action( 'widgets_init', 'wpb_widgets_init' );

function dynamic_section($sections)
{
    //$sections = array();
    $sections[] = array(
        'title'  => __('Section via hook', 'redux-framework-demo'),
        'desc'   => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
        'icon'   => 'el-icon-paper-clip',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}


add_action( 'tgmpa_register', function(){

    $plugins = array(


        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Migrate DB',
            'slug'      => 'wp-migrate-db',
            'required'  => false,
        ),
        array(
            'name'      => 'Pods Framework',
            'slug'      => 'pods',
            'required'  => true,
        )

    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

});

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 */
function site_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
        $title = "$title $sep " . sprintf( __( 'Page %s', 'star' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'site_wp_title', 10, 2 );

function pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'sayfa/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 2,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<'),
    'next_text'       => __('>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<div class='paginations'><div class='container'><div class='row col-xl-auto'><div class='col-xl-12'>";
      echo $paginate_links;
    echo "</div></div></div></div> ";
  }
} 

/**
 * Post View Counter
 *
 * use postView(get_the_ID())
 */
function postView($postID) {
    $count_key = 'view';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count; /* so you can show it */
}

function getAvatarUrl($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}

/**
 * Edit author slug
 */
add_action('init', 'new_author_slug');
function new_author_slug() {
    global $wp_rewrite;
    $author_slug = 'profil'; 
    $wp_rewrite->author_base = $author_slug;
}

function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

/**
 * Change the pagination slug 
 * page > sayfa
 */
if ( ! function_exists( 'change_page_slug' ) ){
    register_activation_hook(   __FILE__ , 't5_flush_rewrite_on_init' );
    register_deactivation_hook( __FILE__ , 't5_flush_rewrite_on_init' );
    add_action( 'init', 'change_page_slug' );

    function change_page_slug(){
        $GLOBALS['wp_rewrite']->pagination_base = 'sayfa';
    }

    function t5_flush_rewrite_on_init(){
        add_action( 'init', 'flush_rewrite_rules', 11 );
    }
}

function re_rewrite_rules() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base    = 'sayfa';
    $wp_rewrite->flush_rules();
}
add_action('init', 're_rewrite_rules');

/**
 * Filter for adding wrappers around embedded objects
 */
function responsive_embeds( $content ) {
    $content = preg_replace( "/<object/Si", '<div class="embed-container"><object', $content );
    $content = preg_replace( "/<\/object>/Si", '</object></div>', $content );
        
    /**
     * Added iframe filtering, iframes are bad.
     */
    //$embedURL = strpos()
    $content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="embed-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
    $content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );

    return $content;
}

add_filter( 'the_content', 'responsive_embeds' );

function alx_embed_html( $html ) {
    return '<div class="embed-container">DENEME' . $html . '</div>';
}
 
//add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' );



/**
 * Add link prev and next posts
 */
add_filter('next_posts_link_attributes', 'next_post_link_attributes');
add_filter('previous_posts_link_attributes', 'prev_post_link_attributes');

function prev_post_link_attributes() {
    return 'class="post-prev"';
}

function next_post_link_attributes() {
    return 'class="post-next"';
}


/** 
 * Timeline function
 */

 function getTimelineBox($time){
    global $wp_embed;

    switch ($time['type']) {
        case 'post':

            if( $time['post_id'] ):
            $args = array(
                'p'          => $time['post_id'],
                'post_type'  => 'post',
                'order'      => 'ASC',
                'orderby'    => 'date'
            );
            $the_query = new WP_Query( $args ); 

            if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="cd-timeline-block">                   
                    <div class="cd-timeline-img cd-picture">
                        <i class="fa fa-newspaper-o"></i>   
                    </div> <!-- cd-timeline-img -->

                    <div class="cd-timeline-content">

                        <?php if( has_post_thumbnail() ): ?> 
                            <div class="thumbnail">
                                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                    <?php the_post_thumbnail('timeline'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                            <?php echo get_the_title(); ?>
                            </a>
                        </h2>

                        <span class="cd-date"><?php echo get_the_date("H:i j F Y"); ?></span>                        
                        
                        <?php /*<div class="entry-content">
                            <?php the_content(); ?>
                            <?php //the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="meta-link">
                            <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                            <span class="meta-link-text"><?php _e('Haberin devamı','nayn'); ?></span>
                        </a> */ ?>

                    </div> <!-- cd-timeline-content -->
                </div> <!-- cd-timeline-block -->
            
            <?php
            endwhile; endif; endif;

            break;        
        default: ?>

        <div class="cd-timeline-block">     

            <div class="cd-timeline-img cd-picture">
                <i class="fa fa-newspaper-o"></i>   
            </div> <!-- cd-timeline-img -->

            <div class="cd-timeline-content">
                <?php if( $time['image'] ): ?>  
                    <div class="thumbnail">                      
                        <img src="<?php echo $time['image']; ?>" alt="<?php echo $time['title']; ?>">
                    </div>
                <?php endif; ?>

                <?php if( $time['title'] ): ?> 
                    <h2><?php echo $time['title']; ?></h2>
                <?php endif; ?>                
                
                <?php if( $time['content_type'] == 1 ): ?> 
                
                    <div class="entry-content">
                        <?php echo $time['content']; ?>
                    </div>

                <?php elseif( $time['content_type'] == 2 ): ?>

                    <div class="entry-content">
                        <div class="embed-container">
                            <?php echo wp_oembed_get($time['content']); ?>
                        </div>
                    </div>                

                <?php else: ?>

                    <div class="entry-content">
                        <?php echo wp_oembed_get($time['content']); ?>
                    </div> 

                <?php endif; ?>

                <?php /*
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="meta-link">
                    <span class="meta-link-icon"><i class="fa fa-newspaper-o"></i></span>
                    <span class="meta-link-text"><?php _e('Haberin devamı','nayn'); ?></span>
                </a> */ ?>

            </div> <!-- cd-timeline-content -->
        </div> <!-- cd-timeline-block -->
            
        <?php 
        break;
    }
 }

 function add_query_vars_filter( $vars ){
    $vars[] = "view";
    return $vars;
  }
  
  add_filter( 'query_vars', 'add_query_vars_filter' );
