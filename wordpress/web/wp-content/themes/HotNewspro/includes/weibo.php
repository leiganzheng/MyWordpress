<?php if (get_option('swt_weib') == 'true') { ?>
<span class="weibo">
	<html xmlns:wb=“http://open.weibo.com/wb”>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<wb:follow-button uid="<?php echo get_option('swt_weibo'); ?>" type="gray_4" width="67" height="24" ></wb:follow-button>
</span>
<? } ?>