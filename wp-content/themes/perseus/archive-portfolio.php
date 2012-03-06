<?php /*the following code is to display portfolio categories and pages this chaining method was use to address an issue with custom post types and paging*/

add_filter('excerpt_more', 'perseus_portfolio_more');

$porturl=get_option('portlink');

$ops=get_option('portfolio');
$per_page=get_option('portsettings');
$class='';

$nav_class='current-cat';

if(is_tax('portfolio-category')) $nav_class='';
global $wp_query;

/*set style class*/
switch($ops['number_cols']){
	 case "One":
	 $class='page-template-1_columns_portfolio-php';
	 break;
	 case "Two":
	 $class='page-template-2_columns_portfolio-php';
	 break;
	 case "Three":
	 $class='page-template-3_columns_portfolio-php';
	 break;
}

?>

<div class="<?php echo $class;?>">
<section id="content">
<div class="container_12">
<div class="grid_12">
<div class="post_content">
<div class="main_blog_titles" style="<?php if($ops['display_title']=='true'): print('border-bottom:1px solid white;');endif ?>">
<div style="<?php if($ops['display_title']=='true'): print('border-bottom:1px solid #EBEBEB;');endif; ?>">
<h2 id="page_titles"><?php if($ops['display_title']=='true'): printf($ops['title']); endif;?></h2>
</div>
</div>
    			
<?php $args=array('show_count'=> 1,'name'=> 'portfolio_cats','taxonomy'=>'portfolio-category','title_li'=>'');?>
       <ul id="portfolio_cats_list" class="portfolio_main_page" style="">
       <li class="<?php print($nav_class);?>"><a href="<?php echo $porturl; ?>">All</a></li>
       <?php wp_list_categories( $args ); ?>
       </ul>       
<?php 
$i=0;$post_index=0;$col='first';

$count=$wp_query->post_count;
$current_count=0;
if(have_posts()): while (have_posts()) : the_post();
$post_index++;$i++;$current_count++;
switch ($ops['number_cols']) {
case "One":
 	add_filter( 'excerpt_length', 'perseus_one_col_excerpt_length', 999 );?>
	<div class="post" id="post-<?php the_ID(); ?>">

<?php  post_contents('one_col_portfolio'); 
break;

case "Two":/*start 2 col loop portfolio*/
	add_filter( 'excerpt_length', 'perseus_two_col_excerpt_length', 999 );?>
	<div class="post <?php if($post_index==2): print('last_item'); endif;?>" id="post-<?php the_ID(); ?>">
<?php post_contents('two_col_portfolio');if($post_index==2||$current_count==$count): print('<div class="clear"></div>'); $post_index=0;endif;        
break;
        /*end 2 col*/
case "Three":
        /*start three cols portfolio*/
        add_filter( 'excerpt_length', 'perseus_three_col_excerpt_length', 999 );?>
	 	<div class="post <?php if($post_index==3): print('last_item'); endif;?>" id="post-<?php the_ID(); ?>">
        <?php post_contents('three_col_portfolio');if($post_index==3||$current_count==$count): print('<div class="clear"></div>'); $post_index=0;endif;  
        break;
}
endwhile;
else : ?><h3>No Portfolio Items Founs</h3><?php endif;?>
</div>

<?php if($ops['limit_items']=='true'): ?><div class="gloss_post_nav"><?php paginate(); ?></div><?php endif; ?>
           <div class="clear"></div>
            </div>
           
		</div>
</section>
</div>

<?php


/*functions to display portfolio items below*/
/*------------------------------------------*/

function perseus_display_meta(){ global $post;?>
<div class="post_date_con">
				<img style="float:left;height:19px;margin-right:2px;" src="<?php print(get_template_directory_uri("template_url")); ?>/css/images/clock.png"/>
				<span class="day_con"><?php the_time('d');?></span>
				<span class="month_con">&nbsp;<?php the_time('M');?>&nbsp;</span>
				<span class="year_con"><?php the_time('Y'); ?></span>
			</div>
<?php if(comments_open()): ?>
<div class="post_date_con">
<img style="float:left;height:19px;margin-right:2px;" src="<?php print(get_template_directory_uri("template_url")); ?>/css/images/blog.png"/>
<a href="<?php print(get_permalink().'#comments');?>"><?php comments_number();?></a>
</div>
<?php endif; ?>			

<?php }

function post_contents($image_size){ global $post; ?>
<div class="blog_title_outer">
	<div class="blog_title_inner">
		<h3 class="blog_post_titles">
			<a class="" href="<?php echo get_permalink();?>"><?php echo the_title();?></a>
		</h3>
	 <?php perseus_display_meta(); ?>
	<div class="clear"></div>
	</div>
  </div>
<?php if (has_post_thumbnail()):?>
<div class="image_dark_con">
      <a href="<?php echo get_permalink();?>">
      <?php $image_id ='';$image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,$image_size, true);?>
		<div class="img-box" style="">
			<img class="" src="<?php echo $image_url[0];?>"/>
		</div>
	   </a>
	</div>

<?php endif; ?> 
                               
                                <div class="entry">
									<?php the_excerpt();
									print('<div class="button_wrapper "><a class="blog_readmore" href="'. get_permalink($post->ID) . '">View Project</a></div>');
									get_template_part('/inc/info');?> 
									
                                </div>
							<div class="clear"></div>
                        </div>

<?php } ?>