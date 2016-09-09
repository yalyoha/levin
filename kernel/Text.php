<?php

class Text {

    static function getTxt($id = null) {
        if (!isset($id))
            return;
        $id = intval($id);
        $result = Db::conn()->query("SELECT text FROM texts WHERE id=$id LIMIT 1");
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0)
            return $data['text'];
        else
            return self::insertTxt($id, 'text#' . $id);
    }

    static function setTxt($id = null, $data) {
        if (!isset($id))
            return;
        $id = intval($id);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("UPDATE texts SET text='$data' WHERE id=$id") === true)
            return Db::conn()->affected_rows;
        else
            die("Error: " . Db::conn()->error);
    }

    static function insertTxt($id = null, $data) {
        if (!isset($id))
            return;
        $id = intval($id);
        $data = strip_tags($data);
        $data = Db::conn()->escape_string($data);
        if (Db::conn()->query("INSERT INTO texts (id, text) VALUES ('$id', '$data')") === true)
            return getTxt($id);
        else
            die("Error: " . Db::conn()->error);
    }

    static function t($id = null) {
        global $admin;
        if (!isset($id))
            return;
        $id = intval($id);
        $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&id=' . $id . '">[' . $id . ']</span>';
        echo $admin ? '<span class="admin-wr">' . $adminBtn . self::getTxt($id) . '</span>' : self::getTxt($id);
    }

}
