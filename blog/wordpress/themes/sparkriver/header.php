<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php meta_title(); ?></title>
<!--[if lt IE 9]><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/lib/js/html5.js"></script><![endif]-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" />
<!--[if lt IE 8]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/lib/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/lib/css/fontello-ie7.css"><![endif]-->
<script type="text/javascript" src="http://cdn.staticfile.org/jquery/1.6.2/jquery.min.js"></script> 
<link rel="shortcut icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
<?php if ( is_singular() && comments_open() ) { wp_enqueue_script( 'comment-reply' ); } ?>
<?php if( function_exists('get_query_var') ) {$cpage = intval(get_query_var('cpage'));if(!empty($cpage)) {echo '<meta name="robots" content="noindex, nofollow" />';}}?>
<?php  wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="container">
 	<header id="header"><!--<div id="header">--> 
        <div class="logo">
            <a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>       
        </div><!-- .logo -->
        <div class="header-right">
            <div id="topsearch">
                <?php get_search_form(); ?>
            </div>
        </div><!-- .header-right -->
    </header><!-- #header -->     
<nav class="clearfix">
    <?php wp_nav_menu( array( 'theme_location' => 'menu-primary', 'container_class' => 'menu-primary-container', 'menu_class' => 'menus menu-primary', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '' ) ); ?>
</nav>