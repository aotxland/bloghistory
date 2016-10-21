<?php get_header() ;?>
    <main class="main-content row u-clearfix">
        <div class="cat-header">
            <h1 class="tag">
                <?php
                if ( is_day() ) :
                    echo 'Daily Archives: <span>' . get_the_date() . '</span>';
                elseif ( is_month() ) :
                    echo 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
                elseif ( is_year() ) :
                    echo 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
                else :
                    echo 'Archives';
                endif;
                ?>
            </h1>
        </div>
        <div class="layoutMultiColumn--primary" role="main">
            <?php if ( have_posts() ) : ?>
                <div class="blockGroup">
                    <?php while (have_posts()) : the_post();?>
                        <?php get_template_part( 'template-parts/content',get_post_format() );?>
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