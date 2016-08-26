<?php

# 24AUG16

$chunk_tags = array( 'chunk' );
$chunk_tags = apply_filters( 'chunk_tags', $chunk_tags );
foreach( $chunk_tags as $tag ) {
	add_shortcode( $tag, 'shortcode_chunk' );
}


function shortcode_chunk ( $atts, $content = null, $tag ) {

	// Shortcode Attributes
		$attr = shortcode_atts( array(
			'id'            => NULL,
			'class'         => '',
			'style'         => NULL,
			'title'         => NULL,
			'key'           => NULL,
			'autop'         => TRUE,
		), $atts, $tag );


	// Content
		
		$content = apply_filters( 'chunk_content', $content );
	// Container ID
		if ( is_null($attr['id']) ) {
			$containerID = '';
		} else {
			$containerID = ' id="' . $attr['id'] . '"';
		}

	// Container classes
		$classes = ' class="';
			$classes .= 'chunk-' . $tag;
			if ( $attr['class'] ) {
				$classes .= ' ' . $attr['class'];
			}
		$classes .= '"';

	// Container Styles
		if ( is_null($attr['class']) ) {
			$containerStyles = '';
		} else {
			$containerStyles = ' style="' . $attr['style'] . '"';
		}

	// Return output
		$output = '<div' . $containerID . $classes . $containerStyles .'>';
			$output .= $content;	
		$output .= '</div>';
		return $output; 

}


// Chunk Content filters
function filter_chunk_content_autop ($content) {
	if ( $attr['autop'] === TRUE ) {
		$content = wpautop($content);
	}
	return $content;
}

function filter_chunk_content_nesting ($content) {
	if ( strpos( $content, '[=' ) !== FALSE ) {
		$content = str_replace ( '[=', '[', $content);

		
		$content = str_replace('&#8220;', '&quot;', $content);
		$content = str_replace('&#8221;', '&quot;', $content);
	}
     return $content;
}

function filter_chunk_content_doshortcode($content) {
	// renders internal shortcodes 
	return do_shortcode($content, TRUE);
}

add_filter( 'chunk_content', 'filter_chunk_content_nesting', 100, 1 );
add_filter( 'chunk_content', 'filter_chunk_content_autop', 150, 1 );
add_filter( 'chunk_content', 'filter_chunk_content_doshortcode', 200, 1 );

