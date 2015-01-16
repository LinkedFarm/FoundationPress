<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'FoundationPress'));

	if ( post_password_required() ) { ?>
	<section id="comments">
		<div class="notice">
			<p class="bottom"><?php _e('This post is password protected. Enter the password to view comments.', 'FoundationPress'); ?></p>
		</div>
	</section>
	<?php
		return;
	}
?>
<?php // You can start editing here. Customize the respond form below ?>
<?php 
if ( have_comments() ) : 
	if( (is_page() || is_single()) && (!is_home() && !is_front_page()) ) :
?>
	<section id="comments"><?php 	
		
				
		wp_list_comments(
			
			array(
				'walker'            => new FoundationPress_comments(), 
				'max_depth'         => '',
				'style'             => 'ol',
				'callback'          => null,
				'end-callback'      => null,
				'type'              => 'all',
				'reply_text'        => __('Reply', 'FoundationPress'),
				'page'              => '',
				'per_page'          => '',
				'avatar_size'       => 48,
				'reverse_top_level' => null,
				'reverse_children'  => '',
				'format'            => 'html5', 
				'short_ping'        => false, 
				'echo'  	    => true,							
				'moderation' 	    => __('Your comment is awaiting moderation.', 'FoundationPress'),					
			)
		);
		
		?>
		
		<footer>
			<nav id="comments-nav">
				<div class="comments-previous"><?php previous_comments_link( __( '&larr; Older comments', 'FoundationPress' ) ); ?></div>
				<div class="comments-next"><?php next_comments_link( __( 'Newer comments &rarr;', 'FoundationPress' ) ); ?></div>
			</nav>
		</footer>
	</section>
<?php 
	endif;
endif;
?>
<?php if ( comments_open() ) : 
	if( (is_page() || is_single()) && (!is_home() && !is_front_page()) ) : ?>
<section id="respond">
	<h3><?php comment_form_title( __('Leave a Reply', 'FoundationPress'), __('Leave a Reply to %s', 'FoundationPress') ); ?></h3>
	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php printf( __('You must be <a href="%s">logged in</a> to post a comment.', 'FoundationPress'), wp_login_url( get_permalink() ) ); ?></p>
	<?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) : ?>
		<p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'FoundationPress'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'FoundationPress'); ?>"><?php _e('Log out &raquo;', 'FoundationPress'); ?></a></p>
		<?php else : ?>
		<p>
			<label for="author"><?php _e('Name', 'FoundationPress'); if ($req) _e(' (required)', 'FoundationPress'); ?></label>
			<input type="text" class="five" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
		</p>
		<p>
			<label for="email"><?php _e('Email (will not be published)', 'FoundationPress'); if ($req) _e(' (required)', 'FoundationPress'); ?></label>
			<input type="text" class="five" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
		</p>
		<p>
			<label for="url"><?php _e('Website', 'FoundationPress'); ?></label>
			<input type="text" class="five" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
		</p>
		<?php endif; ?>
		<p>
			<label for="comment"><?php _e('Comment', 'FoundationPress'); ?></label>
			<textarea name="comment" id="comment" tabindex="4"></textarea>
		</p>
		<p id="allowed_tags" class="small"><strong>XHTML:</strong> <?php _e('You can use these tags:','FoundationPress'); ?> <code><?php echo allowed_tags(); ?></code></p>
		<p><input name="submit" class="button" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e('Submit Comment', 'FoundationPress'); ?>"></p>
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	<?php endif; // If registration required and not logged in ?>
</section>
<?php 
	endif;
endif; // if you delete this the sky will fall on your head ?>
