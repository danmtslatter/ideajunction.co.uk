<?php
?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<?php
check_browser();
if ( ! isset( $content_width ) ) $content_width = 980;
?>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	
	global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

	
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";

	
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', $domain ), max( $paged, $page ) );

?>
</title>

<?php $opts=get_option('theme_options');
if(isset($opts['favicon'])): ?><link rel="shortcut icon" href="<?php print $opts['favicon']; ?>" type="image/x-icon" /><?php endif; ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
  
<?php if(isset($opts['google_analytics'])): print($opts['google_analytics']); endif; ?>	

</head>

<body <?php body_class(); ?> style="overflow:hidden;">
<div id="preloader" style="position:absolute;height:100%;width:100%;z-index:999999;background:url('<?php print(get_template_directory_uri("template_url")); ?>/images/preloader.gif') center center no-repeat #f6f6f6"></div>


		<!-- header -->
<div class="header">  
	<div class="header_inner" > 
	         
        	<div class="container_12">
            	<div class="grid_12">
                	<div class="extra-wrap">
               
              			 <div id="title_con">
               				<?php if(isset($opts['logo_url'])&&$opts['logo_url']!=''): ?>
               				<img class="perseus_logo" src="<?php  print($opts['logo_url']); ?>"/>
               <?php endif; $title_class='hide_title'; ?>
               
                    <h1 class="gloss_site_title <?php if($opts['hide_site_title']=='true'): print($title_class);endif;?>" style="float:left">
                    	<a href="<?php echo home_url(); ?>"><?php print(bloginfo('name')); ?></a>
                    </h1>
                    
					
           				 </div>
           
                    <nav id="perseus_menu" role="navigation" class="jqueryslidemenu" >
				<h3 class="assistive-text"><?php _e( 'Main menu', $GLOBALS['domain'] ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', $GLOBALS['domain'] ); ?>"><?php _e( 'Skip to primary content', $GLOBALS['domain'] ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', $GLOBALS['domain'] ); ?>"><?php _e( 'Skip to secondary content', $GLOBALS['domain'] ); ?></a></div>
				
				
				<?php wp_nav_menu( array('menu_class' => '','container' => false,'theme_location' => 'primary','fallback_cb' => 'my_page_menu') ); ?>
			
			</nav><!-- #access -->
          
           
                </div>
              </div> 
         
			
             
             <div class="clear"></div>
  
        
         </div>
   </div> 
</div>
<div id="header_div" class="">
<?php
$social_media=get_option('social');$display_social=$social_media['display_social'];$social_media=$social_media['social'];
if($opts['display_tagline']=='true' or $display_social=='true'):
?>
<div id="tag_line_con_outer">
<div id="tag_line_con" >
<?php if($opts['display_tagline']!='false'):if(get_bloginfo('description')): ?>
         
        <h4 id="site-description" style=""><?php bloginfo( 'description' ); ?></h4>
        <?php endif; endif; if($display_social=='true'): ?>   
        
        
		<ul class="list-icon" style="">
            <?php foreach ($social_media as $s){	
             	    if($s['url']):
             		echo '<li><a href="'.$s['url'].'"><img style="" src="'.$s['image'].'" /></a></li>';
             	endif;
            		} ?>
   		</ul>
<?php endif;?>
<div class="clear"></div>    
</div>
</div>
<?php endif; ?>
</div>
