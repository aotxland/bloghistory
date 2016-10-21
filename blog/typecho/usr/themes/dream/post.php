<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!-- MAIN CONTENT -->
<div class="main-content">
	<div class="fluid-container">
		<div class="content-wrapper">
			<div class="page-section" id="about">
			<div class="row">
				<div class="col-md-12">
					<h4 class="widget-title"><?php $this->title() ?></h4>
					<ul class="post-meta">
						<li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
						<li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('F j, Y'); ?></time></li>
						<li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
					</ul>
					<p class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></p>
					<div class="page-content"><?php $this->content(); ?></div>
					<hr>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="main-content">
	<div class="fluid-container">
		<div class="content-wrapper">
			<div class="row">
			<?php $this->need('comments.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php $this->need('footer.php'); ?>
