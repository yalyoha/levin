<?php
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();
define('ST_T', $time_start);

include 'config/config.php';

$htmlId = isset($_GET['htmlId']) ? $_GET['htmlId'] : false;
$recount = isset($_GET['recount']) ? $_GET['recount'] : false;

//check access
$queryAdmin = isset($_GET['access']) ? $_GET['access'] : 1;
$sessionAdmin = isset($_SESSION['access']) ? $_SESSION['access'] : 2;
$access = ($sessionAdmin == $queryAdmin);

if ($access) {
    if ($htmlId && $recount) {
        $restruct = new Restruct;
        $restruct->render($htmlId, $recount);
    }
}

if (!$access) ob_start("ob_gzhandler");

$css = new CssMinifier;
$stylesheet = $css->tagLink();

$levinJS = '';
$adminBtns = '';
if ($access) {
    $levinJS = '<script type="text/javascript" src="/admin/js/levin.js" ></script>';
    $adminBtns = '<div id="control"><i class="fa fa-cogs fa-2x" aria-hidden="true"></i> <img src="http://temporary.eto-studio.ru/images/svg/best-logo.svg"><span class="inner"><b><span class="uc">Frankie Makers</span></b> :: <b>Levin CMS</b><br>
                  Landing Page Editor</span></div>
                <div id="exit"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>';
}

include 'template/template.php';

if (!$access) {
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
