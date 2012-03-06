function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}



$('#afl_shortcode_tag').live('change',function() {
var val='';
$val=$('select#afl_shortcode_tag option:selected').val();
$('.sc_option').css({'display':'none'});
if($val=='2_col'||$val=='3_col'||$val=='4_col'||$val=='aside_left'||$val=='aside_right'){

$('.sc_text_options').css({'display':'block'});
if($val=='2_col'){
				$('.sc_2_col').css({'display':'block'});
			}
			if($val=='3_col'){
				$('.sc_3_col').css({'display':'block'});
			}
			if($val=='4_col'){
				$('.sc_4_col').css({'display':'block'});
			}
			if($val=='aside_left'){
				$('.sc_aside').css({'display':'block'});
			}
			if($val=='aside_right'){
				$('.sc_aside').css({'display':'block'});
			}


}

if($val=='button'){
$('.sc_button_options').css({'display':'block'});
}
if($val=='code_block'){
$('.sc_code_block_options').css({'display':'block'});
}
if($val=='recent'){
$('.sc_recent_posts').css({'display':'block'});
}
if($val=='portfolio'){
$('.sc_portfolio').css({'display':'block'});
}

});



function aflshortcodesubmit() {
	var tagtext;
	var text_align;
	var text_title=new Array();
	var button_style;
	var button_text;
	var button_link;
	var code_block_style;
	var recent_cat_id;
	var recent_title;
	var portfolio_cat_id;
	var portfolio_title;
	var order;
	
	var afl_shortcode = document.getElementById('afl_shortcode_panel');
	
	// who is active ?
	if (afl_shortcode.className.indexOf('current') != -1) {
		var afl_shortcodeid = document.getElementById('afl_shortcode_tag').value;
		
		$('.sc_text_options').css({'display':'block'});
		
		if(afl_shortcodeid=='2_col'||afl_shortcodeid=='3_col'||afl_shortcodeid=='4_col'||afl_shortcodeid=='aside_left'||afl_shortcodeid=='aside_right'){
		
			
			
			text_align=$('select#sc_text_align option:selected').val();
			text_title[0]=$('#sc_text_title_1').val();
			text_title[1]=$('#sc_text_title_2').val();
			text_title[2]=$('#sc_text_title_3').val();
			text_title[3]=$('#sc_text_title_4').val();
		}
		if(afl_shortcodeid=='button'){
		
			button_style=$('select#sc_button_style option:selected').val();
			button_text=$('#sc_button_text').val();
			button_link=$('#sc_button_link').val();
		}
		
		
		
		if(afl_shortcodeid=='code_block'){
		code_block_style=$('select#sc_code_block_style option:selected').val();
		}
		if(afl_shortcodeid=='recent'){
		recent_cat_id=$('select#sc_recent_posts_cat option:selected').val();
		order=$('select#sc_recent_posts_order option:selected').val();
		recent_title=$('#sc_recent_posts_title').val();
		}
		
		if(afl_shortcodeid=='portfolio'){
		portfolio_cat_id=$('select#sc_portfolio_cat option:selected').val();
		order=$('select#sc_portfolio_posts_order option:selected').val();
		portfolio_title=$('#sc_portfolio_title').val();
		}
		
		switch(afl_shortcodeid)
		{
			case 0:
				tinyMCEPopup.close();
				break;
			case '2_col':
				tagtext="[column cols='two' first='true' align='"+text_align+"' title='"+text_title[0]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='two' last='true' align='"+text_align+"'  title='"+text_title[1]+"']<br>Your Content Goes Here!.<br>[/column]";
			break;
			
			case 'aside_left':
				tagtext="[column aside='left' cols='two' first='true' align='"+text_align+"' title='"+text_title[0]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column aside='left' cols='two' last='true' align='"+text_align+"'  title='"+text_title[1]+"']<br>Your Content Goes Here!.<br>[/column]";
			break;
			
			case 'aside_right':
				tagtext="[column aside='right' cols='two' first='true' align='"+text_align+"' title='"+text_title[0]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column aside='right' cols='two' last='true' align='"+text_align+"'  title='"+text_title[1]+"']<br>Your Content Goes Here!.<br>[/column]";
			break;
						
			case '3_col':
				tagtext="[column cols='three' first='true' align='"+text_align+"'  title='"+text_title[0]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='three' align='"+text_align+"'  title='"+text_title[1]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='three' last='true'  align='"+text_align+"'  title='"+text_title[2]+"']<br>Your Content Goes Here!.<br>[/column]<br>";
			break;
			case '4_col':
			tagtext="[column cols='four' first='true'  align='"+text_align+"'  title='"+text_title[0]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='four'  align='"+text_align+"'  title='"+text_title[1]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='four'  align='"+text_align+"'  title='"+text_title[2]+"']<br>Your Content Goes Here!.<br>[/column]<br>[column cols='four' last='true'  align='"+text_align+"'  title='"+text_title[3]+"']<br>Your Content Goes Here!.<br>[/column]";
			break;

			case 'button':
			tagtext="[button colour='"+button_style+"' text='"+button_text+"' link='"+button_link+"']";
			break;
			
			case 'code_block':
			tagtext="[code_block colour='"+code_block_style+"']Your code goes here[/code_block]";
			break;
			
			case 'contact_form':
			tagtext="[contact_form]";
			break;
			
			case 'recent':
			tagtext="[recent_posts cat_id='"+recent_cat_id+"' title='"+recent_title+"' order='"+order+"']<br>Your Content Goes Here!.<br>[/recent_posts]";
			break;
			case 'portfolio':
			tagtext="[portfolio cat_id='"+portfolio_cat_id+"' title='"+portfolio_title+"' order='"+order+"']<br>Your Content Goes Here!.<br>[/portfolio]";
			break;
			case 'divider':
			tagtext="[divider]";
			break;
			case 'quote':
			tagtext="[quote]<br>Your Quote Goes Here!.<br>[/quote]";
			break;
			case 'infoblock':
			tagtext="[info]<br>Your Quote Goes Here!.<br>[/info]";
			break;
			
		}
	}
	if(tinyMCEPopup.editor) {
		window.tinyMCE.execInstanceCommand(tinyMCEPopup.editor.id, 'mceInsertContent', false, tagtext);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}