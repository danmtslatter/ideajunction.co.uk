<?php get_header();
global $post;
the_post();
$porturl=get_option('portlink');

$ops=get_option('portfolio');
$per_page=get_option('portsettings');
?>

<section id="content">


  <div class="container_12">
   		<div class="grid_12">
   		
    <div class="clear"></div>
           <div class="marg-left">
           
           <div class="post_content">
			  
                    <div id="page_title_con">
                    	<div id="page_title_con_inner">
                    
                    		<h2 id="page_titles"><?php the_title();?></h2>
                    	</div>
                    	</div>
                    <?php $args=array('show_count'=> 1,'name'=> 'portfolio_cats','taxonomy'=>'portfolio-category','title_li'=>'');?>
       <ul id="portfolio_cats_list" class="portfolio_main_page" style="">
       <li class="<?php print($nav_class);?>"><a href="<?php echo $porturl; ?>">All</a></li>
       <?php wp_list_categories( $args ); ?>
       </ul>	
                    				
				<div class="page_content">
				
                        <?php 
                        
                      
                        the_content();
                        
                        
                        
                        
                        ?>
                </div>      
       <?php
       comments_template(); 
        ?>    
            </div>
         </div>
         </div>
         <div class="clear"></div>
    </div>
</section>
<?php get_footer(); ?>