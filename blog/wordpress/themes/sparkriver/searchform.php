<?php $search_text = empty($_GET['s']) ? __('搜索...', 'themater') : get_search_query(); ?> 
<div id="search" title="<?php _e('输入关键词并按Enter键搜索', 'themater'); ?>">
    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>"> 
        <input type="text" x-webkit-speech   value="<?php echo $search_text; ?>"
            name="s" id="s"  onblur="if (this.value == '')  {this.value = '<?php echo $search_text; ?>';}"  
            onfocus="if (this.value == '<?php echo $search_text; ?>') {this.value = '';}" 
        />
        	<button type="submit"><?php _e("Search"); ?></button>

    </form>
</div><!-- #search -->