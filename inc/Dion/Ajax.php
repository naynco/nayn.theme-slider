<?php 

namespace Dion;

class Ajax {
	
	public static $instance = null;

	public static $action = 'amadeus_ajax';

	/*
	*	We'll look for that post value when $_POST['amadeus_ajax'] is set.
	*/
	public static $eventAction = 'amadeus_event';


	public $events = array();

	public static function hooks()
	{
		add_action('wp_ajax_amadeus_ajax', function(){
			Ajax::listen();
		});
		add_action('wp_ajax_nopriv_amadeus_ajax',function(){
			Ajax::listen();
		});
		

		// Back-end add ajax.js
		add_action( 'admin_enqueue_scripts', function(){
			global $wp;

			wp_enqueue_script('jquery');

			$amadeusAjax = array(
				'ajaxUrl'    => admin_url('admin-ajax.php'),
				'homeUrl'    => home_url(),
				'action'     => 'amadeus_ajax',
				'currentUrl' => home_url(add_query_arg(array(),$wp->request)),
			);

			$permalink = get_permalink();

			if( !empty($permalink) ) {
				$amadeusAjax['currentUrl'] = get_permalink();

			}

			wp_localize_script( 'ajax.js', 'siteAjax', $amadeusAjax );
		});

	}

	public function listen()
	{
		if(!isset(static::$instance)) {
			static::$instance = new self();
		}

		static::call( static::$instance );
	}


	final public static function register($event,$callback)
	{

		if(!isset(static::$instance)) {
			static::$instance = new self();
		}

		if( !in_array( $event, static::$instance->events ) ) {

			static::$instance->events[$event] = $callback;

		}
		return static::$instance;
	}

	final public static function call( Ajax $ajax )
	{

		if( isset($_REQUEST['action']) && $_REQUEST['action'] == static::$action ) {

			$event = $_REQUEST[static::$eventAction];

			if(  array_key_exists($event,$ajax->events) ) {

				call_user_func($ajax->events[$event]);
			}
			exit;
		}
	}

	public function get()
	{
		if(!isset(static::$instance)) {
			static::$instance = new self();
		}

		return( static::$instance );
	}

}