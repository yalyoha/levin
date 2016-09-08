<?php

$servername = "mysql69.1gb.ru";
$username = "gb_koronabaza";
$dbname = "gb_koronabaza";
$password = "a17549abaqwr";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$admin = (isset($_GET['edit'])) ? true : false;

require_once DROOT . '/helper/SimpleImage.php';

function getTxt($id = null) {
    global $conn;
    if (!isset($id)) return;
    $id = intval($id);
    $result = $conn->query("SELECT text FROM texts WHERE id=$id LIMIT 1");
    $data = $result->fetch_assoc();
    if ($result->num_rows > 0) return $data['text'];
    else  return insertTxt($id, 'text#' . $id);
}

function getImg($id = null, $width = null, $height = null, $crop = null) {
    global $conn;
    if (!isset($id)) return;
    if (!isset($width)) $width = 400;
    if (!isset($height)) $height = 300;
    if (!isset($crop)) $crop = true;
    $id = intval($id);
    $result = $conn->query("SELECT image FROM images WHERE id=$id LIMIT 1");
    $data = $result->fetch_assoc();
    if ($result->num_rows > 0) return thumb($data['image'], $width, $height, $crop);
    else  return thumb(insertImg($id, '/images/noimage.jpg'), $width, $height, $crop);
}

function setTxt($id = null, $data) {
    global $conn;
    if (!isset($id)) return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("UPDATE texts SET text='$data' WHERE id=$id") === true) return $conn->affected_rows;
    else  die("Error: " . $conn->error);
}
function setImg($id = null, $data) {
    global $conn;
    if (!isset($id)) return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("UPDATE images SET image='$data' WHERE id=$id") === true) return $conn->affected_rows;
    else  die("Error: " . $conn->error);
}

function insertTxt($id = null, $data) {
    global $conn;
    if (!isset($id)) return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("INSERT INTO texts (id, text) VALUES ('$id', '$data')") === true) return getTxt($id);
    else  die("Error: " . $conn->error);
}

function insertImg($id = null, $data) {
    global $conn;
    if (!isset($id)) return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("INSERT INTO images (id, image) VALUES ('$id', '$data')") === true) return getImg($id);
    else  die("Error: " . $conn->error);
}

function t($id = null) {
    global $admin;
    if (!isset($id)) return;
    $id = intval($id);
    $adminBtn = '<a style="position:absolute;top:0;left:0;background:rgba(255,255,255,.8);text-decoration:none;" href="/admin/edit.php?what=txt&id=' . $id . '">[' . $id . ']</a>';
    echo $admin ? '<div style="position:relative">' . $adminBtn . getTxt($id) . '</div>' : getTxt($id);
}

function i($id = null, $width = null, $height = null, $crop = true) {
    global $admin;
    if (!isset($id)) return;
    $id = intval($id);
    $adminBtn = '<a style="position:absolute;top:0;left:0;background:rgba(255,255,255,.8);text-decoration:none;" href="/admin/edit.php?what=img&id=' . $id . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '">[' . $id . ']</a>';
    echo $admin ? '<div style="position:relative">' . $adminBtn . '<img src="' . getImg($id, $width, $height, $crop) . '"></div>' : '<img src="' . getImg($id, $width, $height, $crop) . '">';
}

function thumb($src, $width, $height, $crop) {
    if (!$height) $height = $width;
    $path = DROOT . $src;
    $info = pathinfo($path);
    $extension = $info['extension'];
    $dirname = $info['dirname'];
    $basename = $info['basename'];
    $newDir = $dirname . '/' . $width . 'x' . $height;
    if (!is_dir($newDir)) mkdir($newDir);
    $newPath = $dirname . '/' . $width . 'x' . $height . '/' . $basename;
    $newSrc = str_replace(DROOT, '', $newPath);
    if (file_exists($newPath) && filemtime($path) == filemtime($newPath)) return $newSrc;
    $img = new SimpleImage($path);
    if ($crop) $img->thumbnail($width, $height)->save($newPath);
    else  $img->best_fit($width, $height)->save($newPath);
    touch($path);
    return $newSrc;
}
