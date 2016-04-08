<?php

/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
if (class_exists('WP_Widget')) {
	class ThemeJunkie_flickr extends WP_Widget {
	
		function ThemeJunkie_flickr() {
			$widget_ops = array('description' => 'This Flickr widget populates photos from a Flickr ID.' );
			parent::WP_Widget(false, __('Theme Junkie - Flickr', 'themejunkie'),$widget_ops);      
		}
	
		function widget($args, $instance) {  
			extract( $args );
			$id = $instance['id'];
			$number = $instance['number'];
			$type = $instance['type'];
			$sorting = $instance['sorting'];
			
			echo $before_widget;
			echo $before_title; ?>
			<?php _e('来自<span>Flick<span>r</span></span>的图片','themejunkie'); ?>
			<?php echo $after_title; ?>
				
			<div class="wrap">
				<div class="clear"></div>
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>"></script>        
				<div class="clear"></div>
			</div>
	
		   <?php			
		   echo $after_widget;
	   }
	
	   function update($new_instance, $old_instance) {                
		   return $new_instance;
	   }
	
	   function form($instance) {        
			$id = esc_attr($instance['id']);
			$number = esc_attr($instance['number']);
			$type = esc_attr($instance['type']);
			$sorting = esc_attr($instance['sorting']);
			?>
			<p>
				<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):','themejunkie'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:','themejunkie'); ?></label>
				<select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
					<?php for ( $i = 1; $i < 10; $i += 1) { ?>
					<option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:','themejunkie'); ?></label>
				<select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
					<option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'themejunkie'); ?></option>
					<option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'themejunkie'); ?></option>            
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Sorting:','themejunkie'); ?></label>
				<select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
					<option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'themejunkie'); ?></option>
					<option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'themejunkie'); ?></option>            
				</select>
			</p>
			<?php
		}
	} 
	register_widget('ThemeJunkie_flickr');
}

?>