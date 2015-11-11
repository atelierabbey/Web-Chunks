<?php # 10Nov15

// Use: [bucket title="" img="" linkto="" linktext="" class="" id="" style=""][/bucket]
function shortcode_bucket( $atts, $content = null, $tag ) {
	$attr = shortcode_atts( array(
		'url'=>'#',
		'target' => '',
		'class'=>'',
		'id'=>'',
		'style'=>'',
		'icon' => '',
		'thumb' => '',
		'img'=>'',
		'autop' => 'true',
		'xtra' => 'false',
		'title'=>'',
		'more'=>''
	), $atts );
	// Container
		// Container ID
			$id = '';
			if ( $attr['id'] != '' ){
				$id = ' id="' . $attr['id'] .'" ';
			}
		// Container class
			$class = '';
			if ( $attr['class'] != '' ) {
				$class = ' '. $attr['class'];
			}
		// Container style
			$style = '';
			if ( $attr['img'] ){
				$style .= 'background-image:url('.$attr['img'].');';
			}
			if ( $attr['style'] ){
				$style .= '' . $attr['style'];
			}
	// LinkGuts
		$linkGuts = ' href="' . $attr['url'] .'"';
		if ( $attr['target'] )
			$linkGuts .= ' target="'. $attr['target'] .'"';
		if ( $attr['more'] != '' ) {
			$linkGuts .= ' title="'. $attr['linktext']  . ' - ' . $attr['title'] .'"';
		} else {
			$linkGuts .= ' title="'. $attr['title'] .'"';
		}
	// icon
		if ( $attr['icon'] != '' ) {
			global $icon_locations;
			foreach ($icon_locations as $key => $value) {
					if ( $attr['icon'] == $key ) {
						$fileLocation = get_stylesheet_directory_uri(). '/img/'. $value;
						$fileInfo = pathinfo($fileLocation);
						$outIcon = '<a class="bucket-icon"' . $linkGuts . '>';
							if ( $fileInfo['extension'] == 'svg' ) {
								$outIcon .= file_get_contents( $fileLocation );
							} elseif ( $fileInfo['extension'] == 'png' || $fileInfo['extension'] == 'jpg' || $fileInfo['extension'] == 'gif' ) {
								$outIcon .= '<img src="'. $fileLocation . '" alt="icon-'. $key . '" >';
							} else {
								$outIcon .= $key;
							}
						
						$outIcon .= '</a>';
					}
			}
		}
	// Extra Link
		$outXLink = '';
		if ( $attr['xtra'] != 'false' || $attr['thumb'] != '' ) {
			$xlinkthumb = ' style="background-image:url('. $attr['thumb'] . ');"';
			$outXLink = '<a class="bucket-lynx" '. $linkGuts .$xlinkthumb.'></a>';
		}
	// Title
		$outTitle = '';
		if ( $attr['title'] ) {
			$outTitle = '<h3 class="bucket-title"><a' . $linkGuts . '>' . $attr['title'] .'</a></h3>';
		}
	// Content
		$outContent = '';
		if ( $content != null ) {
			$outContent .= '<span class="bucket-content">';
				if ( $attr['autop'] == 'true' ) {
					$outContent .= wpautop(do_shortcode($content));
				} else {
					$outContent .= do_shortcode($content);
				}
			$outContent .= '</span>';
		}
	// More
		$outMore = '';
		if ( $attr['more'] ) {
			$outMore = '<a class="bucket-more"' . $linkGuts . '>' . $attr['more'] . '</a>';
		}
	// RENDER
		$output = '<div' . $id . ' class="chunk-bucket'. $class . '" style="' . $style . '">';
			$output .= '<div class="bucket-wrap">';
				$output .= $outIcon;
				$output .= $outXLink;
				$output .= $outTitle;
				$output .= $outContent;
				$output .= $outMore;
				$output .= '<div class="clear"></div>';
			$output .= '</div>';
		$output .= '</div>';
	return $output;
} add_shortcode( 'bucket', 'shortcode_bucket' );

?>