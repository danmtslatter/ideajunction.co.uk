<div class="sidebar">
	<?php if (! dynamic_sidebar('primary-widget-area')):?>
        <?php
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider"><div class="head_divider_inner"></div></div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
		<?php the_widget('WP_Widget_Calendar','title=Calendar',$args);?>
		<?php the_widget('WP_Widget_Meta','title=Meta',$args);?>
		<?php the_widget('WP_Widget_Pages','title=Pages',$args);?>
    <?php endif; ?>
</div>
<div class="clear"></div>
<div class="sidebar">
	<?php if (! dynamic_sidebar('secondary-widget-area')):?>
        <?php
        $args=array(
		'before_widget' => '<div  class="widget">',
		'after_widget' => '<div class="head_divider"><div class="head_divider_inner"></div></div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>');
        
		?>
    <?php endif; ?>
</div>