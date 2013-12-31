<div id="comment-wrapper" class="box">
  <div id="comments">
    <?php if ( post_password_required() ) : ?>
    <p>
      <?php _e( 'This post is password protected. Enter the password to view any comments.', 'elemis' ); ?>
    </p>
    <?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
    <?php
	// You can start editing here -- including this comment!
?>
    <?php if ( have_comments() ) : ?>

    <h3 id="comments-title">
      <?php
			printf( _n( 'One Response to "%2$s"', '%1$s Responses to "%2$s"', get_comments_number(), 'elemis' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?>
    </h3>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <?php previous_comments_link( __( '&larr; Older Comments', 'elemis' ) ); ?>
    <?php next_comments_link( __( 'Newer Comments &rarr;', 'elemis' ) ); ?>
    <?php endif; // check for comment navigation ?>
    <ol id="singlecomments" class="commentlist">
      <?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use elemis_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define elemis_comment() and that will be used instead.
					 * See elemis_comment() in elemis/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'elemis_comment' ) );
				?>
    </ol>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <?php previous_comments_link( __( '&larr; Older Comments', 'elemis' ) ); ?>
    <?php next_comments_link( __( 'Newer Comments &rarr;', 'elemis' ) ); ?>
    <?php endif; // check for comment navigation ?>
    <?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
    <p>
      <?php _e( 'Comments are closed.', 'elemis' ); ?>
    </p>
    <?php endif; // end ! comments_open() ?>
    <?php endif; // end have_comments() ?>
  </div>

  <div id="comment-form" class="comment-form">
  	
    <?php comment_form(); ?>
  </div>
</div>