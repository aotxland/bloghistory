<?php ini_set('display_errors', 0); ?>
<?php 
/*
 防本地路径泄漏
*/
if (function_exists('get_header')) {get_header();}else{header("Location: http://" . $_SERVER['HTTP_HOST'] . "");exit;}; ?>
<?php get_header();?>
    <div id="main">
        <div id="content">
            
            <?php 
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('post', 'homepage');
                    // get_template_part('post', 'list');
                endwhile;
                
                else :
                    get_template_part('post', 'noresults');
                endif; 
            ?>

            <div class="page_navi"><?php par_pagenavi(7); ?></div>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div><!-- #main -->
<?php get_footer(); ?>