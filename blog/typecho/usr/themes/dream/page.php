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
					<p><?php $this->content(); ?></p>
					<hr>
				</div>
			</div>
			</div>
			<?php $this->need('comments.php'); ?>
		</div>
	</div>
</div>

<?php $this->need('footer.php'); ?>
