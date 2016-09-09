<?php
header('Content-Type: text/html; charset=utf-8');
define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
require DROOT . '/admin/function.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Системы безопасности</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/yeti/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/style.css">
</head>

<body>
<div class="wrapper">
  <header>
    <div class="container">
      <div class="inner">
        <div class="row">
          <div class="col-xs-12 text-right"><i class="fa fa-vk" aria-hidden="true"></i></div>
          <div class="col-xs-12 text-center logo-wr"><img src="/images/svg/logo.svg" class="logo"></div>
          <div class="col-xs-12 text-center logo-caption">Системы безопасности</div>
          <div class="col-xs-12 text-center">
            <ul class="main-menu">
              <li><a href="#"><?php t(1); ?></a></li>
              <li><a href="#"><?php t(2); ?></a></li>
              <li><a href="#"><?php t(3); ?></a></li>
              <li><a href="#"><?php t(4); ?></a></li>
              <li><a href="#"><?php t(5); ?></a></li>
              <li><a href="#"><?php t(6); ?></a></li>
              <li><a href="#"><?php t(7); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="content">
    <div class="container">
      <div class="inner">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-center">
              <?php i(1, 1080, 280); ?>
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="row">
          <div class="col-sm-3 text-center"><?php i(11, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(12, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(13, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(14, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(15, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(16, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(17, 72, 72); ?></div>
          <div class="col-sm-3 text-center"><?php i(18, 72, 72); ?></div>
        </div>
      </div>
    </div>
  </div>
  <div class="push"></div>
</div>
<footer>
  <div class="inner"> </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
<script src="/js/script.js"></script>
</body>
</html>