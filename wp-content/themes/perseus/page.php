<?php get_header();
global $post;

$opts=get_post_meta($post->ID, 'nivo_slider');

if(is_array($opts)):
	if (array_key_exists(0, $opts)):
		$opts=$opts[0];
	else:
		$opts["display_slider"]='false';
	endif;
else:
$opts["display_slider"]='false';
endif;			


if($opts["display_slider"]=='true'):

include_once TEMPLATEPATH . '/lib/slider.php';

endif;
the_post();
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
                        
                      
                        do_shortcode(the_content());
                        
                        
                        
                        
                        ?>
                </div>      
       
            </div>
         </div>
         </div>
         <div class="clear"></div>
    </div>
</section>
<?php get_footer(); ?>