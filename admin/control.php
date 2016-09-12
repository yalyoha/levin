<?php
include 'auth.php';
include '../config/config.php';
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Levin CMS Landing Page Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/admin/css/admin.css" >
  </head>
  <body style="margin-top: 30px;">
    <div class="container"> 
        <div class="row" style="margin-top: 30px;">
        <!-- Additional control / -->
          <div class="col-sm-6 text-center"><h3><i class="fa fa-picture-o" aria-hidden="true"></i> Background :: #1</h3><hr><?php Image::admin('background-image-1',  555, 312); ?></div>
          <div class="col-sm-6 text-center"><h3><i class="fa fa-picture-o" aria-hidden="true"></i> Background :: #2</h3><hr><?php Image::admin('background-image-2',  555, 312); ?> </div>
        <!-- / Additional control -->     
        </div>
        <div class="row" style="margin-top: 30px;">
        <!-- Additional control / -->
          <div class="col-sm-4 text-center"><h3><i class="fa fa-file-text-o" aria-hidden="true"></i> Tag Title</h3><hr><?php Text::admin('tag-title'); ?> </div>
          <div class="col-sm-4 text-center"><h3><i class="fa fa-file-text-o" aria-hidden="true"></i> Tag Meta Description</h3><hr><?php Text::admin('tag-meta-description'); ?> </div>
          <div class="col-sm-4 text-center"><h3><i class="fa fa-file-text-o" aria-hidden="true"></i> Tag Meta Keywords</h3><hr><?php Text::admin('tag-meta-keywords'); ?> </div>
        <!-- / Additional control -->     
        </div>        
        <div class="clearfix">
          <button style="margin-top: 30px;" class="btn btn-default btn-lg pull-left" type="button" onclick="javascript: history.back(-1);"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></button>
          <button style="margin-top: 30px;" class="btn btn-default btn-lg pull-left" type="button" onclick="javascript: window.location.href = '/?edit&reset=<?php echo uniqid(); ?>';"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></button>
        </div>        
    </div>
<script src="/js/jquery-1.11.2.min.js" ></script>    
<script>
$('span.admin[data]').click(function() {
    window.location.href = $(this).attr('data');
});
</script>  
<div id="control" class="control"><img src="http://temporary.eto-studio.ru/images/svg/best-logo.svg"><span class="inner"><b><span class="uc">Frankie Maker</span><i class="fa fa-usd" aria-hidden="true"></i></b> :: <b>Levin CMS</b><br>Landing Page Editor</span></div>
<div id="exit"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>
<style>#control {cursor: default;}</style>
<script>
$('#exit').click(function() {
    window.location.href = '/';
});
</script> 
  </body>
</html>
