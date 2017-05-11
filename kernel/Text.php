<?php
class Text {

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

    static function getTxt() {
        $crc32 = self::$crc32;
        $result = Db::query("SELECT text FROM texts WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return str_replace("\n", '<br>', $data['text']);
        else  return self::insertTxt('text#' . self::$alias);
    }

    // update

    static function setTxt($data) {
        $crc32 = self::$crc32;
        //$data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("UPDATE texts SET text='$data' WHERE crc32=$crc32") === true) return true;
        else  die("Error: " . Db::error());
    }

    // insert

    static function insertTxt($data) {
        $alias = self::$alias;
        $crc32 = self::$crc32;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("INSERT INTO texts (crc32, alias, text) VALUES ('$crc32', '$alias', '$data')") === true) return self::getTxt();
        else  die("Error: " . Db::error());
    }

    // mode (admin or not)

    static function mode() {
        $queryAdmin = isset($_GET['access']) ? $_GET['access'] : 2;
        $sessionAdmin = isset($_SESSION['access']) ? $_SESSION['access'] : 3;
        return ($sessionAdmin == $queryAdmin);
    }

    // output

    static function here($alias) {
        self::alias($alias);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&alias=' . self::$alias . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo self::mode() ? '<span class="admin-wr">' . $adminBtn . self::getTxt() . '</span>' : self::getTxt();
    }

    // backend output

    static function admin($alias) {
        self::alias($alias);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&alias=' . self::$alias . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo '<span class="admin-wr">' . $adminBtn . self::getTxt() . '</span>';
    }

    // only text output

    static function txt($alias) {
        self::alias($alias);
        echo self::getTxt();
    }

    static function lcase($alias) {
        self::alias($alias);
        echo mb_strtolower(self::getTxt());
    }

    static function ucase($alias) {
        self::alias($alias);
        echo mb_strtoupper(self::getTxt());
    }
}
