<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<!-- TITLE OF SITE -->
<title><?php Text::txt('tag-title'); ?></title>
<!-- META DATA -->
<meta name="description" content="<?php Text::txt('tag-meta-description'); ?>">
<meta name="keywords" content="<?php Text::lcase('tag-meta-keywords'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- =========================
  FAV AND TOUCH ICONS  
============================== -->
<link rel="icon" href="/images/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon-152x152-precomposed.png">
<meta name="msapplication-TileImage" content="/images/favicon.png">
<!-- =========================
   STYLESHEETS 
============================== -->
<?php $css = new CssMinifier; echo $css->tagLink();  ?>
<style>
.home.image-bg {
	background: url("<?php Image::src('background-image-1',  2560, 788); ?>") center center no-repeat;
}
.testimonials.image-bg {
	background: url("<?php Image::src('background-image-2',  2560, 595); ?>") top center no-repeat;
}
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&subset=cyrillic">
</head>
<body>
<!-- =========================
     NAVBAR 
============================== -->
<header class="navbar fog-navbar fog-navbar-light navbar-fixed-top navbar-anim" id="main-nav">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation"> <span class="sr-only">&nbsp;</span> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span> <span class="icon-bar">&nbsp;</span> </button>
      <a class="navbar-brand" href="#home"><img src="/images/svg/logo.svg"  alt="company name"></a> </div>
    <!-- MAIN NAVIGATION LINKS -->
    <nav class="collapse navbar-collapse" id="main-navigation">
      <ul class="nav navbar-nav navbar-right fog-navbar-nav">
        <li><a href="#service">
          <?php Text::here('menu-item-1'); ?>
          </a></li>
        <li><a href="#app-description">
          <?php Text::here('menu-item-2'); ?>
          </a></li>
        <li><a href="#pricing-table">
          <?php Text::here('menu-item-3'); ?>
          </a></li>
        <li><a href="#testimonials">
          <?php Text::here('menu-item-4'); ?>
          </a></li>
        <li><a href="#contact">
          <?php Text::here('menu-item-5'); ?>
          </a></li>
      </ul>
    </nav>
  </div>
</header>
<!-- =========================
     SERVICE HOME - 1
============================== -->
<section class="home image-bg service-home-1" id="home">
  <div class="overlay">
    <div class="container">
      <div class="home-content text-center">
        <h1>
          <?php Text::here('main-header-1'); ?>
        </h1>
        <p class="sub-title">
          <?php Text::here('main-caption-1'); ?>
        </p>
        <div class="mt-60">
          <form id="callback" class="form-inline">
            <div class="form-group">
              <label class="sr-only">Телефон</label>
              <input type="phone" class="form-control phone big-numbers" placeholder="Номер телефона">
            </div>
            <button type="submit" class="btn btn-cmd btn-base">Обратный звонок</button>
          </form>
        </div>
        <p class="success-msg"></p>
        <p class="error-msg"></p>
      </div>
    </div>
  </div>
  <!-- end of /.overlay --> 
</section>
<!-- =========================
     SERVICES 
============================== --> 
<!-- =========================
     SERVICES 
============================== -->
<section class="service service-1" id="service">
  <div class="container"> 
    <!-- SECTION HEADING -->
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
        <header class="section-heading text-center">
          <h2 class="title-text">
            <?php Text::here('service-title'); ?>
          </h2>
          <p class="sub-title">
            <?php Text::here('service-sub-title'); ?>
          </p>
        </header>
      </div>
    </div>
    <!-- /END SECTION HEADING -->
    <div id="units1" class="row">
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter left, move 40px, over 1s">
        <div class="service-item text-center">
          <?php Image::here('service-image-1', 251, 251); ?>
          <h4 class="title-text">
            <?php Text::here('service-title-1'); ?>
          </h4>
          <p>
            <?php Text::here('service-text-1'); ?>
          </p>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter bottom, move 40px, over 1s, wait 0.5s">
        <div class="service-item text-center">
          <?php Image::here('service-image-2', 251, 251); ?>
          <h4 class="title-text">
            <?php Text::here('service-title-2'); ?>
          </h4>
          <p>
            <?php Text::here('service-text-2'); ?>
          </p>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter right, move 40px, over 1s">
        <div class="service-item text-center">
          <?php Image::here('service-image-3', 251, 251); ?>
          <h4 class="title-text">
            <?php Text::here('service-title-3'); ?>
          </h4>
          <p>
            <?php Text::here('service-text-3'); ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- =========================
     APP DESCRIPTION - 2
============================== -->
<section class="app-description app-description-2" id="app-description">
  <div class="container">
    <div class="row">
      <div class="col-md-7 pull-right mb-45" data-sr="enter right, move 40px, over 1s">
        <?php Image::here('description-image-1', 610, 461,'img-responsive img-md-right', ''); ?>
      </div>
      <div class="col-md-5 pull-left mb-45" data-sr="enter left, move 40px, over 1s">
        <header class="column-heading"> <i class="icon icon-basic-rss"></i>
          <h2 class="title-text">
            <?php Text::here('description-title-1'); ?>
          </h2>
        </header>
        <!-- /.column-heading -->
        <p>
          <?php Text::here('description-text-1'); ?>
        </p>
      </div>
    </div>
  </div>
</section>
<!-- =========================
     APP FEATURE - 2
============================== -->
<section class="app-feature app-feature-2" id="app-feature">
  <div class="container">
    <div class="row">
      <div class="col-md-7 mb-45" data-sr="enter left, move 40px, over 1s">
        <?php Image::here('description-image-2', 610, 461,'img-responsive img-md-left', ''); ?>
      </div>
      <div class="col-md-5 mb-45" data-sr="enter right, move 40px, over 1s">
        <header class="column-heading"> <i class="icon icon-basic-share"></i>
          <h2 class="title-text">
            <?php Text::here('description-title-2'); ?>
          </h2>
        </header>
        <!-- /.column-heading -->
        <p>
          <?php Text::here('description-text-2'); ?>
        </p>
      </div>
    </div>
  </div>
</section>
<!-- =========================
     PRICING TABLE 
============================== -->
<section class="pricing-table pricing-table-2" id="pricing-table">
  <div class="container"> 
    <!-- SECTION HEADING -->
    <div class="row">
      <div class="col-md-6 col-md-offset-3 ">
        <header class="section-heading text-center">
          <h2 class="title-text">
            <?php Text::here('pricing-title'); ?>
          </h2>
          <p class="sub-title">
            <?php Text::here('pricing-sub-title'); ?>
          </p>
        </header>
      </div>
    </div>
    <!-- /END SECTION HEADING -->
    <div id="units2" class="row">
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter left, move 40px, over 1s">
        <div class="single-table">
          <header>
            <h5 class="heading">
              <?php Text::here('pricing-title-1'); ?>
            </h5>
            <div class="pricing"> <span class="rate">
              <?php Text::here('pricing-price-1'); ?>
              </span> <span class="period"><i class="fa fa-rub" aria-hidden="true"></i></span> </div>
          </header>
        </div>
        <!-- /.single-table --> 
      </div>
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter bottom, move 40px, over 1s, wait 0.5s">
        <div class="single-table">
          <header>
            <h5 class="heading">
              <?php Text::here('pricing-title-2'); ?>
            </h5>
            <div class="pricing"> <span class="rate">
              <?php Text::here('pricing-price-2'); ?>
              </span> <span class="period"><i class="fa fa-rub" aria-hidden="true"></i></span> </div>
          </header>
        </div>
        <!-- /.single-table --> 
      </div>
      <div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 mb-45" data-sr="enter right, move 40px, over 1s">
        <div class="single-table">
          <header>
            <h5 class="heading">
              <?php Text::here('pricing-title-3'); ?>
            </h5>
            <div class="pricing"> <span class="rate">
              <?php Text::here('pricing-price-3'); ?>
              </span> <span class="period"><i class="fa fa-rub" aria-hidden="true"></i></span> </div>
          </header>
        </div>
        <!-- /.single-table --> 
      </div>
    </div>
  </div>
</section>
<!-- =========================
     TESTIMONIALS - 2
============================== -->
<section class="testimonials image-bg testimonials-2" id="testimonials">
  <div class="overlay">
    <div class="container"> 
      <!-- SECTION HEADING -->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <header class="section-heading text-center">
            <h2 class="title-text">
              <?php Text::here('testimonials-title'); ?>
            </h2>
            <p class="sub-title">
              <?php Text::here('testimonials-sub-title'); ?>
            </p>
          </header>
        </div>
      </div>
      <!-- /END SECTION HEADING -->
      <div id="units3" class="row">
        <div class="col-md-6 mb-45" data-sr="scale up 30%, over 1s">
          <blockquote class="testimonial text-center">
            <p>
              <?php Text::here('testimonials-text-1'); ?>
            </p>
            <cite class="author">
            <?php Text::here('testimonials-author-1'); ?>
            </span></cite> </blockquote>
        </div>
        <div class="col-md-6 mb-45" data-sr="scale up 30%, over 1s, wait 0.4s">
          <blockquote class="testimonial text-center">
            <p>
              <?php Text::here('testimonials-text-2'); ?>
            </p>
            <cite class="author">
            <?php Text::here('testimonials-author-2'); ?>
            </span></cite> </blockquote>
        </div>
      </div>
    </div>
  </div>
  <!-- /.overlay --> 
</section>
<!-- =========================
     COMPANIES 
============================== -->
<section class="companies" id="companies">
  <div class="container">
    <h4 class="title-text">
      <?php Text::here('companies-text-1'); ?>
    </h4>
    <p>
      <?php Text::here('companies-text-2'); ?>
    </p>
  </div>
</section>
<!-- =========================
     TRIAL DOWNLOAD 
============================== -->
<section class="trial-download trial-download-1" id="trial-download">
  <div class="overlay">
    <div class="container text-center"> 
      <!-- SECTION HEADING -->
      <header class="section-heading">
        <h2 class="title-text">
          <?php Text::here('action-text-1'); ?>
        </h2>
      </header>
      <!-- /END SECTION HEADING -->
      <p class="info">
        <?php Text::here('action-text-2'); ?>
      </p>
    </div>
  </div>
  <!-- /.overlay --> 
</section>
<!-- =========================
     CONTACT 
============================== -->
<div class="contact" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 mb-45" data-sr="enter right, move 40px, over 1s, wait 0.4s">
        <div class="get-in-touch">
          <h5 class="title-text">
            <?php Text::here('contact-text-1'); ?>
          </h5>
          <address>
          <p>
            <?php Text::here('contact-text-2'); ?>
          </p>
          <p>
            <?php Text::here('contact-text-3'); ?>
          </p>
          <p> <span style="font-size: 140%;"><i class="fa fa-phone" aria-hidden="true"></i>
            <?php Text::here('contact-phone-1'); ?>
            </span> </p>
          </address>
        </div>
        <!-- /.get-in-touch -->
        <div class="get-in-touch"> <a href="#"><i class="fa fa-vk fa-2x" aria-hidden="true"></i></a> </div>
        <!-- /.get-in-touch --> 
      </div>
      <div class="col-sm-6 mb-45" data-sr="enter right, move 40px, over 1s">
        <div class="get-in-touch">
          <h5 class="title-text">
            <?php Text::here('contact-text-4'); ?>
          </h5>
          <form id="contact-form" class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="sr-only">Имя</label>
                  <input type="text" name="contact-name" id="contact-name" class="form-control" placeholder="Имя">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="sr-only">Email</label>
                  <input type="email" name="contact-email" id="contact-email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>
            <!-- end of /.row -->
            <div class="form-group">
              <label class="sr-only">Телефон</label>
              <input type="text" name="contact-phone" id="contact-phone" class="form-control phone" placeholder="Телефон">
            </div>
            <div class="form-group">
              <label class="sr-only">Сообщение</label>
              <textarea name="contact-msg" id="contact-msg" class="form-control" cols="3" rows="4" placeholder="Сообщение"></textarea>
            </div>
            <button type="submit" class="btn btn-base-alt btn-cmd">Отправить</button>
          </form>
          <p class="success-msg">Спасибо, сообщение отправлено, мы с вами скоро свяжемся  :)</p>
          <p class="error-msg">Что-то не так :(</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- =========================
     FOOTER 
============================== -->
<footer class="footer">
  <div class="container">
    <p class="copyright text-center">&copy; <?php echo date("Y"); ?>
      <?php Text::here('copyright-text-1'); ?>
    </p>
    <p class="powered text-center"><small>Создание сайта :: <span class="uc">Frankie Maker</span><i class="fa fa-usd" aria-hidden="true"></i> <span>|</span> Управление сайтом :: Levin CMS</small></p>
  </div>
</footer>
<!-- =========================
     SCRIPTS 
============================== --> 
<script type="text/javascript" src="/js/jquery-1.11.2.min.js" ></script> 
<script type="text/javascript" src="/js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="/js/owl.carousel.min.js" ></script> 
<script type="text/javascript" src="/js/nivo-lightbox.min.js" ></script> 
<script type="text/javascript" src="/js/jquery.fitvids.js" ></script> 
<script type="text/javascript" src="/js/smoothscroll.js" ></script> 
<script type="text/javascript" src="/js/matchMedia.js" ></script> 
<script type="text/javascript" src="/js/jquery.nav.js" ></script> 
<script type="text/javascript" src="/js/jquery.ajaxchimp.min.js" ></script> 
<script type="text/javascript" src="/js/scrollReveal.min.js" ></script> 
<script type="text/javascript" src="/js/jquery.videoBG.js" ></script> 
<script type="text/javascript" src="/js/jquery.maskedinput.min.js" ></script> 
<script type="text/javascript" src="/js/application.js" ></script>
<? if (isset($_GET['edit'])) { ?>
<div id="control"><i class="fa fa-cogs fa-2x" aria-hidden="true"></i> <img src="http://temporary.eto-studio.ru/images/svg/best-logo.svg"><span class="inner"><b><span class="uc">Frankie Maker</span><i class="fa fa-usd" aria-hidden="true"></i></b> :: <b>Levin CMS</b><br>
  Landing Page Editor</span></div>
<div id="exit"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>
<? } ?>
</body>
</html>