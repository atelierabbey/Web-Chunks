<?php
// Register all chunk tags to use the appropriate shortcode.
	$chunk_tags = apply_filters( 'chunk_tags', array( 'chunk' ) );
	foreach( $chunk_tags as $tag ) {
		add_shortcode( $tag, 'shortcode_chunk' );
	}

// Chunk Shortcode function
	function shortcode_chunk ( $atts, $content = null, $tag ) {

		// Shortcode Attributes
			$attr = shortcode_atts( array(
				'id'            => NULL,
				'class'         => NULL,
				'style'         => NULL,
				'title'         => NULL,
				'key'           => NULL,
				'autop'         => TRUE,
			), $atts, $tag );

			$attr    = apply_filters( 'chunk_attr', $attr, $tag ); 

			$content = apply_filters( 'chunk_content', $content, $attr, $tag );
			$title   = apply_filters( 'chunk_title', $attr['title'], $attr, $tag );
			$output  = apply_filters( 'chunk_wrapper', $content, $content, $title, $attr, $tag );
			return $output; 

	}


/*

--------  CHUNK FILTERS  --------

*/

// Excludes the filtered shortcodes from wptexturizer
	function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
		
		$chunk_tags = apply_filters( 'chunk_tags', array( 'chunk' ) );
	    return array_merge($shortcodes, $chunk_tags);
	
	} add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );

// Chunk content filter - if autop is TRUE, do autop within shortcode
	function filter_chunk_content_autop ( $content, $attr, $tag ) {
		if ( $attr['autop'] === TRUE ) {
			$content = wpautop($content);
		}
		return $content;
	} add_filter( 'chunk_content', 'filter_chunk_content_autop', 50, 3 );


// Chunk content filter - allows nesting of chunks
	function filter_chunk_content_nesting ( $content, $attr, $tag ) {
		if ( strpos( $content, '[=' ) !== FALSE ) {
			$content = str_replace ( '[=', '[', $content);
		}
		return $content;
	} add_filter( 'chunk_content', 'filter_chunk_content_nesting', 100, 3 );



// Chunk content filter - do_shortcodes
	add_filter( 'chunk_content', 'do_shortcode', 200, 1 );




// Chunk Wrapper 
	function filter_chunk_wrapper_initial ( $output, $content, $title, $attr, $tag ) {

			// Container ID
			if ( is_null($attr['id']) ) {
				$containerID = '';
			} else {
				$containerID = ' id="' . $attr['id'] . '"';
			}

		// Container classes
			if ( is_null($attr['class']) ) {
				$containerClasses = '';
			} else {
				$containerClasses = ' class="' . $attr['class'] . '"';
			}

		// Container Styles
			if ( is_null($attr['style']) ) {
				$containerStyles = '';
			} else {
				$containerStyles = ' style="' . $attr['style'] . '"';
			}

		// Return output
			$newoutput = '<div' . $containerID . $containerClasses . $containerStyles .'>';
				$newoutput .= $title;
				$newoutput .= $output;
			$newoutput .= '</div>';

			return $newoutput;

	} add_filter ( 'chunk_wrapper', 'filter_chunk_wrapper_initial', 100, 5);