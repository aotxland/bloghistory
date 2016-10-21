<?php get_header() ;?>
    <main class="main-content row u-clearfix">
        <div class="layoutMultiColumn--primary"role="main">
            <div class="blockGroup">
            <?php while (have_posts()) : the_post();?>
                    <?php get_template_part( 'template-parts/content',get_post_format() );?>
            <?php endwhile;?>
        </div>
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
