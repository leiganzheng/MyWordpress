<?php 
		$home_carousel_title = get_theme_mod('home_carousel_title');
		$home_carousel_from = get_theme_mod('home_carousel_from');
		$home_carousel_cat = get_theme_mod('home_carousel_cat');
		$home_carousel_num = get_theme_mod('home_carousel_num');
?>
	
<div id="carousel">
	<h3>
		<span class="pc-next">&gt;&gt;</span>
		<span class="pc-prev">&lt;&lt;</span>
		<span>
		<?php
			if($home_carousel_title)
				echo $home_carousel_title;
			elseif($home_carousel_from == 'A Category')
				echo get_cat_name($home_carousel_cat);
			else 
				echo 'Carousel';
		?>
		</span>
	</h3>
	<div class="carousel-posts">
		<ul>
			<?php 
			
				if($home_carousel_from == 'All Categories') {
						query_posts('showposts='.$home_carousel_num.'&caller_get_posts=1');
					} else {
						query_posts('cat='.$home_carousel_cat.'&showposts='.$home_carousel_num.'&caller_get_posts=1');
					}
					while(have_posts()) : the_post(); 
				?>
				
				<li class="item">
				<?php tj_thumbnail(128,get_theme_mod('home_carousel_thumb_height')); ?>
				<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
				</li>
				<?php endwhile; wp_reset_query(); ?>
		</ul>
	</div> <!--end .carousel-posts-->
</div><!--end #carousel-->