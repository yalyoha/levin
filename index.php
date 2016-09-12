<?php
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();
define('ST_T', $time_start);

$edit = isset($_GET['edit']);
include 'config/config.php';

//echo "<!--";
//print_r($_GET);
//echo "-->";

if ($edit) {

    if (isset($_GET['htmlrow']) && isset($_GET['fragment']) && isset($_GET['recount']) && $_GET['htmlrow'] && $_GET['fragment'] && $_GET['recount']) {

        $restruct = new Restruct;
        $restruct->render($_GET['htmlrow'], $_GET['fragment'], $_GET['recount']);
    }

}

if (!$edit) ob_start("ob_gzhandler");

include 'template/template.php';

if (!$edit) {
    $tidy = new tidy;
    $tidy_config = array(
        'hide-comments' => true,
        'tidy-mark' => false,
        'indent' => true,
        'indent-spaces' => 2,
        'new-blocklevel-tags' => 'menu,article,header,footer,section,nav,main',
        'new-inline-tags' => 'video,audio',
        'doctype' => '<!DOCTYPE html>',
        'vertical-space' => false,
        'output-xml' => true,
        'wrap' => 0,
        'wrap-attributes' => false,
        'break-before-br' => false,
        'char-encoding' => 'utf8',
        'input-encoding' => 'utf8',
        'output-encoding' => 'utf8');

    $html = ob_get_clean();
    $html = str_replace('></i', '>&nbsp;</i', $html);
    $html = str_replace('></span', '>&nbsp;</span', $html);
    $html = str_replace('/>', '>', $html);
    $html = str_replace(' >', '>', $html);
    $tidy->parseString($html, $tidy_config, 'utf8');
    echo str_replace('&nbsp;', '', $tidy);
}

$time_end = microtime_float();
$time = $time_end - ST_T;
$time = number_format($time, 4, ",", "");

echo "\n<!--\n";
echo "Page load time: $time seconds\n";
echo "Memory usage: " . round((memory_get_peak_usage(true) / 1024 / 1024), 4) . " Mb\n";
echo "-->\n";
