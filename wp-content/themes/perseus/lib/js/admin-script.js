
jQuery(document).ready(function($){
        
    /* will need to fix this issue upload slider images and resize auto crop.......*/
$('#remove_social_media_fields').live('click',function() {
var ID=$('.social_media_item').length;
ID=ID-1;
$('#social_media_item_'+ID).remove();
$('#remove_social_media_fields').remove();
if($('.social_media_item').length>1){
ID=($('.social_media_item').length-1);
$('#social_media_item_'+ID).append('<a class="button" id="remove_social_media_fields">remove Social Media Field</a>');
}

});

$('#add_social_media_fields').live('click',function() {
var ID=$('.social_url').length;
$('#remove_social_media_fields').remove();
var adata="<div id='social_media_item_"+ID+"' class='social_media_item'><table class='social_table'><tr><td>Social Link</td><td><input class='social_url type='text' id='social_url_"+ID+"' name='social[social]["+ID+"][url]' value=''/></td></tr>"+
"<tr><td>Social image url</td><td><input type='text' class='social_image' id='social_image_"+ID+"' name='social[social]["+ID+"][image]' value=''/>"+
"<a class='button sm_add_image' id='sm_add_image_"+ID+"'>Set Image</a>"+
"</td></tr></table><a class='button' id='remove_social_media_fields'>remove Social Media Field</a></div>";


$('#social_media_list_con').append(adata);
//$('#social_media_list .form-table tbody').append('<tr><th></th><td></td></tr>');

});

window.original_send_to_editor =window.send_to_editor;
window.custom_editor = true;
var uploadtype='';
var sm_icon_field='';

$('.sm_add_image').live('click',function() {

uploadtype='sm_icon';

var ID=$(this).attr('id').substring(13, $(this).attr('id').length);
sm_icon_field='#social_image_'+ID;
 formfield = $('#social_image_'+ID).attr('name');
 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
 return false;

});


$('#upload_theme_logo').live('click',function() {
uploadtype='logo';




 formfield = $('#afl_logo').attr('name');
 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true&amp;');
 return false;

});


$('#upload_about_us_image').live('click',function() {
uploadtype='about_us';




 formfield = $('#afl_about_us').attr('name');
 tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
 return false;

});



$('#upload_theme_favicon').live('click',function() {
uploadtype='favicon';




 formfield = $('#afl_favicon').attr('name');
 var post_id=0;
 tb_show('','media-upload.php?post_id=0&amp;type=image&TB_iframe=true');
 return false;

});


window.send_to_editor = function(html) {
 
	if(uploadtype=='logo'){
 	imgurl = $(html).attr('href');
 	
 		$('#afl_logo').val(imgurl);
 		$("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').unload("#TB_ajaxContent").unbind().remove();}); 
 	}
 	
 	else if(uploadtype=='about_us'){
 	imgurl = $(html).attr('href');
 	
 		$('#afl_about_us').val(imgurl);
 		$("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').unload("#TB_ajaxContent").unbind().remove();}); 
 	}
 	
 	else if(uploadtype=='favicon'){
 	imgurl = $(html).attr('href');
 	
 		$('#afl_favicon').val(imgurl);
 		$("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').unload("#TB_ajaxContent").unbind().remove();}); 
 	}
 	else if(uploadtype=='sm_icon'){
 	imgurl = $(html).attr('href');
 	
 		$(sm_icon_field).val(imgurl);
 		$("#TB_window").fadeOut("fast",function(){$('#TB_window,#TB_overlay,#TB_HideSelect').unload("#TB_ajaxContent").unbind().remove();}); 
 		sm_icon_field='';
 	}
 	else{
 	window.original_send_to_editor(html);
 	
 	}
 
 uploadtype='';
 
 
}
    
    
    

   
    
});