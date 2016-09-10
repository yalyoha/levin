<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
date_default_timezone_set("Europe/Moscow");
setlocale(LC_ALL, "ru_RU.utf8");
header('Content-Type: text/html; charset=utf-8');

define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
define('SQL_HOST', 'mysql69.1gb.ru');
define('SQL_USER', 'gb_koronabaza');
define('SQL_BASE', 'gb_koronabaza');
define('SQL_PASS', 'a17549abaqwr');

function __autoload($class) {
    if (file_exists(DROOT . '/kernel/' . $class . '.php')) include DROOT . '/kernel/' . $class . '.php';
    if (file_exists(DROOT . '/helper/' . $class . '.php')) include DROOT . '/helper/' . $class . '.php';
}
