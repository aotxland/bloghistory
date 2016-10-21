<?php
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
			?>
			<p class="nocomments">亲，您必须输入密码才能查看评论！</p>
			<?php
			return;
		}
	}
	$oddcomment = '';
?>
<?php if ($comments) : ?>
	<h4 id="comments" class="detitle ">喵~本文目前有<?php comments_number('', '<strong class="count">1</strong>条留言', '<strong class="count">%</strong>条留言' );?>，欢迎发表评论！<em></em></h4>
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=dw_comment&end-callback=dw_end_comment&max_depth=23'); ?>
	</ol>
	<div class="navigation">
		<div class="page_navi"><?php paginate_comments_links(); ?></div>
	</div>

 <?php else : ?>
	<?php if ('open' == $post->comment_status) : ?>
        <h4 id="comments" class="detitle">暂时木有评论啊，等您坐沙发呢！<em></em></h4>
	 <?php else :  ?>
		<p class="nocomments">真系报歉呐~评论已关闭</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
	<div id="respond_box">
	<div id="respond">
		<h4 class="detitle">打破沉默，我来发表评论鸟~<em></em></h4>	
		<div class="cancel-comment-reply">
		<div id="real-avatar">
	<?php if(isset($_COOKIE['comment_author_email_'.COOKIEHASH])) : ?>
		<?php echo get_avatar($comment_author_email, 40);?>
	<?php else :?>
		<?php global $user_email;?><?php echo get_avatar($user_email, 40); ?>
	<?php endif;?>
</div>	
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      


	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		<p>
			<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			<label for="author">昵称<?php if ($req) echo " *"; ?></label>
		</p>
		<p>
			<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
			<label for="email">邮箱<?php if ($req) echo " *"; ?> <a id="Get_Gravatar"  title="查看如何申请一个自己的Gravatar全球通用头像" target="_blank" href="http://gravatar.com">（点击获取评论头像）</a></label>
		</p>
		<p>
			<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			<label for="url">网址</label>
		</p>
	</div>
      <?php endif; ?>
      <div class="clear"></div>
		<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
		<p>
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="提 交" />
			<input class="reset" name="reset" type="reset" id="reset" tabindex="6" value="<?php esc_attr_e( '重  写' ); ?>" />
			<?php comment_id_fields(); ?>
		</p>
		<?php do_action('comment_form', $post->ID); ?>
    </form>

	<div class="clear"></div>
    <?php endif;?>
  </div>
  </div>
  <?php endif;?>