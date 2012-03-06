<?php
/**
 * The template for displaying Archive pages.
 
 */

get_header(); ?>

<section id="content">
	
    <div class="container_12">
      <div id="page_title_con">
                    	<div id="page_title_con_inner">
                        <h2 id="page_titles">
                            
                             <?php if ( is_day() ) : ?>
                                <?php printf( __( 'Daily Archives: <span class="title_results">%s</span>', $domain ), get_the_date() ); ?>
                <?php elseif ( is_month() ) : ?>
                                <?php printf( __( 'Monthly Archives: <span class="title_results">%s</span>', $domain ), get_the_date( 'F Y' ) ); ?>
                <?php elseif ( is_year() ) : ?>
                                <?php printf( __( 'Yearly Archives: <span class="title_results">%s</span>', $domain ), get_the_date( 'Y' ) ); ?>
                <?php else : ?>
                                <?php _e( 'Blog Archives', $domain ); ?>
                <?php endif; ?>
                            
                            
                        </h2>
                         
					
                        
                       </div> </div>
        <div class="grid_9 alpha omega background">
            
            <div class="marg-left">
				<?php 
                    
                    if ( have_posts() )
                        the_post();
                ?>
                
                            
               
                            
                
                <?php
                    
                    rewind_posts();
                
                    
                     get_template_part( 'loop', 'archive' );
                ?>
            </div>
             
<div style="display:block" class="gloss_post_nav"> <?php paginate(); ?><div class="clear"></div></div>
        </div>
			<?php get_sidebar(); ?>
            <div class="clear"></div>
    </div>
</section>



<?php get_footer(); ?>
