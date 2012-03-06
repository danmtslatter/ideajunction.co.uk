<?php
/*register theme options*/

$prefix='cpmeta-';
$test_array=array('gen_settings','contact_settings');

function perseus_admin_styles() {
       wp_enqueue_style('admin-custom-style', TEMPLATEURL.'/lib/css/admin-style.css');
       wp_enqueue_style('jqueryUI', TEMPLATEURL.'/lib/css/ui-lightness/jquery-ui-1.8.11.custom.css');
       wp_enqueue_style('thickbox',get_option('siteurl').'/'.WPINC.'/js/thickbox/thickbox.css');
   }

add_action('admin_init', 'codePuzzSettings_admin_init');


function afl_admin_print_scripts_hook(){   
   
      wp_enqueue_script('jqueryUI', TEMPLATEURL.'/lib/js/jquery-ui-1.8.11.custom.min.js', array( 'jquery','media-upload','thickbox' ));
      wp_enqueue_script('admin-custom-script', TEMPLATEURL.'/lib/js/admin-script.js', array( 'jqueryUI' ));
     
}



function codePuzzSettings_admin_init(){
register_setting( 'theme_options', 'theme_options');
add_settings_section('general_options', 'General Settings', 'general_section_text', 'theme_ops');

add_settings_field('display_tagline', 'Display Tag Line', 'set_display_tagline', 'theme_ops', 'general_options');
add_settings_field('hide_site_title', 'Hide Site Title', 'set_site_title', 'theme_ops', 'general_options');
add_settings_field('logo_url', 'Select Logo', 'logo_fields', 'theme_ops', 'general_options');
add_settings_field('favicon', 'Select Favicon', 'favicon_fields', 'theme_ops', 'general_options');
add_settings_field('google_analytics', 'Google Analytics Code', 'google_fields', 'theme_ops', 'general_options');
add_settings_section('footer_options', 'Footer Settings', 'general_section_text', 'theme_ops');
add_settings_field('display_about_us', 'Display About Us footer', 'set_display_about_us', 'theme_ops', 'footer_options');
add_settings_field('about_us_title', 'Set About Us Title', 'set_about_us_title', 'theme_ops', 'footer_options');
add_settings_field('about_us_image', 'Select Image or google map', 'set_about_us_image', 'theme_ops', 'footer_options');
add_settings_field('about_us_text', 'About Us Text', 'set_about_us_text', 'theme_ops', 'footer_options');

add_settings_field('display_copyright', 'Display Copyright Info', 'set_display_copyright', 'theme_ops', 'footer_options');
add_settings_field('copyright_info', 'Copyright text', 'set_copyright_text', 'theme_ops', 'footer_options');
add_settings_field('copyright_align', '', 'set_copyright_align', 'theme_ops', 'footer_options');


register_setting( 'sc_options', 'social');
add_settings_section('social_options', '', 'general_section_text', 'social_ops');
add_settings_field('display_social', 'Display Social Icons', 'set_display_social', 'social_ops', 'social_options');
add_settings_field('social_list', 'Social List', 'social_fields', 'social_ops', 'social_options');


register_setting( 'b_options', 'blog');
add_settings_section('blog_options', 'Main Settings', 'general_section_text', 'blog_opts');
add_settings_field('display_blog_title', 'Display Main Title', 'display_blog_title', 'blog_opts', 'blog_options');
add_settings_field('blog_title', 'Blog Main Title', 'set_blog_title', 'blog_opts', 'blog_options');
add_settings_field('blog_style', 'Display full article or excerpt', 'set_blog_style', 'blog_opts', 'blog_options');


register_setting( 'contact_options', 'contact');
add_settings_section('contact_form_options', 'Contact Settings', 'general_section_text', 'contact_opts');
add_settings_field('show_sidebar', 'Sidebar On Contact Page', 'set_contact_side_bar', 'contact_opts', 'contact_form_options');
add_settings_field('form_title', 'Contact Form Title', 'set_form_title', 'contact_opts', 'contact_form_options');
add_settings_field('return_email', 'Return Email Address', 'set_return_email', 'contact_opts', 'contact_form_options');
add_settings_field('response_message', 'Response Message', 'set_response', 'contact_opts', 'contact_form_options');
add_settings_field('email_subject', 'Return Email Subject', 'set_subject', 'contact_opts', 'contact_form_options');
add_settings_section('contact_form_fields', 'Contact Form Fields', 'general_section_text', 'contact_opts');
add_settings_field('name_field', 'Name Field', 'set_name_field', 'contact_opts', 'contact_form_fields');
add_settings_field('email_field', 'Email Field', 'set_email_field', 'contact_opts', 'contact_form_fields');
add_settings_field('website_field', 'Website Field', 'set_website_field', 'contact_opts', 'contact_form_fields');
add_settings_field('message_field', 'Message Field', 'set_message_field', 'contact_opts', 'contact_form_fields');

register_setting( 'portfolio_options', 'portfolio');
add_settings_section('portfolio_options', '', 'general_section_text', 'portfolio_opts');
add_settings_field('number_cols', 'Number Of Columns', 'set_num_cols', 'portfolio_opts', 'portfolio_options');
add_settings_field('limit_items', 'Limit Items Per Page', 'set_limit_items', 'portfolio_opts', 'portfolio_options');
add_settings_field('items_per_page', 'Items Per Page', 'set_items_per_page', 'portfolio_opts', 'portfolio_options');
add_settings_field('display_title', 'Display Portfolio Title', 'set_portfolio_title', 'portfolio_opts', 'portfolio_options');
add_settings_field('title', 'Portfolio Title', 'set_portfolio_title_text', 'portfolio_opts', 'portfolio_options');


/*set defaults*/
$ops=get_option('theme_options');
if(empty($ops)):
$ops['display_search']='false';
$ops['display_tagline']='true';
$ops['hide_site_title']='false';
$ops['display_about_us']='true';
$ops['about_us_title']='About Us';
$ops['about_us_text']='your about text can go here.Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi magna magna, tincidunt a, mattis non, imperdiet vitae, tellus. Sed odio est, auctor ac, sollicitudin in, consequat vitae, orci. Fusce id felis. Vivamus sollicitudin metus eget eros.';
$ops['about_us_image']='';
$ops['about_us_map']='<iframe width="425" height="190" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.ie/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=cork&amp;aq=&amp;sll=53.401034,-8.307638&amp;sspn=11.360953,23.664551&amp;ie=UTF8&amp;hq=&amp;hnear=Cork,+County+Cathair+Chorcaigh&amp;t=m&amp;z=14&amp;ll=51.897167,-8.477869&amp;output=embed"></iframe>';
$ops['display_copyright']='false';
$ops['copyright_align']='left';


update_option('theme_options',$ops);
endif;
unset($ops);
$ops=get_option('blog');
if(empty($ops)):
$ops['display_blog_title']='true';
$ops['blog_style']='Excerpt';
$ops['blog_title']='Welcome To Our Blog';
update_option('blog',$ops);
endif;
unset($ops);
$ops=get_option('contact');

if(empty($ops)):
$ops['show_sidebar']='true';
$ops['form_title']='Your Feedback';
$ops['display_contact_form']='false';
$ops['response_message']='Thankyou For Your Feedback';
$ops['return_email']='';
$ops['email_subject']='Website Query';
$ops['name_field']='Name';
$ops['email_field']='Email';
$ops['website_field']='Website';
$ops['message_field']='Your Message';

update_option('contact',$ops);
endif;
unset($ops);
$ops=get_option('portfolio');
if(empty($ops)):
$ops['limit_items']='false';
$ops['items_per_page']='6';
$ops['display_title']='true';
$ops['title']='Our Work';
$ops['display_excerpt']='true';
$ops['excerpt_length_one_col']='50';
$ops['excerpt_length_two_col']='30';
$ops['excerpt_length_three_col']='20';
$ops['number_cols']='Three';
update_option('portfolio',$ops);
endif;
unset($ops);
}



add_action('admin_menu', 'add_admin_pages');





function add_admin_pages() {
$page=add_menu_page('Theme Options', 'Theme Options', 'manage_options', 'theme_ops', 'theme_options_page');
$subpage_1=add_submenu_page( 'theme_ops', 'Social Media', 'Social Settings', 'manage_options', 'social_ops', 'social_options_page' );
$subpage_2=add_submenu_page( 'theme_ops', 'Blog Settings', 'Blog Settings', 'manage_options', 'blog_opts', 'blog_options_page' );
$subpage_3=add_submenu_page( 'theme_ops', 'Contact Form Settings', 'Contact Settings', 'manage_options', 'contact_opts', 'contact_options_page' );
$subpage_4=add_submenu_page( 'theme_ops', 'Porfolio Settings', 'Portfolio Settings', 'manage_options', 'portfolio_opts', 'portfolio_options_page' );
add_action( 'admin_print_styles-' . $page, 'perseus_admin_styles' );
add_action( 'admin_print_styles-' . $subpage_1, 'perseus_admin_styles' );
add_action( 'admin_print_styles-' . $subpage_2, 'perseus_admin_styles' );
add_action( 'admin_print_styles-' . $subpage_3, 'perseus_admin_styles' );
add_action( 'admin_print_styles-' . $subpage_4, 'perseus_admin_styles' );

add_action('admin_print_scripts-' . $page, 'afl_admin_print_scripts_hook');
add_action('admin_print_scripts-' . $subpage_1, 'afl_admin_print_scripts_hook');
add_action('admin_print_scripts-' . $subpage_2, 'afl_admin_print_scripts_hook');
add_action('admin_print_scripts-' . $subpage_3, 'afl_admin_print_scripts_hook');
add_action('admin_print_scripts-' . $subpage_4, 'afl_admin_print_scripts_hook');

}



function general_section_text() {
echo '';
}


function display_search_select() {
$options = get_option('theme_options');
$select_ops=array('true','false');
?>
<select id='plugin_text_string' name='theme_options[display_search]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_search']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to display a search form in the header of the page next to the social media icons</p>
<?php
}

function set_display_tagline() {
$options = get_option('theme_options');
$select_ops=array('true','false');
?>
<select name='theme_options[display_tagline]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_tagline']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Select if you wish to display a tagline each page.</p>
<?php
}


function set_site_title() {
$options = get_option('theme_options');
$select_ops=array('true','false');
?>
<select name='theme_options[hide_site_title]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['hide_site_title']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>If you wish to use an image for the site title you may wish to enable this option.</p>
<?php
}



function logo_fields() {
$options = get_option('theme_options');
$select_ops=array('true','false');
$logo='';
if(isset($options['logo_url'])) $logo=$options['logo_url'];
if(isset($logo)):
if($logo!=''){
echo "<img src='{$logo}'/><br>";
}
endif;

echo "<input type='text' id='afl_logo' name='theme_options[logo_url]' value='{$logo}' />";
echo "<input type='button' id='upload_theme_logo' value='Select Image' class='button'/>";
?>
<p>Select Site Logo Will be displayed in the header. Recommended height max 60px.</p>
<?php


}


function favicon_fields() {
$options = get_option('theme_options');
$select_ops=array('true','false');
$logo='';
if(isset($options['logo_url'])) $logo=$options['favicon'];

if($logo!=''){
echo "<img src='{$logo}'/>";
}

echo "<input type='text' id='afl_favicon' name='theme_options[favicon]' value='{$logo}' />";
echo "<input type='button' id='upload_theme_favicon' value='Select Image' class='button'/>";

}


function google_fields() {
$options = get_option('theme_options');
$select_ops=array('true','false');

$logo='';
if(isset($options['google_analytics'])) $logo=$options['google_analytics'];

echo "<textarea type='text' id='afl_favicon' name='theme_options[google_analytics]'>{$logo}</textarea>";
?>
<p>Will Add Goggle analytics code to all pages.</p>
<?php
}


function set_about_us_text() {
$options = get_option('theme_options');
$select_ops=array('true','false');

$logo='';
if(isset($options['about_us_text'])) $logo=$options['about_us_text'];

echo "<textarea rows='7' cols='70' type='text' id='afl_about_us_text' name='theme_options[about_us_text]'>{$logo}</textarea>";
?>
<p>Add about you text.</p>
<?php
}

function set_display_about_us() {
$options = get_option('theme_options');
$select_ops=array('true','false');
?>
<select name='theme_options[display_about_us]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_about_us']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to display An About us area in the page footer area.</p>
<?php
}

function set_about_us_image() {
$options = get_option('theme_options');

$logo='';
$map='';
if(isset($options['about_us_image'])) $logo=$options['about_us_image'];
if(isset($options['about_us_map'])) $map=$options['about_us_map'];
if(isset($logo)):
if($logo!=''){
echo "<img width='250px' src='{$logo}'/><br>";
}
endif;

echo "<input type='text' id='afl_about_us' name='theme_options[about_us_image]' value='{$logo}' />";
echo "<input type='button' id='upload_about_us_image' value='Select Image' class='button'/><br><p>Or enter google map frame in the below textarea. If the map textarea is not empty the image will not be displayed.</p>";
echo "<textarea name='theme_options[about_us_map]'>".$map."</textarea>";
?>
<p>Set about us image or goole map field. Image will appear to the left of the about us text.</p>
<?php


}



function set_display_copyright() {
$options = get_option('theme_options');
$select_ops=array('true','false');
?>
<select name='theme_options[display_copyright]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_copyright']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to display Copyright info at the bottom of each page.</p>
<?php
}

function set_about_us_title() {
$options = get_option('theme_options');
$select_ops=array('true','false');
$title=$options['about_us_title'];


echo "<input type='text' name='theme_options[about_us_title]' value='{$title}' />";
echo '<p>Enter your title.</p>';
}


function set_copyright_text() {
$options = get_option('theme_options');
$select_ops=array('true','false');
$logo='';
if(isset($options['copyright_info'])) $logo=$options['copyright_info'];

echo "<textarea type='text' name='theme_options[copyright_info]'>{$logo}</textarea>";
?>
<p>Add Your Copyright info here.</p>
<?php
}
function set_copyright_align() {
/*$options = get_option('theme_options');
$select_ops=array('left','center');
?>
<select  name='theme_options[copyright_align]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['copyright_align']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}

?>
</select>
<p>Allows you to align the copyright footer.</p>
<?php
*/
}

/*social media functions below*/

function set_display_social() {
$options = get_option('social');
$select_ops=array('true','false');
?>
<select name='social[display_social]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_social']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Select if you wish to display Social Media Icons on each page.</p>
<?php
}


function social_fields() {
$out='';
$options = get_option('social');
$select_ops=array('true','false');
$socials=$options['social'];
$array_count=count($socials);
//unset($options['social']);
$out.='<div id="social_media_list_con">';
$out.='<a class="button" id="add_social_media_fields">Add Social Media</a>';

if($socials):
$index=0;
foreach($socials as $social){
$count=$index+1;
$s_image=$social['image'];
$s_url=$social['url'];

$out.= "<div id='social_media_item_{$index}'  class='social_media_item'>";
$out.= '<table class="social_table">';
$out.= "<tr><td>Social Link</td><td><input type='text' class='social_url' id='social_url_{$index}' name='social[social][{$index}][url]' value='{$s_url}'/></td></tr>";

$out.= "<tr><td>Social image url</td><td><input type='text' class='social_image' id='social_image_{$index}' name='social[social][{$index}][image]' value='{$s_image}'/>";
if($s_image):
$out.="<img width='20px' height='20px' src='{$s_image}' style='margin-left:5px;'/></td><td>";

else:
$out.="</td><td style='padding-left:35px'>";
endif;




$out.="<a class='button sm_add_image' id='sm_add_image_{$index}'>Set Image</a>";


$out.="</td></tr></table>";
if($array_count>1&&$array_count==($index+1)){
$out.= '<a class="button" id="remove_social_media_fields">remove Social Media Field</a>';
}
$out.="</div>";

$index++;
}
else:
echo "<div id='social_media_item_0' class='social_media_item'>";
echo '<table class="social_table"><tr><td>Social Link</td><td><input type="text" id="social_url_0" name="social[social][0][url]" value=""/></td></tr>';
echo "<tr><td>Social image url</td><td><input type='text' id='social_image_0' name='social[social][0][image]' value=''/><a class='button sm_add_image' id='sm_add_image_0'>Set Image</a>";
echo '</td></tr></table></div>';
endif;
echo $out;
echo "</div>";


?>
<?php
}
/*function plugin_setting_string() {
$options = get_option('plugin_options');
echo "<input id='plugin_text_string' name='plugin_options[display_search]' size='40' type='text' value='{$options['display_search']}' />";
}*/

function display_blog_title() {
$options = get_option('blog');
$select_ops=array('true','false');
?>
<select id='plugin_text_string' name='blog[display_blog_title]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_blog_title']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to display a title for your blog page.</p>
<?php
}


function set_blog_style() {
$options = get_option('blog');
$select_ops=array('Full','Excerpt');
?>
<select name='blog[blog_style]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['blog_style']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to choose weather you wish to show full article or excerpt on blog page/cats etc.</p>
<?php
}


function set_blog_title() {
$options = get_option('blog');
$select_ops=array('true','false');
$title=$options['blog_title'];


echo "<input type='text' name='blog[blog_title]' value='{$title}' />";
echo '<p>Enter yout blog title</p>';
}


/*contact form*/

function set_contact_side_bar() {
$options = get_option('contact');
$select_ops=array('true','false');
?>
<select name='contact[show_sidebar]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['show_sidebar']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Select If you wish to display a sidebar on the contact page.</p>
<?php
}



function display_contact_form() {
$options = get_option('contact');
$select_ops=array('true','false');
?>
<select name='contact[display_contact_form]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_contact_form']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Allows you to display a search form form tab on all pages</p>
<?php
}

function set_form_title() {
$options = get_option('contact');



echo "<input type='text' name='contact[form_title]' value='{$options['form_title']}' />";
echo '<p>Set The Contact Form Title.</p>';
}


function set_return_email() {
$options = get_option('contact');
$email=$options['return_email'];


echo "<input type='text' name='contact[return_email]' value='{$email}' />";
echo '<p>Set Your email address here.</p>';
}

function set_response() {
$options = get_option('contact');

$response=$options['response_message'];

echo "<textarea type='text' id='afl_favicon' name='contact[response_message]'>{$response}</textarea>";
?>
<p>Add your responder here.</p>
<?php
}
function set_subject() {
$options = get_option('contact');

$subject=$options['email_subject'];


echo "<input type='text' name='contact[email_subject]' value='{$subject}' />";
echo '<p>Set return email subject here.</p>';
}
function set_name_field() {
$options = get_option('contact');

$name=$options['name_field'];


echo "<input type='text' name='contact[name_field]' value='{$name}' />";
echo '<p>Set The field name to appear on the email form.</p>';
}
function set_email_field() {
$options = get_option('contact');

$name=$options['email_field'];


echo "<input type='text' name='contact[email_field]' value='{$name}' />";
echo '<p>Set The field name to appear on the email form for email address.</p>';
}
function set_website_field() {
$options = get_option('contact');

$name=$options['website_field'];


echo "<input type='text' name='contact[website_field]' value='{$name}' />";
echo '<p>Set website field name.</p>';
}
function set_message_field() {
$options = get_option('contact');

$name=$options['message_field'];


echo "<input type='text' name='contact[message_field]' value='{$name}' />";
echo '<p>Set message field name.</p>';
}
/*portfolio settings*/

function set_limit_items() {
$options = get_option('portfolio');
$select_ops=array('true','false');
?>
<select name='portfolio[limit_items]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['limit_items']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Limit Items Per Page. Pages will be pages if set to true.</p>
<?php
}


function set_items_per_page() {
$options = get_option('portfolio');

$name=$options['items_per_page'];


echo "<input type='text' name='portfolio[items_per_page]' value='{$name}' />";
echo '<p>Set number of items per page.</p>';
}

function set_portfolio_title() {
$options = get_option('portfolio');
$select_ops=array('true','false');
?>
<select name='portfolio[display_title]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_title']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Display a title on the portfolio page.</p>
<?php
}

function set_portfolio_title_text() {
$options = get_option('portfolio');

$name=$options['title'];


echo "<input type='text' name='portfolio[title]' value='{$name}' />";
echo '<p>Set Portfolio Title.</p>';
}





function set_num_cols() {
$options = get_option('portfolio');
$select_ops=array('One','Two','Three');
?>
<select name='portfolio[number_cols]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['number_cols']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Set the number of columns on portfolio pages.</p>
<?php
}



function set_display_excerpt() {
$options = get_option('portfolio');
$select_ops=array('true','false');
?>
<select name='portfolio[display_excerpt]'>
<?php
	foreach($select_ops as $op){
		if($op==$options['display_excerpt']):
			echo "<option value='{$op}' selected='yes'>".$op.'</option>';
		else:
			echo "<option value='{$op}'>".$op.'</option>';
		endif;
	}
?>
</select>
<p>Display an excerpt under the featured images.</p>
<?php
}

function set_excerpt_length_one() {
$options = get_option('portfolio');

$name=$options['excerpt_length_one_col'];


echo "<input type='text' name='portfolio[excerpt_length_one_col]' value='{$name}' />";
echo '<p>Set Excerpt Length. If you have set a manual excerpt this setting is overridden.</p>';
}

function set_excerpt_length_two() {
$options = get_option('portfolio');

$name=$options['excerpt_length_two_col'];


echo "<input type='text' name='portfolio[excerpt_length_two_col]' value='{$name}' />";
echo '<p>Set Excerpt Length. If you have set a manual excerpt this setting is overridden.</p>';
}

function set_excerpt_length_three() {
$options = get_option('portfolio');

$name=$options['excerpt_length_three_col'];


echo "<input type='text' name='portfolio[excerpt_length_three_col]' value='{$name}' />";
echo '<p>Set Excerpt Length. If you have set a manual excerpt this setting is overridden.</p>';
}

/*admin pages below*/
function theme_options_page() {
?>
<div>
<h2>Theme Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('theme_options'); ?>
<?php do_settings_sections('theme_ops'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button"/>
</form></div>

<?php
}


function social_options_page() {

?>
<div>
<h2>Social Settings</h2>

<form action="options.php" method="post">
<div id="social_media_list">
<?php settings_fields('sc_options'); ?>
<?php do_settings_sections('social_ops'); ?>

<?php //settings_fields('gen_settings'); ?>
<?php //do_settings_sections('test'); ?>

</div>


<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button"/>
</form></div>

<?php
}

function blog_options_page() {

?>
<div>
<h2>Blog Page Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('b_options'); ?>
<?php do_settings_sections('blog_opts'); ?>


<input  class="button" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}
function contact_options_page() {

?>
<div>
<h2>Contact Form Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('contact_options'); ?>
<?php do_settings_sections('contact_opts'); ?>



<input  class="button" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}
function portfolio_options_page() {

?>
<div>
<h2>Portfolio Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('portfolio_options'); ?>
<?php do_settings_sections('portfolio_opts'); ?>




<input class="button" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}





?>