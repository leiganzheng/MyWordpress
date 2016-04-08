<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' — '; } ?> <?php bloginfo('name'); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" />

	<?php wp_head(); ?>

	<!--begin of header code-->
	
		<?php if(get_theme_mod('head_code_status') == "Yes") echo stripslashes(get_theme_mod('head_code')); ?>
	<!--end of header code-->

	<!--[if lt IE 7]>
	
	<style type="text/css"> 
		body {behavior:url("<?php bloginfo( 'template_url' ); ?>/js/csshover3.htc");}
	</style>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
	<script type="text/javascript">
			DD_belatedPNG.fix('#image-logo a, .cat-feedlink a,.pc-feedlink a, .sf-sub-indicator, .pc-next, .pc-prev, .backtotop');
	</script>
	
	<![endif]-->
</head>

<body <?php body_class(); ?>>

<?php if (is_home()) add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3); ?> 
<?php if (is_category()) add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3); ?> 

<div id="wrapper">
	<div id="top">
		
		<div id="search">
			<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/search">
				<input type="text" class="field" name="q" id="s"  value="<?php _e('Search in this site...', 'themejunkie') ?>" onfocus="if (this.value == '<?php _e('Search in this site...', 'themejunkie') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search in this site...', 'themejunkie') ?>';}" />
				<input class="submit btn" type="image" src="<?php bloginfo('template_directory'); ?>/images/icon-search.gif" value="Go" />
			</form>

		</div><!--end #search -->

<!--begin of top navigation-->			
		<div class="topnav">	
		<?php 
			$pagesNav = '';
			if (function_exists('wp_nav_menu')) {
				$pagesNav = wp_nav_menu( array( 'theme_location' => 'header-pages', 'menu_class' => 'topnav', 'menu_id' => 'page-nav', 'echo' => false, 'fallback_cb' => '' ) );};
			if ($pagesNav == '') { ?>
			<ul id="page-nav" class="topnav">
				<?php wp_list_pages('title_li='); ?>

			</ul>
		<?php }
			else echo($pagesNav); 
		?>
<!--end of topnavigation-->

<!--begin of top social links-->		
		<?php if (get_theme_mod('social_status') == 'Yes') { ?>
			<ul class="topnav top-social">
				<li><a class="top-rss" href="http://feeds.feedburner.com/<?php echo get_theme_mod('feedburner_id'); ?>" rel="nofollow" target="_blank"><?php _e('RSS', 'themejunkie') ?></a></li>
				<li><a class="top-email" href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_theme_mod('feedburner_id'); ?>&amp;loc=en_US" rel="nofollow" target="_blank">Email</a></li>
			</ul>
		<?php } ?>	
    	</div> <!--end .top-social-->
<!--end of top social links-->    	
    	
    </div> <!--end #top-->
    	
	<div id="header">

		<?php 
			if(get_theme_mod('logo') == 'Image Logo') $logo_class = 'image-logo';
			if(get_theme_mod('logo') == 'Text Logo') $logo_class = 'text-logo';
		?>
		
		<?php if ( is_home() || is_front_page() ) echo '<h1'; else echo '<div'; echo ' class="logo" id="'.$logo_class.'">'; ?>
		
		<a <?php if(get_theme_mod('logo') == 'Image Logo' && get_theme_mod('logo_url')) {echo 'style="background:url('.get_theme_mod('logo_url').') no-repeat" ';} ?>href="<?php bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?> <span class="desc"><?php bloginfo( 'description' ); ?></span></a>
		
		<?php if ( is_home() || is_front_page() ) echo '</h1>'; else echo '</div>'; ?>
		
	<?php if(get_theme_mod('header_ad_status') == "Yes") include(TEMPLATEPATH. '/ads/header-ad.php'); ?>
		
		<div class="clear"></div>
		
	</div><!-- #header -->

	<div id="cat-menu">
	    	
		<?php 
			$catNav = '';
			if (function_exists('wp_nav_menu')) {
				$catNav = wp_nav_menu( array( 'theme_location' => 'header-cats', 'menu_class' => 'nav', 'menu_id' => 'cat-nav', 'echo' => false, 'fallback_cb' => '' ) );};
			if ($catNav == '') { ?>
				<ul id="cat-nav" class="nav">
					<li class="first"><a href="<?php bloginfo('siteurl'); ?>"><?php _e('Home', 'themejunkie'); ?></a></li>
					<?php wp_list_categories('title_li=&orderby=id'); ?>
				</ul>
		<?php } else echo($catNav); ?>	 
        
	</div> <!--end #cat-nav-->

	
	<div id="breadcrumb" class="clear">
		
		

<span id=localtime class="current-time">
<script type="text/javascript">
function showLocale(objD)
{
var str,colorhead,colorfoot;
var yy = objD.getYear();
if(yy<1900) yy = yy+1900;
var MM = objD.getMonth()+1;
if(MM<10) MM = '0' + MM;
var dd = objD.getDate();
if(dd<10) dd = '0' + dd;
var hh = objD.getHours();
if(hh<10) hh = '0' + hh;
var mm = objD.getMinutes();
if(mm<10) mm = '0' + mm;
var ss = objD.getSeconds();
if(ss<10) ss = '0' + ss;
var ww = objD.getDay();
if ( ww==0 ) colorhead="<font color=\"#000\">";
if ( ww > 0 && ww < 6 ) colorhead="<font color=\"#000\">";
if ( ww==6 ) colorhead="<font color=\"#000\">";
if (ww==0) ww="星期日";
if (ww==1) ww="星期一";
if (ww==2) ww="星期二";
if (ww==3) ww="星期三";
if (ww==4) ww="星期四";
if (ww==5) ww="星期五";
if (ww==6) ww="星期六";
colorfoot="</font>"
str = colorhead + yy + "年" + MM + "月" + dd + "日 " + hh + ":" + mm + ":" + ss + " " + ww + colorfoot;
return(str);
}
function tick()
{
var today;
today = new Date();
document.getElementById("localtime").innerHTML = showLocale(today);
window.setTimeout("tick()", 1000);
}
tick();
</script>
</span>
<?php tj_breadcrumb(); ?>
	</div>

	<div id="main" class="clear">