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

include 'lib/shortcode_skivdiv.php';	// SkivDivs-chunks
include 'lib/shortcode_bloginfo.php';	// [bloginfo]
include 'lib/shortcode_bucket.php';		// [bucket]
include 'lib/shortcode_clearall.php';	// [clearall]
include 'lib/shortcode_icon.php';		// [icon key="mapping"]
include 'lib/shortcode_iframe.php';		// [iframe]
include 'lib/shortcode_lorem.php'; 		// [lorem]
include 'lib/shortcode_newsfeed.php';	// [newsfeed]

include 'lib/shortcode_chunk.php';
include 'lib/filters-chunk.php';

?>