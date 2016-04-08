<?php $post = $posts[0]; ?>
<div class="headline">
<span class="display" title="<?php _e('Change Layout','themejunkie'); ?>"><?php _e('List/Grid','themejunkie'); ?></span>			
<h1>
<?php if (is_category()) : ?>
<?php printf( __('%s', 'themejunkie' ), get_cat_name($cat) ); ?>

<span class="single-cat-feedlink cat-feedlink"><a href="<?php echo get_category_feed_link($cat, ''); ?>" title="<?php printf(__('Subscribe to %s','themejunkie'),get_cat_name($cat)); ?>"><?php printf(__('Subscribe to %s','themejunkie'), get_cat_name($cat)); ?></a></span>

<?php elseif( is_tag() ) : ?>	
	<?php printf( __( 'Tag Archives: <span>%s</span>', 'themejunkie' ), single_tag_title('',false)); ?>		
	
<?php elseif ( is_search() ) : ?>
	<?php printf( __( 'Search for <span>%s</span>', 'themejunkie' ), $s ); ?>	
			
<?php elseif ( is_day() ) : ?>
	<?php printf( __( 'Daily Archives: <span>%s</span>', 'themejunkie' ), get_the_time() ); ?>
				
<?php elseif ( is_month() ) : ?>
	<?php printf( __( 'Monthly Archives: <span>%s</span>', 'themejunkie' ), get_the_time('F Y') ); ?>	
			
<?php elseif ( is_year() ) : ?>
	<?php printf( __( 'Yearly Archives: <span>%s</span>', 'themejunkie' ), get_the_time('Y') ); ?>	
			
<?php elseif (is_author()) : ?>	
	<?php if(get_query_var('author_name')) : $curauth = get_userdatabylogin(get_query_var('author_name')); else : $curauth = get_userdata(get_query_var('author'));	endif; ?>				
	<?php printf( __( 'Author Archives: <span>%s</span>', 'themejunkie' ), $curauth->display_name); ?>	
			
<?php elseif (is_home() && get_query_var('paged') > 0) : ?>
	<?php printf( __( 'Archive: <span>Page %s</span>', 'themejunkie' ), $paged ); ?>
	
<?php endif; ?>			
</h1>			
</div> <!--end .headline-->