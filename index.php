<?php

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();
define('ST_T', $time_start);

include 'config/config.php';
include 'template/template.php';

$time_end = microtime_float();
$time = $time_end - ST_T;
$time = number_format($time, 4, ".", "");

echo "\n<!--\n";
echo "Page load time: $time seconds\n";
echo "Memory usage: " . round((memory_get_peak_usage(true) / 1024 / 1024), 2) . " Mb\n";
echo "-->\n";
