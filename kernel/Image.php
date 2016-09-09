<?php

class Image {

    static function getImg($id = null, $width = null, $height = null, $crop = null) {
        if (!isset($id))
            return;
        if (!isset($width))
            $width = 400;
        if (!isset($height))
            $height = 300;
        if (!isset($crop))
            $crop = true;
        $id = intval($id);
        $result = Db::conn()->query("SELECT image FROM images WHERE id=$id LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0)
            return self::thumb($data['image'], $width, $height, $crop);
        else
            return self::thumb(self::insertImg($id, '/images/noimage.png', $width, $height, $crop), $width, $height, $crop);
    }

    static function setImg($id = null, $data) {
        if (!isset($id))
            return;
        $id = intval($id);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("UPDATE images SET image='$data' WHERE id=$id") === true)
            return Db::conn()->affected_rows;
        else
            die("Error: " . Db::conn()->error);
    }

    static function insertImg($id = null, $data, $width, $height, $crop) {
        if (!isset($id))
            return;
        $id = intval($id);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("INSERT INTO images (id, image) VALUES ('$id', '$data')") === true)
            return self::getImg($id, $width, $height, $crop);
        else
            die("Error: " . Db::conn()->error);
    }

    static function i($id = null, $width = null, $height = null, $crop = true) {
        global $admin;
        if (!isset($id))
            return;
        $id = intval($id);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&id=' . $id . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '">[' . $id . ']</span>';
        echo $admin ? '<span class="admin-wr">' . $adminBtn . '<img src="' . self::getImg($id, $width, $height, $crop) . '"></span>' : '<img src="' . self::getImg($id, $width, $height, $crop) . '">';
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
