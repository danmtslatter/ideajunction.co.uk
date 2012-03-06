<?php
$about_options = get_option('theme_options');

?>

<div class="clear"></div>
		
		<!-- footer -->
		<div id="footer" class="padding_top_45 base_footer">
		
		
            <div class="container_12">
            <?php
		
		
		if($about_options['display_about_us']=='true'):
		
		?>
		<div id="about_us_con">
		<div id="about_us_image">
		<?php
			if($about_options['about_us_map']!=''):
		?>
		<div class="about_us_map"><?php print($about_options['about_us_map']);?></div>
		
		<?php
			elseif($about_options['about_us_image']!=''):
		?>
		<img src="<?php print($about_options['about_us_image']);?>"/>
		<?php
			endif;
		?>
		</div>
		<div id="about_us_text">
		<?php
			if($about_options['about_us_title']!=''):
		?>
		<h3><?php print($about_options['about_us_title']);?></h3>
		<?php
			endif;
		?>
		
		<p><?php print($about_options['about_us_text']);?></p>
		</div>
		
		
		
		
		<div class="clear"></div>
		</div>
		<?php
		
		endif;
		
		
		?>
                <div class="extra-wrap">
                    <div class="grid_4" style="padding-left:0px;">
                    	<!--<h6><a href="<?php echo home_url(); ?>">
									<?php
                                    if ($logo_img=get_option('afl_logo')){ ?><img src="<?php echo $logo_img ?>" /><?php } ?>
                                    <strong> <?php echo get_option('blogname_part1') ?> </strong>
                                    <b><?php echo get_option('blogname_part2') ?></b>
                        </a></h6>-->
                        <?php if (! dynamic_sidebar('footer-widget-1')):?>
       
        <?php
        
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider">
		<div class="head_divider_inner">
		</div>
	</div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
		
    <?php endif; ?>
                    </div>
                    <div class="grid_4 top23">
                        <?php if (! dynamic_sidebar('footer-widget-2')):?>
       
        <?php
        
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider">
		<div class="head_divider_inner">
		</div>
	</div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
		
    <?php endif; ?>
                    </div>
                    <div class="grid_4  top23">
                        <?php if (! dynamic_sidebar('footer-widget-3')):?>
       
        <?php
        
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider">
		<div class="head_divider_inner">
		</div>
	</div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
		
    <?php endif; ?>
                    </div>
                    
                    <div class="grid_4  top23" style="margin-right:0px;">
                        <?php if (! dynamic_sidebar('footer-widget-4')):?>
       
        <?php
        
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider">
		<div class="head_divider_inner">
		</div>
	</div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
		
    <?php endif; ?>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
          
            
		</div><!--end of footer-->
		
		<div class="copyright_outer">
		<?php
		$ops=get_option('theme_options');
		if(isset($ops['display_copyright'])):
		if($ops['display_copyright']=='true'):
		
		
		
		?>
		
		<div class="copyright_inner" style="">
		
		<?php
		
		print('&copy;'.$ops['copyright_info']);
		
		$icon_style='';
		$alignment='';
		
		?>
		</div>
		<?php	
		endif;
		endif;
		?>
		
		
		
		
		<div id="footer_sm">
		<?php
		$social_media=get_option('social');$display_social=$social_media['display_social'];$social_media=$social_media['social'];
			if($display_social=='true'):
		?>
			<ul class="list-icon" style="">
            <?php foreach ($social_media as $s){	
             	    if($s['url']):
             		echo '<li><a href="'.$s['url'].'"><img style="" src="'.$s['image'].'" /></a></li>';
             	endif;
            		} ?>
   			</ul>
		<?php	
			endif;
		
		?>
		
		</div>
		<div class="clear"></div>
		</div>
		
		
		
		
		
	   <script type="text/javascript">
        jQuery(window).load(function(){
            jQuery('#preloader').hide();
            jQuery('body').css('overflow', 'auto');  
        }); 
       </script>
       
<?php

	wp_footer();
?>

</body>
</html>
