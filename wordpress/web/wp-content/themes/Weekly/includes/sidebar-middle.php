<?php if ( is_active_sidebar( 'middle-left-widget-area' ) || is_active_sidebar( 'middle-right-widget-area' ) ) : ?>

<div id="middle-sidebar">

	<div class="widget-area">
	
		<?php if ( is_active_sidebar( 'middle-left-widget-area' ) ) :  ?>
			<div id="middle-left">
				<?php dynamic_sidebar( 'middle-left-widget-area'); ?>
			</div> <!--end #middle-left-->
		<?php endif; ?>
			
		<?php if ( is_active_sidebar( 'middle-right-widget-area' ) ) :  ?>
			<div id="middle-right">
				<?php dynamic_sidebar( 'middle-right-widget-area'); ?>
			</div> <!--end #middle-right-->
		<?php endif; ?>

		<?php if(get_theme_mod('sidebar_ad2_status') == 'Yes') include(TEMPLATEPATH . '/ads/sidebar-ad2.php'); ?>
		
		<div class="clear"></div>
		
	</div> <!--end #widget-area-->
	
</div> <!--end #middle-sidebar-->

<?php endif; ?>