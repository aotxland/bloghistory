<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" />
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	
	<!-- 引入jQuery，判断一下浏览器版本，2.0及以上不支持IE9以下浏览器 -->
	<!--[if (gte IE 9)|!(IE)]><!-->
		<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<!--<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
		<script src="http://cdn.staticfile.org/respond.js/1.3.0/respond.min.js"></script>
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<![endif]-->
	
	<!-- 引入Bootstrap的CSS和JS文件 -->
	<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/grid.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">
	
	<!-- 引入风格CSS和JS文件 -->
	<script src="<?php $this->options->themeUrl('js/modernizr-2.6.2.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/normalize.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/owl-carousel.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/templatemo-style.css?v=1.1'); ?>">
	
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<!-- mobile site search -->
	<div class="mobile-site-search mobile-menu">
		<div class="mobile-menu-icon btn-group">
			<div class="dropdown">
				<span class="glyphicon glyphicon-option-vertical dropdown-toggle" data-toggle="dropdown"></span>
				<ul class="list-group dropdown-menu">
					<li class="dropdown-header"><a>文章分类</a></li>
					<li role="separator" class="divider"></li>
					<?php $this->widget('Widget_Metas_Category_List')->parse('<li class="list-group-item"><a href="{permalink}">{name}</a></li>'); ?>
				</ul>
			</div>
			<div class="dropdown">
				<span class="glyphicon glyphicon-th-large dropdown-toggle" data-toggle="dropdown"></span>
				<ul class="dropdown-menu">
					<li class="dropdown-header"><a>导航菜单</a></li>
					<li role="separator" class="divider"></li>
					<li><a<?php if($this->is('index')): ?> class="active"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>" title="<?php _e('首页'); ?>"><?php _e('首页'); ?></a></li>
					<li><a href="http://blog.aotxland.com/about.html" title="<?php _e('关于'); ?>"><?php _e('关于'); ?></a></li>
					<li><a href="http://blog.aotxland.com/guestbook.html" title="<?php _e('留言板'); ?>"><?php _e('留言板'); ?></a></li>
					<li><a href="http://blog.aotxland.com/links.html" title="<?php _e('朋友们'); ?>"><?php _e('朋友们'); ?></a></li>
				</ul>
			</div>
		</div>
		<form id="search" method="post" action="./" role="search">
			<input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
			<button type="submit" class="submit"><?php _e('搜索'); ?></button>
		</form>
	</div>
<!-- mobile site search -->
<?php $this->need('sidebar.php'); ?>
    
    
