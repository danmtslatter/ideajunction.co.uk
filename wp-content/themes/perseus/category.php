<?php
/**
 * The template for displaying Archive pages.
 
 */      
get_header(); 

?>

<section id="content">
	
    <div class="container_12">
      <div id="page_title_con" style="">
                    <div id="page_title_con_inner">	
                        <h2 id="page_titles"><?php
                        $cat_id=get_cat_ID( single_cat_title( '', false ) );
                        
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                        ?></h2>
                        
					</div>
                        
                       </div> 
        <div class="grid_9 alpha omega background">
            
            <div class="marg-left">
				
           
           <?php 
                rewind_posts();
                   
                     get_template_part( 'loop', 'author' );
                      
                ?>
            </div>
            
          <div style="display:block" class="gloss_post_nav"> <?php paginate(); ?><div class="clear"></div></div>
        </div>
			<?php get_sidebar(); ?>
            <div class="clear"></div>
    </div>
</section>



<?php get_footer(); ?>
