<?php
define('PUMA_VERSION','2.1.1');

/**
 * Theme setup additions.
 */

require get_template_directory() . '/inc/setup.php';

/**
 * Puma only works in WordPress 4.4 or later.
 */

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

/**
 * AJAX callback additions.
 */

require get_template_directory() . '/inc/callback.php';

/**
 * Functional Package additions.
 */

require get_template_directory() . '/inc/pack.php';

/**
 * Theme update additions.
 */

require get_template_directory() . '/inc/update.php';

//百度链接自动提交
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