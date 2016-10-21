<?php


if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => '首页边栏',
        'description' => __('该栏目的小工具只在主题首页出现', 'Devework'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle"><span></span>',
        'after_title' => '</h3>'
    ));
    }
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => '内页边栏',
        'description' => __('该栏目的小工具只在内页（除首页外的页面）出现', 'Devework'),
        'before_widget' => '<ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle"><span></span>',
        'after_title' => '</h3>'
    ));
    }

    register_nav_menus(array(
      'menu-primary' => '顶部导航菜单',
    ));

//标题重写
function get_page_number() {
    if ( get_query_var('paged') ) {print ' | ' . '第'. get_query_var('paged') . '页';}}
function meta_title(){
        if ( is_single() ) { 
            single_post_title(); echo ' | '; bloginfo( 'name' );
        } elseif ( is_home() || is_front_page() ) {
            bloginfo( 'name' );
            if( get_bloginfo( 'description' ) ) {
              echo ' | ' ; bloginfo( 'description' ); get_page_number();
            }
        } elseif ( is_page() ) {
            single_post_title( '' ); echo ' | '; bloginfo( 'name' );
        } elseif ( is_search() ) {
            printf( __( '有关 %s 的搜索结果：', 'Geekwork' ), '"'.get_search_query().'"' ); get_page_number(); echo ' | '; bloginfo( 'name' );
        } elseif ( is_404() ) { 
            _e( '404 Not Found', 'Geekwork' ); echo ' | '; bloginfo( 'name' );
        } else { 
            wp_title( '' ); echo ' | '; bloginfo( 'name' ); get_page_number();
        }
    }

function get_cats_name() {
$allcats=get_categories();
foreach ($allcats as $category) 
{
$keywords[] = $category->cat_name;
}
return $keywords;
}
// utf8 substr
function utf8Substr($str, $from, $len) {
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
'$1',$str);
}

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'rel_canonical' );
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink  

//分页导航---自定义
function par_pagenavi($range = 9){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
    if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
    previous_posts_link(' 上一页 ');
    if($max_page > $range){
        if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    if ( $paged < $max_page - $p - 1 ) echo '... ';
    next_posts_link(' 下一页 ');

    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
} 

//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
 
//输出缩略图地址
function post_thumbnail_src(){
    global $post;
    if( $values = get_post_custom_values("thumb") ) {   //输出自定义域图片地址
        $values = get_post_custom_values("thumb");
        $post_thumbnail_src = $values [0];
    } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_thumbnail_src = $thumbnail_src [0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
        if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
            $random = mt_rand(1, 10);
            echo get_bloginfo('template_url');
            echo '/images/pic/'.$random.'.jpg';
            //如果日志中没有图片，则显示默认图片
            //echo '/images/default_thumb.jpg';
        }
    };
    echo $post_thumbnail_src;
}

//标签云自定义
add_filter('widget_tag_cloud_args','style_tags'); 
function style_tags($args) { 
$args = array( 
'largest'=> '11', 
'smallest'=> '11',
'order'  => 'RAND',   
'number' => '30',  
); 
return $args; 
} 


//注销部分默认小工具
function dw_unregister_widget(){
unregister_widget('WP_Widget_Search');
unregister_widget('WP_Widget_Calendar');
}
add_action('widgets_init','dw_unregister_widget');

include(TEMPLATEPATH .'/includes/commentplus.php');

include(TEMPLATEPATH .'/lib/widgets/dw_randposts.php');
include(TEMPLATEPATH .'/lib/widgets/dw_blogstatistics.php');

?>