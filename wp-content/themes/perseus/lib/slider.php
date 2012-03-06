<?php 
$slider_array=get_post_meta($post->ID, 'nivo_slider');
$slider_array=$slider_array[0];
$slides_out='';
$captions_out='';
$class="";
$out='';
$style=0;
if(isset($slider_array['slide_style'])):
$style=intval($slider_array['slide_style']);
endif;

                
        
                switch($style){
                case 0:
                $class='full_image_only';
                break;
                case 1:
                $class='image_left';
                break;
                
                
                
                }


$code_puzzle_recent_post_args='';  


			if(array_key_exists('slider_cat', $slider_array)==false){
				$slider_array['slider_cat']='0';

			}
			 
			if($slider_array['slider_cat']=='')$slider_array['slider_cat']='0';
            if($slider_array['slider_cat']!='0'):
            $code_puzzle_recent_post_args = array(
        	'post_type' => 'slides',
        	'order' => 'DESC',
        	'posts_per_page' => $slider_array['num_slides'],
        	'post_status' => 'publish',	
        	'tax_query' => array(
								array(
										'taxonomy' => 'slides-category',
										'terms' => $slider_array['slider_cat'],
										)
									)
        	
			
			
			
				);
				
			else:
			
			
			$code_puzzle_recent_post_args = array(
        	'post_type' => 'slides',
        	'order' => 'DESC',
        	'posts_per_page' => $slider_array['num_slides'],
        	'post_status' => 'publish',	
        	
			
			
				);
			
			
			
			endif;
				$code_puzzle_recent_post = new WP_Query( $code_puzzle_recent_post_args );
                
               




?>
                            <div id="nivo-slider" class="slider theme-default <?php print($class); ?>">
                            <div class="nivoSlider ">
<?php              
 
                   $index=0;
                    	while ( $code_puzzle_recent_post->have_posts() ) : $code_puzzle_recent_post->the_post(); 
                    
                   				if (has_post_thumbnail()): 
                   				$index++;
								$image_id ='';
								$image_url='';
								$title='';
								$image_id = get_post_thumbnail_id();
            					
                   
									if($style==0):$image_url = wp_get_attachment_image_src($image_id,'slider_image', true);
									else: $image_url = wp_get_attachment_image_src($image_id,'slider_image_sidebar', true);endif;
                    
					
					
								$link=get_post_meta(get_the_ID(), 'slide_link');
								$diplay_excerpt=get_post_meta(get_the_ID(), 'display_slide_excerpt');
								$display_slide_title=get_post_meta(get_the_ID(), 'display_slide_title');
					
					
									
                    
                    
                    			if($diplay_excerpt[0]=='true' or $display_slide_title[0]=='true'):
                    			
                    			if($link):
                    				$slides_out .= '<a href="http://'.$link[0].'"><img class="slider_images" src="'.$image_url[0].'" alt="" title="#htmlcaption_'.$index.'"/></a>';
                   					else:
                   					$slides_out .= '<img class="slider_images" src="'.$image_url[0].'" alt="" title="#htmlcaption_'.$index.'" />';
                   					endif;
                   				
                    			
                   				$captions_out.='<div id="htmlcaption_'.$index.'" class="nivo-html-caption">';
                   
                   					
                  					
                  					if($display_slide_title[0]=='true') : 
                  					if($link): $captions_out.='<a href="http://'.$link[0].'" class="nivo_links" style="text-decoration:none">'; endif;
                  						$captions_out.='<h3>'.get_the_title().'</h3>';
                  						if($link):$captions_out.='</a>';endif;
                   					endif;
                   
                   
                   				
                  
                    
                    				if($diplay_excerpt[0]=='true'): 
                    				$captions_out.='<div class="slider_content"><p>';
                   						if($link): $captions_out.='<a href="http://'.$link[0].'" class="nivo_links" style="text-decoration:none">'; endif;
                   						$captions_out.=get_the_excerpt(); 
                   						if($link):$captions_out.='</a>';endif;
                   						$captions_out.='</p></div>';
                   					endif;
                    
                   
                   				
                   
                  
									                 
                   				
                   					$captions_out.='</div>';
						
                    
                    			else:
                    			
                    			if($link):
                    			$slides_out .= '<a href="http://'.$link[0].'"><img class="slider_images" src="'.$image_url[0].'" alt="" title=""/></a>';
                    			else:
                    			$slides_out .= '<img class="slider_images" src="'.$image_url[0].'" alt="" title=""/>';
                    			endif;
                    			
                    			
                    			endif;
                    			
                    		endif;
                    endwhile;
                    
                    $out.=$slides_out;
                    $out.='</div>';
                    $out.=$captions_out;
                    
                    
        			
               
                                               
                                $out.='
                                
                                <script type="text/javascript">
									jQuery(window).load(function(){
										jQuery(function(){
											jQuery("#nivo-slider div.nivoSlider").nivoSlider({directionNavHide: false,';
											if ($slider_array['slider_effect']) $out .= 'effect: \''.$slider_array['slider_effect'].'\',';
											if ($slider_array['slider_speed']) $out .= ' animSpeed: '.$slider_array['slider_speed'].',';
											if ($slider_array['slider_pauze']) $out .= ' pauseTime: '.$slider_array['slider_pauze'].',';
											
									
											if ($slider_array['slider_autoplay']=='true') $out .= ' manualAdvance: false'; else $out .= ' manualAdvance: true'  ;
											
										$out .='}); }); jQuery(".nivo-directionNav a").hover(function(){
				jQuery(this).stop().animate({opacity:1.0},{queue:false,duration:300});
				}, function() {
					jQuery(this).stop().animate({opacity:0.7},{queue:false,duration:300});
				});}); 
										
								</script>
                
               ';
 
print($out);
?>


</div>