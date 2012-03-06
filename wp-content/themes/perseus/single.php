<?php
/**
 * The Template for displaying all single posts.
 
 */

get_header(); 
the_post();?>
<section id="content">	
   <div class="container_12">
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
				
                        <?php the_content();?>
                	</div>    
                    
        

					
					
                    <p><?php edit_post_link('Edit this entry','','.'); ?></p>
                   
                                
                               		<div class="code_puzzle_post_footer">
										<div class="code_puzzle_post_footer_inner"> 
											<div class="code_puzzle_post_info">                                
												
												<?php 
												get_template_part('/inc/info');
												
												?>
											
											</div>
											
										</div>
										
									</div>	
							
							<div class="clear"></div>
                 </div>
                 <div class="divider_outer"><div class="divider_inner"></div></div>
                 
<?php wp_link_pages( array( 'before' => '<div style="display:block" class="gloss_post_nav">', 'after' => '</div>','link_before'      => '<span>',
    'link_after'       => '</span>' ) ); ?>
                   <?php 
                   if(get_post_type( $post )!='portfolio'):
                   comments_template(); 
                   endif;
                   ?> 
                
                </div>
            </div>
       
		<?php get_sidebar(); ?>
        <div class="clear"></div>
   </div> 
   
   </div>
</section>


<?php get_footer(); ?>
