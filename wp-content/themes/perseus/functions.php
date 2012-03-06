<?php

define('TEMPLATEURL', get_template_directory_uri());



add_action( 'after_setup_theme', 'afl_setup' );

$domain='perseus';


if ( ! function_exists( 'afl_setup' ) ):
function afl_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	add_theme_support( 'post-thumbnails');	
	// This theme uses post thumbnails
	if ( function_exists('add_theme_support') ) {
           
            add_image_size('one_col_portfolio', 475, 200, TRUE);
            add_image_size('two_col_portfolio', 440, 200, TRUE);
            add_image_size('three_col_portfolio', 271, 150, TRUE);
            add_image_size('2_col_gallery_sidebar', 320, 250, TRUE);
            add_image_size('2_col_gallery', 466, 300, TRUE);
            add_image_size('1_col_gallery', 980, 400, TRUE);
            add_image_size('1_col_gallery_sidebar', 686, 297, TRUE);
            add_image_size('square', 270, 270, TRUE);
            add_image_size('recent_images', 149, 149, TRUE);
            add_image_size('recent_images_sidebar', 150, 100, TRUE);
            add_image_size( 'slider_image', 980, 350,true );
            add_image_size('single_post', 300, 215, TRUE);
            add_image_size('recent_posts', 310, 200, TRUE);
			add_image_size('post-thumbnail', 72, 72, TRUE);
	        add_image_size( 'recent_posts_widget', 70, 60,true );
        }

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( $GLOBALS['domain'], TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', $GLOBALS['domain'] ),
	) );
	
	


	

}



function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[column\].*?\[/raw\])}is';
	$pattern_contents = '{\[column\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}






remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);

include_once TEMPLATEPATH . '/browser_detection/browser_detection.php';
endif;


add_action( 'admin_init', 'register_portsettings' );
function register_portsettings() { // whitelist options
  register_setting( 'portsettings-group', 'portsettings' );
  register_setting( 'portsettings-group', 'portlink' );
}
$portops=get_option('portsettings');
$porturl=get_option('portlink');
if(empty($portops)):

$portops=3;
update_option('portsettings',$portops);
endif;
if(empty($porturl)):

$porturl='';
update_option('portlink',$porturl);
endif;


add_filter( 'widget_tag_cloud_args', 'my_tag_cloud_args' );
function my_tag_cloud_args($in){
return 'smallest=11&largest=11&number=25&orderby=name&unit=px';
}


//deactivate WordPress function
remove_shortcode('gallery', 'gallery_shortcode');
//activate own function
add_shortcode('gallery', 'wpe_gallery_shortcode');
//the own renamed function
function wpe_gallery_shortcode($attr) {
    
    
global $post;

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	
	
	global $post;
		$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
	

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));
	
	
	if($columns==1):
		if($template_name=='default'):
			$size='1_col_gallery';
		else:
			$size='1_col_gallery_sidebar';
		endif;
	
	
	elseif($columns==2):
	
		if($template_name=='default'):
			$size='2_col_gallery';
	
		else:
			$size='2_col_gallery_sidebar';
		endif;
		
	
	
	elseif($columns==3):
	
		if($template_name=='default'):
			$size='2_col_gallery';
	
		else:
			$size='2_col_gallery_sidebar';
		endif;
	else:	
	$size='square';
	
	endif;
	
	
	
	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
	
		$output = "\n";
		
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
	
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}


function perseus_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'perseus_prettyPhoto_link'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
 
  
  return $html;
}
add_filter('image_send_to_editor','perseus_linked_images_class',10,8); 



if ( ! function_exists( 'perseus_comment' ) ) :

function perseus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', $GLOBALS['domain'] ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', $GLOBALS['domain'] ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 40;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 30;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', $GLOBALS['domain'] ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', $GLOBALS['domain'] ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', $GLOBALS['domain'] ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', $GLOBALS['domain'] ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', $GLOBALS['domain'] ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; 





function wt_get_category_count($input = '') {
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}





add_action('wp_print_scripts', 'afl_wp_print_scripts_hook');



function my_page_menu($args){
  $menu = '';
  $args['echo'] = false;
  $args['title_li'] = '';

  
  if (get_option('show_on_front') == 'page') $args['exclude'] = get_option('page_on_front');
	$menu.='<ul>';

    $menu .= '<li class="home '.((is_front_page() && !is_paged()) ? 'current-menu-item' : null).'"><a href="'.home_url('/').'" title="'.__("Home Page").'">'.$args['link_before'].__("Home").		$args['link_after'].'</a></li>';
  	$menu .= str_replace(array("\r", "\n", "\t"), '', wp_list_pages($args));

  	if($menu):
    
    	$menu = apply_filters('wp_page_menu', $menu, $args);
  	endif;
	$menu.='</ul>';
  	echo $menu;
}

	function afl_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}


add_filter( 'wp_page_menu_args', 'afl_page_menu_args' );



function paginate() {
	global $wp_query, $wp_rewrite;
	
	
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	//$wp_query->query_vars['page'] > 1 ? $current = $wp_query->query_vars['page'] : $current = 1;
	$pagination='';
	if($wp_query->query_vars!=NULL):
	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain');
	
	else:
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain');
	endif;	
	
	
	if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
}
 

/*contact form*/
add_action('wp_ajax_send_contact_form', 'send_contact_form_callback');
add_action('wp_ajax_nopriv_send_contact_form', 'send_contact_form_callback');
function send_contact_form_callback(){
$email=$_POST['email'];
$name=$_POST['name'];
$url=$_POST['url'];
$message=$_POST['message'];
$contact_array=get_option('contact');


$to = $contact_array['return_email'];
$subject = $contact_array['email_subject'];

$headers = "From:" . $email;
mail($to,$subject,$message,$headers);
echo $contact_array['response_message'];

die();
}
/*-----------------------------------------*/

/*blog excerpt filters*/
function perseus_excerpt_more($more) {
		$out ='...';
		global $post;
	 	$out.='<div class="button_wrapper "><a class="blog_readmore" href="'. get_permalink($post->ID) . '">Read Article</a></div>';
		
		return $out;
		}

add_filter('excerpt_more', 'perseus_excerpt_more');
/*----------------------------------------------------*/

/*portfolio excerpt filters*/
function perseus_portfolio_more($more) {
		$out ='';
		global $post;
	 	$out.='';
		
		return $out;
		}



function perseus_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'perseus_excerpt_length', 999 );


function perseus_one_col_excerpt_length( $length ) {
	return 80;
}


function perseus_two_col_excerpt_length( $length ) {
	return 50;
}

function perseus_three_col_excerpt_length( $length ) {
	return 30;
}
/*-------------------------------------------------------------*/

add_filter( 'use_default_gallery_style', '__return_false' );

function afl_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'afl_remove_gallery_css' );



if ( ! function_exists( 'perseus_posted_on' ) ) :

function perseus_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', $GLOBALS['domain'] ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', $GLOBALS['domain'] ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

function afl_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', $GLOBALS['domain'] ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', $GLOBALS['domain'] ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="gloss_titles_con_main"><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>'
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', $GLOBALS['domain'] ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', $GLOBALS['domain'] ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>'
	) );
	
	
	
	

	
}
/** Register sidebars by running afl_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'afl_widgets_init' );

function afl_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'afl_remove_recent_comments_style' );

function afl_strEx($str, $length){
    $str = explode(" ", $str);
    $nstr = array();
    for($t=0;$t<count($str);$t++){
       $strl = strlen(implode($nstr));
       $strr = strlen(implode($nstr)." ".$str[$t]);
       if($strl<$length && $strr<$length){
          array_push($nstr, " ".$str[$t]);
       }else{
          return trim(implode($nstr));
       }
    }
}

 
function afl_most_popular_posts($amount, $lenght) {
	global $wpdb;
	$request = "SELECT ID, post_title, post_excerpt, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $amount";
	$posts = $wpdb->get_results($request);
	$output = '<ul class="popular-posts">';
	if ($posts) {
	foreach ($posts as $post) {
	$post_title = stripslashes($post->post_title);
	$post_content = afl_strEx(stripslashes($post->post_excerpt), $lenght);
	$comment_count = $post->comment_count;
	$permalink = get_permalink($post->ID);
	$output .= '<li><a href="' . $permalink . '" title="' . $post_title.'">' . $post_content . '</a><strong>' . $comment_count.' comment(s)</strong>' .'</li>' ;
	}
	} else {
	$output .= '<li>'. "None found" . '</li>';
	}
	$output .= '</ul>';
	return $output;
} 

/*custom slider post type*/

add_action('init', 'setup_slider');

function setup_slider() {
  $labels = array(
    'name'               => 'Slides', 'slides',
    'singular_name'      => 'Slide', 'slides',
    'add_new'            => 'Add New', 'slides', 'slides',
    'add_new_item'       => 'Add New Slide', 'slides',
    'edit_item'          => 'Edit Slide', 'slides',
    'new_item'           => 'New Slide', 'slides',
    'view_item'          => 'View Slide', 'slides',
    'search_items'       => 'Search Slides', 'slides',
    'not_found'          => 'No Slides found', 'slides',
    'not_found_in_trash' => 'No SLides found in Trash', 'slides',
    'parent_item_colon'  => ''
  );
  
  $rewrite = array(
    'slug'       => '/slides/item',
    'with_front' => true
  );
  
  $args = array(
  	'labels'              => $labels,
  	'public'              => true,
  	'query_var'           => true,
  	'capability_type'     => 'post',
  	'show_in_nav_menus'   => false,
  	'exclude_from_search' => true,
    'rewrite'             => $rewrite,
  	'menu_position'       => 5,
  	'supports'            => array('title', 'thumbnail', 'excerpt')
  );
	
  register_post_type('slides', $args);
  
  register_taxonomy(
    'slides-category', 
  	array( 'slides' ),
  	array(
  	  'hierarchical'   => true, 
			'label'          => __('Slide Categories', 'perseus'),
			'singular_label' => __('Slide Category', 'perseus'), 
			'rewrite'        => true,
			'query_var'      => true
 	  )
 	);
 	
 	// Flush rewrite rules to get permalinks to work
 	flush_rewrite_rules();

}

add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
	global $typenow;
	$taxonomy = $typenow.'-category';
	
	if( $typenow != "page" && $typenow != "post" && $typenow !=''){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach ($terms as $term) { 
			$tx=$_GET[$tax_slug];
			$ts=$term->slug;
			echo '<option value='. $term->slug, $tx == $ts ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
			}
			
			echo "</select>";
		}
		
	}
}



/*custom portfolio post type*/

add_action('init', 'setup_portfolio');

function setup_portfolio() {
 
 
 $labels_portfolio = array(
		'add_new' => 'Add New', 'portfolio',
		'add_new_item' => 'Add New Portfolio Post',
		'edit_item' => 'Edit Portfolio Post',
		'menu_name' => 'Portfolio',
		'name' => 'Portfolio', 'post type general name',
		'new_item' => 'New Portfolio Post',
		'not_found' =>  'No portfolio posts found',
		'not_found_in_trash' => 'No portfolio posts found in Trash', 
		'parent_item_colon' => '',
		'singular_name' => 'Portfolio Post', 'post type singular name',
		'search_items' => 'Search Portfolio Posts',
		'view_item' => 'View Portfolio Post',
	);
	$args_portfolio = array(
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'labels' => $labels_portfolio,
		'menu_position' => 4,
		'public' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio', 'with_front' => true ),
		'show_in_menu' => true, 
		'show_ui' => true, 
		'supports' => array('comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
	);
	register_post_type( 'portfolio', $args_portfolio );
  
 	
 	// Flush rewrite rules to get permalinks to work
 	flush_rewrite_rules();

}

function perseus_custom_taxonomies() {


	// Portfolio Categories	
	
	$labels = array(
		'add_new_item' => 'Add New Category' ,
		'all_items' => 'All Categories' ,
		'edit_item' =>  'Edit Category' , 
		'name' => 'Portfolio Categories', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Category' ,
		'menu_name' => 'Categories' ,
		'parent_item' => 'Parent Category' ,
		'parent_item_colon' => 'Parent Category:',
		'singular_name' => 'Portfolio Category', 'taxonomy singular name' ,
		'search_items' =>   'Search Categories' ,
		'update_item' => 'Update Category' ,
	);
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio/category' ),
		'show_ui' => true,
	));
		
}

add_action( 'init', 'perseus_custom_taxonomies', 0 );





add_action( 'admin_menu', 'add_title_page_meta_box' );
add_action( 'save_post', 'save_title_meta_box');
add_action( 'edit_page', 'save_title_meta_box');
add_action( 'save_page', 'save_title_meta_box');


function add_title_page_meta_box() {


	add_meta_box( 'title-meta-box', 'Slider Settings', 'add_title_meta_box', 'page', 'side', 'high');
	  
}



function add_title_meta_box() { 
global $post;
add_post_meta($post->ID, 'display_title','',true);
$display_title=get_post_meta($post->ID, 'display_title');
if(!isset($display_title[0])||$display_title[0]=='')$display_title='true';

add_post_meta($post->ID, 'nivo_slider','',true);
$nivo_slider2=get_post_meta($post->ID, 'nivo_slider');

$nivo_slider=$nivo_slider2[0];


if(is_array($nivo_slider)):
	if(array_key_exists('display_slider',$nivo_slider)):
		if($nivo_slider['display_slider']=='') : 
		$nivo_slider['display_slider']='false'; 
		endif;
	endif;
else:
$nivo_slider['display_slider']='false';
endif;


if(is_array($nivo_slider)):
if(array_key_exists('slider_effect',$nivo_slider)):
if($nivo_slider['slider_effect']=='') : $nivo_slider['slider_effect']='random'; endif;
else:
$nivo_slider['slider_effect']='random';
endif;
else:
$nivo_slider['slider_effect']='random';
endif;


if(is_array($nivo_slider)):
if(array_key_exists('slider_cat',$nivo_slider)):
if($nivo_slider['slider_cat']=='') : $nivo_slider['slider_cat']='all'; endif;
else:
$nivo_slider['slider_cat']='all';
endif;
else:
$nivo_slider['slider_cat']='all';
endif;

if(is_array($nivo_slider)):
if(array_key_exists('slider_autoplay',$nivo_slider)):
if($nivo_slider['slider_autoplay']=='') : $nivo_slider['slider_autoplay']='true'; endif;
else:
$nivo_slider['slider_autoplay']='true';
endif;
else:
$nivo_slider['slider_autoplay']='true';
endif;

if(is_array($nivo_slider)):
if(array_key_exists('slider_speed',$nivo_slider)):
if($nivo_slider['slider_speed']=='') : $nivo_slider['slider_speed']=3000; endif;
else:
$nivo_slider['slider_speed']=1000;
endif;
else:
$nivo_slider['slider_speed']=1000;
endif;


if(is_array($nivo_slider)):
if(array_key_exists('slider_pauze',$nivo_slider)):
if($nivo_slider['slider_pauze']=='') : $nivo_slider['slider_pauze']=3000; endif;
else:
$nivo_slider['slider_pauze']=3000;
endif;
else:
$nivo_slider['slider_pauze']=3000;
endif;


if(is_array($nivo_slider)):
if(array_key_exists('num_slides',$nivo_slider)):
if($nivo_slider['num_slides']=='') : $nivo_slider['num_slides']=5; endif;
else:
$nivo_slider['num_slides']=5;
endif;
else:
$nivo_slider['num_slides']=5;
endif;


if(is_array($nivo_slider)):
if(array_key_exists('slider_style',$nivo_slider)):
if($nivo_slider['slider_style']=='') : $nivo_slider['slider_style']=0; endif;
else:
$nivo_slider['slider_style']=0;
endif;
else:
$nivo_slider['slider_style']=0;
endif;


?>

<strong>Nivo-Slider Settings</strong>
<table>
<tr>
<td>Display Slider</td>
<td>
<select name="nivo_slider[display_slider]">
<option value="true" <?php if($nivo_slider['display_slider']=='true'){echo 'selected="yes"';} ?>>True</option>
<option value="false" <?php if($nivo_slider['display_slider']=='false'){echo 'selected="yes"';} ?>>False</option>
</select>
</td>
</tr>

<tr>
<td>Slider Category</td>

<td>
<?php
$args=array('show_option_all'    =>'All' ,'name'=> 'nivo_slider[slider_cat]','selected' =>$nivo_slider['slider_cat'],'taxonomy'=>'slides-category');
       wp_dropdown_categories($args); 
    $selected='0';

?>
</td>
</tr>

<tr>
<td>Number Of Slides</td>
<td>
<select name="nivo_slider[num_slides]">
<?php
for($x=1;$x<11;$x++){
?>
<option value="<?php print($x); ?>" <?php if($nivo_slider['num_slides']==$x){echo 'selected="yes"';} ?>><?php print($x); ?></option>

<?php
}
?>
</select>
</td>
</tr>
<tr>
<td>Effect</td>
<td>
<select id="nivo-slider-effect" class="regular-text" name="nivo_slider[slider_effect]">
<option value="sliceDown"  <?php if($nivo_slider['slider_effect']=='sliceDown'){echo 'selected="yes"';} ?>>Slice Down</option>
<option value="sliceDownLeft" <?php if($nivo_slider['slider_effect']=='sliceDownLeft'){echo 'selected="yes"';} ?>>Slice Down-Left</option>
<option value="sliceUp"  <?php if($nivo_slider['slider_effect']=='sliceUp'){echo 'selected="yes"';} ?>>Slice Up</option>
<option value="sliceUpLeft" <?php if($nivo_slider['slider_effect']=='sliceUpLeft'){echo 'selected="yes"';} ?>>Slice Up-Left</option>
<option value="sliceUpDown" <?php if($nivo_slider['slider_effect']=='sliceUpDown'){echo 'selected="yes"';} ?>>Slice Up-Down</option>
<option value="sliceUpDownLeft" <?php if($nivo_slider['slider_effect']=='sliceUpDownLeft'){echo 'selected="yes"';} ?>>Slice Up-Down-Left</option>
<option value="fold" <?php if($nivo_slider['slider_effect']=='fold'){echo 'selected="yes"';} ?>>Fold</option>
<option value="fade" <?php if($nivo_slider['slider_effect']=='fade'){echo 'selected="yes"';} ?>>Fade</option>
<option value="random"  <?php if($nivo_slider['slider_effect']=='random'){echo 'selected="yes"';} ?>>Random</option>
<option value="slideInRight"  <?php if($nivo_slider['slider_effect']=='slideInRight'){echo 'selected="yes"';} ?>>Slide In Right</option>
<option value="slideInLeft" <?php if($nivo_slider['slider_effect']=='slideInLeft'){echo 'selected="yes"';} ?>>Slide In Left</option>
<option value="boxRandom" <?php if($nivo_slider['slider_effect']=='boxRandom'){echo 'selected="yes"';} ?>>Box Random</option>
<option value="boxRain" <?php if($nivo_slider['slider_effect']=='boxRain'){echo 'selected="yes"';} ?>>Box Rain</option>
<option value="boxRainReverse" <?php if($nivo_slider['slider_effect']=='boxRainReverse'){echo 'selected="yes"';} ?>>Box Rain Reverse</option>
<option value="boxRainGrow"  <?php if($nivo_slider['slider_effect']=='boxRainGrow'){echo 'selected="yes"';} ?>>Box Rain Grow</option>
<option value="boxRainGrowReverse" <?php if($nivo_slider['slider_effect']=='boxRainGrowReverse'){echo 'selected="yes"';} ?>>Box Rain Grow Reverse</option></select>
</td>
</tr>
<tr>
<td>Slider Auto Play</td>
<td>
<select name="nivo_slider[slider_autoplay]">
<option value="true" <?php if($nivo_slider['slider_autoplay']=='true'){echo 'selected="yes"';} ?>>True</option>
<option value="false" <?php if($nivo_slider['slider_autoplay']=='false'){echo 'selected="yes"';} ?>>False</option>
</select>
</td>
</tr>

<tr>
<td>Slide Transition speed</td>
<td>
<input type="text" name="nivo_slider[slider_speed]" value="<?php print($nivo_slider['slider_speed']); ?>"/>
</td>
</tr>

<tr>
<td>Slide Pauze Time</td>
<td>
<input type="text" name="nivo_slider[slider_pauze]" value="<?php print($nivo_slider['slider_pauze']); ?>"/>
</td>
</tr>



</table>
<?php
}
function save_title_meta_box(){
if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
global $post;

if(isset($_POST['display_title'])): 
$display_title=stripslashes($_POST['display_title']);
update_post_meta($post->ID,'display_title',$display_title);
endif;


$slider_settings=array();


if(isset($_POST['nivo_slider'])):
$slider_settings=$_POST['nivo_slider'];

update_post_meta($post->ID,'nivo_slider',$slider_settings);
endif;

}

function afl_wp_print_styles_hook(){
    wp_enqueue_style('nivo-slider', TEMPLATEURL.'/css/nivo-slider.css');
    
    wp_enqueue_style('prettyPhoto', TEMPLATEURL.'/css/prettyPhoto.css');
    wp_enqueue_style('validationEngine', TEMPLATEURL.'/css/validationEngine.jquery.css');
     wp_enqueue_style('menus', TEMPLATEURL.'/css/menus.css');

	wp_enqueue_style('twitter', TEMPLATEURL.'/css/jquery.twitter.css');
	

}
add_action('wp_print_styles', 'afl_wp_print_styles_hook');

function afl_wp_print_scripts_hook(){
    if(!is_admin()){
        wp_enqueue_script("jquery");
        wp_enqueue_script('nivo-slider', TEMPLATEURL.'/js/jquery.nivo.slider.js',array('jquery'));
        wp_enqueue_script('prettyPhoto', TEMPLATEURL.'/js/jquery.prettyPhoto.js',array('jquery'));
        wp_enqueue_script('html5', TEMPLATEURL.'/js/html5.js');
        wp_enqueue_script('js-menus', TEMPLATEURL.'/js/menus.js');
        wp_enqueue_script('jquery-from', TEMPLATEURL.'/js/jquery.form.js');
		wp_enqueue_script('twitter', TEMPLATEURL.'/js/jquery.twitter.js');
		 wp_enqueue_script('cufon-yui', TEMPLATEURL.'/js/cufon-yui.js');
        wp_enqueue_script('merriweather', TEMPLATEURL.'/js/Merriweather.font.js');
		wp_enqueue_script('color-animation', TEMPLATEURL.'/js/color_animation.js');
		wp_enqueue_script('jquery-validator-engine', TEMPLATEURL.'/js/jquery.validationEngine.js');
		wp_enqueue_script('jquery-validator-en', TEMPLATEURL.'/js/jquery.validationEngine-en.js');
		wp_enqueue_script('perseus-custom', TEMPLATEURL.'/js/custom.js');
		wp_enqueue_script( 'my-ajax-request', TEMPLATEURL . '/js/custom.js');
		wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );				
    }
}

/*custom meta url box


/* Define the custom box */

add_action( 'add_meta_boxes', 'add_slide_link_meta_box' );

add_action( 'save_post', 'save_slide_link_meta_box' );


/* Adds a box to the main column on the Post and Page edit screens */
function add_slide_link_meta_box() {
    add_meta_box( 
        'myplugin_sectionid',
        __( 'Slide Settings', 'myplugin_textdomain' ),
        'perseus_inner_custom_box',
        'slides' 
    );
}


function add_slide_style_meta_box() {
    add_meta_box( 
        'perseus_slide_style',
        __( 'Slide Style', 'myplugin_textdomain' ),
        'slide_style_inner_custom_box',
        'slides' 
    );
}



/* Prints the box content */
function perseus_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
add_post_meta($post->ID, 'slide_link','',true);
add_post_meta($post->ID, 'slide_text','',true);
add_post_meta($post->ID, 'display_slide_title','',true);
add_post_meta($post->ID, 'display_slide_excerpt','',true);
$diplay_slide_excerpt=get_post_meta($post->ID, 'display_slide_excerpt');
$diplay_title=get_post_meta($post->ID, 'display_slide_title');
$slide_link=get_post_meta($post->ID, 'slide_link');
$slide_text=get_post_meta($post->ID, 'link_text');


echo $diplay_slide_excerpt[0];

if($slide_text==''||empty($slide_text)){
$slide_text[0]='Read More';
}

if(is_array($diplay_title)){
if($diplay_title[0]==''||empty($diplay_title[0])){
		$diplay_title[0]='false';
	}

}
else{
	if($diplay_title==''||empty($diplay_title)){
		$diplay_title[0]='false';
	}
}


if(is_array($diplay_slide_excerpt)){
	if($diplay_slide_excerpt[0]==''||empty($diplay_slide_excerpt[0])){
		$diplay_slide_excerpt[0]='false';
	} 
}
else{
	if($diplay_slide_excerpt==''||empty($diplay_slide_excerpt)){
		$diplay_slide_excerpt[0]='false';
	}


}

?>
  
  <table>
  <tr>
  
  <tr><td><label for="slide_title">Display Title</td><td></td>
  <td><select name="display_slide_title"><option value="true" <?php if($diplay_title[0]=='true') print('selected="yes"');?>>True</option><option value="false"  <?php if($diplay_title[0]=='false') print('selected="yes"');?>>False</option></select></td></tr>
  <tr><td><label for="slide_excerpt">Display Excerpt</td><td></td>
  <td><select name="display_slide_excerpt"><option value="true" <?php if($diplay_slide_excerpt[0]=='true') print('selected="yes"');?>>True</option><option value="false"  <?php if($diplay_slide_excerpt[0]=='false') print('selected="yes"');?>>False</option></select></td></tr>
  
  <?php
  echo '<td><label for="myplugin_new_field">';
       _e("Enter full slide url", 'myplugin_textdomain' );
  echo '</label><td>http://</td></td>';
  echo '<td><input type="text" id="slide_link" name="slide_link" value="'.$slide_link[0].'" size="25" /></td>';
  echo '<!--<tr><td><label for="link_text">';
       _e("Enter Link Text(only applies to 3/4 width slides)", 'myplugin_textdomain' );
  echo '</label></td><td></td>';
  echo '<td><input type="text" id="link_text" name="link_text" value="'.$slide_text[0].'" size="25" /></td>';
   ?>
  </tr>-->
  </table>
  <?php
  
}

/* When the post is saved, saves our custom data */
function save_slide_link_meta_box( $post_id ) {
if(array_key_exists('post_type',$_POST)==False){

$_POST['post_type']='';
}
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
}
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
 if ( 'slides' == $_POST['post_type'] ) 
  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if ( 'slides' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  
	if ( 'slides' == $_POST['post_type'] ) :
  		$mydata = $_POST['slide_link'];
  
  		$display_slide_title=$_POST['display_slide_title'];
  		$display_slide_excerpt=$_POST['display_slide_excerpt'];
		update_post_meta($post_id, 'slide_link',$mydata);
	
		update_post_meta($post_id, 'display_slide_title',$display_slide_title);
		update_post_meta($post_id, 'display_slide_excerpt',$display_slide_excerpt);
	endif;
  



}


## widgets
	$includes_path = TEMPLATEPATH . '/inc/';
	require_once $includes_path . 'register-widgets.php';
        require_once $includes_path . 'sidebar-init.php';

include_once TEMPLATEPATH . '/lib/init.php';
include_once TEMPLATEPATH . '/lib/options/main.php';

/*filter to restrict posts per page on portfolio pages*/
function portfolio_posts_per_page( $query ) {
    $per_page=get_option('portfolio');
    $per_page=$per_page['items_per_page'];
    
    if(isset($query->query_vars['post_type'])):
    
    else:
    $query->query_vars['post_type'] = '';
    endif;
    if ( $query->query_vars['post_type'] == 'portfolio' ) $query->query_vars['posts_per_page'] = $per_page;
    if(is_tax('portfolio-category')) $query->query_vars['posts_per_page'] = $per_page;
    return $query;
    
}
if ( !is_admin() ) add_filter( 'pre_get_posts', 'portfolio_posts_per_page' );


?>