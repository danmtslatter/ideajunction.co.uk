<?php
/**
 * The template for displaying attachments.
 *
 
 */

get_header(); ?>

<section id="content">
	
    <div class="container_12">
        <div class="grid_9 alpha omega background">
            
            <div class="marg-left">
			<?php
			/* Run the loop to output the attachment.
			 * If you want to overload this in a child theme then include a file
			 * called loop-attachment.php and that will be used instead.
			 */
			get_template_part( 'loop', 'attachment' );
			?>
 		</div>
          <div style="display:block" class="gloss_post_nav"> <?php paginate(); ?><div class="clear"></div></div>
        </div>
			<?php get_sidebar(); ?>
            <div class="clear"></div>
    </div>
</section>



<?php get_footer(); ?>
