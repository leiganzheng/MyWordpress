<?php
/*
Template Name: cse
*/
?>
<?php get_header();  ?>
<div id="container">

	<div id="content">
<div id="cse" style="width: 100%;">正在从Google 加载搜索结果......</div>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
  google.load('search', '1', {language : 'zh-CN'});
  google.setOnLoadCallback(function(){
        var customSearchControl = new google.search.CustomSearchControl('017702585843647209183:l3sfdgcikse');
        customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
        customSearchControl.draw('cse');
        var match = location.search.match(/q=([^&]*)(&|$)/);
        if(match && match[1]){
            var search = decodeURIComponent(match[1]);
            customSearchControl.execute(search);
        }
    });
</script>

    <link rel="stylesheet" href="http://www.google.com/cse/style/look/shiny.css" type="text/css" />
  </div>
  </div>
  <?php get_sidebar(); ?>

<?php get_footer(); ?>
