<?php get_header(); ?>

<div id="container">

	<div id="content">
	
		<div class="clear">
			<?php include(TEMPLATEPATH. '/includes/home-featured.php'); ?>
			<?php include(TEMPLATEPATH. '/includes/home-latest.php'); ?>
		</div>
	
		<?php if(get_theme_mod('home_carousel_status') == "Yes") include(TEMPLATEPATH. '/includes/home-carousel.php'); ?>
		
		<?php if(get_theme_mod('home_ad1_status') == "Yes") include(TEMPLATEPATH. '/ads/home-ad1.php'); ?>
		
		<?php if(get_theme_mod('home_onecol_status') == "Yes") include(TEMPLATEPATH. '/includes/home-onecol.php'); ?>
		
		<?php if(get_theme_mod('home_ad2_status') == "Yes") include(TEMPLATEPATH. '/ads/home-ad2.php'); ?>
		
		<?php if(get_theme_mod('home_twocol_status') == "Yes") include(TEMPLATEPATH. '/includes/home-twocol.php'); ?>
		
	</div><!--end #content-->
	
</div><!--end #container-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>