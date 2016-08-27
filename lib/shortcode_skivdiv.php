<?php #12Aug16


function return_skivdiv_tags( $tag = NULL ) {
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
		'one_sixth', 'one_sixth_last',
		'five_sixth', 'five_sixth_last',
	);
	if ( is_null($tag) ) {
		return $tags;
	} else {
		return in_array( $tag, $tags );
	}
}

// Register skivdiv shortcodes
	function chunk_tags_skivdiv ( $tags ) {
		return array_merge( $tags, return_skivdiv_tags() );
	} add_filter( 'chunk_tags', 'chunk_tags_skivdiv' );



// Filter skivdiv attr
	function chunk_attr_skivdiv ( $attr, $tag ) {

		$new_attr = $attr;
		if ( return_skivdiv_tags($tag) ) {

		// if _last, add .last. But all ways use the main tag
			if ( strpos( $tag, '_last' ) !== false ) {
				$new_attr['class'] = str_replace( '_last', ' last', $tag);
			} else {
				$new_attr['class'] = $tag;
			}

		// appends the attr classes if not empty
			if ( ! empty($attr['class']) ) {
				$new_attr['class'] .= ' ' . $attr['class'];
			}
		}

		return $new_attr;

	} add_filter( 'chunk_attr', 'chunk_attr_skivdiv', 110, 2 );



// Filter SkivDiv Second tier wrapper
	function chunk_wrapper_skivdiv ( $output, $content, $title, $attr, $tag ) {

		if ( return_skivdiv_tags($tag) ) {

			if ( $tag == 'one_full' ) {
				$supwrapClass = 'page-wrapper';
			} else {
				$supwrapClass = 'skivdiv-content';
			}

			$output = '<div class="'. $supwrapClass . '">' . $output . '<div class="clear"></div>' .'</div>';

			if ( $last === true ) {
				$output .= '<div class="clear"></div>';
			}
		}
		return $output;

	} add_filter ( 'chunk_wrapper', 'chunk_wrapper_skivdiv', 90, 5);



// Filter SkivDiv Titles
	function chunk_title_skivdiv ( $title, $attr, $tag ) {

		if ( return_skivdiv_tags($tag) ) {

			if ( $attr['title'] != '' ) {
				if ( $tag == 'one_full' || $tag == 'fullwidth' ) {
					$title = '<h2>' . $title . '</h2>';
				} else {
					$title = '<h3>' . $title . '</h3>';
				}
			}
		}

		return $title;

	} add_filter( 'chunk_title', 'chunk_title_skivdiv', 100, 3);


// Enqueue Styles
	function skivdiv_enqueuer() {

		wp_enqueue_style( 'skivdiv', plugins_url('css/skivdiv.css', __FILE__), false, '09Nov15', 'all' );

	} add_action( 'wp_enqueue_scripts', 'skivdiv_enqueuer');

