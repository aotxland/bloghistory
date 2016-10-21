<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-box">
    <?php if($comments) : //如果有评论 ?>
        <meta content="UserComments:<?php echo count($comments); ?>" itemprop="interactionCount">
        <h3 class="commentlist-number"><span><?php echo count($comments); ?> Comments On <?php the_title();?></span></h3>
        <ol class="commentlist" >
            <?php wp_list_comments('callback=lion_comment&max_depth=10000'); ?>
        </ol>
        <nav class="commentnav" data-fuck="<?php echo $post->ID?>">
            <?php paginate_comments_links('prev_text=«&next_text=»');?>
        </nav>
    <?php else : ?>
    <?php endif; ?>
    <?php if(comments_open()) : ?>
        <div id="respond" class="respond" role="form">
            <h2 id="reply-title" class="comments-title"><?php comment_form_title( '发表评论 ', '回复给 %s' ); ?> <small>
                    <?php cancel_comment_reply_link(); ?>
                </small></h2>
            <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
            <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform" id="commentform">
                    <?php if ( $user_ID ) : ?>
                        <p style="margin-bottom:10px">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
                        <textarea id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="Text message..." tabindex="1" name="comment"></textarea>
                    <?php else : ?>
                        <textarea id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="Text message..." tabindex="1" name="comment"></textarea>
                        <div class="commentform-info">
                            <label id="author_name" for="author">
                                *name.
                                <input id="author" type="text" tabindex="2" value="<?php echo $comment_author; ?>" name="author">
                            </label>
                            <label id="author_email" for="email">
                                *email.
                                <input id="email" type="text" tabindex="3" value="<?php echo $comment_author_email; ?>" name="email">
                            </label>
                            <label id="author_website" for="url">
                                website.
                                <input id="url" type="text" tabindex="4" value="<?php echo $comment_author_url; ?>" name="url">
                            </label>
                        </div>
                    <?php endif; ?>
                    <div class="comment-form-bottom">
                        <input name="submit" type="submit" id="submit" class="commentsubmit" tabindex="5" value="SUBMIT（Ctrl + Enter）" /></div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>