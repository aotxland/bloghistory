<?php

function lion_sns(){
    $output = '<div class="u-floatRight">';
    $output .= '<a href="' . get_bloginfo('rss2_url') . '" target="_blank"><svg class="svgIcon" viewBox="0 0 14 14" width="20" height="20"><use class="svgIcon-use" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-feed3"></svg></a>';
    $output .= '</div>';
    return $output;
}

function lion_theme_scripts() {
    if(!is_admin()){
        $dir = get_template_directory_uri();
        wp_enqueue_style('fancybox', $dir . '/static/css/main.css', array(), LION_VERSION , 'screen');
        wp_enqueue_script( 'base', $dir . '/static/js/main.js' , array( 'jquery' ), LION_VERSION , false);
        wp_localize_script('base', 'O_Connor', array(
            'admin_ajax_url' => admin_url('admin-ajax.php'),
            'order' => get_option('comment_order'),
        ));
    }

}
add_action('wp_enqueue_scripts', 'lion_theme_scripts');


add_filter('comment_text','comment_add_at_parent');
function comment_add_at_parent($comment_text){
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent ) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@'.$parent_comment->comment_author.'</a> ' . $comment_text;
    }
    return $comment_text;
}


function lion_theme_title( $title, $sep ) {
    global $paged, $page, $wp_query;;
    if ( is_feed() )
        return $title;
    $title .= get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
    return $title;
}
add_filter( 'wp_title', 'lion_theme_title', 10, 2 );


add_theme_support( 'post-thumbnails' );

function lion_is_has_image(){
    global $post;
    if( has_post_thumbnail() ) return true;
    $content = $post->post_content;
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    if(!empty($strResult[1])) return true;
    return false;
}

function get_post_thumbnail(){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        return $timthumb_src[0];
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            return $strResult[1][0];
        } else {
            return false;
        }
    }
}

remove_action( 'wp_head',   'feed_links_extra', 3 );
remove_action( 'wp_head',   'rsd_link' );
remove_action( 'wp_head',   'wlwmanifest_link' );
remove_action( 'wp_head',   'index_rel_link' );
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 );
remove_action( 'wp_head',   'wp_generator' );



add_filter( 'pre_option_link_manager_enabled', '__return_true' );



function unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_default_widgets', 11);

function bigfa_theme_widgets_init() {
    register_sidebar( array(
        'name' => 'Main Sidebar',
        'id' => 'sidebar-1',
        'description' => '在首页以及文章列表页显示',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Single Siderbar',
        'id' => 'sidebar-2',
        'description' => '将在文章页、分类页等非首页显示',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

}
add_action( 'widgets_init', 'bigfa_theme_widgets_init' );


function time_ago( $type = 'commennt', $day = 30 ) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    $timediff = time() - $d('U');
    if ($timediff <= 60*60*24*$day){
        echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
    }
    if ($timediff > 60*60*24*$day){
        echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
    };
}



add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'header-menu' => '顶部菜单',
        )
    );
}

add_theme_support( 'post-formats',array(
        'status'
        ));

remove_filter('the_content', 'wptexturize');


add_filter('pre_get_posts','lion_search_filter');
function lion_search_filter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}


function lion_popuplinks($text) {
    $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
    return $text;
}
add_filter('get_comment_author_link', 'lion_popuplinks', 6);



function lion_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'lion_get_ssl_avatar');



function lion_post_list( $type = 'latest' , $num = 5){
    if ( $type == 'popular') {
        $the_query = new WP_Query( array(
            'posts_per_page'=>$num,
            'orderby'=>'meta_value_num',
            'meta_key' => '_post_like',
        ) );
    } elseif ( $type == 'modified') {
        $the_query = new WP_Query( array(
            'posts_per_page'=>$num,
            'orderby'=>'modified',
        ) );
    } else {
        $the_query = new WP_Query( array(
            'posts_per_page'=>$num,
            'orderby'=>'latest',
        ) );
    }

    $post_list = '';
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        $post_list .= '<li class="list-item u-clearfix"><a href="' . get_permalink() . '" title="' . get_the_title() . '"><div class="list-item-image';
        if ( !lion_is_has_image() ) $post_list .=' no-image';
        $post_list .=' u-floatLeft" style="background-image:url(' . get_post_thumbnail() . ')"></div><div class="list-item-title">' . get_the_title() . '</div><div class="list-item-meta">' . get_the_date('Y-m-d');
        if ( function_exists('wpl_get_like_count')) $post_list .= '<span class="middotDivider"></span>' . wpl_get_like_count() . ' likes';
        $post_list .= '</div></a></li>';
    }
    wp_reset_postdata();
    return $post_list;
}
