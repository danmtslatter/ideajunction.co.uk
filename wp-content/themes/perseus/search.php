<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		
<section id="content"> 
    <div class="container_12 gloss_main_content">
    
	 
 

	
			
				<div id="page_title_con" style="">
                    <div id="page_title_con_inner">	
                    		<h2 id="page_titles"><?php print( 'Search Results for : <span class="title_results">' . get_search_query() . '</span>' ); ?></h2>
                    		
                    </div>
                    </div>
           
      		 	
				
     
 
 
        <div class="grid_9 alpha omega">
      
      	
            
           <div class="marg-left" style="">
           
             <div class="post_contents">   
                 
                <?php get_template_part( 'loop_search', 'search' );?>
             </div>    
           </div>
			<div style="display:block" class="gloss_post_nav"> <?php paginate(); ?><div class="clear"></div></div>
        </div>
        <?php get_sidebar(); ?>

        <div class="clear"></div>
        
    </div>
</section>
<?php get_footer(); ?>
		