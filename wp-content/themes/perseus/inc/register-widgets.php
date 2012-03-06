<?php

include_once (TEMPLATEPATH . '/inc/widgets/perseus_twitter.php');
include_once (TEMPLATEPATH . '/inc/widgets/perseus_portfolio_widget.php');
include_once (TEMPLATEPATH . '/inc/widgets/perseus_recent_posts.php');
add_action("widgets_init", "load_my_widgets");

function load_my_widgets() {
	
	register_widget("perseus_TwitterWidget");
	register_widget("perseus_RecentPostsWidget");
	register_widget("perseus_portfolioWidget");
	
}
?>