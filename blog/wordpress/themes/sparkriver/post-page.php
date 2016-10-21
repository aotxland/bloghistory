<?php get_header(); ?>
    <div <?php post_class('post page clearfix'); ?> id="post-<?php the_ID(); ?>">
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="postmeta-primary">最近更新:<?php the_time(Y年n月d日) ?>

        <?php if(is_user_logged_in())  { ?>
           <span class="meta_edit"><?php edit_post_link(); ?></span>
        <?php } ?>
        </div>        
        <div class="entry clearfix">
             <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" > 
                    <?php if ( get_post_meta($post->ID, 'thumb', true) ) : ?> 
                    <?php $image = get_post_meta($post->ID, 'thumb', true); ?>
                    <div class="thumb">
                        <img class="lazy featured_image aligncenter" width="580" height="150" src="<?php bloginfo('template_url'); ?>/images/image-pending.gif" data-original="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
                        <!--<img width="580" height="150" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="featured_image aligncenter"/>-->
                        <em></em>
                    </div>
                    <?php elseif( has_post_thumbnail() ): ?> 
                     <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="featured_image aligncenter" />
                 <?php endif;?>
            </a>
            
            <?php
                the_content('');
            ?>

        </div>
        
    </div><!-- Page ID <?php the_ID(); ?> -->