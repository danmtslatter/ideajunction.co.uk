<?php
get_header();
/* Template Name: Portfolio */
$porturl=get_page_link();
update_option('portlink',$porturl);

$paged = 1;
if ( get_query_var('paged') ){
$paged = get_query_var('paged');

} 
if ( get_query_var('page') ){
$paged = get_query_var('page');
} 

$ops=get_option('portfolio');

    		if($ops['limit_items']=='false'):
    		
				query_posts( 'showposts=-1&post_type=portfolio&paged=' . $paged );
				
			else:
				
				query_posts( '&post_type=portfolio&paged=' . $paged );
			
			endif;



require_once( 'archive-portfolio.php' );

get_footer();
?>