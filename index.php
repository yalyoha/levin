<?php
include 'config/config.php';

$cache = new Cache('LandingPage');

$cache->getCache();

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

$cache->setCache();
