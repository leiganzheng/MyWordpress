<?php
/*
 Plugin Name: NewsPlus Shortcodes
 Version: 2.4.0
 Author: Saurabh Sharma
 Author URI: http://themeforest.net/user/SaurabhSharma
 Description: Shortcodes and widgets for the NewsPlus WordPress theme
*/

class NewsPlus_Shortcodes {

	function __construct() {	
		require_once( 'shortcodes/shortcodes.php' );
		require_once( 'shortcodes/visual-shortcodes.php' );
		require_once( 'widgets/widgets.php' );
		require_once( 'includes/aq_resizer.php' );		
		add_action( 'init', array(&$this, 'init') );
	}
	
	function init() {
	
		// Translation
		load_plugin_textdomain( 'newsplus', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
		if ( ! is_admin() ) {
				
				// CSS files
				wp_enqueue_style( 'newsplus-fontawesome', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css' );
				wp_enqueue_style( 'newsplus-shortcodes', plugin_dir_url( __FILE__ ) . 'assets/css/newsplus-shortcodes.css' );
				
				// JavaScript files
				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'newsplus-custom-js', plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', array( 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion' ), '', true );
				wp_enqueue_script( 'jq-easing', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.easing.min.js', array(), '', true );
				wp_enqueue_script( 'jq-froogaloop', plugin_dir_url( __FILE__ ) . 'assets/js/froogaloop2.min.js', array(), '', true );
				wp_enqueue_script( 'jq-flex-slider', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.flexslider-min.js', array(), '', true );
				wp_enqueue_script( 'jq-marquee', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.marquee.min.js', array(), '', true );
		}
	}
}
$newsplus_shortcodes = new NewsPlus_Shortcodes();
?>