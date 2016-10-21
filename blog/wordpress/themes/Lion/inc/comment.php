<?php

function lion_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> </p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>

            <li <?php comment_class(); ?> <?php if( $depth > 2){ echo ' style="margin-left:-50px;"';} ?> id="li-comment-<?php comment_ID() ?>" itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
            <div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
                <div class="comhead u-clearfix">
                    <?php echo get_avatar( $comment, $size = '44');?>
                    <div class="comment-author">
                        <cite class="reviewer" itemprop="author"><?php echo get_comment_author_link(); ?></cite>
                        <div class="comment-meta commentmetadata"><time itemprop="datePublished"><?php echo time_ago(); ?></time>
                            <?php comment_reply_link(array_merge( $args, array('reply_text' => '@Ta','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div>
                </div>
                <div class="comment-content" itemprop="description">
                    <?php comment_text(); ?>
                </div>
            </div>
            <?php
            break;
    endswitch;
}

add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'ajax_comment_callback');
function ajax_comment_callback(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    $post_author = $post->post_author;
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err('Sorry, comments are closed for this item.');
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err('Password Protected');
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = esc_sql($user->display_name);
        $comment_author_email = esc_sql($user->user_email);
        $comment_author_url   = esc_sql($user->user_url);
        $user_ID              = esc_sql($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err('Sorry, you must be logged in to post a comment.');
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( 'Error: please fill the required fields (name, email).' );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( 'Error: please enter a valid email address.' );
    }
    if ( '' == $comment_content )
        ajax_comment_err( 'Error: please type a comment.' );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err('Duplicate comment detected; it looks as though you&#8217;ve already said that!');
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err('You are posting comments too quickly.  Slow down.');
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );


    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;
    //这里修改成你的评论结构
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
            <div class="comhead u-clearfix">
                <?php echo get_avatar( $comment, $size = '44');?>
                <div class="comment-author vcard1 yahei">
                    <cite class="reviewer" itemprop="author"><?php echo get_comment_author_link(); ?></cite>
                    <div class="comment-meta commentmetadata"><span class="dtreviewed1"><time itemprop="datePublished"><?php echo time_ago(); ?></time></span>
                    </div>
                </div>
            </div>
            <div class="comment-content" itemprop="description">
                <?php comment_text(); ?>
            </div>
        </div>
    </li>
    <?php die();
}

function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

function lion_comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    $logo = get_template_directory_uri().'/images/logo.png';//LOGO 地址
    if (($parent_id != '') && ($spam_confirmed != 'spam') && (!get_comment_meta($parent_id,'_deny_email',true)) && (get_option('admin_email') != get_comment($parent_id)->comment_author_email)) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //可以修改为你自己的邮箱地址
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
        $message = '<table class="email" style=" width: 600px; margin-top: 10px; margin-right: auto; margin-bottom: 0; margin-left: auto; font-size: 16px; line-height: 1.4;">
    <tbody>
    <tr>
        <td style="padding-top:40px;padding-right:5%;padding-bottom:46px;padding-left:5%;color:#333332">
            <div class="email-header" style="margin-bottom: 20px;">
                <div class="email-logo-wrapper" style="width: 50px; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto;">
                    <img class="email-logo" style="display: block; width: 50px;" src="'. $logo .'">
                </div>
            </div>
            <div>
                <p style="margin-top:0;margin-right:0;margin-bottom:20px;margin-left:0;font-size:18px;line-height:1.4;text-align:center;color:#333332">' . trim(get_comment($parent_id)->comment_author) . '，你好。</p>
                <p><span style="color:#3eae5f;">' . trim($comment->comment_author) . '</span> 回复了您在文章<strong style="font-weight:bold">' . get_the_title($comment->comment_post_ID) . '</strong>中的评论"' . trim(get_comment($parent_id)->comment_content) . '"</p>
                <hr style="width:50px;border:0;border-bottom:1px solid #e5e5e5;margin-top:20px">
                <p style="margin-top:20px;margin-right:0;margin-bottom:20px;margin-left:0">If you like what you read,  keep the conversation going!</p>
                <div style="margin-top:30px;padding-top:26px;border-top:1px solid #e5e5e5;font-size:16px;color:#333332;overflow:hidden">
                    <div><a target="_blank" style="text-decoration:none;display:block;width:50px;float:left;margin-left:0;line-height:0;margin-right:10px;margin-top:5px" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">'. get_avatar($comment->comment_author_email,50). '</a>' . trim($comment->comment_content) . '</div>
                    <div style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;margin-top:10px;margin-right:0;margin-bottom:0;margin-left:60px;overflow:hidden"><a target="_blank" style="color:#ffffff;text-decoration:none;display:inline-block;min-height:26px;line-height:27px;padding-top:0;padding-right:16px;padding-bottom:0;padding-left:16px;outline:0;background:#3eae5f;font-size:12px;text-align:center;font-style:normal;font-weight:400;border:0;vertical-align:bottom;white-space:nowrap;border-radius:999em" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看</a></div>
                </div>
                <div style="color:#b3b3b1;font-size:14px;text-align:center;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;margin-top:50px;margin-right:0;margin-left:0">本邮件由' . get_option("blogname") . '自动生成，<span style="color:#3eae5f">请勿回复</span>。</div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:12px;text-align:center;color:#b3b3b1">
            <div style="padding-top:13px;border-top:1px solid #e5e5e5">Sent by <a target="_blank" style="color:#b3b3b1" href="' . home_url() . '">' . get_option("blogname") . '</a> · Since 2011 </div>
        </td>
    </tr>
    </tbody>
</table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'lion_comment_mail_notify');