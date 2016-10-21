<aside id="sidebar-primary">
<?php wp_reset_query(); if ( is_home() ) { ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页边栏') ) : ?>
	<?php endif; ?>
	<?php } ?>

	<?php wp_reset_query(); if ( !is_home() ) { ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('内页边栏') ) : ?>
	<?php endif; ?>
	<?php } ?>  
</aside><!-- #sidebar-primary -->
