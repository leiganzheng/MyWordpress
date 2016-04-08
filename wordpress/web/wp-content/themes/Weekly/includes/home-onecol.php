<div class="onecol">

	<?php 
		if(get_theme_mod('home_onecol_cats'))
			$categories = get_categories('parent=0&orderby=id&include='.get_theme_mod('home_onecol_cats'));
		else 
			$categories = get_categories('number=1&parent=0&orderby=id&include='.get_theme_mod('home_onecol_cats'));
	    	$catcount = 0;
		
	    foreach ($categories as $cat) {
			echo '<div id="catbox1-'.$catcount.'" class="catbox';
			if(is_int($catcount/2)) echo ' catbox-even'; else echo ' catbox-odd';
			echo '">';
			
			if(get_theme_mod('home_onecol_feedlink') == 'Yes') {
				echo '<span class="cat-feedlink"><a href="'.get_category_feed_link($cat->cat_ID, '').'" title="';
				printf(__('Subscribe to %s','themejunkie'),$cat->cat_name);
				echo '">';
				printf(__('Subscribe to %s','themejunkie'),$cat->cat_name);
				echo '</a></span>'; 
			}
	
			echo '<h3 class="catbox-title"><a href="'.get_category_link($cat->cat_ID).'" title="View all posts under '.$cat->cat_name.'">'.$cat->cat_name.'</a></h3>';
			
			echo '';
	        query_posts('showposts='.get_theme_mod('home_onecol_num').'&cat='.$cat->cat_ID);
	        $postcount = 0;
	        while (have_posts()) : the_post();
	            global $post;
				include(TEMPLATEPATH. '/includes/onecol-loop.php');
	            $postcount++;
	        endwhile;
			wp_reset_query();
			
			echo '</div><!-- end .catbox -->';
			$catcount++;
	    }
	?>
	
	<div class="clear"></div>
	
</div> <!--end .onecol-->