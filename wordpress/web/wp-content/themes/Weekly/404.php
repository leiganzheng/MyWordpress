<?php get_header(); ?>

<div id="container">
	<div id="content">
		<h1 class="headline"><?php _e( '404 Not Found', 'themejunkie' ); ?></h1>
		<div id="post-0" class="hentry post error404 not-found">
			<div class="entry entry-content">
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'themejunkie' ); ?></p>
			</div><!--end .entry-content-->
		</div><!--end #post-0-->

	</div><!--end #content-->
</div><!--end #container-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>