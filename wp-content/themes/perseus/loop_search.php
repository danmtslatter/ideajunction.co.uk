<?php 
$opts=get_option('blog');
$index=0;
$style="border-top:none;";
if (have_posts()) : while (have_posts()) : the_post();
?>
                        
                        
                        <div class="post" id="post-<?php the_ID(); ?>">
                                
                        

	<div class="blog_title_outer" style="<?php if($index==0) print($style); ?>">
		<div class="blog_title_inner" style="<?php if($index==0): print($style);$index++;endif; ?>">
			<h3 class="blog_post_titles">

<a class="" href="<?php echo get_permalink();?>"><?php echo the_title();?></a></h3><div class="post_date_con"><img style="float:left;height:19px;margin-right:2px;" src="<?php print(get_template_directory_uri("template_url")); ?>/css/images/clock.png"/>
<span class="day_con"><?php the_time('d');?></span>
<span class="month_con">&nbsp;<?php the_time('M');?>&nbsp;</span>
<span class="year_con"><?php the_time('Y'); ?></span>
</div>
<div class="post_date_con">
<img style="float:left;height:19px;margin-right:2px;" src="<?php print(get_template_directory_uri("template_url")); ?>/css/images/blog.png"/>
<a href="<?php print(get_permalink().'#comments');?>"><?php comments_number();?></a>
</div>
<div class="clear"></div>
</div>
</div>




                                
                                
                                
                                <?php if (has_post_thumbnail()):
                                ?>
                               
                               
                               
                                
                               
                               
                               <div class="image_dark_con">
                               <a href="<?php echo get_permalink();?>">
                                <?php
								  	$image_id ='';
									$image_id = get_post_thumbnail_id();
                      				$image_url = wp_get_attachment_image_src($image_id,'single_post', true);
								?>
								<div class="img-box" style=""><img class="" src="<?php echo $image_url[0];?>"/></div>
								</a></div>
								
								<?php endif; ?> 
                                <?php if($opts['blog_style']=='Excerpt'): ?>
                                <div class="entry">
                              
                                
                                        <?php the_excerpt(); ?>
                                
                                <?php else: ?>
                                <div class="entry page_content">
                                <?php 	
                                        the_content(); 
                                      endif;
                                        ?>
                                      <?php 
												get_template_part('/inc/info');
												
												?> 
                                        
                                </div>

							<div class="clear"></div>
								 	
                        </div>
                <?php endwhile; 
                
                
                
                ?>
               
                <?php //afl_pager($posts_count, $per_page, $paged);  ?>
                <?php else : ?>
                        <h4>Sorry no results for entered search "<?php echo get_search_query();?>".</h4>
                <?php endif; ?>
