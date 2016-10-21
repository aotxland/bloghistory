<!--首页主体 -->    
    <article <?php post_class('post clearfix'); ?> id="post-<?php the_ID(); ?>">
    <header>
        <h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <div class="postmeta-primary">
            <span class="meta_date"><time datetime="<?php the_date('Y-m-d'); ?>" pubdate><i class="icon-date"></i><?php echo get_the_date(); ?></time></span>
            <span class="meta_categories"><i class="icon-cat"></i>分类：<?php the_category(', '); ?></span>
            <span class="meta_comeurl"><i class="icon-from"></i>
                <?php 
                    $f = get_post_meta($post->ID, 'f', true);
                    $furl = get_post_meta($post->ID, 'furl', true);
                    if($f){
                    echo '来源：'."<a href='$furl' target='blank' rel='nofllow'>$f</a>";}
                    else echo '来源：'."原创"
                ?></span>

                <?php if(is_user_logged_in())  {
                ?> &nbsp; <span class="meta_edit"><i class="icon-edit"></i><?php edit_post_link(); ?></span><?php
                    } ?> 
        </div>
 <header>       
        <section class="entry clearfix">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" > 
                    <?php if ( get_post_meta($post->ID, 'thumb', true) ) : ?> 
                    <?php $image = get_post_meta($post->ID, 'thumb', true); ?>
                    <div class="thumb">
                        <img class="lazy featured_image aligncenter" width="580" height="150" src="<?php bloginfo('template_url'); ?>/images/image-pending.gif" data-original="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
                        <!--<img width="580" height="150" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="featured_image aligncenter"/>-->
                    </div>
                    <?php elseif( has_post_thumbnail() ): ?> 
                     <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="featured_image aligncenter" />
                 <?php endif;?>
            </a>
                
            <?php
                the_content('');
            ?>
        </section>
        <footer class="readmore">
            <a href="<?php the_permalink(); ?>"  rel="nofollow"  title="<?php the_title(); ?>" rel="bookmark">阅读更多</a>
        </footer>
    </article><!-- Post ID <?php the_ID(); ?> -->