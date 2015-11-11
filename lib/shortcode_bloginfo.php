<?php #25Feb15

function shortcode_bloginfo( $atts ) {
	extract(shortcode_atts(array(
		'key' => '',
	), $atts));
	return get_bloginfo( $key );
} add_shortcode( 'bloginfo',	'shortcode_bloginfo' );


?>