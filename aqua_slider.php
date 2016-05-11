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
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) ); // Aqua slider admin assets
				add_action('admin_menu', array($this,"aqua_slider_load")); // Aqua Slider option ---
			}


			// Media assets
			add_action('admin_print_scripts', array($this,'wp_gear_manager_admin_scripts'));
			add_action('admin_print_styles', array($this,'wp_gear_manager_admin_styles'));
		}

		public function aqua_slider_load(){
			$icon = plugins_url("aquaSliderWP/admin/css/imgs/aqua-slider-ico.png");
			add_menu_page('Aqua Slider', 'Aqua Slider', 10, 'aquaSliderWP/admin/index.php','',$icon);
		}

		public function admin_assets(){
			//jQuery Core
			wp_enqueue_script("aqua-slider-admin-jquery",plugins_url("admin/assets/jquery/dist/jquery.min.js", __FILE__ ));

			// jQuery UI
			wp_enqueue_script("aqua-slider-admin-jqueryUi",plugins_url("admin/assets/jquery-ui/jquery-ui.min.js", __FILE__ ));
			wp_enqueue_style("aqua-slider-admin-jqueryUi-theme-style",plugins_url("admin/assets/jquery-ui/themes/dot-luv/theme.css", __FILE__ ));
			wp_enqueue_style("aqua-slider-admin-jqueryUi-theme-style-min",plugins_url("admin/assets/jquery-ui/themes/dot-luv/jquery-ui.min.css", __FILE__ ));

			//Font Awesome
			wp_enqueue_style("aqua-slider-admin-fontAwesome",plugins_url("admin/assets/font-awesome/css/font-awesome.min.css", __FILE__ ));

			//Admin folder ---
			wp_enqueue_style("aqua-slider-admin-style",plugins_url("admin/css/style.css", __FILE__ ));
			wp_enqueue_script("aqua-slider-admin-script",plugins_url("admin/js/script.js", __FILE__ ));

			// WP Media
			wp_enqueue_media();
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

	//Images ---
	function save_all_images(){
		include_once("admin/data/save-all-images.php");
	}
	function get_all_images(){
		include_once("admin/data/get-all-images.php");
	}
	function remove_image(){
		include_once("admin/data/remove-image.php");
	}
	// ---

	//Params
	function send_all_params(){
		include_once("admin/data/send-all-params.php");
	}
	function get_all_params(){
		include_once("admin/data/get-all-params.php");
	}
	// ---

	function assets(){
		wp_enqueue_script('jquery');
		wp_enqueue_style("aqua-slider-style",plugins_url("css/aqua-style.css", __FILE__ ));
		wp_enqueue_script("aqua-slider-srcipt",plugins_url("js/aqua-script.min.js", __FILE__ ));
	}

	// Salva/Atualiza todas as imagens
	add_action( 'wp_ajax_save_all_images', 'save_all_images' );
	add_action( 'wp_ajax_nopriv_save_all_images', 'save_all_images' );

	// Recebe todas imagens
	add_action( 'wp_ajax_get_all_images', 'get_all_images' );
	add_action( 'wp_ajax_nopriv_get_all_images', 'get_all_images' );

	// Remove imagem
	add_action( 'wp_ajax_remove_image', 'remove_image' );
	add_action( 'wp_ajax_nopriv_remove_image', 'remove_image' );

	// Envia parâmetros
	add_action( 'wp_ajax_send_all_params', 'send_all_params' );
	add_action( 'wp_ajax_nopriv_send_all_params', 'send_all_params' );

	// Recebe parâmetros
	add_action( 'wp_ajax_get_all_params', 'get_all_params' );
	add_action( 'wp_ajax_nopriv_get_all_params', 'get_all_params' );

	// Creating the slider function ---
	if ( !is_admin() ){
		function aquaSlider(){
			assets();
			include_once("build-slider/aqua-slider-builder.php");
		}
	}
?>
