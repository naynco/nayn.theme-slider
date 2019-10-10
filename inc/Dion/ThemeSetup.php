<?php

namespace Dion;
/**
 * Includes standart theme functions, theme styles, scripts for both 
 * frontend and backend
 *
 * @package wpdion
 */
class ThemeSetup {


	private static $instance;

	/**
	 * Constructor. add_action and add_filters for class are here
	 *
	 * @access public
	 */
	private function __construct()
	{
		//check version first
		$this->checkPhpVersion();

		add_action('after_setup_theme',array($this,'themeSetup'));

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'adminStyles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'adminScripts' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );


		add_action( 'widgets_init', array( $this, 'widgets' ) );


	}


	public static function getInstance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new ThemeSetup;
		}

		return self::$instance;
	}
	
	/**
	* Standart wordpress theme setup functions
	*
	*/
	public function themeSetup()
	{

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );


		
		add_image_size('hero', 1920, 1080, true );	
		add_image_size('hero-news', 480, 250, true );	
		add_image_size('timeline', 768, 450, true );		
		//add_image_size('660x400', 660, 400, true );		
		//add_image_size('810x431', 810, 431, true );			

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files
		 */
		load_theme_textdomain( DION_THEME_SLUG, get_template_directory() . '/languages' );
		

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );


		/**
		 * More menus can be added if necessary
		 */
		register_nav_menus( array(
			'primary' => __( 'Ana Menü', DION_THEME_SLUG ),
			'footer-section' => __( 'Alt Menü', DION_THEME_SLUG ),
		) );


	}
	/**
	* Theme CSS Files
	*/
	public function styles()
	{
		wp_enqueue_style('theme-style', get_stylesheet_uri() );
		wp_enqueue_style('bootstrap',DION_THEME_URL.'/assets/css/bootstrap.min.css');
		wp_enqueue_style('font-awesome',DION_THEME_URL.'/assets/css/font-awesome.min.css');
		wp_enqueue_style('owl-carousel',DION_THEME_URL.'/assets/css/owl.carousel.min.css');
		wp_enqueue_style('main',DION_THEME_URL.'/assets/css/main.min.css', array(), '1.2', false);
	}

	/**
	* Admin CSS Files
	*/
	public function adminStyles()
	{
		wp_enqueue_style('wp-admin-main',DION_THEME_URL.'/assets/css/wp-admin.min.css', array(), '1.1', false);
	}


	/*
	* Theme JS Files
	*
	* uses: wp_register_script & wp_enqueue_script
	* If any javascript (jquery, backbone, plupload etc.) that is shipped with
	* WordPress is going to be used, should be used from the wordpress core
	* see: http://codex.wordpress.org/Function_Reference/wp_enqueue_script#Default_Scripts_Included_and_Registered_by_WordPress
	*/
	public function scripts()
	{

		wp_enqueue_script('jquery');

		// If using the regular comments of wordpress
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		//put modernizr as late as possible
		wp_enqueue_script('bootstrap',DION_THEME_URL.'/assets/js/bootstrap.min.js');
		wp_enqueue_script('owl-carousel',DION_THEME_URL.'/assets/js/owl.carousel.min.js');
		wp_enqueue_script('zuck',DION_THEME_URL.'/assets/js/zuck.min.js');
		wp_enqueue_script('main',DION_THEME_URL.'/assets/js/main.min.js');
	}

	/**
	* Admin JS files
	*/
	public function adminScripts()
	{
		
	}

	/**
	 * Widgets
	 * 
	 */
	function widgets() {
		register_sidebar( array(
			'name'          => __( 'Genel Bileşenler', '_s' ),
			'id'            => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//it should be at least 5.3.7
	function checkPhpVersion()
	{
		$version = explode('.', PHP_VERSION);

		$message =  'Php version must be at least 5.3.7 for wpdiontheme to work. Please upgrade.';

		if (strnatcmp(phpversion(),'5.3.7') >= 0) 
	    { 
	    	// do nothing
	    } 
	    else 
	    { 
			die($message); 
	    }  
	}

	


}

