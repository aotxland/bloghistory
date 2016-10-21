<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('管理员头像'), _t('在这里填入一个图片URL地址, 以在网站首页显示管理员头像'));
    $form->addInput($logoUrl);
    $myname = new Typecho_Widget_Helper_Form_Element_Text('myname', NULL, NULL, _t('我的昵称'), _t('显示在左侧导航顶部的博主昵称'));
    $form->addInput($myname);
    $mydesc = new Typecho_Widget_Helper_Form_Element_Text('mydesc', NULL, NULL, _t('自我介绍'), _t('填写一下博主的自我介绍'));
    $form->addInput($mydesc);
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

