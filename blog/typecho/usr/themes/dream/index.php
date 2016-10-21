<?php
/**
 * 原本给自己博客做的一套风格，第一次做typecho的模板，算是试水吧。
 * 
 * @package Dream 
 * @author Delay.Hsiao
 * @version 1.2
 * @link http://www.fackyou.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 //print_r($this);
 ?>

<div class="banner-bg" id="top">
	<div class="banner-overlay"></div>
	<div class="welcome-text">
		<h2><?php $this->options->title(); ?></h2>
		<h5><?php $this->options->description(); ?></h5>
	</div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
	<div class="fluid-container">
		<div class="content-wrapper">
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
			<?php $this->pageNav('<< 上一页', '下一页 >>'); ?>
		</div>
	</div>
</div>


<?php $this->need('footer.php'); ?>
