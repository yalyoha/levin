<?php
class Text {

    static function getTxt($alias) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $result = Db::conn()->query("SELECT text FROM texts WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) return $data['text'];
        else  return self::insertTxt($alias, $crc32, 'text#' . $alias);
    }

    static function setTxt($alias, $data) {
        if (!isset($alias)) return;
        $crc32 = sprintf("%u", crc32($alias));
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("UPDATE texts SET text='$data' WHERE crc32=$crc32") === true) return Db::conn()->affected_rows;
        else  die("Error: " . Db::conn()->error);
    }

    static function insertTxt($alias, $crc32, $data) {
        if (!isset($crc32)) return;
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("INSERT INTO texts (crc32, alias, text) VALUES ('$crc32', '$alias', '$data')") === true) return self::getTxt($alias);
        else  die("Error: " . Db::conn()->error);
    }

    static function mode() {
        return (isset($_GET['edit'])) ? true : false;
    }

    static function here($alias) {
        $crc32 = sprintf("%u", crc32($alias));
        if (!isset($crc32)) return;
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&alias=' . $alias . '">[' . $alias . ']</span>';
        echo self::mode() ? '<span class="admin-wr">' . $adminBtn . self::getTxt($alias) . '</span>' : self::getTxt($alias);
    }

}
