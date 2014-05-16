<?php
/*
Plugin Name: GMO Go to Top
Plugin URI: http://wpshop.com
Description: GMO Go to Top is simple plugin and it will add a simple button which allows users to easily scroll back to the top of the page.
Version: 1.0
Author: WP Shop byGMO
Author URI: http://wpshop.com
*/

add_action('wp_footer','go_top');

function go_top(){

//	echo '<link rel="stylesheet" src="'.plugin_dir_url( __FILE__ ) .'style.css" type="text/css" media="all" />';
	echo '<div class="gotop" style="background-image: url('.plugin_dir_url( __FILE__ ).'images/up.png);background-repeat: no-repeat;height:31px;width:31px;margin: 10px;position:fixed;right:30px;bottom:30px;cursor: pointer;"></div>';
}

function go_top_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'script', plugin_dir_url( __FILE__ ) .'script.js' );
}
add_action( 'wp_enqueue_scripts', 'go_top_scripts' );