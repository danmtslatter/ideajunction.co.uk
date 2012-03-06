<?php

class perseus_portfolioWidget extends WP_Widget {
    /** constructor */
    function perseus_portfolioWidget() {
        parent::WP_Widget(false, $name = 'Perseus Portfolio Widget',array( 'description' => 'Custom Perseus Widget for displaying portfolio posts in multiple formats.' ));
    }
	
	
	
	
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        if(empty($instance['title'])){ $instance['title'] = '';}
        $title = apply_filters('widget_title', $instance['title']);
		
		
		
		if(empty($instance['number'])){ $instance['number'] = '5';}
		$number = apply_filters('widget_post_number', $instance['number']);
		
		
		
		if(empty($instance['cat_id'])){ $instance['cat_id'] = '';}
		$cat_id = apply_filters('widget_cat_id', $instance['cat_id']);
		
		
		$style = '';
		
		
		//$excerpt_lenght = apply_filters('widget_post_excerpt_lenght', $instance['excerpt_lenght']);		
        if($title==''){
        $title="Recent Work";
        }
        if($number==''){
        $number=5;
        }
      
            
             echo $before_widget; 
              echo $before_title . $title . $after_title;
         $code_puzzle_recent_post_args='';
                
                
        if(isset($cat_id)&&$cat_id!=''):            
        $code_puzzle_recent_post_args = array(
        	'showposts' => $number,
        	'post_type' => 'portfolio',
        	'order' => 'DESC',
        	'post_status' => 'publish',	
        	'tax_query' => array(
								array(
										'taxonomy' => 'portfolio-category',
										'terms' => $cat_id
										)
									)
        	
			
			
			
		);
		else:
		
		$code_puzzle_recent_post_args = array(
        	'showposts' => $number,
        	'post_type' => 'portfolio',
			'order' => 'DESC',
			'post_status' => 'publish',
			
			
			
		);
		
		endif;
		
		$code_puzzle_recent_post = new WP_Query( $code_puzzle_recent_post_args );
		
        if ( $code_puzzle_recent_post->have_posts() ) : 
                   
                    
                    if($style!='thumbs'):
                    ?>
                    <ul class="recent-posts-thumbs">
                    <?php
                    else:
                    ?> 
                    <div class="recent_thumbs_con">
                    <?php
                    endif;
                    $counter=0;
           while ( $code_puzzle_recent_post->have_posts() ) : $code_puzzle_recent_post->the_post(); ?>
				<?php
				$image_id =  get_post_thumbnail_id();	
				$counter++;
			
			if($style!='thumbs'):	
				?>
			<!--start li full width-->
			<li class="widget-entry-title">
			
			
			<div class="code_puzzle_entry_container">
			<?php
			if (has_post_thumbnail()): 
			$image_id ='';
					$image_id = get_post_thumbnail_id();
                      $image_url = wp_get_attachment_image_src($image_id,'recent_posts_widget', true);
			
			?>
			<div class="sidebar_image_con">
			<div class="image_dark_con">
			<div class="img-box" style="">
			<a href="<?php echo get_permalink();?>"><img class="" src="<?php echo $image_url[0];?>"/></a>
			</div>
			</div>
			</div>
			<?php
			endif;
			?>
			
			
			<div class="code_puzz_date_con"><?php the_time('M j, Y') ?></div>
			<div class="sidebar_content_con"  style="<?php if (has_post_thumbnail()): print('padding-left: 87px');endif; ?>">
			
			<a  class="widget_title_link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'glossmagpro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><h5><?php the_title(); ?></h5></a>
			
			</div>
			
			
			
			
			<div class="clear"></div>
			</div>	
			</li><!--end li full width-->
			<?php
			
				
			
			endif;
			
			
		
			endwhile; 
			remove_filter('excerpt_more', 'one_col_excerpt');
add_filter('excerpt_more', 'afl_auto_excerpt_more');
               else : ?>
                    <li> "None found" </li>
                   <?php endif; ?>
                    <div class="clear"></div>
                    <?php
                    if($style!='thumbs'):
                    ?>
                    </ul>
                    <?php
                    else:
                    ?>
                    <div class="clear"></div></div>
                    <?php 
                    endif;
                    wp_reset_query(); ?>
								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
      if(empty($instance['title'])){ $instance['title'] = '';}
      $title = esc_attr($instance['title']);
	  
	  if(empty($instance['number'])){ $instance['number'] = '5';}
	  $number = esc_attr($instance['number']);
	  
	  
	  if(empty($instance['cat_id'])){ $instance['cat_id'] = '';}
		$cat_id = esc_attr($instance['cat_id']);
	  
	  
	  
	  
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php print('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php print('Number of posts:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
        
        <p>
      
       <?php 
       $flield_name=$this->get_field_name('cat_id');
       $selected=$cat_id;
       $args=array('show_option_all'    =>'All' ,'name'=> $flield_name,'selected' =>$selected,'taxonomy'=>'portfolio-category');
       wp_dropdown_categories($args); ?> 
      </p>
        
        <?php 
    }

} // class  Widget
?>