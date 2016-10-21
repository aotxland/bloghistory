<?php get_header() ;?>
    <main class="main-content row u-clearfix">
        <div class="layoutMultiColumn--primary" role="main">
            <?php
            $allsearch = &new WP_Query("s=$s&showposts=-1");
            $key = esc_html($s, 1);
            $count = $allsearch->post_count;
            wp_reset_query(); ?>
            <?php if ( have_posts() ) : ?>
                <div class="cat-header">
                    <h1 class="tag">
                        <?php echo $key; ?>
                    </h1>
                    <div class="description"><?php echo $key.'的搜索结果—'.$count . '篇文章'; ?></div>
                </div>
                <div class="blockGroup">
                    <?php while (have_posts()) : the_post();?>
                        <?php get_template_part( 'template-parts/content',get_post_format());?>
                    <?php endwhile;?>
                </div>
            <?php  endif;?>
            <div class="u-textAlignCenter page-nav">
                <?php the_posts_pagination( array(
                    'prev_next'          => 0,
                    'before_page_number' => '',
                ) ); ?>
            </div>
        </div>
        <?php get_sidebar() ;?>
    </main>
<?php get_footer() ;?>