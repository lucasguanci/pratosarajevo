<!DOCTYPE html>
<html>
  <head>
    <title>Prato-Sarajevo art invasion</title>
    <!-- properly render unicode characters in IE -->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=7" /> -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- common head elements -->
    <?php include_once 'inc/head-common.php' ?>
    <link rel="stylesheet/less" type="text/css" href="css/styles-secondary.less" />
    <?php include_once 'inc/ie-fix.php' ?>
  </head>
<body>
  <?php include_once("analyticstracking.php") ?>
  <!-- main-nav -->
    <?php include_once 'inc/main-nav.php' ?>
  </header>
  <!-- /header -->
  <!-- content -->
  <section id="content">
    <div class="container">
      <div class="row content">
        <!-- sidebar -->
        <div class="col-md-3 sidebar">
          <ul id="menu-spreaker">
            <li>
              <a class="sidebar spreaker activeLink" data-target="radio">
                Radio Prato-Sarajevo
              </a>
            </li>
            <li>
              <a class="sidebar spreaker " data-target="radio-programma">
                Programma radiofonico
              </a>
            </li>
          </ul>
        </div>
        <!-- /sidebar -->
        <!-- content secondary pages -->
        <div class="col-md-9 secondary">
          <div id="spreaker-wrapper">
            <div id="radio" class="spreaker">                
              <h2>Prato-Sarajevo su Spreaker</h2>
              <p class="spreaker">
                Ogni giovedì alle 14.00 un'intervista con un artista.<br>
              </p>
              <p class="spreaker website">
                <a href="http://www.spreaker.com/show/prato-sarajevo-art-invasions-tracks" traget="_blank">visita il canale di Prato-Sarajevo su spreaker.com</a>
              </p>
              <p class="spreaker">
                <h4>Intervista a Valentina Lapolla</h4>
                <iframe src="//www.spreaker.com/embed/player/standard?autoplay=false&episode_id=4409415" style="width: 100%; height: 131px; min-width: 400px;" frameborder="0" scrolling="no"></iframe>
              </p>              
              <p class="spreaker">
                <h4>Intervista a Giacomo Laser e Giulia del Piero</h4>
                <iframe src="//www.spreaker.com/embed/player/standard?autoplay=false&episode_id=4379980" style="width: 100%; height: 131px; min-width: 400px;" frameborder="0" scrolling="no"></iframe>
              </p>
              <p class="spreaker">
                <h4>Intervista a Gaetano Cunsolo</h4>
                <iframe src="//www.spreaker.com/embed/player/standard?autoplay=false&episode_id=4349641" style="width: 100%; height: 131px; min-width: 400px;" frameborder="0" scrolling="no"></iframe>
              </p>
              <p class="spreaker">
                <h4>Presentazione del progetto</h4>
                <iframe src="//www.spreaker.com/embed/player/standard?autoplay=false&episode_id=4317997" style="width: 100%; height: 131px; min-width: 400px;" frameborder="0" scrolling="no"></iframe>
              </p>


            </div>
          </div>
        </div>
        <!-- /content secondary pages -->
        <div class="clearfix visible-sm visible-xs"></div>
      </div>
    </div>
  </section>
  <!-- /content -->    
  <?php include 'footer.php'; ?>
