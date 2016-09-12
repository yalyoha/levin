<?php
class Image {

    static function getImg($alias, $width = 400, $height = 300, $crop = true) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $result = Db::query("SELECT image FROM images WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return self::thumb($data['image'], $width, $height, $crop);
        else  return self::insertImg($alias, $crc32, '/images/empty.png', $width, $height, $crop);
    }

    static function setImg($alias, $data) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("UPDATE images SET image='$data' WHERE crc32=$crc32") === true) return Db::conn()->affected_rows;
        else  die("Error: " . Db::error());
    }

    static function insertImg($alias, $crc32, $data, $width, $height, $crop) {
        if (!isset($crc32)) return;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("INSERT INTO images (crc32, alias, image) VALUES ('$crc32', '$alias', '$data')") === true) return self::getImg($alias, $width, $height, $crop);
        else  die("Error: " . Db::error());
    }

    static function mode() {
        return (isset($_GET['edit'])) ? true : false;
    }

    static function here($alias, $width, $height = null, $attrClass = '', $attrAlt = '', $crop = true) {
        if (!isset($height)) $height = $width;
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&alias=' . $alias . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo self::mode() ? '<span class="admin-wr">' . $adminBtn . '<img class="' . $attrClass . '" src="' . self::getImg($alias, $width, $height, $crop) . '" alt="' . $attrAlt . '"></span>' : '<img src="' . self::getImg($alias, $width, $height, $crop) . '" alt="">';
    }
    
    static function admin($alias, $width, $height, $attrClass = '', $attrAlt = '', $crop = true) {
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&alias=' . $alias . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo '<span class="admin-wr">' . $adminBtn . '<img class="' . $attrClass . '" src="' . self::getImg($alias, $width, $height, $crop) . '" alt="' . $attrAlt . '"></span>';
    }    
    
    static function src($alias, $width, $height, $crop = true) {
        echo self::getImg($alias, $width, $height, $crop);
    }    

    static function thumb($src, $width, $height, $crop) {        
        $path = DROOT . $src;
        $info = pathinfo($path);
        //$extension = $info['extension'];
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

}
