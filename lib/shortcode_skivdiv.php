<?php # 25Feb15

function skivdiv_enqueuer() {
	wp_enqueue_style( 'skivdiv', plugins_url('css/skivdiv.css', __FILE__), false, '09Nov15', 'all' );
} add_action( 'wp_enqueue_scripts', 'skivdiv_enqueuer');

$tags = array(
	'fullwidth',
	'one_full',
	'one_half', 'one_half_last',
	'one_third', 'one_third_last',
	'two_third', 'two_third_last',
	'one_fourth', 'one_fourth_last',
	'three_fourth', 'three_fourth_last',
	'one_fifth', 'one_fifth_last',
	'two_fifth', 'two_fifth_last',
	'three_fifth', 'three_fifth_last',
	'four_fifth', 'four_fifth_last',
	'one_sixth','one_sixth_last',
	'five_sixth', 'five_sixth_last'
);
foreach( $tags as $tag ) {
	add_shortcode( $tag,	'shortcode_skivdiv' );
}

function shortcode_skivdiv( $atts, $content = null, $tag) {
		extract( shortcode_atts( array(
			'id'      => '',
			'style'   => '',
			'class'   => '',
			'title'   => '',
			'func'    => '',
			'param'   => '',
			'prepend' => '',
			'before'  => '',
			'after'   => '',
			'echoes'  => 0
		), $atts ) );

		// $style
			if ( !empty($style) ) {
				$style = ' style="'.$style.';"';
			}
		// $class
			if ( $class != '' ) {
				$class = ' ' . $class;
			}
		// $id
			if ( $id != '' ) {
				$id = ' id="' . $id . '"';
			}
		// $last
			$last = '';
			if ( strpos( $tag, '_last' ) !== false ) {
				$tag = str_replace( '_last', ' last', $tag);
				$last = true;
			}
		// $title
			$newtitle = '';
			$titleclass = '';
			if ( $title != '' ) {
				$titleclass = ' ' . sanitize_title( $title );
				if ( $tag == 'one_full' || $tag == 'fullwidth' ) {
					$newtitle = '<h2>' . $title . '</h2>';
				} else {
					$newtitle = '<h3>' . $title . '</h3>';
				}
			}


		// RENDERING ------
			$output  =	 $before . '<div' . $id . ' class="' . $tag . $class . $titleclass . '" '. $style . '>' . $prepend;
				$output .=	$newtitle;
				if ( $tag == 'one_full' ) $output .= '<div class="page-wrapper">';
				$output .=		'<div class="skivdiv-content">';
					if ( $func == '' ) {
							$output .= do_shortcode($content);
					} else {
						if ( $echoes === 0 ) {
							// if $func( $param ) RETURN value
								$output .= call_user_func_array( $func, explode(",", $param) );
						} else {
							// if $func( $param ) ECHO value, the below function captures the buffer and returns the value as per shortcode specs.
								ob_start();
								call_user_func_array( $func, explode(",", $param) );
								$output .= ob_get_clean();
						}
					}
				$output .=			'<div class="clear"></div>';
				$output .=		'</div>';
				if ( $tag == 'one_full' ) $output .= '</div>';
				$output .=	'</div>' . $after;
			if ( $last === true ) {
				$output .= '<div class="clear"></div>';
			}
		return $output;
}

?>