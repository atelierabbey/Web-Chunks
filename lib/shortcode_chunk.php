<?php

$chunk_tags = apply_filters( 'chunk_tags', $array( 'chunk' ) );
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

		$content = apply_filters( 'chunk_content', $content, $tag, $attr );
		$output  = apply_filters( 'chunk_wrapper', $content, $tag, $attr );
		return $output; 

}

