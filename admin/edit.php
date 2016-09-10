<?php
include 'auth.php';
include '../config/config.php';
include 'save.php';
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Levin CMS Landing Page Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  </head>
  <body style="margin-top: 30px;">
    <div class="container">  
      <form action="" method="post" enctype="multipart/form-data">
        <?php if ($what == 'txt') { ?>
        <h3><i class="fa fa-file-text-o" aria-hidden="true"></i> Text ::  <?php echo $alias; ?></h3>
        <textarea class="form-control" name="text" rows="10"><?php echo $text; ?></textarea>
        <? } ?>
        <?php if ($what == 'img') { ?>
        <h3><i class="fa fa-picture-o" aria-hidden="true"></i> Image ::  <?php echo $alias; ?></h3>
        <img src="<?php echo $image; ?>" style="max-width: 100%">
        <input style="margin-top: 30px;" class="form-control" type="file" name="image">
        <? } ?>
        <div class="clearfix">
          <button style="margin-top: 30px;" class="btn btn-primary btn-lg pull-right" type="submit"><i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i></button>
          <button style="margin-top: 30px;" class="btn btn-default btn-lg pull-left" type="button" onclick="javascript: window.location.href = '/?edit';"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></button>
        </div>
      </form>
    </div>
  <? if ( (isset($_POST) && $_POST) || (isset($_FILES) && $_FILES) ) { ?>        
  <script>window.location.href = '/?edit';</script>
  <? } ?>
  </body>
</html>

