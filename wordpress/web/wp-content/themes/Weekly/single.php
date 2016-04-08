<?php get_header(); ?>
<div id="container">

	<div id="content">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="single-entry-meta">
				<span class="meta-author"><?php _e('Posted by','themejunkie'); ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-date"><?php _e( 'on ', 'themejunkie' ); ?><?php the_time(get_option('date_format')); ?></span>
				<span class="meta-cat"><?php _e( 'in ', 'themejunkie' ); ?><?php the_category( ', ' ); ?></span>
				<span class="meta-sep">|</span>
				<span class="meta-comments"><?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) )	; ?></span>
				<?php edit_post_link( __( 'Edit', 'themejunkie' ), '<span class="meta-edit right">', '</span>' ); ?>
			</div> <!--end .entry-meta-->

			<div class="entry entry-content">

				<?php the_content(); wumii_get_related_items(); ?>


				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>

<div style="margin-top: 15px"><p><strong>原创文章，转载请注明：</strong> 转载自<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p><p><strong>本文链接地址:</strong> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></div>
<div id="wumiiDisplayDiv"></div>


			</div> <!--end .entry-->
			<?php printf(the_tags(__('<div id="entry-tags"><span>标签:</span>&nbsp;','themejunkie'),', ','</div>')); ?>  
			<?php if(get_theme_mod('display_author_info') == 'Yes') { ?>
		
			<div id="entry-author" class="clear">
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'themejunkie_author_bio_avatar_size', 60 ) ); ?>
				</div> <!--end .author-avatar-->
				<div id="author-description">
					<h3>本文由 <?php the_author(); ?> 分享</h3>
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__('查看%s的全部文章'), get_the_author() ); ?>">查看<?php the_author(); ?>的全部文章 &rarr;</a>
					</div> <!--end .author-link-->
<!-- JiaThis Button BEGIN -->
<div id="ckepop">
	<a href="http://www.jiathis.com/share/?uid=1503770" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">分享到：</a>
							<a class="jiathis_button_qzone"></a>
						<a class="jiathis_button_tsina"></a>
						<a class="jiathis_button_icons_1"></a>

						<a class="jiathis_button_icons_2"></a>
						<a class="jiathis_button_icons_3"></a>
						<a class="jiathis_button_icons_4"></a>
						<a class="jiathis_button_icons_5"></a>
						<a class="jiathis_button_icons_6"></a>
						<a class="jiathis_button_icons_7"></a>

						<a class="jiathis_button_icons_8"></a>
						<a class="jiathis_button_icons_9"></a>

</div>
<script type="text/javascript">var jiathis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://v1.jiathis.com/code/jia.js?uid=1503770" charset="utf-8"></script>
<!-- JiaThis Button END -->
				</div> <!--end .author-description-->
			</div> <!--end .entry-author-->
			<?php } ?>
		</div>


<?php comments_template( '', true ); ?>
	</div><!--end #content -->

</div><!--end #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
