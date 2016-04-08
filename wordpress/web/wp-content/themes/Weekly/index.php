<?php 
	if(is_home() && get_query_var('paged') == 0)
		include(TEMPLATEPATH. '/front.php');
	else
		include(TEMPLATEPATH. '/archive.php');
?>