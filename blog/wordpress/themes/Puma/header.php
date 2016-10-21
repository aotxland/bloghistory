<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title( '-', true, 'right' ); ?></title>
<?php//如果是首页if (is_home()){        $keywords = "Yif,韩小哈,翱天翔地,中型组机器人,折腾";        $description = "翱天翔地，记录行走和折腾之路";}//如果是文章页elseif (is_single()){        //默认使用文章页添加关键字        $keywords = get_post_meta($post->ID, "keywords", true);        //如果为空，使用标签作为关键字        if($keywords == ""){                $tags = wp_get_post_tags($post->ID);                foreach ($tags as $tag){                        $keywords = $keywords.$tag->name.",";                }                //去掉最后一个,                $keywords = rtrim($keywords, ', ');        }        //默认使用文章页添加描述        $description = get_post_meta($post->ID, "description", true);        //如果为空，使用文章前100个字作为描述        if($description == ""){                if($post->post_excerpt){                        $description = $post->post_excerpt;                }else{                        $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,200);                }        }}//如果是页面，使用页面添加的关键字和描述elseif (is_page()){        $keywords = get_post_meta($post->ID, "keywords", true);        $description = get_post_meta($post->ID, "description", true);}//如果是分类页，使用分类名作为关键字，分类描述作为描述elseif (is_category()){        $keywords = single_cat_title(", false);        $description = category_description();}//如果是标签页，使用标签名作为关键字，标签描述作为描述elseif (is_tag()){        $keywords = single_tag_title(", false);        $description = tag_description();}//去掉两段空格$keywords = trim(strip_tags($keywords));$description = trim(strip_tags($description));?><meta name="keywords" content="<?php echo $keywords; ?>" /><meta name="description" content="<?php echo $description; ?>" />

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/static/img/favicon.ico" type="image/vnd.microsoft.icon">
    <?php wp_head();?>
</head>
<body <?php body_class();?>>
<div class="surface-content">
    <header class="site-header u-textAlignCenter hasImage">
    <div class="header-inner">
        <h1 class="site-title">
            <a href="<?php echo home_url();?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
        </h1>
        <?php $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; ?></p>
        <?php endif;
        ?>
        <div class="social-links">
          <?php echo header_social_link();?>
        </div>
    </div>
    </header>
    <nav class="topNav u-textAlignCenter">
        <div class="layoutSingleColumn">
            <?php wp_nav_menu( array( 'theme_location' => 'angela','menu_class'=>'topNav-items','container'=>'ul','fallback_cb' => 'link_to_menu_editor')); ?>
        </div>
    </nav>