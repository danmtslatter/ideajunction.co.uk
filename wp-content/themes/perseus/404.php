<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

<section id="content">
   <div class="container_12">
 
            <div class="container_12">
                <div class="grid_12">
                    <div class="post error_404">
                   
    
                        <h3 class="gloss_main_titles_main">The Page You were looking for was not found</h3>
                        <p><?php echo 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps try a search using the below form.'; ?></p>

                        <div class="clear"></div>
                        <div class="widget 404_search">
						<?php get_search_form(); ?>
						<div class="clear"></div>
					</div>
                    </div>                 
                </div>
                <div class="clear"></div>
            </div>
        </div>
    
</section>
<script type="text/javascript">
    // focus on search field after it has loaded
    document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_footer(); ?>