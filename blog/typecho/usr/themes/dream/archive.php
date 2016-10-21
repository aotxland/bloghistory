<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
	<div class="fluid-container">
		<div class="content-wrapper">
		    <h3 class="archive-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
			), '', ''); ?></h3>
			<?php if ($this->have()): ?>
			<?php while($this->next()): ?>
			<div class="page-section" id="about">
			<div class="row">
				<div class="col-md-12">
					<h4 class="widget-title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h4>
					<p><?php $this->content('阅读全文 >>'); ?></p>
					<hr>
				</div>
			</div>
			</div>
			<?php endwhile; ?>
			<?php else: ?>
			<div class="page-section" id="about">
			<div class="row">
                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
			</div>
			</div>
			<?php endif; ?>
			<?php $this->pageNav('<< 上一页', '下一页 >>'); ?>
		</div>
	</div>
</div>

<?php $this->need('footer.php'); ?>
