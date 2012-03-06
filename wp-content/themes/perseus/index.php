<?php get_header(); 
$ops=get_option('blog');

?>
<section id="content"> 
    <div class="container_12 gloss_main_content" style="<?php if($ops['display_blog_title']=='false') print('margin-top:45px;'); ?>">
    
	 
 
 <?php if($ops['display_blog_title']=='true'): ?>

	
			
				<div id="page_title_con" style="">
                    <div id="page_title_con_inner">	
                    		<h2 id="page_titles"><?php print($ops['blog_title']); ?></h2>
                    		
                    </div>
                    </div>
           
      		 <?php endif; ?>	
				
     
 
 
        <div class="grid_9 alpha omega" >
      
      	
            
           <div class="marg-left" style="">
           
             <div class="post_contents">   
                 
                <?php get_template_part( 'loop', 'author' );?>
             </div>    
           </div>
			<div style="display:block" class="gloss_post_nav"> <?php paginate(); ?><div class="clear"></div></div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
        
    </div>
</section>
<?php get_footer(); ?>
