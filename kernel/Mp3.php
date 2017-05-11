<?php
class Mp3 {

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

    static function getMp3() {
        $crc32 = self::$crc32;
        $result = Db::query("SELECT mp3 FROM mp3s WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return $data['mp3'];
        else  return self::insertMp3('/songs/track.mp3');
    }

    // update

    static function setMp3($data) {
        $crc32 = self::$crc32;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("UPDATE mp3s SET mp3='$data' WHERE crc32=$crc32") === true) return true;
        else  die("Error: " . Db::error());
    }

    // insert

    static function insertMp3($data) {
        $alias = self::$alias;
        $crc32 = self::$crc32;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("INSERT INTO mp3s (crc32, alias, mp3) VALUES ('$crc32', '$alias', '$data')") === true) return self::getMp3();
        else  die("Error: " . Db::error());
    }

    // mode (admin or not)

    static function mode() {
        $queryAdmin = isset($_GET['access']) ? $_GET['access'] : 2;
        $sessionAdmin = isset($_SESSION['access']) ? $_SESSION['access'] : 3;
        return ($sessionAdmin == $queryAdmin);
    }

    // output
    // backend output

    static function admin($alias) {
        self::alias($alias);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=mp3&alias=' . self::$alias . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo '<span class="admin-wr">' . $adminBtn . self::getMp3() . '</span>';
    }

    // only mp3 source output

    static function audio($alias) {
        self::alias($alias);
        echo self::getMp3();
    }

}
