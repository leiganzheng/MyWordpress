<div id="tab-sidebar">

                <div class="widget" id="recent-posts"> 
		<h3 class="widget-title"><?php _e('Latest', 'themejunkie'); ?></h3>
		<ul>
			<?php tj_tabs_latest(get_theme_mod('tabber_popular_num'), get_theme_mod('tabber_thumb')); ?>                    
		</ul>	
	</div> <!--end #recent-posts-->

	<div class="widget" id="popular-posts">
		<h3 class="widget-title"><?php _e('热评', 'themejunkie'); ?></h3>
		<ul>
			<?php tj_tabs_popular(get_theme_mod('tabber_popular_num'), get_theme_mod('tabber_thumb')); ?>                    
		</ul>			
	 </div> <!--end #popular-posts-->
		       
		    
	<div class="widget" id="recent-comments">
		<h3 class="widget-title"><?php _e('Comments', 'themejunkie'); ?></h3>
		<ul>
			<?php tj_tabs_comments(get_theme_mod('tabber_popular_num'), get_theme_mod('tabber_thumb')); ?>                    
		</ul>
	</div> <!--end #recent-comments-->
		      
	<div class="widget widget_tag_cloud">
		<h3 class="widget-title"><?php _e('Tags', 'themejunkie'); ?></h3>
		<div>
		<?php wp_tag_cloud('unit=px&smallest=12&largest=20'); ?>
		</div>
	</div> <!--end #tag-cloud-->
	
</div> <!--end #tab-sidebar-->