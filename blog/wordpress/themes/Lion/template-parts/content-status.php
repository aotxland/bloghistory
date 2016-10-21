<article class="block--list u-clearfix post-status">
    <a href="<?php the_permalink();?>" class="status-link" title="<?php the_title();?>">
        <?php echo get_avatar(get_the_author_meta( 'user_email' ),64);?>
        <div class="status-content">
            <?php the_content();?>
        </div>
    </a>
    <div class="status-meta"><span><?php echo get_the_date('Y-m-d');?></span></div>
</article>