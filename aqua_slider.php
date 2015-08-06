<?php
	/*
		Plugin Name: Aqua Slider
		Plugin URI: http://github.com/magnorion/aquaslider2.0
		Description: Aqua slider for wordpress
		Version: 1.0
		Author: Magnorion
		Author URI: http://github.com/magnorion/
	*/

	defined( 'ABSPATH' ) or die ( 'Plugin file cannot be accessed directly!' );
	class aqua_slider {
		public function __construct(){
			if ( is_admin() ){
				add_action( 'admin_init', array( $this, 'admin_assets' ) ); // Aqua slider admin assets
				add_action('admin_menu', array($this,"aqua_slider_load")); // Aqua Slider option ---
			}
			

			// Media assets
			add_action('admin_print_scripts', array($this,'wp_gear_manager_admin_scripts'));
			add_action('admin_print_styles', array($this,'wp_gear_manager_admin_styles'));
		}

		public function aqua_slider_load(){
			add_menu_page('Aqua Slider', 'Aqua Slider', 10, 'aqua_slider/admin/index.php','','');
		}

		public function admin_assets(){
			wp_enqueue_script('jquery');
			wp_enqueue_style("aqua-slider-admin-style",plugins_url("admin/css/style-admin.css", __FILE__ ));
			wp_enqueue_script("aqua-slider-admin-srcipt",plugins_url("admin/js/script-admin.js", __FILE__ ));
		}

		public function wp_gear_manager_admin_scripts() {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('jquery');
		}

		public function wp_gear_manager_admin_styles() {
			wp_enqueue_style('thickbox');
		}
	}

	$aqua_slider = new aqua_slider;

	function aqua_slider_get_all_params(){
		include_once("admin/data/aqua-slider-get-all-params.php");
	}

	function aqua_slider_get_all_images(){
		include_once("admin/data/aqua-slider-get-all-images.php");
	}	

	function aqua_slider_image_insert(){
		include_once("admin/data/aqua-slider-record-image.php");
	}

	function aqua_slider_remove_image(){
		include_once("admin/data/aqua-slider-remove-images.php");
	}	

	function aqua_slider_send_params(){
		include_once("admin/data/aqua-slider-send-params.php");
	}	

	function aqua_slider_send_images(){
		include_once("admin/data/aqua-slider-send-images.php");
	}

	function assets(){
		wp_enqueue_script('jquery');
		wp_enqueue_style("aqua-slider-style",plugins_url("css/aqua-style.css", __FILE__ ));
		wp_enqueue_script("aqua-slider-srcipt",plugins_url("js/aqua-script.min.js", __FILE__ ));
	}
	
	add_action( 'wp_ajax_aqua_slider_get_all_params', 'aqua_slider_get_all_params' );
	add_action( 'wp_ajax_nopriv_aqua_slider_get_all_params', 'aqua_slider_get_all_params' );

	add_action( 'wp_ajax_aqua_slider_get_all_images', 'aqua_slider_get_all_images' );
	add_action( 'wp_ajax_nopriv_aqua_slider_get_all_images', 'aqua_slider_get_all_images' );	

	add_action( 'wp_ajax_aqua_slider_image_insert', 'aqua_slider_image_insert' );
	add_action( 'wp_ajax_nopriv_aqua_slider_image_insert', 'aqua_slider_image_insert' );	

	add_action( 'wp_ajax_aqua_slider_remove_image', 'aqua_slider_remove_image' );
	add_action( 'wp_ajax_nopriv_aqua_slider_remove_image', 'aqua_slider_remove_image' );

	add_action( 'wp_ajax_aqua_slider_send_params', 'aqua_slider_send_params' );
	add_action( 'wp_ajax_nopriv_aqua_slider_send_params', 'aqua_slider_send_params' );

	add_action( 'wp_ajax_aqua_slider_send_images', 'aqua_slider_send_images' );
	add_action( 'wp_ajax_nopriv_aqua_slider_send_images', 'aqua_slider_send_images' );

	// Creating the slider function ---
	if ( !is_admin() ){
		function aquaSlider(){
			assets();
			include_once("build-slider/aqua-slider-builder.php");
		}
	}
?>