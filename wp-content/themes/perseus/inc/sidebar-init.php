<?php
function elegance_widgets_init() {
	
	// Sidebar Widget
	// Location: at the top of the content
	register_sidebar(array(
		'name'			=> 'Footer widget 1',
		'id' 			=> 'footer-widget-1',
		'description'   => 'Footer - 1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>'
	));
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name' 			=> 'Footer widget 2',
		'id'			=> 'footer-widget-2',
		'description'	=> 'Footer - 2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>'
	));
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name' 			=> 'Footer widget 3',
		'id'			=> 'footer-widget-3',
		'description'	=> 'Footer - 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div>'
	));
	
	register_sidebar(array(
		'name' 			=> 'Footer widget 4',
		'id'			=> 'footer-widget-4',
		'description'	=> 'Footer - 4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="gloss_titles_con_main" ><h3 class="widget-title gloss_main_titles_main">',
		'after_title' => '</h3></div><div class="widget_con">'
	));
    
		
		
}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
	add_action( 'widgets_init', 'elegance_widgets_init' );
	
?>