<?php
/**
 * Plugin short codes
 * Containes short codes for layout columns, tabs, accordion, slider, carousel, posts, etc.
 */

// Helper function for removing automatic p and br tags from nested short codes
if ( ! function_exists ( 'return_clean' ) ) :
function return_clean( $content, $p_tag = false, $br_tag = false ) {
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

	if ( $br_tag )
		$content = preg_replace( '#<br \/>#', '', $content );

	if ( $p_tag )
		$content = preg_replace( '#<p>|</p>#', '', $content );

	return do_shortcode( shortcode_unautop( trim( $content ) ) );
}
endif;

/**
 * Funtion to shorten any text by characters
 */
if ( ! function_exists( 'short' ) ) :
	function short( $text, $limit )
	{
		$chars_limit = intval( $limit );
		$chars_text = strlen( $text );
		$text = strip_tags( $text );
		$text = $text . '';
		$text = substr( $text, 0, $chars_limit );
		$text = substr( $text, 0, strrpos( $text, ' ' ) );
		if ( $chars_text > $chars_limit )
		{
			$text = $text . " &hellip;";
		}
		return $text;
	}
endif;

/**
 * Function to shorten any text by word
 * Derived from http://plugins.ten-321.com/post-content-shortcodes/
 */
if ( ! function_exists( 'short_by_word' ) ) :
	function short_by_word( $text, $limit )
	{
		if ( intval( $limit ) && intval( $limit ) < str_word_count( $text ) ) {
				$text = explode( ' ', $text );
				$text = implode( ' ', array_slice( $text, 0, ( intval( $limit ) ) ) );
				$text = force_balance_tags( $text );
				$tags = array("<p>", "</p>");
				$text = str_replace($tags, "", $text);
		}
		return $text;
	}
endif;

/**
 * Get Excerpt outside of loop
 * http://pippinsplugins.com/a-better-wordpress-excerpt-by-id-function/
 */ 
if ( ! function_exists( 'get_excerpt' ) ) {
	function get_excerpt( $post, $length = 100, $tags = '<a><em><strong>' ) {
	
		if ( is_int($post) ) {
			// get the post object of the passed ID
			$post = get_post($post);
		} elseif ( ! is_object($post) ) {
			return false;
		}
		
		if ( has_excerpt($post->ID) ) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters( 'the_content', $the_excerpt );
		} else {
			$the_excerpt = $post->post_content;
		}
		
		$the_excerpt = strip_shortcodes( strip_tags($the_excerpt), $tags );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2+1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		return $the_excerpt;
	}
}

/**
 * Function to shorten any text by word
 * Derived from http://plugins.ten-321.com/post-content-shortcodes/
 */
if ( ! function_exists( 'short_by_word' ) ) :
	function short_by_word( $text, $limit )
	{
		if ( intval( $limit ) && intval( $limit ) < str_word_count( $text ) ) {
			$text = explode( ' ', $text );
			$text = implode( ' ', array_slice( $text, 0, ( intval( $limit ) ) ) );
			$text = force_balance_tags( $text );
				
			$tags = array("<p>", "</p>");
			$text = str_replace($tags, "", $text);
		}
		return $text;
	}
endif;

if ( ! function_exists ( 'col' ) ) :
	function col( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'type' => 'full',
			'xclass' => false
		), $atts ) );
		$out = sprintf( '<div class="column%s%s">%s</div>',
			' ' . esc_attr( $type ),
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
		if ( strpos( $type, 'last' ) ) {
			$out .= '<div class="clear"></div>';
		}
		return $out;
	}
endif;

if ( ! function_exists ( 'row' ) ) :
	function row( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'xclass' => false
		), $atts ) );
		$out = sprintf( '<div class="row%s">%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
		return $out;
	}
endif;

if ( ! function_exists ( 'tabs' ) ) :
	function tabs( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'xclass' => false
		), $atts ) );
		$out = sprintf( '<div class="tabber%s">%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
		return $out;
	}
endif;

if ( ! function_exists ( 'tab' ) ) :
	function tab( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'title' => 'mytab',
		  'xclass' => false
		  ), $atts ) );
		$tab_id = 'tab-' . rand( 2, 20000 );
		$out = sprintf( '<div class="tabbed%s" id="%s"><h4 class="tab_title">%s</h4>%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			esc_attr( $tab_id ),
			esc_attr( $title ),
			return_clean( $content )
		);
		return $out;
	}
endif;

if ( ! function_exists ( 'toggle' ) ) :
	function toggle( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'title' => 'mytoggle'
		  ), $atts ) );
		$out = '<h5 class="toggle">' . $title . '</h5><div class="toggle-content">' . return_clean( $content ) . '</div>';
		return $out;
	}
endif;

if ( ! function_exists ( 'accordion' ) ) :
	function accordion( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'xclass' => false
		  ), $atts ) );
		$out = sprintf( '<div class="accordion%s">%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
		return $out;
	}
endif;

if ( ! function_exists ( 'acc_item' ) ) :
	function acc_item( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'title' => 'myaccordion'
		  ), $atts ) );
		$out = '<h5 class="handle">' . $title . '</h5><div class="acc-content"><div class="acc-inner">' . return_clean( $content ) . '</div></div>';
		return $out;
	}
endif;

if ( ! function_exists ( 'box' ) ) :
	function box( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'style' 		=> '0',
		  'close_btn'	=> false,
		  'xclass'		=> false
		  ), $atts ) );
		
		$out = sprintf( '<div class="box box%s%s">%s%s</div>',
			esc_attr( $style ),
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content ),
			$close_btn ? '<span class="hide-box"></span>' : ''			
		);
		return $out;
	}
endif;

if ( ! function_exists ( 'btn' ) ) :
	function btn( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'link'		=> false,
			'color'		=> false,
			'size'		=> false,
			'target'	=> false,
			'xclass'	=> false
		), $atts ) );
	
		return sprintf( '<a href="%s" class="ss-button%s%s"%s>%s</a>',
			$link ? esc_url( $link ) : '#',
			$color ? ' ' . esc_attr( $color ) : ' default',
			$size ? ' ' . esc_attr( $size ) : '',
			$target ? ' target="' . esc_attr( $target ) . '"' : '',
			return_clean( $content )		
		);
	}
endif;

if ( ! function_exists ( 'hr' ) ) :
	function hr( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'style' => 'single',
		  'xclass' => false
		  ), $atts ) );
		$class = '';
		if ( $style == 'single' ) $class = 'hr';
		if ( $style == 'double' ) $class = 'hr-double';
		if ( $style == '3d' ) $class = 'hr-3d';
		if ( $style == 'bar' ) $class = 'hr-bar';
		if ( $style == 'dashed' ) $class = 'hr-dashed';

		return sprintf( '<div class="hr%s%s"></div>',
			' ' . esc_attr( $class ),
			$xclass ? ' ' . esc_attr( $xclass ) : ''
		);
	}
endif;

if ( ! function_exists ( 'indicator' ) ) :
	function indicator( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'label'	=> 'Label here',
			'bg'	=> '#ffcc00',
			'value'	=> '75',
		), $atts ) );
		if ( $value < 0 )
			$value = 0;
		elseif ( $value > 100 )
			$value = 100;
		return '<div class="p_bar"><div class="p_label">' . esc_attr( $label ) . '</div><div class="p_indicator"><div class="p_active" style="width:' . esc_attr( $value ) . '%; background:' . esc_attr( $bg ) . '"></div></div><div class="p_value">' . esc_attr( $value ) . '%</div></div>';
	}
endif;

if ( ! function_exists ( 'slider' ) ) :
	function slider( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'effect'			=> 'fade',
			'easing'			=> 'swing',
			'speed'				=> '600',
			'timeout'			=> '4000',
			'animationloop'		=> 'false',
			'slideshow'			=> 'true',
			'smoothheight'		=> 'true',
			'controlnav'		=> 'true',
			'directionnav'		=> 'true',
			'xclass'			=> false
		), $atts ) );
		$slider_id = 'slider-' . rand( 2, 400000 );
		if ( 'false' == $directionnav && 'false' == $controlnav ) {
			$controls_container = "''";
			$container_markup = '';
		}
		else {
			$controls_container = '"#' . $slider_id . '-controls"';
			$container_markup = '<div class="flex-controls-container main-slider" id="' . $slider_id . '-controls"></div>';
		}
		$out = sprintf( '<div class="slider-wrap clear%s">', $xclass ? ' ' . esc_attr( $xclass ) : '' );
		$out .= '<script type="text/javascript">
jQuery(window).load(function () {
    "use strict";
    var vimeoPlayers = jQuery("#' . $slider_id . '").find("iframe");
    jQuery(vimeoPlayers).each(function () {
        Froogaloop(this).addEvent("ready", ready);
    });
	function ready(player_id) {
        Froogaloop(player_id).addEvent("play", function () {
            jQuery("#' . $slider_id . '").flexslider("pause");
        });
        Froogaloop(player_id).addEvent("pause", function () {
            jQuery("#' . $slider_id . '").flexslider("play");
        });
    }
    if (jQuery.fn.flexslider) {
        jQuery("#' . $slider_id . '").flexslider({
			animation: "' . $effect . '",
			easing: "' . $easing . '",
			animationSpeed:' . $speed . ',
			slideshowSpeed:' . $timeout . ',
			selector: ".slides > .slide",
			pauseOnAction: true,
			smoothHeight: ' . $smoothheight . ',
			controlNav: ' . $controlnav . ',
			directionNav: ' . $directionnav . ',
			useCSS: false,
			prevText: "' . __( 'Prev', 'newsplus') . '",
			nextText: "' . __( 'Next', 'newsplus') . '",
			controlsContainer: ' . $controls_container . ',
			animationLoop: ' . $animationloop . ',
			slideshow: ' . $slideshow . ',
            start: function (slider) {
                jQuery(slider).removeClass("flex-loading");
            },
            before: function (slider) {
                if (slider.slides.eq(slider.currentSlide).find("iframe").length !== 0) {
                    Froogaloop(slider.slides.eq(slider.currentSlide).find("iframe").attr("id")).api("pause");
                }
            }
        });
    }
});
</script>';
		$out .= '<div class="flexslider flex-loading" id="' . $slider_id . '"><div class="slides">' . return_clean( $content, false, true ) . '</div></div></div>' . $container_markup;
		return return_clean($out, 0, 1);
	}
endif;

if ( ! function_exists ( 'slide' ) ) :
	function slide( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'xclass' => false
		), $atts ) );
		return sprintf( '<div class="slide%s">%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
	}
endif;

if ( ! function_exists ( 'slide_video' ) ) :
	function slide_video( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'src' => false,
			'xclass' => false
			), $atts ) );
		if ( $src ) {
			$player_id = 'player_' . rand( 10, 400000 );
			
			$out = sprintf( '<div class="slide%1$s"><div class="embed-wrap"><iframe id="%2$s" src="http://player.vimeo.com/video/%3$s?api=1&mp;player_id=%2$s"></iframe></div></div>',
				$xclass ? ' ' . esc_attr( $xclass ) : '',
				esc_attr( $player_id ),
				esc_attr( $src )
			)	;
		}
		else $out = '';
		return $out;
	}
endif;

if ( ! function_exists ( 'slide_text' ) ) :
	function slide_text( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'xclass' => false
		), $atts ) );

		return sprintf( '<div class="flex-caption%s">%s</div>',
			$xclass ? ' ' . esc_attr( $xclass ) : '',
			return_clean( $content )
		);
	}
endif;

if ( ! function_exists ( 'posts_slider' ) ) :
	function posts_slider( $atts ) {
		extract( shortcode_atts( array(
			'query_type'		=> 'category',
			'cats'				=> null,
			'posts'				=> null,
			'pages'				=> null,
			'tags'				=> null,
			'post_type'			=> null,
			'taxonomy'			=> null,
			'terms'				=> null,
			'blog_id'			=> null,
			'operator'			=> 'IN',
			'order'				=> 'desc',
			'orderby'			=> 'date',
			'num'				=> '2',
			'offset'			=> '0',
			'ignore_sticky'		=> 0,
			'effect'			=> 'fade',
			'easing'			=> 'swing',
			'speed'				=> '600',
			'timeout'			=> '4000',
			'animationloop'		=> 'false',
			'slideshow'			=> 'true',
			'smoothheight'		=> 'false',
			'controlnav'		=> 'true',
			'directionnav'		=> 'true',
			'excerpt_length'	=> '140',
			'use_word_length' 	=> 'false',
			'hide_excerpt'		=> 'false',
			'hide_meta'			=> 'false',
			'hide_image'		=> 'false',
			'imgwidth'			=> '800',
			'imgheight'			=> '450',
			'imgcrop'			=> 'true',
			'imgupscale'		=> 'true',
			'xclass'			=> false
		), $atts ) );

		if ( 'posts' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $posts ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'pages' == $query_type ) {
			$custom_args = array(
				'post_type'				=> 'page',
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $pages ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'tags' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tag'					=> $tags,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'cpt' == $query_type ) {
			$term_names = ( $terms ) ? explode( ',', $terms ) : null;
			$post_type  = ( $post_type ) ? explode( ',', $post_type ) : null;
			if ( $taxonomy && $term_names ) {
				$tax_query =  array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'		=> $term_names,
										'operator' 	=> $operator // Allowed values AND, IN, NOT IN
									)
				);
			}
			else {
				$tax_query = null;
			}
			$custom_args = array(
				'post_type'				=> $post_type,
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tax_query' 			=> $tax_query,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		else {
			$custom_args = array(
				'posts_per_page' 		=> $num,
				'order' 				=> $order,
				'orderby' 				=> $orderby,
				'cat' 					=> $cats,
				'offset' 				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		if ( is_multisite() ) {
			switch_to_blog( $blog_id );
		}
		$custom_query = new WP_Query( $custom_args );
		if ( $custom_query->have_posts() ) :
			$slider_id = 'slider-' . rand( 2, 20000 );
			if ( 'false' == $directionnav && 'false' == $controlnav ) {
				$controls_container = "''";
				$container_markup = '';
			}
			else {
				$controls_container = '"#' . $slider_id . '-controls"';
				$container_markup = '<div class="flex-controls-container main-slider" id="' . $slider_id . '-controls"></div>';
			}
$out = '<script type="text/javascript">
jQuery(window).load(function () {
    "use strict";
    if (jQuery.fn.flexslider) {
        jQuery("#' . $slider_id . '").flexslider({
			animation: "' . $effect . '",
			easing: "' . $easing . '",
			animationSpeed:' . $speed . ',
			slideshowSpeed:' . $timeout . ',
			selector: ".slides > .slide",
			pauseOnAction: true,
			smoothHeight: ' . $smoothheight . ',
			controlNav: ' . $controlnav . ',
			directionNav: ' . $directionnav . ',
			useCSS: false,
			prevText: "' . __( 'Prev', 'newsplus') . '",
			nextText: "' . __( 'Next', 'newsplus') . '",
			controlsContainer: ' . $controls_container . ',
			animationLoop: ' . $animationloop . ',
			slideshow: ' . $slideshow . ',
            start: function (slider) {
                jQuery(slider).removeClass("flex-loading");
            }
        });
    }
});
</script>';
			$slides = '';
			while ( $custom_query->have_posts() ) :
				$custom_query->the_post();
				global $multipage;
				$multipage = 0;
				$time = get_the_time( get_option( 'date_format' ) );
				$permalink = get_permalink();
				$title = get_the_title();
				if ( 'true' == $use_word_length ) {
					$excerpt_text = short_by_word( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				else {
					$excerpt_text = short( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				$excerpt = ( $hide_excerpt == 'true' ) ? '' : sprintf( '<p class="slide-excerpt">%1$s</p>', $excerpt_text );
				$postID = get_the_ID();
				
				$post_class_obj = get_post_class( $postID );
				$post_classes = '';
				
				if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
					foreach( $post_class_obj as $post_class ) {
						$post_classes .= ' ' . $post_class;
					}
				}					
				
				$num_comments = get_comments_number();
				
				if ( comments_open() && ( $num_comments >= 1 ) ) {
					if ( $num_comments > 1 ) {
						$comments = $num_comments . __( ' Comments', 'newsplus' );
					} else {
						$comments = __( '1 Comment', 'newsplus' );
					}
					$write_comments = sprintf( __( '<span class="sep comment-sep"></span><a href="%1$s" class="post-comment" title="Comment on %3$s">%2$s</a>', 'newsplus' ), get_comments_link(), $comments, $title );
				}
				else {
					$write_comments = '';
				}
				$post_meta = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'posts_slider_meta', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="sep category-sep"></span><span class="post-category">%5$s</span>%6$s',
						esc_url( get_permalink() ),
						esc_attr( get_the_time() ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() ),
						get_the_category_list( ', ' ),
						$write_comments
					)
				) . '</span>';
				if ( has_post_thumbnail() && 'true' !== $hide_image ) {
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'large' );
					$img = $img_src[0];
					if ( function_exists( 'aq_resize' ) ) {
						$crop = ( $imgcrop == 'false' ) ? false : true;	
						$upscale = ( $imgupscale == 'false' ) ? false : true;				
						$thumbnail = aq_resize( $img, $imgwidth, $imgheight, $crop, true, $upscale );
						
						$thumbnail = ! empty( $thumbnail ) ? $thumbnail : $img;
					}
					
					$video_icon = '';
					
					if ( 'video' == get_post_format() ) {
						$video_icon = '<div class="video-overlay"></div>';
					}
					
					$thumblink = sprintf( apply_filters( 'posts_slider_thumbnail', '<a class="slide-image" href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%4$s</a>' ), $permalink, $title, $thumbnail, $video_icon );
				}
				else {
					$thumblink = '';
				}
				$no_meta_class = ( 'true' == $hide_excerpt && 'true' == $hide_meta ) ? 'no-meta' : '';
				$format = apply_filters( 'posts_slider_output', '<div class="slide%1$s">%2$s<div class="flex-caption %3$s"><h2><a href="%4$s" title="%5$s">%5$s</a></h2>%6$s%7$s</div></div>' );
				$slides .= sprintf( $format, $post_classes, $thumblink, $no_meta_class, $permalink, $title, $excerpt, $post_meta );
			endwhile;
			$out .= sprintf( '<div class="flexslider flex-loading%s" id="%s"><div class="slides">%s</div></div>%s',
				$xclass ? ' ' . esc_attr( $xclass ) : '',
				esc_attr( $slider_id ),
				$slides,
				$container_markup
			);
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
			if ( is_multisite() ) {
				restore_current_blog(); // Restore current blog
			}
		return $out;
		endif;
	}
endif;

if ( ! function_exists ( 'posts_carousel' ) ) :
	function posts_carousel( $atts ) {
		extract( shortcode_atts( array(
			'query_type'		=> 'category',
			'cats'				=> null,
			'posts'				=> null,
			'pages'				=> null,
			'tags'				=> null,
			'post_type'			=> null,
			'taxonomy'			=> null,
			'terms'				=> null,
			'blog_id'			=> null,
			'operator'			=> 'IN',
			'order'				=> 'desc',
			'orderby'			=> 'date',
			'num'				=> '6',
			'offset'			=> '0',
			'ignore_sticky'		=> 0,
			'easing'			=> 'swing',
			'speed'				=> '600',
			'timeout'			=> '4000',
			'animationloop'		=> 'false',
			'slideshow'			=> 'true',
			'controlnav'		=> 'true',
			'directionnav'		=> 'true',
			'excerpt_length'	=> '140',
			'use_word_length'	=> 'false',
			'hide_excerpt'		=> 'false',
			'hide_meta'			=> 'false',
			'hide_image'		=> 'false',
			'hide_video'		=> 'false',
			'imgwidth'			=> '800',
			'imgheight'			=> '450',
			'imgcrop'			=> 'true',
			'imgupscale'		=> 'true',
			'xclass'			=> false
		), $atts ) );

		if ( 'posts' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $posts ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'pages' == $query_type ) {
			$custom_args = array(
				'post_type'				=> 'page',
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $pages ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'tags' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tag'					=> $tags,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'cpt' == $query_type ) {
			$term_names = ( $terms ) ? explode( ',', $terms ) : null;
			$post_type	= ( $post_type ) ? explode( ',', $post_type ) : null;
			if ( $taxonomy && $term_names ) {
				$tax_query =  array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'		=> $term_names,
										'operator' 	=> $operator // Allowed values AND, IN, NOT IN
									)
				);
			}
			else {
				$tax_query = null;
			}
			$custom_args = array(
				'post_type'				=> $post_type,
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tax_query' 			=> $tax_query,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		else {
			$custom_args = array(
				'posts_per_page' 		=> $num,
				'order' 				=> $order,
				'orderby' 				=> $orderby,
				'cat' 					=> $cats,
				'offset' 				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		if ( is_multisite() ) {
			switch_to_blog( $blog_id );
		}
		$custom_query = new WP_Query( $custom_args );
		if ( $custom_query->have_posts() ) :
			$slider_id = 'slider-' . rand( 5, 20000 );
			$out = sprintf( '<div class="slider-wrap clear%s">',
				$xclass ? ' ' . esc_attr( $xclass ) : ''
			);
			$out .= '<script type="text/javascript">
jQuery(window).load(function () {
    "use strict";
    if (jQuery.fn.flexslider) {
        var parentWidth = jQuery("#' . $slider_id . '").width(),
            item_width = Math.floor((parentWidth - 48) / 3),
            item_margin = 24,
            max_items = 3;
        if (parentWidth < 480) {
            item_width = Math.floor((parentWidth - 24) / 2);
            max_items = 2;
        }
        jQuery("#' . $slider_id . '").flexslider({
			animation: "slide",
			easing:"' . $easing . '",
			animationSpeed:' . $speed . ',
			slideshowSpeed:' . $timeout . ',
			selector: ".slides > .slide",
			useCSS:false,
			prevText: "'.__( 'Prev', 'newsplus').'",
			nextText: "'.__( 'Next', 'newsplus').'",
			controlsContainer: "#' . $slider_id . '-controls",
			animationLoop: ' . $animationloop . ',
			controlNav: ' . $controlnav . ',
			directionNav: ' . $directionnav . ',
			smoothHeight: false,
			itemWidth: item_width,
			itemMargin: item_margin,
			minItems: 1,
			maxItems: max_items,
			move: 0,
			slideshow: ' . $slideshow . ',
            start: function (slider) {
                jQuery(slider).removeClass("flex-loading");
            }
        });
    }
});
</script>';
			$slides = '';
			while ( $custom_query->have_posts() ) :
				$custom_query->the_post();
				global $multipage;
				$multipage = 0;
				$time = get_the_time( get_option( 'date_format' ) );
				$permalink = get_permalink();
				$title = get_the_title();
				if ( 'true' == $use_word_length ) {
					$excerpt_text = short_by_word( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				else {
					$excerpt_text = short( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				$excerpt = ( $hide_excerpt == 'true' ) ? '' : sprintf( '<p class="post-excerpt">%1$s</p>', $excerpt_text );
				$postID = get_the_ID();
				
				$post_class_obj = get_post_class( $postID );
				$post_classes = '';
				
				if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
					foreach( $post_class_obj as $post_class ) {
						$post_classes .= ' ' . $post_class;
					}
				}
				
				$num_comments = get_comments_number();
				if ( comments_open() && ( $num_comments >=1 ) ) {
					if ( $num_comments > 1 ) {
						$comments = $num_comments . __( ' Comments', 'newsplus' );
					} else {
						$comments = __( '1 Comment', 'newsplus' );
					}
					$write_comments = sprintf( __( '<span class="sep comment-sep"></span><a href="%1$s" class="post-comment" title="Comment on %3$s">%2$s</a>', 'newsplus' ), get_comments_link(), $comments, $title );
				}
				else {
					$write_comments = '';
				}
				$post_meta = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'posts_carousel_meta', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a>%5$s',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					$write_comments
				)
				) . '</span>';
				if ( has_post_thumbnail() && 'true' !== $hide_image ) {
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'grid_thumb' );
					$img = $img_src[0];
					if ( function_exists( 'aq_resize' ) ) {
						$crop = ( $imgcrop == 'false' ) ? false : true;	
						$upscale = ( $imgupscale == 'false' ) ? false : true;				
						$thumbnail = aq_resize( $img, $imgwidth, $imgheight, $crop, true, $upscale );
						
						$thumbnail = ! empty( $thumbnail ) ? $thumbnail : $img;
					}
					
					$video_icon = '';
					
					if ( 'video' == get_post_format() && 'true' == $hide_video ) {
						$video_icon = '<div class="video-overlay"></div>';
					}
					
					$thumblink = sprintf( apply_filters( 'posts_carousel_thumb', '<div class="post-thumb"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%4$s</a></div>' ), $permalink, $title, $thumbnail, $video_icon );
				}
				else {
					$thumblink = '';
				}
				if ( 'video' == get_post_format() && 'true' !== $hide_video ) {
					$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true );
					$pf_video = ! empty( $post_opts['pf_video'] ) ? $post_opts['pf_video'] : '';
					global $wp_embed;
					$post_embed = $wp_embed->run_shortcode( '[embed]' . $pf_video . '[/embed]' );
					if ( '' != $pf_video ) {
						$thumblink = sprintf( '<div class="embed-wrap">%1$s</div>', $post_embed );
					}
				}
				$no_meta_class = ( 'true' == $hide_excerpt && 'true' == $hide_meta ) ? 'no-meta' : '';
				$format = apply_filters( 'posts_carousel_output', '<div class="slide%1$s">%2$s<div class="entry-content %7$s"><h3><a href="%3$s" title="%4$s">%4$s</a></h3>%5$s%6$s</div></div>' );
				$slides .= sprintf ( $format, $post_classes, $thumblink, $permalink, $title, $excerpt, $post_meta, $no_meta_class );
			endwhile;
		
			$out .= sprintf( '<div class="flexslider carousel flex-loading" id="%1$s"><div class="slides">%2$s</div></div><div class="flex-controls-container" id="%1$s-controls"></div></div>',
				esc_attr( $slider_id ),
				$slides
			);
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
			if ( is_multisite() ) {
				restore_current_blog(); // Restore current blog
			}
		return $out;
		endif;
	}
endif;

if ( ! function_exists ( 'insert_posts' ) ) :
	function insert_posts( $atts ) {
		extract( shortcode_atts( array(
			'query_type'		=> 'category',
			'cats'				=> null,
			'posts'				=> null,
			'pages'				=> null,
			'tags'				=> null,
			'post_type'			=> null,
			'taxonomy'			=> null,
			'terms'				=> null,
			'blog_id'			=> null,
			'operator'			=> 'IN',
			'order'				=> 'desc',
			'orderby'			=> 'date',
			'num'				=> '4',
			'display_style'		=> 'one-col',
			'offset'			=> '0',
			'ignore_sticky'		=> 0,
			'excerpt_length'	=> '140',
			'use_word_length'	=> 'false',
			'hide_excerpt'		=> 'false',
			'hide_meta'			=> 'false',
			'hide_image'		=> 'false',
			'hide_video'		=> 'false',
			'imgwidth'			=> '',
			'imgheight'			=> '',
			'imgcrop'			=> 'true',
			'imgupscale'		=> 'true',
			'xclass'			=> false
		), $atts ) );

		if ( 'posts' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $posts ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'pages' == $query_type ) {
			$custom_args = array(
				'post_type'				=> 'page',
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $pages ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'tags' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tag'					=> $tags,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'cpt' == $query_type ) {
			$term_names = ( $terms ) ? explode( ',', $terms ) : null;
			$post_type	= ( $post_type ) ? explode( ',', $post_type ) : null;
			if ( $taxonomy && $term_names ) {
				$tax_query =  array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'		=> $term_names,
										'operator' 	=> $operator // Allowed values AND, IN, NOT IN
									)
				);
			}
			else {
				$tax_query = null;
			}
			$custom_args = array(
				'post_type'				=> $post_type,
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tax_query' 			=> $tax_query,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		else {
			$custom_args = array(
				'posts_per_page' 		=> $num,
				'order' 				=> $order,
				'orderby' 				=> $orderby,
				'cat' 					=> $cats,
				'offset' 				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		
		if ( is_multisite() ) {
			switch_to_blog( $blog_id );
		}
		
		$custom_query = new WP_Query( $custom_args );
		
		if ( $custom_query->have_posts() ) :
			
			$count = 1;
			$fclass = '';
			$lclass = '';
			$out = '';
			
			if( $display_style == 'two-col' ) {
			
				$out = sprintf( '<ul class="two-col clear%s">',
					$xclass ? ' ' . esc_attr( $xclass ) : ''
				);
				
				$imgwidth = ( '' == $imgwidth ) ? '640' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '360' : $imgheight;	
							
			}
			
			elseif ( $display_style == 'three-col' ) {
			
				$out = sprintf( '<ul class="three-col clear%s">',
					$xclass ? ' ' . esc_attr( $xclass ) : ''
				);
				
				$imgwidth = ( '' == $imgwidth ) ? '400' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '225' : $imgheight;
				
			}
			
			elseif ( $display_style == 'four-col' ) {
			
				$out = sprintf( '<ul class="four-col clear%s">',
					$xclass ? ' ' . esc_attr( $xclass ) : ''
				);
				
				$imgwidth = ( '' == $imgwidth ) ? '320' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '180' : $imgheight;
				
			}
			
			elseif ( $display_style == 'list-small' || $display_style == 'list-plain' ) {
			
				$out = sprintf( '<ul class="post-list%s">',
					$xclass ? ' ' . esc_attr( $xclass ) : ''
				);
				
				$imgwidth = ( '' == $imgwidth ) ? '128' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '96' : $imgheight;
				
			}
			
			elseif ( $display_style == 'list-big' ) {
			
				$imgwidth = ( '' == $imgwidth ) ? '320' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '180' : $imgheight;
				
			}
	
			else {			

				$imgwidth = ( '' == $imgwidth ) ? '800' : $imgwidth;
				$imgheight = ( '' == $imgheight ) ? '450' : $imgheight;
				
			}

			while ( $custom_query->have_posts() ) :
				$custom_query->the_post();
				global $multipage;
				$multipage = 0;
				$time = get_the_time( get_option( 'date_format' ) );
				$permalink = get_permalink();
				$title = get_the_title();
				if ( 'true' == $use_word_length ) {
					$excerpt_text = short_by_word( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				else {
					$excerpt_text = short( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				$excerpt = ( $hide_excerpt == 'true' ) ? '' : sprintf( '<p class="post-excerpt">%1$s</p>', $excerpt_text );
				$postID = get_the_ID();
				
				$post_class_obj = get_post_class( $postID );
				$post_classes = '';
				
				if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
					foreach( $post_class_obj as $post_class ) {
						$post_classes .= ' ' . $post_class;
					}
				}
				
				$num_comments = get_comments_number();
				if ( comments_open() && ( $num_comments >= 1 ) ) {
					if ( $num_comments > 1 ) {
						$comments = $num_comments . __( ' Comments', 'newsplus' );
					} else {
						$comments = __( '1 Comment', 'newsplus' );
					}
					$write_comments = sprintf( __( '<span class="sep comment-sep"></span><a href="%1$s" class="post-comment" title="Comment on %3$s">%2$s</a>', 'newsplus' ), get_comments_link(), $comments, $title );
				}
				else {
					$write_comments = '';
				}
				$post_meta = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'insert_posts_meta_small', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a>%5$s',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					$write_comments )
				) . '</span>';

				$post_meta_big = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'insert_posts_meta_big', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="sep category-sep"></span><span class="post-category">%5$s</span>%6$s',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					get_the_category_list( ', ' ),
					$write_comments )
				) . '</span>';

				$no_meta_class = ( 'true' == $hide_excerpt && 'true' == $hide_meta ) ? 'no-meta' : '';

				if ( has_post_thumbnail() && 'true' !== $hide_image ) {
					if ( ! function_exists( 'aq_resize' ) ) {
						if ( $display_style == 'list-small' ) {
							$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'list_small_thumb' );
						}
						elseif ( $display_style == 'list-big' ) {
							$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'list_big_thumb' );
						}
						else {
							$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'grid_thumb' );
						}
						$img = $img_src[0];
					}
					else {
						$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'full' );
						$img = $img_src[0];
						$crop = ( $imgcrop == 'false' ) ? false : true;	
						$upscale = ( $imgupscale == 'false' ) ? false : true;				
						$thumbnail = aq_resize( $img, $imgwidth, $imgheight, $crop, true, $upscale );
						
						$thumbnail = ! empty( $thumbnail ) ? $thumbnail : $img;
					}

					$thumbclass = '';
					$video_icon = '';
					
					if ( ( 'video' == get_post_format() && 'true' == $hide_video ) || ( 'video' == get_post_format() && 'list-small' == $display_style ) ) {
						$video_icon = '<div class="video-overlay"></div>';
					}
					
					if ( $display_style == 'list-big') {
						$thumblink = sprintf( apply_filters( 'insert_posts_list_big_thumbnail', '<div class="entry-list-left"><div class="post-thumb"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%4$s</a></div></div>' ), $permalink, $title, $thumbnail, $video_icon );
					}
					else {
						$thumblink = sprintf( apply_filters( 'insert_posts_grid_thumbnail','<div class="post-thumb"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%4$s</a></div>' ), $permalink, $title, $thumbnail, $video_icon );
					}
				}
				else {
					$thumblink = '';
					if ( $display_style == 'list-big' || $display_style == 'list-small' || $display_style == 'list-plain' ) {
						$thumbclass = 'no-image';
					}
				}
				
				if ( 'video' == get_post_format() && $display_style !== 'list-small' && 'true' !== $hide_video ) {
					$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true );
					$pf_video = ! empty( $post_opts['pf_video'] ) ? $post_opts['pf_video'] : '';
					global $wp_embed;
					$post_embed = $wp_embed->run_shortcode( '[embed]' . $pf_video . '[/embed]' );
					if ( '' !== $pf_video ) {
						if ( $display_style == 'list-big' ) {
							$thumblink = sprintf( '<div class="entry-list-left"><div class="embed-wrap">%1$s</div></div>', $post_embed );
							$thumbclass = '';
						}
						else {
							$thumblink = sprintf( '<div class="embed-wrap">%1$s</div>', $post_embed );
						}
					}
				}
				if ( $display_style == 'two-col' ) {
					$fclass = ( 0 == ( ( $count - 1 ) % 2 ) ) ? ' first-grid' : '';
					$lclass = ( 0 == ( $count % 2 ) ) ? ' last-grid' : '';
					$format = apply_filters( 'insert_posts_two_col_output', '<li class="entry-grid%1$s %2$s%3$s">%4$s<div class="entry-content %9$s"><h3><a href="%5$s" title="%6$s">%6$s</a></h3>%7$s%8$s</div></li>' );
					$out .= sprintf ( $format, $post_classes, $fclass, $lclass, $thumblink, $permalink, $title, $excerpt, $post_meta_big, $no_meta_class );
					$count++;
				}
				elseif ( $display_style == 'three-col' ) {
					$fclass = ( 0 == ( ( $count - 1 ) % 3 ) ) ? ' first-grid' : '';
					$lclass = ( 0 == ( $count % 3 ) ) ? ' last-grid' : '';
					$format = apply_filters( 'insert_posts_three_col_output', '<li class="entry-grid%1$s %2$s%3$s">%4$s<div class="entry-content %9$s"><h3><a href="%5$s" title="%6$s">%6$s</a></h3>%7$s%8$s</div></li>' );
					$out .= sprintf ( $format, $post_classes, $fclass, $lclass, $thumblink, $permalink, $title, $excerpt, $post_meta, $no_meta_class );
					$count++;
				}
				elseif ( $display_style == 'four-col' ) {
					$fclass = ( 0 == ( ( $count - 1 ) % 4 ) ) ? ' first-grid' : '';
					$lclass = ( 0 == ( $count % 4 ) ) ? ' last-grid' : '';
					$format = apply_filters( 'insert_posts_four_col_output', '<li class="entry-grid%1$s %2$s%3$s">%4$s<div class="entry-content %9$s"><h3><a href="%5$s" title="%6$s">%6$s</a></h3>%7$s%8$s</div></li>' );
					$out .= sprintf ( $format, $post_classes, $fclass, $lclass, $thumblink, $permalink, $title, $excerpt, $post_meta, $no_meta_class );
					$count++;
				}
				elseif ( $display_style == 'list-big' ) {
					$format = apply_filters( 'insert_posts_list_big_output', '<div class="entry-list%1$s clear %3$s">%2$s<div class="entry-list-right"><h3><a href="%4$s" title="%5$s">%5$s</a></h3>%6$s%7$s</div></div>' );
					$out .= sprintf ( $format, $post_classes, $thumblink, $thumbclass, $permalink, $title, $excerpt, $post_meta_big );
				}
				elseif ( $display_style == 'list-small' ) {
					$format = apply_filters( 'insert_posts_list_small_output', '<li class="%1$s %3$s">%2$s<div class="post-content"><h3><a href="%4$s" title="%5$s">%5$s</a></h3>%6$s</div></li>' );
					$out .= sprintf ( $format, $post_classes, $thumblink, $thumbclass, $permalink, $title, $post_meta );
				}
				elseif ( $display_style == 'list-plain' ) {
					$format = apply_filters( 'insert_posts_list_plain_output', '<li class="%1$s no-image"><h4><a href="%2$s" title="%3$s">%3$s</a></h4>%4$s</li>' );
					$out .= sprintf ( $format, $post_classes, $permalink, $title, $post_meta );
				}
				else {
					$format = apply_filters( 'insert_posts_one_col_output', '<div class="one-col%1$s entry-grid">%2$s<div class="entry-content %7$s"><h3><a href="%3$s" title="%4$s">%4$s</a></h3>%5$s%6$s</div></div>' );
					$out .= sprintf ( $format, $post_classes, $thumblink, $permalink, $title, $excerpt, $post_meta_big, $no_meta_class );
				}
			endwhile;
			if ( $display_style !== 'one-col' && $display_style !== 'list-big' )
				$out .= '</ul>';
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
			if ( is_multisite() ) {
				restore_current_blog(); // Restore current blog
			}
		return $out;
		endif;
	}
endif;

if ( ! function_exists( 'newsplus_sidebar' ) ) :
	function newsplus_sidebar( $atts ) {
		extract( shortcode_atts( array(
			'id'				=> 'default-sidebar',
			'data'				=> false,
			'xclass'			=> false
		), $atts ) );

		$data_props = $this->parse_data_attributes( $data );

		$id = sanitize_title($id);

		ob_start();
		printf( '<div class="widget-area%s"%s>',
			( $xclass ) ? ' ' . esc_attr( $xclass ) : '',
			( $data_props ) ? ' ' . esc_attr( $data_props ) : ''
		);

		if ( is_active_sidebar( $id ) ) :
			dynamic_sidebar( $id );
		endif;

		printf( '</div>' );

		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
endif;

if ( ! function_exists ( 'newsplus_grid_list' ) ) :
	function newsplus_grid_list( $atts ) {
		extract( shortcode_atts( array(
			'query_type'		=> 'category',
			'cats'				=> null,
			'posts'				=> null,
			'pages'				=> null,
			'tags'				=> null,
			'post_type'			=> null,
			'taxonomy'			=> null,
			'terms'				=> null,
			'blog_id'			=> null,
			'operator'			=> 'IN',
			'order'				=> 'desc',
			'orderby'			=> 'date',
			'display_style'		=> 's1',
			'num'				=> 5,
			'offset'			=> '0',
			'ignore_sticky'		=> 0,
			'excerpt_length'	=> '140',
			'use_word_length'	=> 'false',
			'hide_excerpt'		=> 'false',
			'hide_meta'			=> 'false',
			'imgwidth'			=> '600',
			'imgheight'			=> '600',
			'imgcrop'			=> 'true',
			'imgupscale'		=> 'true',
			'viewport_width'	=> 1192,
			'gutter'			=> 4,
			'aspect_ratio'		=> .75,
			'featured_label'	=> false,
			'xclass'			=> false
		), $atts ) );

		if ( 'posts' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $posts ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'pages' == $query_type ) {
			$custom_args = array(
				'post_type'				=> 'page',
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $pages ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'tags' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tag'					=> $tags,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'cpt' == $query_type ) {
			$term_names = ( $terms ) ? explode( ',', $terms ) : null;
			$post_type	= ( $post_type ) ? explode( ',', $post_type ) : null;
			if ( $taxonomy && $term_names ) {
				$tax_query =  array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'		=> $term_names,
										'operator' 	=> $operator // Allowed values AND, IN, NOT IN
									)
				);
			}
			else {
				$tax_query = null;
			}
			$custom_args = array(
				'post_type'				=> $post_type,
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tax_query' 			=> $tax_query,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		else {
			$custom_args = array(
				'posts_per_page' 		=> $num,
				'order' 				=> $order,
				'orderby' 				=> $orderby,
				'cat' 					=> $cats,
				'offset' 				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		
		if ( is_multisite() ) {
			switch_to_blog( $blog_id );
		}
		
		$custom_query = new WP_Query( $custom_args );
		
		if ( $custom_query->have_posts() ) :

			$out = '';
			$count = 0;
			
			$out = sprintf( '<ul class="grid-list clear%s%s">',
				' ' . esc_attr( $display_style ),
				$xclass ? ' ' . esc_attr( $xclass ) : ''
			);

			while ( $custom_query->have_posts() ) :
				$custom_query->the_post();
				global $multipage;
				$multipage = 0;
				$time = get_the_time( get_option( 'date_format' ) );
				$permalink = get_permalink();
				$title = get_the_title();
				if ( 'true' == $use_word_length ) {
					$excerpt_text = short_by_word( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				else {
					$excerpt_text = short( get_excerpt( $GLOBALS['post']->ID ), $excerpt_length );
				}
				$excerpt = ( $hide_excerpt == 'true' ) ? '' : sprintf( '<p class="post-excerpt">%1$s</p>', $excerpt_text );
				$postID = get_the_ID();
				
				$post_class_obj = get_post_class( $postID );
				$post_classes = '';
				
				if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
					foreach( $post_class_obj as $post_class ) {
						$post_classes .= ' ' . $post_class;
					}
				}
				
				$num_comments = get_comments_number();
				if ( comments_open() && ( $num_comments >= 1 ) ) {
					if ( $num_comments > 1 ) {
						$comments = $num_comments . __( ' Comments', 'newsplus' );
					} else {
						$comments = __( '1 Comment', 'newsplus' );
					}
					$write_comments = sprintf( __( '<span class="sep comment-sep"></span><a href="%1$s" class="post-comment" title="Comment on %3$s">%2$s</a>', 'newsplus' ), get_comments_link(), $comments, $title );
				}
				else {
					$write_comments = '';
				}
				
				$post_meta = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'featured_grid_meta_small', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a>%5$s',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					$write_comments )
				) . '</span>';

				$post_meta_big = ( $hide_meta == 'true' ) ? '' : '<span class="entry-meta">' . apply_filters( 'featured_grid_meta_big', sprintf( '<a href="%1$s" title="%2$s" class="post-time"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="sep category-sep"></span><span class="post-category">%5$s</span>%6$s',
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					get_the_category_list( ', ' ),
					$write_comments )
				) . '</span>';

				$no_meta_class = ( 'true' == $hide_excerpt && 'true' == $hide_meta ) ? 'no-meta' : '';

				if ( has_post_thumbnail() ) {
					if ( ! function_exists( 'aq_resize' ) ) {
						$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'grid_thumb' );
						$img = $img_src[0];
					}
					else {
						$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'full' );
						$img = $img_src[0];
						$crop = ( $imgcrop == 'false' ) ? false : true;	
						$upscale = ( $imgupscale == 'false' ) ? false : true;
						if ( $display_style == 's1' ) {							
							$imgwidth_big = (int)( ( (int)$viewport_width - (int)$gutter ) / 2 );
							$imgheight_big = (int)( $imgwidth_big * $aspect_ratio );
							
							// Round off to even value if the height is odd
							// Needed for preventing pixel fraction value like .5px
							$imgheight_big = ( $imgheight_big % 2 == 0 ) ? $imgheight_big : $imgheight_big - 1;
							
							$imgwidth_small = (int)( ( (int)$imgwidth_big - (int)$gutter ) / 2 );
							$imgheight_small = (int)( ( $imgheight_big - (int)$gutter ) / 2 );
						}
						
						if ( $display_style == 's2' ) {							
							$imgwidth_big = (int)( ( (int)$viewport_width - (int)$gutter ) / 2 );
							$imgheight_big = (int)( $imgwidth_big * 1 / $aspect_ratio );
							
							// Round off to even value if the height is odd
							// Needed for preventing pixel fraction value like .5px
							$imgheight_big = ( $imgheight_big % 2 == 0 ) ? $imgheight_big : $imgheight_big - 1;
							
							$imgwidth_small = (int)( ( (int)$imgwidth_big - (int)$gutter ) / 2 );
							$imgheight_small = (int)( ( $imgheight_big - 2 * (int)$gutter ) / 3 );
						}

						$thumbnail_big = aq_resize( $img, $imgwidth_big, $imgheight_big, $crop, true, $upscale );
						$thumbnail_small = aq_resize( $img, $imgwidth_small, $imgheight_small, $crop, true, $upscale );
						
						$thumbnail_big = ! empty( $thumbnail_big ) ? $thumbnail_big : $img;
						$thumbnail_small = ! empty( $thumbnail_small ) ? $thumbnail_small : $img;
					}

				} // has post thumbnail
				
				else {
						$thumbnail_big = plugin_dir_url( __FILE__ ) . '/dummy_image.jpg'; 
						$thumbnail_small = plugin_dir_url( __FILE__ ) . '/dummy_image.jpg';
				}				
					
				$video_icon = '<div class="hover-overlay"></div>';
				
				if ( 'video' == get_post_format() ) {
					$video_icon = '<div class="video-overlay"></div>';
				}
				
				$thumblink_big = sprintf( apply_filters( 'featured_grid_thumbnail_big','<div class="post-thumb"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%5$s%4$s</a></div>' ), $permalink, $title, $thumbnail_big, $video_icon,
				 $featured_label ? '<span class="featured-title">' . esc_attr( $featured_label ) . '</span>' : ''
				);
				
				$thumblink_small = sprintf( apply_filters( 'featured_grid_thumbnail_small','<div class="post-thumb"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" title="%2$s"/>%4$s</a></div>' ), $permalink, $title, $thumbnail_small, $video_icon );
				

				if ( $display_style == 's1' || $display_style == 's2' ) {
					if ( $count == 0 ) {
						$format = apply_filters( 'featured_grid_first_item_output', '<li class="grid-2x2">%1$s<div class="grid-content"><div class="grid-overlay"><h2><a href="%2$s" title="%3$s">%3$s</a></h2>%4$s%5$s</div></div></li>' );
						$out .= sprintf ( $format, $thumblink_big, $permalink, $title, $excerpt, $post_meta_big );
					}
					else {
						$format = apply_filters( 'featured_grid_small_items_output', '<li class="grid-1x1">%1$s<div class="grid-content"><div class="grid-overlay"><h2><a href="%2$s" title="%3$s">%3$s</a></h2>%4$s</div></div></li>' );
						$out .= sprintf ( $format, $thumblink_small, $permalink, $title, $post_meta );
					
					}
					$count++;
				}

			endwhile;
			$out .= '</ul>';
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
			if ( is_multisite() ) {
				restore_current_blog(); // Restore current blog
			}
		return $out;
		endif;
	}
endif;

if ( ! function_exists ( 'newsplus_news_ticker' ) ) :
	function newsplus_news_ticker( $atts ) {
		extract( shortcode_atts( array(
			'query_type'		=> 'category',
			'cats'				=> null,
			'posts'				=> null,
			'pages'				=> null,
			'tags'				=> null,
			'post_type'			=> null,
			'taxonomy'			=> null,
			'terms'				=> null,
			'blog_id'			=> null,
			'operator'			=> 'IN',
			'order'				=> 'desc',
			'orderby'			=> 'date',
			'num'				=> 6,
			'offset'			=> '0',
			'ignore_sticky'		=> 0,
			'title_length'		=> '10',
			'ticker_label'		=> __( 'Breaking News', 'newsplus' ),
			'xclass'			=> false
		), $atts ) );

		if ( 'posts' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $posts ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'pages' == $query_type ) {
			$custom_args = array(
				'post_type'				=> 'page',
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'post__in'				=> explode( ',', $pages ),
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'tags' == $query_type ) {
			$custom_args = array(
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tag'					=> $tags,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		elseif ( 'cpt' == $query_type ) {
			$term_names = ( $terms ) ? explode( ',', $terms ) : null;
			$post_type	= ( $post_type ) ? explode( ',', $post_type ) : null;
			if ( $taxonomy && $term_names ) {
				$tax_query =  array(
									array(
										'taxonomy'	=> $taxonomy,
										'field'		=> 'slug',
										'terms'		=> $term_names,
										'operator' 	=> $operator // Allowed values AND, IN, NOT IN
									)
				);
			}
			else {
				$tax_query = null;
			}
			$custom_args = array(
				'post_type'				=> $post_type,
				'posts_per_page'		=> $num,
				'order'					=> $order,
				'orderby'				=> $orderby,
				'tax_query' 			=> $tax_query,
				'offset'				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		else {
			$custom_args = array(
				'posts_per_page' 		=> $num,
				'order' 				=> $order,
				'orderby' 				=> $orderby,
				'cat' 					=> $cats,
				'offset' 				=> $offset,
				'post_status'			=> 'publish',
				'ignore_sticky_posts' 	=> $ignore_sticky
			);
		}
		
		if ( is_multisite() ) {
			switch_to_blog( $blog_id );
		}
		
		$custom_query = new WP_Query( $custom_args );
		
		if ( $custom_query->have_posts() ) :

			$out = sprintf( '<div class="np-news-ticker-container">%s<div class="np-news-ticker%s">',
				$ticker_label ? '<div class="ticker-label">' . esc_attr( $ticker_label ) . '</div>' : '',
				$xclass ? ' ' . esc_attr( $xclass ) : ''
			);

			while ( $custom_query->have_posts() ) :
				$custom_query->the_post();
				global $multipage;
				$multipage = 0;

				$permalink = get_permalink();
				$title = short_by_word( get_the_title(), $title_length );

				$postID = get_the_ID();
				
				$post_class_obj = get_post_class( $postID );
				$post_classes = '';
				
				if ( isset( $post_class_obj ) && is_array( $post_class_obj ) ) {
					foreach( $post_class_obj as $post_class ) {
						$post_classes .= ' ' . $post_class;
					}
				}

				$format = apply_filters( 'news_ticker_list_output', '<span><a href="%1$s" title="%2$s">%2$s</a></span>' );
				$out .= sprintf ( $format, $permalink, $title );

			endwhile;
			$out .= '</div></div>';
			wp_reset_query();
			wp_reset_postdata(); // Restore global post data
			if ( is_multisite() ) {
				restore_current_blog(); // Restore current blog
			}
		return $out;
		endif;
	}
endif;

// Register and initialize short codes
if ( ! function_exists( 'newsplus_add_shortcodes' ) ) :
	function newsplus_add_shortcodes() {
		add_shortcode( 'col', 'col' );
		add_shortcode( 'row', 'row' );
		add_shortcode( 'tabs', 'tabs' );
		add_shortcode( 'tab', 'tab' );
		add_shortcode( 'toggle', 'toggle' );
		add_shortcode( 'accordion', 'accordion' );
		add_shortcode( 'acc_item', 'acc_item' );
		add_shortcode( 'box', 'box' );
		add_shortcode( 'hr', 'hr' );
		add_shortcode( 'btn', 'btn' );
		add_shortcode( 'indicator', 'indicator' );
		add_shortcode( 'slider', 'slider' );
		add_shortcode( 'slide', 'slide' );
		add_shortcode( 'slide_video', 'slide_video' );
		add_shortcode( 'slide_text', 'slide_text' );
		add_shortcode( 'posts_slider', 'posts_slider' );
		add_shortcode( 'posts_carousel', 'posts_carousel' );
		add_shortcode( 'insert_posts', 'insert_posts' );
		add_shortcode( 'newsplus_sidebar', 'newsplus_sidebar' );
		add_shortcode( 'newsplus_grid_list', 'newsplus_grid_list' );
		add_shortcode( 'newsplus_news_ticker', 'newsplus_news_ticker' );
	}
endif;
add_action( 'init', 'newsplus_add_shortcodes' );
?>