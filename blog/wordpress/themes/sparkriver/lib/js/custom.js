 jQuery(function() {    
 		//懒加载      
       jQuery("img.lazy").lazyload({ 
   	 effect : "fadeIn",
    	failure_limit : 10 }); 
        });
jQuery(document).ready(function(){

// 菜单栏
jQuery(function(){ 
  jQuery('ul.menu-primary').superfish({ 
  animation: {height:'show'},
autoArrows:  true,
                dropShadows: false, 
                speed: 200,
                delay: 800
                });
            });