<?php get_header(); ?>
    <div id="content" class="container single-content">
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="post-item">
                <header class="post-header">
                    <h1 class="post-title">
                        <?php the_title();?>
                    </h1>
                    <div class="post-meta">
                        <?php echo get_the_date('Y-m-d');?>
                    </div>
                </header>
                <div class="grap">
                    <?php if(has_post_thumbnail()):?>
                        <p class="with-img"><?php the_post_thumbnail( 'full' ); ?></p>
                        <p><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 220,"...");?></p>
                    <?php else : ?>
                        <?php the_content('');?>
                    <?php endif;?>
                </div>
            </article>
            <div class="post-action">
                <?php if( function_exists('wp_postlike')) wp_postlike();?>
            </div>
            <div class="author-info u-clearfix">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64 );?>
                <div class="author-content">
                    <h3 class="author-name"> <?php the_author();?></h3>
                    <div class="author-description"><?php echo get_the_author_meta('description');?></div>
                </div>
            </div>
            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        <?php endwhile; ?>
    </div>
<?php get_footer(); ?>