<?php
// =============================== Twitter  ======================================
class perseus_TwitterWidget extends WP_Widget {
    /** constructor */
    function perseus_TwitterWidget() {
        parent::WP_Widget(false, $name = 'Perseus Twitter Widget',array( 'description' =>'Perseus Widget for displaying Tweets.'));
    }
	
	
  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$twitter_name = apply_filters('twitter_name', $instance['twitter_name']);
		$amount = apply_filters('twitter_twitts_amount', $instance['twitts_amount']);
		$suf = rand(100000,999999);		
        ?>
              <?php echo $before_widget ?>
                 <?php if ( $title )
			echo $before_title . $title . $after_title; ?>
			
                        <div id="twitter-<?php echo $suf; ?>" class="twitter"></div>
                       
                            <script>
								jQuery(document).ready(function() {
									jQuery("#twitter-<?php echo $suf; ?>").getTwitter({
										userName: "<?php echo $twitter_name; ?>",
										numTweets: <?php echo $amount; ?>,
										loaderText: "Loading tweets...",
										slideIn: true,
										showHeading: true,
										headingText: "",
										id:"#twitter-<?php echo $suf; ?>",
										showProfileLink: true
									});
								});
                                
                            </script>
                        
                        
    
                        <?php wp_reset_query(); ?>
								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        if(empty($instance['title'])){ $instance['title'] = '';}
        $title = esc_attr($instance['title']);
        if(empty($instance['twitter_name'])){ $instance['twitter_name'] = '';}
		$twitter_name = esc_attr($instance['twitter_name']);
		if(empty($instance['twitts_amount'])){ $instance['twitts_amount'] = '';}
		$amount = esc_attr($instance['twitts_amount']);
			
        ?>
        
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php print('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('twitter_name'); ?>"><?php print('Twitter Name:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo $twitter_name; ?>" /></label></p>
	  <p><label for="<?php echo $this->get_field_id('twitts_amount'); ?>"><?php print('Twitts number:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitts_amount'); ?>" name="<?php echo $this->get_field_name('twitts_amount'); ?>" type="text" value="<?php echo $amount; ?>" /></label></p>		
			
        <?php 
    }

} // class  Widget
?>