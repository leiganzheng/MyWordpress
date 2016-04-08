<div id="sidebar">
		
	<?php 
		
		if(get_theme_mod('tabber_status') == 'Yes') include(TEMPLATEPATH . '/includes/sidebar-tabber.php');

		if(get_theme_mod('sidebar_ad1_status') == 'Yes') include(TEMPLATEPATH . '/ads/sidebar-ad1.php');
		
		include(TEMPLATEPATH . '/includes/sidebar-top.php');

		include(TEMPLATEPATH . '/includes/sidebar-middle.php');
				
		include(TEMPLATEPATH . '/includes/sidebar-bottom.php');
		
		if(get_theme_mod('sidebar_ad3_status') == 'Yes') include(TEMPLATEPATH . '/ads/sidebar-ad3.php');

	?>
		
</div> <!--end #sidebar-->