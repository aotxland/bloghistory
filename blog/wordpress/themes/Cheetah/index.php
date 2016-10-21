<?php get_header(); ?>
    <div class="container">
        <div class="blockGroup">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('template-parts/content',get_post_format());?>
            <?php endwhile; ?>
            <div class="u-textAlignCenter postsFooterNav">
                <div class="posts-nav">
                    <?php echo paginate_links( array(
                        'prev_next'          => 0,
                        'before_page_number' => '',
                        'mid_size' => 2
                    ) );?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>