<?php get_header();?>
    <main class="main-content row u-clearfix">
        <div class="layoutMultiColumn--primary" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="breadcrumbs" itemprop="breadcrumb"><a href="<?php echo home_url(); ?>">Home&nbsp;</a>  &gt; <?php the_category(' &gt; '); ?> &gt; <?php the_title(); ?></div>
                <div class="sectionBody" itemtype="http://schema.org/Article" itemscope="itemscope">
                    <header class="block-header">
                        <h2 class="block-title" itemprop="headline">
                            <?php the_title(); ?>
                        </h2>
                        <div class="block-meta">
                            <?php echo get_the_date('Y-m-d');?>
                        </div>
                    </header>
                    <div class="grap" itemprop="articleBody">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php if( function_exists('wp_postlike')) : ?>
                    <div class="post-action">
                        <?php wp_postlike();?>
                    </div>
                <?php endif; ?>
                <?php if ( get_the_tags() ) the_tags('<div class="post-tags">', '', '</div>');  ?>
                <div class="author-profile u-clearfix">
                    <div class="author-profile-face">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 56 ); ?>
                    </div>
                    <div class="author-profile-text">
                        <h2 class="author-name">
                            <?php echo get_the_author(); ?>
                        </h2>
                        <p class="author-description">
                            <?php the_author_meta( 'description' ); ?>
                        </p>
                    </div>
                </div>
                <?php comments_template( '', true ); ?>
            <?php endwhile; endif;?>
        </div>
        <?php get_sidebar() ;?>
    </main>
<?php get_footer() ;?>