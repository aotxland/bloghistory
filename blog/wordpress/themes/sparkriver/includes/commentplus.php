<?php
 //评论回复
function dw_comment($comment, $args, $depth) {$GLOBALS['comment'] = $comment;
    global $commentcount,$wpdb, $post;
     if(!$commentcount) { 
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);
          $page = get_query_var('cpage');
          $cpp=get_option('comments_per_page');
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;
         } else {$commentcount = $cpp * $page + 1;}
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>" itemprop="reviews" itemscope itemtype="http://schema.org/Review" >
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
        <div class="comment-author vcard">         
         <div id="avatar"><?php echo get_avatar( $comment, 40 ); ?></div>
    <strong itemprop="author"><?php comment_author_link() ?></strong>:<?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?></div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span>
        <br />          
        <?php endif; ?>
        <div  itemprop="reviewBody"><?php comment_text() ?></div>
        <div class="clear"></div><span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span> <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
  </div>
<?php
}
function dw_end_comment() {echo '</li>';};
//登陆显示头像
function dw_own_avatar($email, $size = 48){
return get_avatar($email, $size);
};


//屏蔽全英文评论
function refused_spam_comments( $comment_data ) {  
$pattern = '/[一-龥]/u';  
if(!preg_match($pattern,$comment_data['comment_content'])) {  
wp_die( "You should type some Chinese word (like \"你好\") in your comment to pass the spam-check, thanks for your patience! 您的评论中必须包含汉字!" );
}
return( $comment_data );  
}  
add_filter('preprocess_comment','refused_spam_comments'); 

?>