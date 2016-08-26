<?php

// Excludes the filtered shortcodes from wptexturizer
	function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
	    return array_merge($shortcodes, $chunk_tags);
	}
	add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );


/*
**
**    Chunk Content Filters
** 
*/
// Chunk content filter - if autop is TRUE, do autop within shortcode
	function filter_chunk_content_autop ( $content, $tag, $attr ) {
		if ( $attr['autop'] === TRUE ) {
			$content = wpautop($content);
		}
		return $content;
	}
	add_filter( 'chunk_content', 'filter_chunk_content_autop', 50, 3 );


// Chunk content filter - allows nesting of chunks
	function filter_chunk_content_nesting ( $content, $tag, $attr ) {
		if ( strpos( $content, '[=' ) !== FALSE ) {
			$content = str_replace ( '[=', '[', $content);
		}
		return $content;
	}
	add_filter( 'chunk_content', 'filter_chunk_content_nesting', 100, 3 );



// Chunk content filter - do_shortcodes
	add_filter( 'chunk_content', 'do_shortcode', 200, 1 );




// Chunk Wrapper 
	function filter_chunk_wrapper_initial ( $content, $tag, $attr ) {
			// Container ID
			if ( is_null($attr['id']) ) {
				$containerID = '';
			} else {
				$containerID = ' id="' . $attr['id'] . '"';
			}

		// Container classes
			$classes = ' class="';
				$classes .= 'chunk-' . $tag;
				if ( ! is_null($attr['class']) ) {
					$classes .= ' ' . $attr['class'];
				}
			$classes .= '"';

		// Container Styles
			if ( is_null($attr['style']) ) {
				$containerStyles = '';
			} else {
				$containerStyles = ' style="' . $attr['style'] . '"';
			}

		// Return output
			$output = '<div' . $containerID . $classes . $containerStyles .'>';

				if ( $attr['title'] ) {
					$output .= apply_filters( 'chunk_title', $attr['title'], $tag, $attr );
				}

				$output .= $content;	
			$output .= '</div>';

			return $output; 
	}
	add_filter ( 'chunk_wrapper', 'filter_chunk_wrapper_initial', 100, 3);