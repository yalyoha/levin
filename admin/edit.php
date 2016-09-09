<?php

define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
require DROOT . '/admin/auth.php';
require DROOT . '/admin/function.php';

$id = $_GET['id'];
$what = $_GET['what'];
$width = $_GET['w'];
$height = $_GET['h'];
$crop = $_GET['c'];
$error = false;

if ($_POST)
    setTxt($id, $_POST['text']);
    
if ($_FILES) {
    $tmp_name = $_FILES['image']['tmp_name'];
    $type = $_FILES['image']['type'];
    if ($type == 'image/jpeg')
        $ext = 'jpg';
    if ($type == 'image/png')
        $ext = 'png';
    if ($type != 'image/jpeg' && $type != 'image/png')
        $error = true;
    $uploads_path = DROOT . '/images';
    $uploads_url = '/images';
    $name = uniqid();
    if (!$error) {
        move_uploaded_file($tmp_name, "$uploads_path/$name.$ext");
        setImg($id, "$uploads_url/$name.$ext");
    }
}

if ($what == 'img')
    $image = getImg($id, $width, $height, $crop);
    
if ($what == 'txt')
    $text = getTxt($id);

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
      <form action="<?php echo $_SERVER["REQUEST_URI "]; ?>" method="post" enctype="multipart/form-data">
        <?php if ($what == 'txt') { ?>
        <h3>Текстовой блок № <?php echo $id; ?></h3>
        <textarea class="form-control" name="text" rows="10"><?php echo trim($text); ?></textarea>
        <? } ?>
        <?php if ($what == 'img') { ?>
        <h3>Изображение № <?php echo $id; ?></h3>
        <img src="<?php echo $image; ?>" style="max-width: 100%">
        <input style="margin-top: 30px;" class="form-control" type="file" name="image">
        <? } ?>
        <button style="margin-top: 30px;" class="btn btn-primary btn-lg pull-right" type="submit"><i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i></button>
        <button style="margin-top: 30px;" class="btn btn-default btn-lg pull-left" type="button" onclick="javascript: window.location.href = '/?edit';"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></button>
      </form>
    </div>
  </body>
</html>

