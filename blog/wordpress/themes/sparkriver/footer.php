  </div><!--#container -->
    <footer id="footer"> <!--<div id="footer"> -->
    <div id="footer-content">
    <!--尊重作者，请不要删除主题链接。-->
        <p>Copyright &copy; <?php echo date("Y")?>  <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>.  Powered by <a href="//cn.wordpress.org/"  target="_blank" rel="external nofollow" title="一个优美、先进的个人信息发布平台。">WordPress</a>.  Theme by <a href="//sparkriver.com/"  target="_blank" rel="external nofollow" title="sparkriver主题">sparkriver</a>.</p>
    </div><!-- #footer-content --> 

    </footer><!-- #footer -->
         <div id="shangxia">
            <div id="shang" title="↑ 返回顶部"></div>
                <?php if ( is_singular() ){ ?>
                 <?php if ( comments_open() ){ ?>
                <?php if ( $post -> comment_count ) { ?>
                <div id="comt" title="查看评论"></div>
                <?php } else { ?>
                <div id="comt"  title="沙发还没有被抢哦"></div>
                 <?php } ?><?php } ?>
                 <?php } ?>
            <div id="xia" title="↓ 移至底部"></div>
        </div>  
<?php wp_footer(); ?>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/lib/js/devework.js'></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/lib/js/custom.js"></script>
</body>
<!--[if IE 6]>
            <script type="text/javascript" src="http://static.duoshuo.com/js/letskillie6.zh_CN.min.js"></script>
        <![endif]-->
</html>