<?php
/**
 * The template for displaying Tag Archive pages.
 *
 
 */

get_header(); ?>

		<section id="content">
            <div class="container_12">
            <div id="page_title_con" style="">
                    <div id="page_title_con_inner">	
                        <h2 id="page_titles"><?php
                            printf( __( 'Tag Archives: %s', $GLOBALS['domain'] ), '<span class="title_results">' . single_tag_title( '', false ) . '</span>' );
                        ?></h2></div></div>
                    <div class="grid_9">
                        
                        <?php get_template_part( 'loop', 'tag' );?>
           			 
           			 <div class="gloss_post_nav">
 
 <?php paginate(); ?>
 <div class="clear"></div>
</div>
           			 
           			 </div>
           			  
				<?php get_sidebar(); ?>
                <div class="clear"></div>
            </div>
		</section>
<?php get_footer(); ?>