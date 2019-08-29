<?php

namespace Dion;
/**
 * Includes favicon list, custom css, custom js, google analytics,
 * company dasboard widget
 *
 * @package star
 */
class DashboardSetup {


	private static $instance;

	/**
	 * Constructor. add_action and add_filters for class are here
	 *
	 * @access public
	 */
	private function __construct() {

		global $options, $wpdb;
		$this->options = $options;
		$this->wpdb = $wpdb;

		// I love the Redux Framework!
		// Default theme config.
		add_action('wp_head', array( $this, 'faviconList') );
		add_action('wp_head', array( $this, 'customCSS') );
		add_action('wp_footer', array( $this, 'customJS') );
		add_action('wp_footer', array( $this, 'googleAnalytics') );

		// Load custom dasboard widget and wp-admin logo
		//add_action( 'login_enqueue_scripts', array( $this, 'starLoginLogo') );
		//add_filter( 'login_headerurl',       array( $this, 'starLoginLogoUrl') );
		//add_filter( 'login_headertitle',     array( $this, 'starLoginLogoUrlTitle') );

		// Disable all widgets and welcome panel
		//add_action('wp_dashboard_setup', array( $this, 'disableDashboardWidgets') );
		//remove_action('welcome_panel', array( $this, 'wp_welcome_panel') );

		// Star Welcome Dasboard
		//add_action('welcome_panel', array( $this, 'starWelcomePanel') );
		//add_action('after_switch_theme',array( $this, 'starWelcomePanelInit') );

		// Admin Custom CSS
		add_action('admin_head', array( $this, 'adminCustomCss') );
	}


	public static function getInstance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new DashboardSetup;
		}

		return self::$instance;
	}
	
	/**
	 * Added favicon list
	 *
	 * @return html
	 */
	public function faviconList() {	

    	$content  ="<!-- Fav and touch icons -->\n";
    	$content .="<link rel='shortcut icon' href='".$this->options['favicon']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='57x57' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='60x60' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='72x72' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='76x76' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='114x114' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='120x120' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='144x144' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='152x152' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='apple-touch-icon' sizes='180x180' href='".$this->options['favicon512']['url']."'>\n";
    	$content .="<link rel='icon' type='image/png' href='".$this->options['favicon512']['url']."' sizes='32x32'>\n";
    	$content .="<link rel='icon' type='image/png' href='".$this->options['favicon512']['url']."' sizes='192x192'>\n";
    	$content .="<link rel='icon' type='image/png' href='".$this->options['favicon512']['url']."' sizes='96x96'>\n";
    	$content .="<link rel='icon' type='image/png' href='".$this->options['favicon512']['url']."' sizes='16x16'>\n";

    	echo $content;
	}


	/**
	 * Get redux custom css
	 *
	 * @return html
	 */
	public function customCSS() {

	    if ( isset( $this->options['customCSS'] ) ){

	    	$content  = "<style type='text/css'>\n";
	    	$content .= $this->options['customCSS']."\n";
	    	$content .= "</style>";

	    	echo $content;
	    }
	}

	/**
	 * Get redux custom js
	 *
	 * @return html
	 */
	public function customJS() {

	    if ( isset( $this->options['customJS'] ) ){

	    	$content  = "<script type='text/javascript'>\n";
	    	$content .= $this->options['customJS']."\n";
	    	$content .= "</script>";

	    	echo $content;
	    }
	}

	/**
	 * Get google analytics 
	 *
	 * @return html
	 */
	public function googleAnalytics() {

	    if ( isset( $this->options['googleAnalytics'] ) ) {

	    	$content  = "<script async src='//nayn.co/wp-content/themes/nayn/assets/js/aaa.js?id=UA-26162600-1'></script>";
	    	$content .= "<script>\n";
	    	$content .= "window.dataLayer = window.dataLayer || [];\n";
	    	$content .= "function gtag(){dataLayer.push(arguments);}\n";
	    	$content .= "gtag('js', new Date());\n";
	    	$content .= "gtag('config', 'UA-26162600-1');\n";
	    	$content .= "</script>\n";

	    	echo $content;

	    }
	}


	/**
	 * WordPress login page custom logo, description and url
	 * 
	 * @return html
	 */
	public function starLoginLogo() {
		$content  = "<style type='text/css'>";
        $content .= "body.login div#login h1 a {";
        $content .= "background-image: url(".$this->options['logo']['url'].") !important;";
        $content .= "background-size: 100% 100%;";
        $content .= "}";
    	$content .= "</style>";

    	echo $content;
	}

	/**
	 * WP login custom url
	 *
	 * @return url	 
	 */
	public function starLoginLogoUrl() {
    	return 'https://github.com/tarikcayir/star-wordpress-theme';
	}

	/**
	 * WP login custom title
	 *
	 * @return url	 
	 */
	public function starLoginLogoUrlTitle() {
    	return __('Star','star');
	}


	/**
	 * Dashboard Hack!
	 */
	public function disableDashboardWidgets() { 
	    remove_meta_box('dashboard_right_now', 'dashboard', 'core');  
	    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');  
	    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  
	    remove_meta_box('dashboard_plugins', 'dashboard', 'core');  
	    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  
	    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');  
	    remove_meta_box('dashboard_primary', 'dashboard', 'core');  
	    remove_meta_box('dashboard_activity', 'dashboard', 'core');  
	} 
	
	public function starWelcomePanel() {
	    $content  = "<div class='welcome-panel-content'>\n";
	    $content .= "<div class='welcome-panel-content__logo'\n>";
	    $content .= "<a href='https://github.com/tarikcayir/star-wordpress-theme?site='".get_bloginfo('url')."' title='Star' target='_blank'>\n";
	   	$content .= "<img src='".DION_THEME_URL."/img/star.png' alt='__('Star','star')'>\n";
	   	$content .= "</a>\n";
	   	$content .= "</div>\n";
	    $content .= "<div class='welcome-panel-content__address'>\n";
	    $content .= "Örnek Mah. Örnek Sok. No:14/A<br/>Nişantaşı / İstanbul<br/><br/>\n";
	    $content .= "+90 216 123 4567<br/><br/>\n";
	    $content .= "<a href='mailto:tarikcayir@gmail.com?Subject=Merhaba'>tarikcayir@gmail.com</a><br/>\n";
	    $content .= "</div>\n";
	    $content .= "</div>\n";

	    echo $content;
	}

	public function starWelcomePanelInit() {	    
		$this->wpdb->update( $this->wpdb->usermeta, array('meta_value'=>1), array('meta_key'=>'show_welcome_panel') );
	}

	public function adminCustomCss() {
	    /*echo '<style>
	        .welcome-panel-close,
	        #dashboard-widgets-wrap{
	            display:none;
	        }

	        .welcome-panel-content{
	            border: none;
	            padding: 20px 10px 30px;
	            max-width: 100%;
	        }
	        .welcome-panel-content__logo{
	            max-height: 106px;
	            margin: 0px auto;
	            max-width: 506px;            
	        }
	        .welcome-panel-content__logo a{
	            display: inline-block;
	        }
	        .welcome-panel-content__logo img{
	            height: auto;
	            width: 100%;
	        }
	        .welcome-panel-content__address{
	            color: #5c4a4a;
	            font-size: 30px;
	            font-weight: 600;
	            line-height: 38px;
	            margin-top: 30px;
	            text-align: center;
	        }
	        .welcome-panel-content__address a{
	            color: #5c4a4a;
	        }
	        .welcome-panel-content__address a:hover{
	            text-decoration: underline;
	        }
	    </style>';*/
	}

}

