<?php
/*
Template Name: radio
*/
?>

<?php get_header(); ?>
<style>

#radio-menu {
float:left;
		height:480px;
		width:100px;
		padding:10px 5px 0 10px;

	}
ul, li{margin:0; padding:0; list-style:none;}

.menu_head{border:1px solid #998675;}

#rnav {display:none; width:100px;border-right:1px solid #998675;border-bottom:1px solid #998675;border-left:1px solid #998675;}
#rnav li{background:#493e3b;}
#rnav li.alt{background:#362f2d;}
#rnav li a{color:#FFFFFF; text-decoration:none; padding:10px; display:block;}
#rnav li a:hover{color:#EC18EA;padding:15px 10px; font-weight:bold;}
.radio-title{padding:5px 0 0 15px;
#radio{
float:right;
padding-top:10px;
padding-right:5px;
overflow: hidden;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
	$("ul#rnav li:even").addClass("alt");
    $('img.menu_head').click(function () {
	$('ul#rnav').slideToggle('medium');
    });
	$('ul#rnav li a').mouseover(function () {
	$(this).animate({ fontSize: "14px", paddingLeft: "20px" }, 50 );
    });
	$('ul#rnav li a').mouseout(function () {
	$(this).animate({ fontSize: "12px", paddingLeft: "10px" }, 50 );
    });
});
</script>
  <script type="text/javascript">

        function frame() {
            var nav = document.getElementById("rnav");
            var links = nav.getElementsByTagName("a");
            var radio = document.getElementById("radio");
            for (var i = 0; i < links.length; i++) {

                links[i].onclick = function() {
                    remove();
                    var source = this.getAttribute("href");
                    var frame = document.createElement("iframe");
                    frame.setAttribute("src", source);
                    frame.setAttribute("frameborder", "0");
                    frame.setAttribute("width", "800px");
                    frame.setAttribute("height", "480px");
                    radio.appendChild(frame);
                    return false;
                }
            }

        }

        function remove() {
            var radio = document.getElementById("radio");
            if (radio.hasChildNodes()) {
                radio.removeChild(radio.childNodes[0]);
            } 

        }

        window.onload = function() {
            frame();
        }

    </script>   

<div id="container" class="onecolumn">
	


<?php the_post(); ?>
<h1 class="radio-title"><?php the_title(); ?></h1>
<div>
	    	<div id="radio-menu">
<img src="<?php bloginfo('template_url'); ?>/images/rnav.gif" width="100" height="32" class="menu_head" />
		<ul id="rnav">
<li><a href="http://bywhy.com/douban" title="豆瓣电台">豆瓣电台</a></li>
<li><a href="http://bywhy.com/xiami" title="虾米电台">虾米电台</a></li>
<li><a href="http://bywhy.com/kugou" title="酷狗电台">酷狗电台</a></li>
<li><a href="http://bywhy.com/yueku" title="乐库电台">乐库电台</a></li>
<li><a href="http://bywhy.com/kuwo" title="酷我音乐">酷我音乐</a></li>
<li><a href="http://bywhy.com/yytv" title="音悦TV">音悦TV</a></li>
<li><a href="http://www.bywhy.com/fm/" title="网络电台">网络电台</a></li>
</ul>
		
        </div> 
<div id="radio">

</div>
</div>
<div class="clear"></div>
<?php comments_template( '', true ); ?>
</div>
	
<?php get_footer(); ?>