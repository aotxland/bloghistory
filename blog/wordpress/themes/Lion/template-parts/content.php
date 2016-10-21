<article id="<?php echo $post->ID?>" class="block--list u-clearfix<?php if( !lion_is_has_image() ) echo ' block--widthoutImage';?>">
    <header class="block-header">
        <h2 class="block-title" itemprop="headline">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
    </header>
    <div class="block-content u-clearfix grap">
        <?php if( lion_is_has_image() ) :?>
            <div class="block-image" style="background-image:url(<?php echo get_post_thumbnail();?>)">
            </div>
        <?php endif;?>
        <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 280,"……"); ?>
    </div>
    <footer class="block-footer u-clearfix">
        <?php echo get_the_date('Y-m-d'); ?><span class="middotDivider"></span><span itemprop="articleSection"><?php the_category(', ');?></span><?php if ( comments_open() ) : ?><span class="middotDivider"></span><?php comments_number('No Reply', '1 Reply', '% Replies'); ?><?php endif; // comments_open() ?>
    </footer>
</article>
