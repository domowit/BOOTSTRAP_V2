<?php
 /**
 * Shore Theme: Blog, comment template
 * @package WordPress
 * @subpackage Shore Theme
 * @since 1.0
 */
 ?>
 <div id="comments"> 
  <!-- Prevents loading the file directly -->
  <?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
  <?php die('Please do not load this page directly. Thanks and have a great day!'); ?>
  <?php endif; ?>
  
  <!-- Password Required -->
  <?php if(!empty($post->post_password)) : ?>
	  <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
      <?php endif; ?>
  <?php endif; ?>
  <!-- variable for alternating comment styles -->
  
  <?php if($comments) : ?>
  <h2>
    <?php comments_number('No comments', 'One comment', '% comments'); ?>
  </h2>
  <?php wp_list_comments(array('style' => 'div','avatar_size' => 64,), $comments);?>
  <?php else : ?>
  
  <?php if(comments_open()) : ?>
  <p>
    <?php _e('No comments yet. You should be kind and add one!', 'hgr_lang'); ?>
  </p>
  <?php endif; ?>
  
  <?php endif; ?>
  <div id="comments-form">
    <?php if(comments_open()) : ?>
    <?php
			$required_text =	__('This is a required field!','hgr_lang');
			$aria_req		=	' required ';
			
			$args = array(	'id_form'           => 'commentform',
							'id_submit'         => 'submit',
							'title_reply'       => __( 'Leave a Reply', 'hgr_lang' ),
							'title_reply_to'    => __( 'Leave a Reply to %s' , 'hgr_lang'),
							'cancel_reply_link' => __( 'Cancel Reply' , 'hgr_lang'),
							'label_submit'      => __( 'Post Comment' , 'hgr_lang'),
							'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'hgr_lang' ) . 
								'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . 
								'</textarea></p>',
							'must_log_in' => '<p class="must-log-in">' .
								sprintf(
								  __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'hgr_lang'),
								  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
								) . '</p>',
							'logged_in_as' => '<p class="logged-in-as">' .
								sprintf(
								__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' , 'hgr_lang' ),
								  admin_url( 'profile.php' ),
								  $user_identity,
								  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
								) . '</p>',
							'comment_notes_before' => '<p class="comment-notes">' .
								__( 'Your email address will not be published.', 'hgr_lang' ) . ( $req ? $required_text : '' ) .
								'</p>',
							'comment_notes_after' => '<p class="form-allowed-tags">' .
								sprintf(
								  __( '<small>You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:<br> %s' , 'hgr_lang' ), allowed_tags() . '</small>'
								) . '</p>',
							'fields' => apply_filters( 'comment_form_default_fields', array(
								'author' =>
									'<p class="comment-form-author">' .
									'<label for="author">' . __( 'Name', 'hgr_lang' ) . '</label> ' .
									'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
									'" size="30"' . $aria_req . ' /></p>',
								'email' =>
									'<p class="comment-form-email"><label for="email">' . __( 'Email', 'hgr_lang' ) . '</label> ' .
									'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
									'" size="30"' . $aria_req . ' /></p>',
								'url' =>
									'<p class="comment-form-url"><label for="url">' .
									__( 'Website', 'hgr_lang' ) . '</label>' .
									'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
									'" size="30" /></p>'
								)
							  ),
							);?>
    <?php comment_form( $args ); ?>
    <?php else : ?>
    <p>
      <?php _e('The comments are closed.', 'hgr_lang'); ?>
    </p>
    <?php endif; ?>
  </div>
  <!--#commentsForm--> 
</div>
<!--#comments-->