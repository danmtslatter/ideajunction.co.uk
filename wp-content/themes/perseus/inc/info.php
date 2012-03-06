	<div class="info" style="">
	<?php
	if(get_post_type( $post )!='portfolio'):
	?><span class="author">
Posted By&nbsp;:&nbsp;<a href="<?php print(esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )); ?>" rel="author">
<?php print(get_the_author()); 

?>

</a>
</span>
	in&nbsp;:&nbsp;  
	<?php 
                   
	the_category(', '); 
	
	?>&nbsp;
	
	<?php
	endif;
	
	
	$posttags = get_the_tags();
	if ($posttags) {
		echo '<img src="'.get_template_directory_uri("template_url").'/css/images/pin.png" height="15px" style="margin-top:3px"/>';
  		echo '&nbspTags&nbsp;:&nbsp;';
  			foreach($posttags as $tag) {
    			echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>,&nbsp;'; 
  			}
	}

	?>
	<div class="clear"></div></div>