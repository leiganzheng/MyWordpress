<?php if (get_option('swt_directory') == 'true') { ?>
<?php 
// 导航目录
function article_index($content) {
    $matches = array();
    $ul_li = '';
    $r = "/<h3>([^<]+)<\/h3>/im";  
    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
            $content = str_replace($matches[0][$num], '<h4 id="title-'.$num.'">'.$title.'</h4>', $content);
            $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
        }
        $content = "\n<div id=\"article-index\">
                <strong>文章目录</strong>  
                <ul id=\"index-ul\">\n" . $ul_li . "</ul>
            </div>\n" . $content;
    }
    return $content;
}
add_filter( "the_content", "article_index" );
?>
<? } ?>