<?php #2Oct15

// Simple returns '<div class="chunk-icon icon-$key $class"></div>'
// So you can style and map any images with CSS
// Likewise, you can add the icon attr to a skivdiv chunk to add the same thing outside of the .skivdiv-content
function shortcode_chunkicon ( $atts ) {
	$attr = shortcode_atts( 
				array(
					'key' => '',
					'class' => '',
					'style' => ''
				),
				$atts
			);

	if ($attr['style'] != '') {
		$style = ' style="' . $attr['style'] . '"';
	}

	return '<div class="chunk-icon icon-'. $attr['key'] .' '. $attr['class'] .'"' . $style .'></div>';
} add_shortcode( 'icon', 'shortcode_chunkicon' );
