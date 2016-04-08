<?php
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'themejunkie', TEMPLATEPATH . '/languages' );	

// Load functions.
require_once(TEMPLATEPATH . '/functions/comments.php');
require_once(TEMPLATEPATH . '/functions/theme-options.php');
require_once(TEMPLATEPATH . '/functions/flickr-widget.php');
require_once(TEMPLATEPATH . '/themes.php');


if (function_exists('create_initial_post_types')) create_initial_post_types(); //fix for wp 3.0
if (function_exists('add_custom_background')) add_custom_background();
if (function_exists('add_post_type_support')) add_post_type_support( 'page', 'excerpt' );

/* MENUS */
add_action( 'init', 'tj_register_my_menu' );

function tj_register_my_menu() {
   register_nav_menus(
      array(
         'header-pages' => __( 'Header Pages', 'themejunkie' ),
         'header-cats' => __( 'Header Categories', 'themejunkie' ),
         'footer-cats' => __( 'Footer Categories', 'themejunkie' )
      )
   );
}
/* MENUS END */

// Filter to new excerpt length
function tj_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'tj_excerpt_length' );

// Filter to new excerpt more text
function tj_excerpt_more($post) {
	return '... <a class="meta-more" href="'. get_permalink($post->ID) . '">'.__('Read more <span class="meta-nav">&raquo;</span>','themejunkie').'</a>';
}
add_filter('excerpt_more', 'tj_excerpt_more');
/* comment_mail_notify */
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回覆通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 有了回复，回复内容为:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看回复完整內容</a></p>
      <p>欢迎再度访问 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发出，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

/* 自動加勾選欄 */
function add_checkbox() {
  echo '<br/><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"  /><label for="comment_mail_notify">有人回复时邮件通知我</label>';
}
add_action('comment_form', 'add_checkbox');

// Register Widgets
function tj_widgets_init() {
	
	// Top Widget Area
	register_sidebar( array (
		'name' => __( 'Top Widget Area', 'themejunkie' ),
		'id' => 'top-widget-area',
		'description' => __( 'The top widget area', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Middle Left Widget Area
	register_sidebar( array (
		'name' => __( 'Middle Left Widget Area', 'themejunkie' ),
		'id' => 'middle-left-widget-area',
		'description' => __( 'The middle left widget area', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Middle Right Widget Area
	register_sidebar( array (
		'name' => __( 'Middle Right Widget Area', 'themejunkie' ),
		'id' => 'middle-right-widget-area',
		'description' => __( 'The middle right area', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Bottom Widget Area
	register_sidebar( array (
		'name' => __( 'Bottom Widget Area', 'themejunkie' ),
		'id' => 'bottom-widget-area',
		'description' => __( 'The bottom widget area', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'tj_widgets_init' );

// Register and deregister Stylesheet and Scripts files	
if(!is_admin()) {
//	add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 100 );
}
	
// function my_deregister_styles() {
//	$color_scheme = get_theme_mod('color_scheme');
//	if($color_scheme == 'Brown') 
//		wp_enqueue_style('style-brown',get_bloginfo('template_url').'/style-brown.css');
// }
	
function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );
		          if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
		wp_enqueue_script('jquery', get_bloginfo('template_url').'/js/jquery-1.3.2.min.js', false, '1.3.2');
		wp_enqueue_script('jquery-cookie', get_bloginfo('template_url').'/js/jcookie.js', true, '0.1');
		wp_enqueue_script('jquery-carousel', get_bloginfo('template_url').'/js/jcarousellite.js', true, '1.0.1');
		wp_enqueue_script('jquery-superfish', get_bloginfo('template_url').'/js/superfish.js', true, '1.0');
		wp_enqueue_script('jquery-global', get_bloginfo('template_url').'/js/global.js', true, '1.0');
		wp_enqueue_script('loopedslider', get_bloginfo('template_url').'/js/loopedslider.js', true, '0.5.6');
                wp_enqueue_script('scrolltopcontrol', get_bloginfo('template_url').'/js/scrolltopcontrol.js', true, '1.1');


	}

// Pagenavi
function tj_pagenavi($range = 9) {
	global $paged, $wp_query;
	if ( !$max_page ) { $max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		echo '<div class="pagenavi clear">';
		if(!$paged){$paged = 1;}
		echo '<span>'.$paged.' / '.$max_page.'</span>';
		previous_posts_link('&laquo; 上一页');
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";

				}
			} elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			}
		} else {
			for($i = 1; $i <= $max_page; $i++){
				echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current'";
				echo ">$i</a>";
			}
		}
		next_posts_link('下一页 &raquo;');
		echo '</div>';
	}
}

// Breadcrumb
function tj_breadcrumb() {
	 $delimiter = '';
  $name = '首页'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
	echo '当前位置:';
 
    global $post;
    $home = get_bloginfo('url');
   
	if(is_home() && get_query_var('paged') == 0) 
		echo '<span class="home">' . $name . '</span>';
	else
		echo '<a class="home" href="' . $home . '">' . $name . '</a> '. $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search for ' . get_search_query() . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore;
      single_tag_title();
      echo $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore. $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo $currentBefore . __('Page') . ' ' . get_query_var('paged') . $currentAfter;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 

}

// Get image attachment (sizes: thumbnail, medium, full)
function get_thumbnail($postid=0, $size='full') {
	if ($postid<1) 
	$postid = get_the_ID();
	$thumb_key = get_theme_mod('thumb_key');
	if($thumb_key)
		$thumb_key = $thumb_key;
	else
		$thumb_key = 'thumb';
	$thumb = get_post_meta($postid, $thumb_key, TRUE); // Declare the custom field for the image
	if ($thumb != null or $thumb != '') {
		return $thumb; 
	} elseif ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => '1',
		'post_mime_type' => 'image', ))) {
		foreach($images as $image) {
			$thumbnail=wp_get_attachment_image_src($image->ID, $size);
			return $thumbnail[0]; 
		}
	} else {
		return get_bloginfo ( 'stylesheet_directory' ).'/images/default_thumb.gif';
	}
	
}

// Automatically display/resize thumbnail
function tj_thumbnail($width, $height) {
	echo '<a href="'.get_permalink($post->ID).'" rel="bookmark"><img src="'.get_bloginfo('template_url').'/timthumb.php?src='.get_thumbnail($post->ID, 'full').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.get_the_title().'" /></a>';
}

// Get limit excerpt
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}


// Return number of posts in a Archive Page
function tj_current_postnum() {
	global $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) $paged = 1;
	if (!is_404()) 
		$begin_postnum = (($paged-1)*$posts_per_page)+1; 
	else 
		$begin_postnum = '0';
	if ($paged*$posts_per_page < $numposts) 
		$end_postnum = $paged*$posts_per_page; 
	else 
		$end_postnum = $numposts;
	$current_page_postnum = $end_postnum-$begin_postnum+1;
	return $current_page_postnum;
}

// Tabber: Get Most Popular Posts
function tj_tabs_popular( $posts = 5, $size = 35 ) {
	$popular = new WP_Query('caller_get_posts=1&orderby=comment_count&posts_per_page='.$posts);
	while ($popular->have_posts()) : $popular->the_post();
?>
<li class="clear">
 	<?php tj_thumbnail($size, $size); ?>
 	<div class="info">
 	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
 	<span class="meta"><?php comments_popup_link('0条评论', '1条评论', '%条评论', 'comments-link', ''); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

function tj_tabs_latest( $posts = 5, $size = 35 ) {
	$the_query = new WP_Query('caller_get_posts=1&showposts='. $posts .'&orderby=post_date&order=desc');	
	while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li class="clear">
	<?php if ($size <> 0) ?>
	<?php tj_thumbnail($size, $size);?>
	<div class="info">
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	<span class="meta"><?php the_time('Y年m月d日'); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

// Tabber: Get Recent Comments
function tj_tabs_comments( $posts = 5, $size = 35 ) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,65) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT ".$posts;
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	?>
	<li class="clear">
		<?php echo get_avatar( $comment, $size ); ?>
	
		<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'themejunkie'); ?> <?php echo $comment->post_title; ?>">
			<span class="comment-author"><?php echo strip_tags($comment->comment_author); ?>:</span> <span class="comment-excerpt"><?php echo strip_tags($comment->com_excerpt); ?>...</span>
		</a>
	</li>
	<?php 
	}
}

?>
<?php
//调用友情链接
function bywhy_links($link_type="txt",$get_total=0) {
	global $wpdb;
	$link_select = ($link_type == "txt") ? " = ''" : " != ''";
	$get_total = ($get_total != 0) ? "LIMIT $get_total" : "";
	$request = "SELECT link_id, link_url, link_name, link_image, link_target, link_description, link_visible, link_rating FROM $wpdb->links ";
	$request .= " WHERE $wpdb->links.link_visible = 'Y' AND $wpdb->links.link_image $link_select ";
	$request .= " ORDER BY link_rating DESC, link_id ASC $get_total";
	$links = $wpdb->get_results($request);
	foreach ($links as $link) { //调用菜单
		$output = '<li>';
		if ($link_type == "txt") $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'">'.$link->link_name.'</a>';
		else $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'"><img src="'.$link->link_image.'" alt="'.$link->link_name.'"></a>';
		$output .= '</li>'."\n";
		echo $output;
	}
}


function wumii_get_related_items() {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    
    // 该值表示是否启用无觅相关文章功能，您也可以在主题设置页提供此设置选项，然后在这里为该变量赋值
    // 例如: $is_enabled = get_option('wumii_is_enabled');
    $is_enabled = true;
    
    global $post, $wumii_should_display;
    $wumii_should_display = $is_enabled && !is_plugin_active('wumii-related-posts/wumii-related-posts.php') &&
                     get_post_status($post->ID) == 'publish' && get_post_type() == 'post' &&
                     empty($post->post_password) && !is_preview();
    if (!$wumii_should_display) {
        return;
    }
    $escapedUrl = wumii_html_escape(get_permalink());
    $escapedTitle = wumii_html_escape(the_title('', '', false));
    $escapedPic = wumii_html_escape(wumii_get_thumbnail_src());
    
    echo <<<WUMII_HOOK
    
<div class="wumii-hook">
    <input type="hidden" name="wurl" value="$escapedUrl" />
    <input type="hidden" name="wtitle" value="$escapedTitle" />
    <input type="hidden" name="wpic" value="$escapedPic" />
</div>
WUMII_HOOK;
}

function wumii_add_load_script($num = 4, $mode = 3) {
    global $wumii_should_display;
    
    if (!$wumii_should_display) {
        return;
    }
    
    $sitePrefix = function_exists('home_url') ? home_url() : get_bloginfo('url');
    $themeName = urlencode(get_current_theme());
    echo <<< WUMII_SCRIPT

<p style="margin:0;padding:0;height:1px;">
    <script type="text/javascript"><!--
        var wumiiSitePrefix = "$sitePrefix";
        var wumiiEnableCustomPos = true;
    //--></script>
    <script type="text/javascript" src="http://widget.wumii.com/ext/relatedItemsWidget.htm?type=1&amp;num=$num&amp;mode=$mode&amp;pf=WordPress&amp;theme=$themeName"></script>
</p>
WUMII_SCRIPT;
}

function wumii_html_escape($str) {
    return htmlspecialchars(html_entity_decode($str, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
}

// 如果您的主题提供了可以让用户为每篇文章设置缩略图的功能，请重写该方法。
// 返回值：文章缩略图绝对URL或null
function wumii_get_thumbnail_src() {
    if (!function_exists('get_post_thumbnail_id')) {
        return;
    }
    $image_info = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if ($image_info) {
        return $image_info[0];
    }
}

?>