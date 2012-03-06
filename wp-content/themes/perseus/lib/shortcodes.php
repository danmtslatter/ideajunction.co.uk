<?php 
   
/*-------------------3 column-------------------------*/

function render_col_contents($atts, $content = null){
			
		extract( shortcode_atts( array(
		'cols' => '',
		'first' => 'false',
		'last' => 'false',
		'align' => '',
		'title' => '',
		'aside' => '',
		
	), $atts ) );
	$class='';
		switch ($cols) {
    case 'two':
    	if($aside==''):
        $class='two_col_item';
        elseif($aside=='left'):
        $class='two_col_aside_left';
        elseif($aside=='right'):
        $class='two_col_aside_right';
        else:
        $class='two_col_item';
        endif;
        break;
    case 'three':
        $class='three_col_item';
        break;
    case 'four':
        $class='four_col_item';
        break;
    case '':
    	$class='';
    break;
}

		if($title!='')$title='<div class="col_title"><h4>'.$title.'</h4></div>'; //check for title

	
		if($first=='true'):	
		
		
		return '<div class="col_wrapper margin_bottom_45" style="text-align:'.$align.'"><div class="'.$class.' col_item margin_right_15">'.$title.do_shortcode($content).'</div>';
		
		elseif($last=="true"):
		
		
		return '<div class="'.$class.' last col_item">'.$title.do_shortcode($content).'</div><div class="clear"></div></div>';
		
		else:
		
		return '<div class="'.$class.' col_item margin_right_15">'.$title.do_shortcode($content).'</div>';
		
		endif;
		

}
add_shortcode('column', 'render_col_contents');   
/*----------------------------------------------------*/


/*-------------------buttons-------------------------*/

function render_button($atts, $content = null){
		
		extract( shortcode_atts( array(
		'text' => 'Read More',
		'colour' => 'Light_gray',
		'link' => '#',
		
		
	), $atts ) );
	
		$class='';
		switch ($colour) {
    case 'gray':
        $class='sc_gray_button';
        break;
    case 'blue':
        $class='sc_blue_button';
        break;
    case 'dark':
        $class='sc_dark_button';
        break;
    case '':
    	$class='';
    break;
}
		
			
		
		return '<div class="button_wrapper"><a href="'.$link.'" class="sc_button '.$class.'">'.$text.'</a><div class="clear"></div></div>';
		
		

}
add_shortcode('button', 'render_button'); 



/*----------------------------------------------------*/

/*quote*/

function render_quote($atts, $content = null){
		
		
		
			
		
		return '<blockquote>'.do_shortcode($content).'</blockquote>';
		
		

}
add_shortcode('quote', 'render_quote'); 
/*-------------------------------------------*/

/*info block*/

function render_infoblock($atts, $content = null){
		
		
		
			
		
		return '<div class="info_block">'.do_shortcode($content).'</div>';
		
		

}
add_shortcode('info', 'render_infoblock'); 



/*-------------------code bock-------------------------*/

function render_code_block($atts, $content = null){
		
		extract( shortcode_atts( array(
		
		'colour' => 'Light_gray',
		
		
		
	), $atts ) );
	
		$class='';
		switch ($colour) {
    case 'gray':
        $class='sc_gray_code_block';
        break;
    case 'blue':
        $class='sc_blue_code_block';
        break;
    case 'dark':
        $class='sc_dark_code_block';
        break;
    case '':
    	$class='';
    break;
}
		
			
		
		return '<pre class="cs_code_block '.$class.'">'.$content.'</pre>';
		
		

}
add_shortcode('code_block', 'render_code_block'); 



/*---------------Contact Form--------------------*/

function render_contact_form($atts, $content = null){
		
		
		
		
		$args=get_option('contact');
		$out='';
		
	
	
		
		$img_url=get_template_directory_uri("template_url").'/css/images/letter.png';
		
		
	
		
		$out.='<div id="code_puzz_contact_form">
						<div id="code_puzz_contact_form_inner">
							
			<h3 class="contact_form_title"><img src="'.$img_url.'" height="30px" style="margin-right:10px;"/>'.$args['form_title'].'</h3>
			
						
						<form class="formular" id="commentForm" method="post" action="">
	
							
								<table class="contact_table">
									<tr>';
			
								$out.='<td>
										<label>'.$args['name_field'].'</label></td>
										<td><fieldset><input  id="cname" name="cname" class="validate[required] contact_input" minlength="2" value=""></fieldset></td>
										
									</tr>
									<tr>	
			
									<td><label>'.$args['email_field'].'</label></td>
									<td><fieldset><input  id="cemail" name="email" class="contact_input email validate[required,[custom[email]]" value=""></fieldset></td>
										
									</tr>	
									<tr>	
			
										<td><label>'.$args['website_field'].'</label></td>
										<td><input  id="curl" name="url" class="contact_input validate[custom[url]]" value=""></td>
										
									</tr>	
									<tr>';
										
										$rand1=rand(1, 10);
										$rand2=rand(1, 10);
										
			
									$out.='<td><label>'.$args['message_field'].'</label></td>
									<td><textarea id="ccomment" name="comment" class="contact_textarea validate[required]"></textarea></td>
										
									</tr>	
									
				
										
									<tr>
									
			
										<td>
										<input type="hidden" id="label_1" value="'.$rand1.'"/>
											<input type="hidden"  id="label_4" value="'.$rand2.'"/>
										<label>Sum : '.$rand1.' + '.$rand2.' = </label></td>
										<td><input name="contact_answer" class="validate[required,funcCall[checksum]] contact_input" id="contact_answer" type="text" value=""/></td>
									</tr>	
									<tr>
										<td></td>
										<td><input class="submit contact_button"  style="display:none" value="Submit" type="submit">
										<div class="clear"></div>
		<input class="submit sc_button sc_dark_button" type="submit" value="Send Mail" style="padding:5px 10px 5px 10px;"/>
										
										</td>
									</tr>
			
							</table>
		
		
		
							<div id="#code_puzzle_email_response"></div>	
		
						
						</form>		
					<div id="code_puzzle_email_response"></div>

					</div><!--end inner contact-->


			</div>';
			
		$out.='<div class="clear"></div>';
		
		
		
		
		return $out;
		
		

}
add_shortcode('contact_form', 'render_contact_form'); 



/*----------------------------------------------------*/

/*portfolio shortcode---------------------------------*/

function afl_portfolio($atts, $content = null){

extract( shortcode_atts( array(
		'cat_id' => 0,
		'title' => 'From Our Portfolio',
		'order' => 'recent',
		), $atts ) );
        
        
        //$title=$atts['title'];
        $res = '';
        wp_reset_query();
		global $post;
		$temp='';
		$temp=$post;
		$post_counter=0;
		$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
		
		$post=$temp;
		$num_posts='';
		if($template_name=='custom_page_width_sidebar.php'):
		$num_posts=2;
		else:
		$num_posts=4;
		endif;
		
		$temp;
        
		add_filter('excerpt_more', 'new_excerpt_more');
        
        $col='first';
        $args='';
      
        if($cat_id!=0):$args = array( 'orderby' => $order,'showposts'=>10,'post_status' => 'publish','post_type' => 'portfolio',	
        	'tax_query' => array(
								array(
										'taxonomy' => 'portfolio-category',
										'terms' => $cat_id
										)
									));else:$args = array( 'orderby' => $order,'showposts'=>10,'post_status' => 'publish','post_type' => 'portfolio'
									);endif;
		$myposts = get_posts( $args );
		$num=0;
		$num_divs=0;
		
		$num_images=0; 
		$images_divs;
		$outer=0;
		$outer_width=0;
		
		$current_pos;
		$res.='<div class="recent_con margin_bottom_45">';			
                    if($template_name=='custom_page_width_sidebar.php'){
                    $temp='recent_sidebar';
                    $current_pos=2;
                    }
                    else{
                    $temp='recent_full'; 
                    $current_pos=3;                 
                    }
                    $images_divs='';
           $index=0;         
		 foreach( $myposts as $post ) : setup_postdata($post);
				
				 
					
					$image='';
					
					
					$id=get_post_thumbnail_id(get_the_ID());
                    
                /* 
                
                <div class="boxgrid captionfull">
				<img src="jareck.jpg">
				<div class="cover boxcaption" style="top: 160px; ">
					<h3>Jarek Kubicki</h3>
					<p>Artist<br><a href="http://www.nonsensesociety.com/2009/03/art-by-jarek-kubicki/" target="_BLANK">More Work</a></p>
				</div>		
			</div>
                
                */
                    
                    if($id):
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()  ), 'recent_images',true );                   
                   $post_counter++;
                    endif;
                    if($id):
                    $res.='<a href="'.get_permalink(get_the_ID()).'" style="display:block"><div class="recent_item margin_right_15">';
                    $res.='<div class="boxgrid captionfull">';
				$res.='<img src="'.$image[0].'">';
				$res.='<div class="cover boxcaption" style="top: 160px; ">';
					$res.='<h4>'.get_the_title().'</h4>';
				$res.='</div>';		
			$res.='</div>';
                    
                    
                    $index++; 
                    $res.='</div></a>';
                    endif;
                    if($index==$num_posts):break;endif;
                    
               endforeach; 
              
               $res.='<div class="recent_main_title"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
                       	
		$res.='<div class="clear"></div></div>';
         if($post_counter==0) $res='';                             
					
        return $res;


}    
add_shortcode('portfolio', 'afl_portfolio');

	function perseus_divider(){

        $out = '<div class="divider_outer">
<div class="divider_inner">

</div>

</div>';

        return $out;

    }

    add_shortcode('divider', 'perseus_divider');

    
	function afl_recent_posts($atts, $content = null){
        extract( shortcode_atts( array(
		'cat_id' => 0,
		'title' => 'From Our Blog',
		'order' => 'recent',
		), $atts ) );
        
      
        $res = '';
		wp_reset_query();
		
		global $post;
		$temp='';
		$temp=$post;
		$test=$post;
		
		$template_name = get_post_meta( $test->ID, '_wp_page_template', true );
		
		$post=$temp;
		
		
		$num_posts='';
		if($template_name=='custom_page_width_sidebar.php'):
		$num_posts=2;
		else:
		$num_posts=4;
		endif;
		
		$temp;
        $post_counter=0;
		add_filter('excerpt_more', 'new_excerpt_more');
        
        $col='first';
        $args='';
        
        if($cat_id!=0):$args = array( 'orderby' => $order,'showposts'=>10,'cat'=>$cat_id);else:$args = array( 'showposts'=>10,'orderby' => $order,);endif;
		$myposts = get_posts( $args );
		$num=0;
		$num_divs=0;
		
		$num_images=0; 
		$images_divs;
		$outer=0;
		$outer_width=0;
		
		$current_pos;
		$res.='<div class="recent_con margin_bottom_45">';			
                    if($template_name=='custom_page_width_sidebar.php'){
                    $temp='recent_sidebar';
                    $current_pos=2;
                    }
                    else{
                    $temp='recent_full'; 
                    $current_pos=3;                 
                    }
                    $images_divs='';
             $index=0;       
		 foreach( $myposts as $post ) : setup_postdata($post);
				
				 
					
					$image='';
					
					
					$id=get_post_thumbnail_id(get_the_ID());
                    
                 
                    if($id):
                    $post_counter++;
                    $image=wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()  ), 'recent_images',true );
                    endif;
                    
                  
                    if($id):
                    $res.='<a href="'.get_permalink(get_the_ID()).'" style="display:block"><div class="recent_item margin_right_15">';
                    $res.='<div class="boxgrid captionfull">';
				$res.='<img src="'.$image[0].'">';
				$res.='<div class="cover boxcaption" style="top: 160px; ">';
					$res.='<h4>'.get_the_title().'</h4>';
				$res.='</div>';		
			$res.='</div>';
                    $index++;
                    $res.='</div></a>';
                    endif;
                    if($index==$num_posts):break;endif;
                    
               endforeach; 
              
               $res.='<div class="recent_main_title"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
                       	
		$res.='<div class="clear"></div></div>';
         if($post_counter==0) $res='';                           
					
        return $res;
    }
    add_shortcode('recent_posts', 'afl_recent_posts');	
?>