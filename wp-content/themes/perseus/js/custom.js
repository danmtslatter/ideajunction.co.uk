/*Cufon fonts replace*/
jQuery(document).ready(function() {
Cufon.replace('h1.gloss_site_title',{hover:true});
Cufon.replace('h3.blog_post_titles',{hover:{color:'#333'}});
Cufon.replace('.widget_title_link',{hover:{color:'#333'}});
Cufon.replace('h1');

Cufon.replace('h2');

Cufon.replace('h3:not(.nivo_links h3)');
Cufon.replace('h4:not(#site-description)');
Cufon.replace('h5');


});


/*recent posts and portfolio effects*/
jQuery(document).ready(function($){
			
	$('.boxgrid.captionfull').hover(function(){
				
		$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:160});
		}, 
		function() {
					$(".cover", this).stop().animate({top:'150px'},{queue:false,duration:160});
		}
	);
				
				
});


jQuery(document).ready(function($){

		if ($('#fps_num_slides').val()<4){
		$('.recent_posts_nav').css('display','none')
		
		}
		
		if ($('div.nivoSlider, div.roundslider-container').length==0){
				jQuery('#preloader').css('display','none');
				
		}	
	
  
		$('.blog_readmore').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );
	   
	   
	   $('.widget_recent_entries ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );
	   
	   $('.widget_meta ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );

		$('.widget_archive ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );
	 
	 
	  	$('.widget_categories ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );
	   
	    $('.widget_pages ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) }
	   );
		$('.widget_nav_menu ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) });

		$('.widget_links ul li').hover(function() {  $(this).stop().animate({paddingLeft:23},100) },
		 function() {  $(this).stop().animate({paddingLeft:20},100) });

	  
	   $('.list-icon a').hover(
		 function() {  $(this).stop().animate({opacity:0.6}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );
	   
	   
	   
	   $('.link').hover(
		 function() {  $(this).stop().animate({paddingRight:15, paddingLeft:15},{easing:'easeInOutCubic'}) },
		 function() {  $(this).stop().animate({paddingRight:10, paddingLeft:10}),{} }
	   );
      
		
		
        $("a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
		
		$('.wp-post-image').wrap('<div class="img-box"></div>');
		$('.img-box img').hover(
		 function() {  $(this).stop().animate({opacity:0.1}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );

	
	
	$('.recent_images').hover(
		 function() {  $(this).stop().animate({opacity:0.1}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );
	
	
	$('.portfolio_widget img').hover(
		 function() {  $(this).stop().animate({opacity:0.1}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );
	
		$('.gallery-item img').hover(
		 function() {  $(this).stop().animate({opacity:0.1}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );
	$('.portfolio_images').hover(
		 function() {  $(this).stop().animate({opacity:0.7}) },
		 function() {  $(this).stop().animate({opacity:1}) }
	   );
				
			
				$('.recent_posts_nav a').hover(function(){
				$(this).stop().animate({opacity:1.0},{queue:false,duration:300});
				}, function() {
					$(this).stop().animate({opacity:0.5},{queue:false,duration:300});
				});
				
				
				$(".gallery-icon a").each(function(index) {
					var url =jQuery(this).attr('href');
		
		
		
		if (url.indexOf('attachment_id')> -1) {
    
    	$(this).attr('rel','nopf');
    	
    
  		}
		
		
	

});

				
				$('.perseus_prettyPhoto_link').each(function(index) {
				$(this).attr('rel','prettyPhoto');
				});
				
				$('.gallery').each(function(index) {
				
				var gal_index=index;
				 	$('a',this).each(function(index) {
						if($(this).has('img')&&$('.page_content a').has('img').attr('rel')!='nopf'){
							$(this).attr('rel','prettyPhoto[pp_gal_'+gal_index+']');
				
							}
				
					});
				
				
				});
				$('.ngg-galleryoverview').each(function(index) {
				var gal_index=index;
				
				 	$('.ngg-gallery-thumbnail a',this).each(function(index) {
						
							$(this).attr('rel','prettyPhoto[pp_gal_'+gal_index+']');
				
							
				
					});
				
				
				});
				
				
				var num_divs=0;
				
				
				

				
				
				
				
				
				$('.page_content .gallery-columns-2').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==2){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				
				
				$('.page_content .gallery-columns-3').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==3){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				
				$('.page_content .gallery-columns-4').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==4){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				
				$('.page_content .gallery-columns-5').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==5){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				
				$('.page_content .gallery-columns-6').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==6){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				
				$('.page_content .gallery-columns-7').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==7){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				$('.page_content .gallery-columns-8').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==8){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
				
				$('.page_content .gallery-columns-9').each(function(index) {
					num_divs=0;
					//alert($('.gallery-item',this).length);
					$('.gallery-item',this).each(function(index) {
					
					num_divs++;
					
						if(num_divs==9){
							num_divs=0;
							$(this).addClass('last_gal_item');
						
						}
					
					
					});
				
				});
                
                /*add pretty photo*/
				$("a[rel^='prettyPhoto']").prettyPhoto();
				

/*validate form*/				
				
jQuery("#commentForm").validationEngine({
				promptPosition : "centerRight",
               	scroll: false,
  				onValidationComplete: function(form, status){
    				if(status==true){
    					
    					var int1= parseInt(jQuery('#label_1').val());
						var int2= parseInt(jQuery('#label_4').val());
						var answer= parseInt(jQuery('#contact_answer').val());

						if(int1+int2==answer){


							var email=jQuery('#cemail').val();
							var name=jQuery('#cname').val();
							var url=jQuery('#curl').val();
							var message=jQuery('#ccomment').val();
							jQuery.post(
    
   								 MyAjax.ajaxurl,
    									{
        
        									action : 'send_contact_form',
        									email:email,
        									name:name,
        									url:url,
        									message:message
        
    									},
    							function( response ) {
    								var response_string='<h3 class="contact_form_response">';
    								response_string+=response;
    								response_string+='</h3>';
        							jQuery('#code_puzzle_email_response').html(response_string);
        							jQuery('#code_puzzle_email_response').fadeIn('slow', function() {
        
        							jQuery('#code_puzzle_email_response').delay(3000).fadeOut('slow');
        	        
        
        
        						});

    						});

						}//end of sum check
						else{
							jQuery('#contact_answer').css({'border':'1px solid red'});
							jQuery('#answer_incorrect').html('Invalid Answer');
						}
    						
    				}
    
  				}  
});				

});

/*contact form capcha sum*/
function checksum(field, rules, i, options){

                var int1= parseInt(jQuery('#label_1').val());
				var int2= parseInt(jQuery('#label_4').val());
				var answer= parseInt(jQuery('#contact_answer').val());
                
                if (parseInt(field.val()) != (int1+int2)) {
                    // this allows to use i18 for the error msgs
                    
                    var sum=int1+int2;
                    return 'please enter "'+sum+'"';
                }
}


