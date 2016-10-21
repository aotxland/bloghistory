<?php
define('LION_VERSION','1.0.3');
require get_template_directory() . '/inc/base.php';   
require get_template_directory() . '/inc/comment.php'; 
require get_template_directory() . '/inc/widget.php'; 

<!-- 友链优化 -->
 function get_the_link_items($id = null){
    $bookmarks = get_bookmarks('orderby=date&category=' .$id );
    $output = '';
    if ( !empty($bookmarks) ) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) {
            $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >'. get_avatar($bookmark->link_notes,64) . '<span class="sitename">'. $bookmark->link_name .'</span></a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}

function get_link_items(){
    $linkcats = get_terms( 'link_category' );
    if ( !empty($linkcats) ) {
        foreach( $linkcats as $linkcat){            
            $result .=  '<h3 class="link-title">'.$linkcat->name.'</h3>';
            if( $linkcat->description ) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
            $result .=  get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}

function shortcode_link(){
    return get_link_items();
}
add_shortcode('bigfalink', 'shortcode_link');

<!--百度链接自动提交-->
function fa_push_to_baidu($post_ID){
    global $post;
    if( $post->post_status != "publish" ){
        $urls = array(
            get_permalink($post_ID),
        );
        $api = 'http://data.zz.baidu.com/urls?site=blog.aotxland.com&token=p1HGiW646KZ4zhVa&type=original';//替换成你的接口调用地址
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        //var_dump($result);
    }
}
add_action('publish_post', 'fa_push_to_baidu');