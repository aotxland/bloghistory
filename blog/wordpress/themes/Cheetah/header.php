<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/static/img/favicon.ico" type="image/vnd.microsoft.icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <h1 class="site-title">
        <a href="/"><img src="<?php echo get_template_directory_uri();?>/static/img/logo.png" width=160 height=38 alt="<?php bloginfo( 'name' ); ?>"></a>
    </h1>
    <nav class="site-nav">
        <?php wp_nav_menu( array( 'theme_location' => 'cheetah','menu_class'=>'topNav-items','container'=>'ul','fallback_cb' => 'link_to_menu_editor')); ?>
    </nav>
</header>