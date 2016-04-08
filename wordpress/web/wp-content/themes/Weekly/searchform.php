<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/search">
	<input type="text" class="input-text" name="q" id="s"  value="<?php _e('Search in this site...','themejunkie'); ?>" onfocus="if (this.value == '<?php _e('Search in this site...','themejunkie'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search in this site...','themejunkie'); ?>';}" />
	<input id="searchsubmit" type="submit" value="Go" />
</form>