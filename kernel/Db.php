<?php

require 'mysqlcong.php';

class Db {

    static $conn = null;

    static function conn() {
        if (isset(self::$conn))
            return self::$conn;
            
        self::$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PASS, SQL_BASE);

        if (self::$conn->connect_error)
            die("Connection failed: " . self::$conn->connect_error);

        return self::$conn;
    }

}
