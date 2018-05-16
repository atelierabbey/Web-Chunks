<?php #16May18

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
// [skivdivs]
		$attr =  shortcode_atts( array(
			'id'      => '',
			'style'   => '',
			'class'   => '',
			'title'   => '',
			'func'    => '',
			'param'   => '',
			'prepend' => '',
			'before'  => '',
			'after'   => '',
			'icon'    => '',
			'iconclass' => '',
			'echoes'  => 0,
			'autop'   => TRUE,
			'data'	=> '',
		), $atts );

		// $style
			if ( $attr['style'] != '' ) {
				$style = ' style="'.$attr['style'].';"';
			}
		// $class
			if ( $attr['class'] != '' ) {
				$class = ' ' . $attr['class'];
			}
		// $id
			if ( $attr['id'] != '' ) {
				$id = ' id="' . $attr['id'] . '"';
			}
		// $last
			$last = '';
			if ( strpos( $tag, '_last' ) !== false ) {
				$tag = str_replace( '_last', ' last', $tag);
				$last = true;
			}
		// $title
			if ( $attr['title'] != '' ) {
				$titleclass = ' ' . sanitize_title( $attr['title'] );
				if ( $tag == 'one_full' || $tag == 'fullwidth' ) {
					$newtitle = '<h2>' . $attr['title'] . '</h2>';
				} else {
					$newtitle = '<h3>' . $attr['title'] . '</h3>';
				}
			}


		// RENDERING ------
			$output  = $attr['before'];
			$output .= '<div' . $id . ' class="' . $tag . $class . $titleclass . '" '. $style . $attr['data'] .'>';
				$output .= $attr['prepend'];
				$output .=	$newtitle;
				if ( $tag == 'one_full' ) {
					$output .= '<div class="page-wrapper">';
				}
					if ( $attr['icon'] != '' ) {
						$output .= do_shortcode( '[icon key="'. $attr['icon'] . '" class="'. $attr['iconclass'] . '"]' );
					}
					$output .= '<div class="skivdiv-content">';

						if ( $attr['func'] == '' ) {

							if ( $attr['autop'] !== TRUE ) {
								$output .= do_shortcode($content);
							} else {
								$output .= wpautop(do_shortcode($content));
							}

						} else {
							if ( $attr['echoes'] === 0 ) {
								// if $func( $param ) RETURN value
									$output .= call_user_func_array( $attr['func'], explode(",", $attr['param']) );
							} else {
								// if $func( $param ) ECHO value, the below function captures the buffer and returns the value as per shortcode specs.
									ob_start();
									call_user_func_array( $attr['func'], explode(",", $attr['param']) );
									$output .= ob_get_clean();
							}
						}
						$output .= '<div class="clear"></div>';
					$output .= '</div>';
				if ( $tag == 'one_full' ) {
					$output .= '<div class="clear"></div>';
					$output .= '</div>';
				}
			$output .=	'</div>';
			$output .= $attr['after'];
			if ( $last === true ) {
				$output .= '<div class="clear"></div>';
			}
		return $output;

}