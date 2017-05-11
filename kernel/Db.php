<?php
class Db {

    static $conn = null;

    static function conn() {
        if (isset(self::$conn)) return self::$conn;
        self::$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PASS, SQL_BASE);
        self::$conn->set_charset("utf8");
        if (self::$conn->connect_error) die("Connection failed: " . self::$conn->connect_error);
    }

    static function query($query) {
        //echo "\n<!--" . $query . "-->\n";
        if (!isset($query)) return;
        if (!isset(self::$conn)) self::conn();
        return self::$conn->query($query);
    }

    static function escape($data) {
        if (!isset($data)) return;
        if (!isset(self::$conn)) self::conn();
        return self::$conn->escape_string($data);
    }

    static function error() {
        return self::$conn->error;
    }

}
