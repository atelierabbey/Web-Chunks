<?php
/*
	Plugin Name: Web Chunks
	Plugin URI: https://github.com/atelierabbey/Web-Chunks
	GitHub Plugin URI: https://github.com/atelierabbey/Web-Chunks
	GitHub Branch: master
	Description: Chunk up your website to create flexible, modular, and friendly divisions all across your WordPress site.
	Version: 27Aug16
	Author: Grayson A.C. Laramore
	License: GPL2
*/

include 'lib/shortcode_skivdiv.php';	// SkivDivs - chunk filters
include 'lib/shortcode_bucket.php';		// [bucket]
include 'lib/shortcode_icon.php';		// [icon key="mapping"]
include 'lib/shortcode_newsfeed.php';	// [newsfeed]
include 'lib/shortcode_misc.php';	    // [lorem], [iframe], [clearall], [bloginfo], [style][/style], [note][/note]
include 'lib/shortcode_chunk.php';		// [chunk] & API for Webchunks

?>