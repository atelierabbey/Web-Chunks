<?php
defined('ABSPATH') or die("Ya, took a wrong turn at Albuquerque, mac!"); // Don't worry about this portion, it's for security folks.

/*
	Plugin Name: skivdiv-chunks
	Plugin URI: https://github.com/atelierabbey/Skivdiv-chunks
	Description: The ideal primer for a custom post type plugin. Simple find and replace 'skivvy_post_type', the singular name, and plural name
	Version: 24Feb15
	Author: Grayson A.C. Laramore
	License: GPL2
*/

if ( ! class_exists( 'skivdiv_chunks' ) ) :

	// Include function module
		include 'inc/lib/skivvy_shortcodes.php';


	// Enqueue styles
		function skivdiv_enqueuer() {
			wp_enqueue_style( 'skivdiv', plugins_url('css/skivdiv.css', __FILE__), false, '24Feb15', 'all' );
		} add_action( 'wp_enqueue_scripts', 'skivdiv_enqueuer');

endif;
?>