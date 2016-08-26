<?php
defined('ABSPATH') or die("Ya, took a wrong turn at Albuquerque, mac!"); // Don't worry about this portion, it's for security folks.

/*
	Plugin Name: Web Chunks
	Plugin URI: https://github.com/atelierabbey/Skivdiv-chunks
	GitHub Plugin URI: https://github.com/atelierabbey/Skivdiv-chunks
	GitHub Branch: master
	Description: Chunk up your website to create flexible, modular, and friendly divisions all across your WordPress site.
	Version: 23Aug16
	Author: Grayson A.C. Laramore
	License: GPL2
*/





// This moves the_content filter 'wptexturize' to after 'do_shortcode'. This solves a curly quote issue in nested plugins.
	   // This may be gone if future additions, I just need to figure out regex non-sense
	remove_filter('the_content', 'wptexturize');
	add_filter('the_content', 'wptexturize', 12, 1);

include 'lib/shortcode_skivdiv.php';	// SkivDivs-chunks
include 'lib/shortcode_bloginfo.php';	// [bloginfo]
include 'lib/shortcode_bucket.php';		// [bucket]
include 'lib/shortcode_clearall.php';	// [clearall]
include 'lib/shortcode_icon.php';		// [icon key="mapping"]
include 'lib/shortcode_iframe.php';		// [iframe]
include 'lib/shortcode_lorem.php'; 		// [lorem]
include 'lib/shortcode_newsfeed.php';	// [newsfeed]

include 'lib/shortcode_chunk.php';	// SkivDivs-chunks


?>