<?php
$what = (isset($_GET['what'])) ? $_GET['what'] : '';
$alias = (isset($_GET['alias'])) ? $_GET['alias'] : '';
$width = (isset($_GET['w'])) ? $_GET['w'] : '';
$height =  (isset($_GET['h'])) ? $_GET['h'] : '';
$crop =  (isset($_GET['c'])) ? $_GET['c'] : '';

if (isset($_POST) && $_POST) Text::setTxt($alias, $_POST['text']);
if (isset($_FILES) && $_FILES) {
    $tmp_name = $_FILES['image']['tmp_name'];
    $type = $_FILES['image']['type'];
    if ($type == 'image/jpeg') $ext = 'jpg';
    if ($type == 'image/png') $ext = 'png';
    if ($type != 'image/jpeg' && $type != 'image/png') return;
    $uploads_path = DROOT . '/images';
    $uploads_url = '/images';
    $name = uniqid();
    if (move_uploaded_file($tmp_name, "$uploads_path/$name.$ext")) Image::setImg($alias, "$uploads_url/$name.$ext");
    else die('Error: file not uploaded');
}
if ($what == 'txt') $text = Text::getTxt($alias);
if ($what == 'img') $image = Image::getImg($alias, $width, $height, $crop);
