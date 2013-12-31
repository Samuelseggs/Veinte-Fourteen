<!-- BEGIN COMMENTFORM + COMMENTS SLIDE-OUT ANCHOR -->
<div id="comments-open-anchor"></div>
<!-- END COMMENTFORM + COMMENTS SLIDE-OUT ANCHOR -->

<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'bonfire' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<div id="comments" class="commentwrap">
	<div class="comments-wrapper">
	
		<?php
			// You can start editing here -- including this comment!
		?>
		
		<?php if ( have_comments() || comments_open() ) : ?>
		<?php endif; // end commentwrap ?>
		
		
		<?php 
		$custom_comment_form = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div id="commentform-fields"><div id="author-wrapper">' .
					'<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name' , 'bonfire' ) . '" size="22" tabindex="2" />' .
					'</div>',
			'email'  => '<div id="email-wrapper">' .
					'<input type="text" name="email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email (hidden)' , 'bonfire' ) . '" size="22" tabindex="3" />' .
					'</div></div>',
			'url'    =>  '') ),
			'comment_field' => '<div id="comment-wrapper">' .
					'<textarea name="comment" id="comment" cols="45" rows="10" tabindex="1" placeholder="' . __( 'Type your comment here...' , 'bonfire' ) . '"></textarea>' .
					'</div><div id="cancel-comment"></div>',
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out?</a>', 'bonfire' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
			'title_reply' => ( '' ),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'cancel_reply_link' => ( '<span id="cancel-comment-reply"></span>' ),
			'label_submit' => __( 'Post comment' , 'bonfire' ),
		);
		comment_form($custom_comment_form); 
		?>
		
		
		
		<?php if ( have_comments() || comments_open() ) : ?>
		</div>
		<!-- /.commentwrap -->
		<?php endif; // end commentwrap ?>
		
		
		
		
		<?php if ( have_comments() || comments_open() ) : ?>
		
		<?php endif; // end commentwrap ?>
		
		<?php if ( have_comments() ) : ?>
		
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="pagenav top clearfix">
					<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') );?>
				</div> 
				<!-- /.pagenav -->
			<?php endif; // check for comment navigation ?>
		
			<ol class="commentlist">
				<?php wp_list_comments('callback=custom_theme_comment'); ?>
			</ol>
		
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="pagenav bottom clearfix">
					<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') );?>
				</div>
				<!-- /.pagenav -->
			<?php endif; // check for comment navigation ?>
		
		<?php else : // or, if we don't have comments:
		
			/* If there are no comments and comments are closed,
			 * let's leave a little note, shall we?
			 */
			if ( ! comments_open() ) :
		?>
		
		<!-- BEGIN COMMENTS CLOSED MESSAGE -->
		<div id="respond-closed">
			<?php _e( 'Apologies, for this post the comments are closed.', 'bonfire' ); ?>
		</div>
		<!-- END COMMENTS CLOSED MESSAGE -->
	
	</div>
</div>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>