<?php
class Image {
    
    static $alias;
    static $crc32;
    
    // alias
    
    static function alias($alias) {
        if (!$alias) die('Error: empty alias!');
        $alias = str_replace(array('[', ']'), '', $alias);
        self::$alias = $alias;
        self::$crc32 = sprintf("%u", crc32($alias));
    } 
    
    // select   

    static function getImg($width = 400, $height = 300, $crop = true) {
        $crc32 = self::$crc32;
        $result = Db::query("SELECT image FROM images WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return self::thumb($data['image'], $width, $height, $crop);
        else  return self::insertImg('/images/empty.png', $width, $height, $crop);
    }
    
    // update 

    static function setImg($data) {
        $crc32 = self::$crc32;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("UPDATE images SET image='$data' WHERE crc32=$crc32") === true) return true;
        else  die("Error: " . Db::error());
    }
    
    // insert 

    static function insertImg($data, $width, $height, $crop) {
        $alias = self::$alias;
        $crc32 = self::$crc32; 
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("INSERT INTO images (crc32, alias, image) VALUES ('$crc32', '$alias', '$data')") === true) return self::getImg($width, $height, $crop);
        else  die("Error: " . Db::error());
    }
    
    // mode (admin or not)

    static function mode() {        
        $queryAdmin = isset($_GET['access']) ? $_GET['access'] : 1;
        $sessionAdmin = isset($_SESSION['access']) ? $_SESSION['access'] : 2;
        return ($sessionAdmin == $queryAdmin);
    }
    
    // output

    static function here($alias, $width, $height = null, $attrClass = '', $attrAlt = '', $crop = true) {
        self::alias($alias);   
        if (!isset($height)) $height = $width;
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&alias=' . self::$alias . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo self::mode() ? '<span class="admin-wr">' . $adminBtn . '<img class="' . $attrClass . '" src="' . self::getImg($width, $height, $crop) . '" alt="' . $attrAlt . '"></span>' : '<img src="' . self::getImg($width, $height, $crop) . '" alt="">';
    }
    
    // backend output

    static function admin($alias, $width, $height, $attrClass = '', $attrAlt = '', $crop = true) {
        self::alias($alias);   
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=img&alias=' . self::$alias . '&w=' . $width . '&h=' . $height . '&c=' . $crop . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo '<span class="admin-wr">' . $adminBtn . '<img class="' . $attrClass . '" src="' . self::getImg($width, $height, $crop) . '" alt="' . $attrAlt . '"></span>';
    }
    
    // only image source output

    static function src($alias, $width, $height, $crop = true) {
        self::alias($alias);   
        echo self::getImg($width, $height, $crop);
    }
    
    // thumb maker

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
