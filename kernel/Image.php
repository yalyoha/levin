<?php

class Image {

    static function getImg($crc32 = null, $width = null, $height = null, $crop = null) {
        if (!isset($crc32))
            return;
        if (!isset($width))
            $width = 400;
        if (!isset($height))
            $height = 300;
        if (!isset($crop))
            $crop = true;
        $crc32 = intval($crc32);
        $result = Db::conn()->query("SELECT image FROM images WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0)
            return self::thumb($data['image'], $width, $height, $crop);
        else
            return self::thumb(self::insertImg($crc32, '/images/noimage.png', $width, $height, $crop), $width, $height, $crop);
    }

    static function setImg($crc32 = null, $data) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("UPDATE images SET image='$data' WHERE crc32=$crc32") === true)
            return Db::conn()->affected_rows;
        else
            die("Error: " . Db::conn()->error);
    }

    static function insertImg($crc32 = null, $data, $width, $height, $crop) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("INSERT INTO images (id, image) VALUES ('$crc32', '$data')") === true)
            return self::getImg($crc32, $width, $height, $crop);
        else
            die("Error: " . Db::conn()->error);
    }

    static function i($crc32 = null, $width = null, $height = null, $crop = true) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&crc32=' . $crc32 . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '">[' . $crc32 . ']</span>';
        echo $admin ? '<span class="admin-wr">' . $adminBtn . '<img src="' . self::getImg($crc32, $width, $height, $crop) . '"></span>' : '<img src="' . self::getImg($crc32, $width, $height, $crop) . '">';
    }

    static function thumb($src, $width, $height, $crop) {
        if (!$height)
            $height = $width;
        $path = DROOT . $src;
        $info = pathinfo($path);
        $extension = $info['extension'];
        $dirname = $info['dirname'];
        $basename = $info['basename'];
        $newDir = $dirname . '/' . $width . 'x' . $height;
        if (!is_dir($newDir))
            mkdir($newDir);
        $newPath = $dirname . '/' . $width . 'x' . $height . '/' . $basename;
        $newSrc = str_replace(DROOT, '', $newPath);
        if (file_exists($newPath) && filemtime($path) == filemtime($newPath))
            return $newSrc;
        $img = new SimpleImage($path);
        if ($crop)
            $img->thumbnail($width, $height)->save($newPath);
        else
            $img->best_fit($width, $height)->save($newPath);
        touch($path);
        return $newSrc;
    }

}
