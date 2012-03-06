<?php
/* Template Name: Contact Page */
global $post;
?>
<?php get_header(); 

$options = get_option('contact');

if($options['show_sidebar']=='false'):
                    
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
                    				
				<div class="page_content">
				
                        <?php 
                        
                       the_post();
                        the_content();
                        echo do_shortcode("[contact_form]");
                        
                        
                        
                        ?>
                </div>      
       
            </div>
         </div>
         </div>
         <div class="clear"></div>
    </div>
</section>

<?php
else:
?>

<section id="content">
    <div class="container_12">
		
    <div class="clear"></div>

        <div class="extra-wrap">
 
                    	<div id="page_title_con">
                    	<div id="page_title_con_inner">
                    		<h2 id="page_titles"><?php the_title();?></h2>
                    	</div>
                    	</div>
            <div class="grid_9 alpha omega">    

            <div class="marg-left">
		   <div class="post_content">
				
                   
                    
                    
                   
                      
				
				<div class="page_content">
				
                       <?php 
                       the_post();
                       the_content();
                        echo do_shortcode("[contact_form]"); ?>
                </div>        
              

				</div>
              </div>

            </div>

                <?php get_sidebar(); ?>

                

        

        <div class="clear"></div>           

    	</div>

    </div>

</section>


<?php
endif;






get_footer(); ?>