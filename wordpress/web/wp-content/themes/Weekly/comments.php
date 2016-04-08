<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view any comments.', 'themejunkie' ); ?>
		</div>
</div> <!--end .comments-->

<?php
	return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

	<span class="pc-feedlink"><a href="<?php echo get_post_comments_feed_link(); ?>" title="<?php _e('Subscribe to Comments RSS Feed in this post','themejunkie'); ?>"><?php _e('Subscribe to Comments RSS Feed in this post','themejunkie'); ?></a></span>
	
	<h3 id="comments-title"><?php printf( _n( 'One Response', '%1$s Responses', get_comments_number(), 'themejunkie' ), number_format_i18n( get_comments_number() )); ?></h3>

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themejunkie' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themejunkie' ) ); ?></div>
		</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'tj_custom_comment', 'type' => 'comment' ) ); ?>
	</ol>
			
	<?php if ( ! empty($comments_by_type['pings']) ) : // Begin Pings Loop ?>
		<h3 id="pings"><?php _('Pingbacks/Trackbacks','themejunkie'); ?></h3>
			<ul class="pinglist">
				<?php wp_list_comments( array( 'callback' => 'tj_custom_comment', 'type' => 'pings' ) ); ?>
			</ul>
	<?php endif; // End Pings Loop ?>

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themejunkie' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themejunkie' ) ); ?></div>
		</div> <!--end .navigation-->
	<?php endif; // check for comment navigation ?>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

<?php else : // if comments are closed ?>

	<p class="nocomments"><?php _e( 'Comments are closed.', 'themejunkie' ); ?></p>

<?php endif; ?>
<?php endif; ?>

<?php tj_comment_form(); ?>

</div><!-- #comments -->
