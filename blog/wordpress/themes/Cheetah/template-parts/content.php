<article class="post-item">
    <header class="post-header">
        <h1 class="post-title">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
        </h1>
        <div class="post-meta">
            <?php echo get_the_date('Y-m-d');?>
        </div>
    </header>
    <div class="grap">
        <?php if(has_post_thumbnail()):?>
            <p class="with-img"><?php the_post_thumbnail( 'full' ); ?></p>
            <p><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 220,"...");?></p>
            <p class="u-textAlignCenter"><a class="more-link" href="<?php the_permalink();?>" title="<?php the_title();?>">More </a></p>
        <?php else : ?>
            <?php the_content('');?>
            <p class="u-textAlignCenter"><a class="more-link" href="<?php the_permalink();?>" title="<?php the_title();?>">More </a></p>
        <?php endif;?>
    </div>
    <div class="post-footer">
    </div>
</article>