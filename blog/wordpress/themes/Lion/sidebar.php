<div id="sidebar" class="layoutMultiColumn--secondary" role="complementary">
    <?php if(is_singular()) {?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Single Siderbar') ) : ?><?php endif; ?>
    <?php } else { ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar') ) : ?><?php endif; ?>
    <?php }?>
</div>