<?php get_header(); ?>

<div id="container">
	<div id="content" class="list-content">
		<?php 
			include(TEMPLATEPATH. '/includes/headline.php');
			
			rewind_posts();
			if (have_posts()) {
				echo '<div class="gridrow clear">';
				while (have_posts()) : the_post();
				global $post;
					include(TEMPLATEPATH. '/includes/loop.php');
					$q = $wp_query->current_post;  $maxq = tj_current_postnum(); if($q < $maxq-1 && is_int(($q+1)/2)) echo '</div><div class="gridrow clear">';
					$postcount++;
				endwhile;
				echo '</div> <!--end .gridrow-->';
			} else { 
				include(TEMPLATEPATH. '/includes/not-found.php'); 
			}
			if ( $wp_query->max_num_pages > 1 ) tj_pagenavi();
		?>
	</div><!-- #content -->
</div><!-- #container -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>