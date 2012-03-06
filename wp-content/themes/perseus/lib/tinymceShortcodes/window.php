<?php
require_once('config.php');

if (!current_user_can('edit_pages') && !current_user_can('edit_posts')){
	wp_die(__("You are not allowed to be here", $GLOBALS['domain']));
}

	global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortcode Panel</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/lib/tinymceShortcodes/tinymce.js"></script>
	
	<base target="_self" />
<style type="text/css">
<!-- 
select#afl_shortcode_tag optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif;}
select#afl_shortcode_tag optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding-top:1px; padding-bottom:1px;}
-->
.sc_option{display:none}
#link .panel_wrapper, #link div.current {
height: 155px;
}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';
document.getElementById('afl_shortcode_tag').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="afl_tabs" action="#">
		<!-- gallery panel -->
		<div id="afl_shortcode_panel" class="panel current">
			<br />
			<table border="0" cellpadding="4" cellspacing="0">
				<tr>
					<td nowrap="nowrap"><label for="afl_shortcode_tag"><?php _e("Select Shortcodes", 'shortcodes'); ?></label></td>
					<td><select id="afl_shortcode_tag" name="afl_shortcode_tag" style="width: 200px">
						<option value="0">None</option>
						<option value="button">Button</option>
						<option value="contact_form">Contact form</option>
						<option value="code_block">Content/Code Block</option>
						<option value="divider">Divider</option>
						<option value="recent">Recent Posts Block</option>
						<option value="portfolio">Portfolio Block</option>
						<option value="aside_right">Aside Right(2/3 + 1/3)</option>
						<option value="aside_left">Aside Left(1/3 + 2/3)</option>
						<option value="2_col">Two Columns</option>
						<option value="3_col">Three Columns</option>
						<option value="4_col">Four Columns</option>
						<option value="quote">Quote</option>
						<option value="infoblock">Gray Info Box</option>
						</select>
					</td>
					
					
					</td>
				</tr>
				
				<tr>
				
					<td class="sc_option sc_portfolio">
						<label>Select Category</label></td><td class="sc_option sc_portfolio">
						<?php
						$args=array('show_option_all'    =>'All' ,'taxonomy'=>'portfolio-category','id'=> 'sc_portfolio_cat');
       wp_dropdown_categories($args); ?> 
					</td>
				</tr>
				
				<tr>
				<td class="sc_option sc_portfolio">
						<label>Order</label></td><td class="sc_option sc_portfolio"><select id="sc_portfolio_posts_order"><option value="recent">Recent</option><option value="rand">Random</option></select></td>
				</tr>
				
				
				<tr>
				
				
				<tr>
				<td class="sc_option sc_portfolio">
						<label>Title</label></td><td class="sc_option sc_portfolio"><input type="text" id="sc_portfolio_title" /></td>
				</tr>
				
				
				
				
				<tr>
				
					<td class="sc_option sc_recent_posts">
						<label>Select Category</label></td><td class="sc_option sc_recent_posts">
						<?php $args=array('show_option_all'    =>'All' ,'id'=> 'sc_recent_posts_cat');
       wp_dropdown_categories($args); ?> 
					</td>
				</tr>
				
				<tr>
				<td class="sc_option sc_recent_posts">
						<label>Order</label></td><td class="sc_option sc_recent_posts"><select id="sc_recent_posts_order"><option value="recent">Recent</option><option value="rand">Random</option></select></td>
				</tr>
				
				
				<tr>
				<td class="sc_option sc_recent_posts">
						<label>Title</label></td><td class="sc_option sc_recent_posts"><input type="text" id="sc_recent_posts_title" /></td>
				</tr>
				
			
				
				
				<tr>
				
					<td class="sc_option sc_2_col sc_3_col sc_4_col sc_aside">
						<label>Title(*optional)</label></td><td class="sc_option sc_2_col sc_3_col sc_4_col sc_aside"><input type="text" id="sc_text_title_1" />
					</td>
				</tr>
				
				<tr>
				
					<td class="sc_option sc_2_col sc_3_col sc_4_col sc_aside">
						<label>Title(*optional)</label></td><td class="sc_option sc_2_col sc_3_col sc_4_col sc_aside"><input type="text" id="sc_text_title_2" />
					</td>
				</tr>
				
				<tr>
				
					<td class="sc_option sc_3_col sc_4_col">
						<label>Title(*optional)</label></td><td class="sc_option sc_3_col sc_4_col"><input type="text" id="sc_text_title_3" />
					</td>
				</tr>
				
				<tr>
				
					<td class="sc_option sc_4_col">
						<label>Title(*optional)</label></td><td class="sc_option sc_4_col"><input type="text" id="sc_text_title_4" />
					</td>
				</tr>
				
				
				<tr>
				
				<td class="sc_text_options sc_option">
					<label>text options</label></td><td class="sc_text_options sc_option">
		<select id="sc_text_align">
		<option value='left'>Left</option>
		<option value='center'>Center</option>
		<option value='justify'>Justify</option>
		</select>
				</td>
				</tr>
				<tr>
				
				
				<td class="sc_button_options sc_option">
					<label>Button Style</label></td>
				<td class="sc_button_options sc_option">
					<select id="sc_button_style">
						<option value='gray'>Light Gray</option>
						<option value='blue'>Blue</option>
						<option value='dark'>Dark Gray</option>
					</select>
				</td>
				<tr>
				<td  class="sc_button_options sc_option"><label>Button Text</label></td>
				<td  class="sc_button_options sc_option"><input id="sc_button_text" type="text"/></td>
				
				</tr>
				<tr>
				<td  class="sc_button_options sc_option"><label>Button Link</label></td>
				<td  class="sc_button_options sc_option"><input id="sc_button_link" type="text" value="http://"/></td>
				
				</tr>
				
				
				<tr>
				
				<td class="sc_code_block_options sc_option">
					<label>Content/Code Box Style</label></td>
				<td class="sc_code_block_options sc_option">
					<select id="sc_code_block_style">
						<option value='gray'>Light Gray</option>
						<option value='blue'>Blue</option>
						<option value='dark'>Dark Gray</option>
					</select>
				</td>
				</tr>
				
				
				
				
				
			</table>
		</div>
		<div>
		
		
		
		
		</div>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
			</div>

			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="Insert" onClick="aflshortcodesubmit();" />
			</div>
		</div>
	</form>
</body>
</html>
