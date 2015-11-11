<?php
defined('ABSPATH') or die("Ya, took a wrong turn at Albuquerque, mac!"); // Don't worry about this portion, it's for security folks.

/*
	Plugin Name: skivdiv-chunks
	Plugin URI: https://github.com/atelierabbey/Skivdiv-chunks
	Description: The ideal primer for a custom post type plugin. Simple find and replace 'skivvy_post_type', the singular name, and plural name
	Version: 11Nov15
	Author: Grayson A.C. Laramore
	License: GPL2
*/



include 'lib/shortcode_skivdiv.php';	// SkivDivs-chunks
include 'lib/shortcode_bucket.php';		// [bucket]
include 'lib/shortcode_bloginfo.php';	// [bloginfo]
include 'lib/shortcode_clearall.php';	// [clearall]
include 'lib/shortcode_lorem.php'; 		// [lorem]
include 'lib/shortcode_newsfeed.php';	// [newsfeed]
include 'lib/shortcode_iframe.php';		// [iframe]



?>