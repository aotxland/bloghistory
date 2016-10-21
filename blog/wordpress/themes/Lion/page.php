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
<?php comments_template( '', true ); ?>
            <?php endwhile;
            endif;?>
        </div>
        <?php get_sidebar();?>
    </main>
<?php get_footer();?>