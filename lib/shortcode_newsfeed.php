<?php # 25Feb15
function shortcode_newsfeed( $atts ) {


	// Shortcode Attrs & Variable set up
	$atts = shortcode_atts(array(
		'show'   => 2,
		'category' => '',
		'tag' => '',
		'class' => '',
		'length'   => 55,
		'morelink' => 'Read More',
		'alllink' => 'See All Posts',
		'title' => ''
	), $atts, 'newsfeed' );

	if  ( $atts['category'] != '' ) {
		$allpermalink = esc_url(get_category_link( get_category_by_slug( $atts['category'] )->term_id ));

	} elseif( $atts['tag'] != '' ) {
		$allpermalink = esc_url(get_category_link( get_cat_ID( 'Category Name' ) ));

	} else {
		$allpermalink = get_permalink( get_option( 'page_for_posts' ) );

	}


	if ( $atts['alllink'] != '' ) {
		$alllink = '<a class="blogfeed-all" href="' . $allpermalink . '">' . $atts['alllink'] . '</a>';
	}

	if ( $atts['title'] != '' ) {
		$title = '<h3><a href="' . $allpermalink . '">' . $atts['title'] . '</a></h3>';
	}


	$newsfeed = new WP_Query(array(
		'posts_per_page' => $atts['show'],
		'category_name' => $atts['category'],
		'tag' => $atts['tag'],
		'order' => 'DESC',
		'orderby' => 'date'
	));


	// Output building
		$output = '<div class="newsfeed ' . $atts['class'] . '">';
			$output .= $title;
			$output .= '<div class="skivdiv-content">';


				while ( $newsfeed->have_posts() ) {
					$newsfeed->the_post();

					$output .= '<div class="post-block">';

						// Title
							$output .= '<h4 class="post-title"><a href="' . get_permalink() . '" title="' . __( 'View - ' , 'skivvy' ) . the_title_attribute( 'echo=0' ) . '" rel="bookmark">' . get_the_title(). '</a></h4>';

						// Post Meta
							$output .= '<div class="post-meta">';
								$output .= get_the_time('F j, Y');
								$tags_list = get_the_tag_list( '', ', ' );
									if ( $tags_list ) $output .=  __( ' | ' , 'skivvy' ) . ' ' . $tags_list;
							$output .= '</div>';

						// Content
						if ($atts['length'] == '0' || $atts['length'] == 'false' ) {
							// nothing
						} else {
							$output .= get_the_snippet( $atts['length'], $atts['morelink'] );
						}

					$output .= '</div>';
				} wp_reset_postdata();

				$output .= $alllink;
				$output .= '<div class="clear"></div>';
			$output .= '</div>';
		$output .= '</div>';


	return $output;
}

add_shortcode( 'newsfeed',	'shortcode_newsfeed' );?>