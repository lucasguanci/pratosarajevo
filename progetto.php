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
          <ul id="menu-progetto">
            <li>
              <a class="sidebar progetto activeLink" data-target="concept">
                Concept
              </a>
            </li>
            <li>
              <a class="sidebar progetto" data-target="partners">
                Partners
              </a>
            </li>
          </ul>
        </div>
        <!-- /sidebar -->
        <!-- content secondary pages -->
        <div class="col-md-9 secondary">
          <div id="progetto-wrapper">
            <div id="concept" class="progetto active">
              <div id="to-top">
                <a class="to-top"><i class="fa fa-arrow-circle-up fa-2x"></i></a>
              </div>
              <?php include_once './content-concept.php' ?>
            </div>
            <div id="partners" class="progetto">
              <p class="partners">
                Nell'ambito di<br>
                <strong>TOSCANAINCONTEMPORANEA 2013</strong> 
              </p>
              <p>
                Ente Promotore<br>
                <strong>REGIONE TOSCANA</strong><br>
                <strong>PROVINCIA DI PRATO</strong>
              </p>
              <p>
                Realizzazione e cura<br>
                <a class="partners" target="_blank" href="http://www.centropecci.it/">CENTRO PER L'ARTE CONTEMPORANEA LUIGI PECCI, PRATO</a>
              </p>
              <p>
                con<br>
                <a class="partners" target="_blank" href="http://www.dryphoto.it/">DRYPHOTO ARTE CONTEMPORANEA</a><br>
                <a class="partners" target="_blank" href="http://www.kinkaleri.it/">KINKALERI</a>
              </p>
              <p>
                In collaborazione con<br>
                <strong>COMUNE DI PRATO</strong><br>
                <strong>COMUNE DI CARMIGNANO</strong><br>
                <strong>SPAZIO D'ARTE ALBERTO MORETTI, CARMIGNANO (PO)</strong>
              </p>
              <p>
                In collegamento con<br>
                <strong>ARS AEVI - MUSEO D'ARTE CONTEMPORANEA, SARAJEVO</strong>
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
