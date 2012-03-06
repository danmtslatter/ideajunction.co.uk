<?php
/**
 * The template for displaying Author Archive pages.
 
 */

get_header(); ?>

<section id="content">
	
    <div class="container_12">
    <div id="page_title_con" style="">
                    <div id="page_title_con_inner">	
                        <h2 id="page_titles">
                        <?php
                        if ( have_posts() )
                            the_post();
                            if ( !get_the_author_meta( 'description' ) ) : 
                    ?>
                    
                                    <?php printf( __( 'Author Archives: %s', $domain ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?>
                    	 </h2>	
                    <?php
                    endif;
                    // If a user has filled out their description, show a bio on their entries.
                    if ( get_the_author_meta( 'description' ) ) : ?>
                                        <div id="entry-author-info" class="author_bio">
                                            <div id="author-avatar">
                                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( '$domain_author_bio_avatar_size', 60 ) ); ?>
                                            </div><!-- #author-avatar -->
                                            <div id="author-description">
                                                <h3><?php printf( __( 'About %s', $domain ), get_the_author() ); ?></h3>
                                                <p><?php the_author_meta( 'description' ); ?></p>
                                            </div><!-- #author-description	-->
                                        </div><!-- #entry-author-info -->
                    <?php endif; ?>
                       
                        
     </div>    </div>               
        <div class="grid_9 alpha omega">
            
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
