<?php

class Text {

    static function getTxt($crc32 = null) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $result = Db::conn()->query("SELECT text FROM texts WHERE crc32=$crc32 LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0)
            return $data['text'];
        else
            return self::insertTxt($crc32, 'text#' . $crc32);
    }

    static function setTxt($crc32 = null, $data) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("UPDATE texts SET text='$data' WHERE crc32=$crc32") === true)
            return Db::conn()->affected_rows;
        else
            die("Error: " . Db::conn()->error);
    }

    static function insertTxt($crc32 = null, $data) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("INSERT INTO texts (crc32, text) VALUES ('$crc32', '$data')") === true)
            return getTxt($crc32);
        else
            die("Error: " . Db::conn()->error);
    }

    static function t($crc32 = null) {
        if (!isset($crc32))
            return;
        $crc32 = intval($crc32);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&crc32=' . $crc32 . '">[' . $crc32 . ']</span>';
        echo $admin ? '<span class="admin-wr">' . $adminBtn . self::getTxt($crc32) . '</span>' : self::getTxt($crc32);
    }

}
