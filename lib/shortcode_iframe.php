<?php #11Nov15

function shortcode_iframe ( $atts ) {
	$attr = shortcode_atts( array(
				'src' => '',
				'class' => '',
				'width' => '100%',
				'height' => '300'
	), $atts );
		if ( $attr['class'] ) {
			$class = 'class="'. $attr['class'] .'" ';
		}
		$output = '<iframe ' . $class . 'src="' . $attr['src'] . '" width="' . $attr['width'] . '" height="' . $attr['height'] . '" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
	return $output;
} add_shortcode( 'iframe', 'shortcode_iframe' );

?>