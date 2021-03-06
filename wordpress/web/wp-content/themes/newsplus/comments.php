<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
        <h3 class="comments-title"><?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'newsplus' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h3>
        <ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'newsplus_comments', 'style' => 'ul' ) ); ?>
        </ol><!-- .commentlist -->
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'newsplus' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'newsplus' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'newsplus' ) ); ?></div>
            </nav>
        <?php endif; // comment navigation
        if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="nocomments"><?php _e( 'Comments are closed.' , 'newsplus' ); ?></p>
        <?php endif;
    endif; // have_comments()
    comment_form(); ?>
</div><!-- #comments .comments-area -->