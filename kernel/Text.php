<?php
class Text {

    static function getTxt($alias) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $result = Db::query("SELECT text FROM texts WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return $data['text'];
        else  return self::insertTxt($alias, $crc32, 'text#' . $alias);
    }

    static function setTxt($alias, $data) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("UPDATE texts SET text='$data' WHERE crc32=$crc32") === true) return Db::conn()->affected_rows;
        else  die("Error: " . Db::error());
    }

    static function insertTxt($alias, $crc32, $data) {
        if (!isset($crc32)) return;
        $data = strip_tags($data);
        $data = Db::escape($data);
        if (Db::query("INSERT INTO texts (crc32, alias, text) VALUES ('$crc32', '$alias', '$data')") === true) return self::getTxt($alias);
        else  die("Error: " . Db::error());
    }

    static function mode() {
        return (isset($_GET['edit'])) ? true : false;
    }

    static function here($alias) {
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&alias=' . $alias . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo self::mode() ? '<span class="admin-wr">' . $adminBtn . self::getTxt($alias) . '</span>' : self::getTxt($alias);
    }

    static function admin($alias) {
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&alias=' . $alias . '"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></span>';
        echo '<span class="admin-wr">' . $adminBtn . self::getTxt($alias) . '</span>';
    }

    static function txt($alias) {
        echo self::getTxt($alias);
    }

    static function lcase($alias) {
        echo mb_strtolower(self::getTxt($alias));
    }
    
    static function ucase($alias) {
        echo mb_strtoupper(self::getTxt($alias));
    }    

}
