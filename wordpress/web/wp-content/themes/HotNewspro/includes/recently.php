<div class="recently">
	<div class="ad">
		<div class="box_top">
			<i class="rt"></i>
			<i class="lt"></i>
		</div>
		<div class="ads_c"><p align="center"><?php echo stripslashes(get_option('swt_adsr')); ?></p>
			<div class="clear"></div>
		</div>
		<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>
	</div>
	<div class="box_top">
		<i class="rt"></i>
		<i class="lt"></i>
	</div>
	<div class="mimg">
		<h4>最近浏览过的文章：</h4>
		<?php zg_recently_viewed(); ?>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>
<!-- 跟随滚动 -->
<script type="text/javascript">
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top, pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 10
                    });
                } else {
                    element.css({
                        top: scrolls
                    });
                }
            }else {
                element.css({
                    position: "",
                    top: top
                });
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};
//绑定
$(".recently").smartFloat();
</script>