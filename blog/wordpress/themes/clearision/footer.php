<footer id="footer" role="contentinfo">
<?php $clrs_tjt = get_option('clrs_tongji'); if ( !empty($clrs_tjt) ) { echo $clrs_tjt;}; ?>

 <a href="http://aotxland.com" title="AoTxLand">AoTxLand</a> theme<a href="http://blog.dimpurr.com/clearision" title="Clearision">Clearision</a><br />
Powered by <a href="http://wordpress.org/" title="WordPress">WordPress</a>

<script src="<?php echo get_template_directory_uri(); ?>/js/script.js" type="text/javascript"></script>
<?php wp_footer(); ?>
</footer>

</div>
</body>
</html>