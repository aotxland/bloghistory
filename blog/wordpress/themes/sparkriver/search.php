<?php get_header(); ?>
    <div id="main">
        <div id="content">
               <?php 
                if (have_posts()) : while (have_posts()) : the_post();
            
                    get_template_part('post', 'search');
                endwhile;
                
                else : ?>
                    <div class="entry">
                        <p style="color:red;"><?php printf( __( '根据相关法律法规和政策，有关“ %s ”的搜索结果未予显示。', 'devework' ), '<strong>' . get_search_query() . '</strong>' ); ?></p>
                        </br></br>
                        <p>╮(╯_╰)╭  淡定，其实是找不到该词的搜索结果。</p>

                        <p>» 浏览 <a href="<?php echo home_url(); ?>/articles">存档页</a> 查找要访问的页面</p>
                      <p>» <a href="<?php echo home_url( '/' ); ?>">回到首页</a></p>      
                     <p>» <a href="javascript:history.go(-1);">返回上页</a></p>
                    </div>

                <?php endif; 
            ?>
            

                <div class="page_navi"><?php par_pagenavi(7); ?></div>   
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div><!-- #main -->
<?php get_footer(); ?>