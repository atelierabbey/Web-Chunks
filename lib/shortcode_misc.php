<?php


// [lorem]
	function shortcode_loremipsum ( $atts ) {
		extract( shortcode_atts( array(
				'words' => 55
			), $atts ) );
		$lipsum = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.';
		return wp_trim_words( $lipsum , $words , '' );
	} add_shortcode( 'lorem', 	'shortcode_loremipsum' );



// [iframe]
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



// [clearall]
	function shortcode_clearall() {
		return '<div class="clear"></div>';
	} add_shortcode( 'clearall',	'shortcode_clearall' );


// [bloginfo key=""]
	function shortcode_bloginfo( $atts ) {
		extract(shortcode_atts(array(
			'key' => '',
		), $atts));
		return get_bloginfo( $key );
	} add_shortcode( 'bloginfo',	'shortcode_bloginfo' );



// [style][/style]
	function shortcode_style( $atts, $content = NULL ) {
		return '<style>' . $content . '</style>';
	} add_shortcode( 'style', 'shortcode_style' );


// [note][/note] -- Hides any content within the shortcode (Bewary of excerpts)
	function shortcode_note( $atts, $content = NULL ) {
		return;
	} add_shortcode( 'note', 'shortcode_note' );

