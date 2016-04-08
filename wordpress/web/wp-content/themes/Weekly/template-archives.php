<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="container">

	<div id="content">
		
		<?php the_post(); ?>
			
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry">
    	
				<!--Latest Posts-->
				<h2>
					<?php $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
						  if (0 < $numposts) $numposts = number_format($numposts); ?>
					<?php echo '本站共有 '.$numposts.' 篇文章:'; ?>
				</h2>
				<ul>
					<?php
					$myposts = get_posts('numberposts=-1&');
					foreach($myposts as $post) : ?>
						<li><?php the_time('m/d/y') ?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>

				
				<!--Categories-->
				<h3><?php _e('Categories', 'themejunkie'); ?>:</h3>
				<ul>
					<?php wp_list_categories('title_li='); ?>
				</ul>
        
				<!--Monthly Archive-->
				<h3><?php _e('Monthly Archive', 'themejunkie'); ?>:</h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				
			</div> <!--end .entry-->
	
		</div> <!--end #post-->
		
	</div><!--end #content-->
		
</div><!--end #container-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>