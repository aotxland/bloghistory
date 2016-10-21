    <article <?php post_class('post post-single clearfix'); ?> id="post-<?php the_ID(); ?>">   
    <header>
        <h1 class="title" itemprop="name"><?php the_title(); ?></h1>     
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

           <?php if(comments_open( get_the_ID() ))  {
                    ?><span class="meta_comments"><i class="icon-comment"></i><?php comments_popup_link( __( '暂无评论', 'themater' ), __( '1个评论', 'themater' ), __( '%个评论', 'themater' ) ); ?></span><?php
                } ?>

            <?php if(is_user_logged_in())  {
                ?> &nbsp; <span class="meta_edit"><i class="icon-edit"></i><?php edit_post_link(); ?></span><?php
            } ?> 

       </header>     
        <section class="entry clearfix" >
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
                
            <?php
                the_content('');
            ?>
    
        </section>
            <footer>
               <div class="cpright">  
               本文标签：<?php the_tags('', ', ', '  '); ?><br/>
               <b>&copy;声明：</b>本站原创文章采用<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/cn/" rel="external nofollow" title="署名-非商业性使用-相同方式共享 3.0 中国大陆" target="_blank"> BY-NC-SA </a>创作共用协议，转载时请以链接形式标明本文地址；非原创（转载）文章版权归原作者所有。【<a href="/copyright" title="版权声明" target="_blank">查看版权声明</a>】<br/>
                <b>&copy;转载请注明来源：</b> <a class="permalink" href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
               </div> 
             </footer>
      </article><!-- Post ID <?php the_ID(); ?> -->
    <div id="nav-single">
            <span class="nav-previous"><?php previous_post_link( '&laquo; 上一篇 %link' ); ?></span>
            <span class="nav-next"><?php next_post_link( '&raquo;下一篇 %link ' ); ?></span>
        </div><!-- #nav-single -->

    <?php 
        if(comments_open( get_the_ID() ))  {
            comments_template('', true); 
        }
    ?>