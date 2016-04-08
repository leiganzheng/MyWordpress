</div><!--end #main-->
  
	<div id="footer">
<?php if ( is_home() ) { ?>

	<div class="links">
<span class="add"><a href="<?php echo home_url( '/' ) ?>links" title="友情链接">申请加入>></a></span>
<h3 class="links-title">友情链接</h3>

<div class="links-txt">
		<?php bywhy_links("txt",24) ?>
</div>
		</div><!-- /links -->
<?php } ?>

		<div class="clear"></div>
		<div class="bottom">
			
			<div class="center">


				Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"> 	<?php bloginfo( 'name' ); ?>
				</a> All Rights Reserved.  
主题由<a href="http://theme-junkie.com/" target="_blank">Theme Junkie</a>设计,<a href="http://www.bywhy.com/" target="_blank">落幕</a>汉化修改.
			</div> <!--end .center--> 
				
	</div> <!--end #footer -->

</div> <!--end #wrapper -->
      <?php wp_footer(); ?>
<!--begin of body code-->	
<?php if(get_theme_mod('body_code_status') == "Yes") echo stripslashes(get_theme_mod('body_code')); ?>
<!--end of body code-->
<?php wumii_add_load_script(5,3); ?>
</body>
</html>
