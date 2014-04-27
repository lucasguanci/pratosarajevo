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
              <a class="sidebar progetto" data-target="staff">
                Staff
              </a>
            </li>
            <li>
              <a class="sidebar progetto" data-target="sedi">
                Sedi
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
              <?php include_once 'content-concept.php' ?>
            </div>
            <div id="staff" class="progetto">
              <p class="staff">
                <strong>Centro per l'arte contemporanea Luigi Pecci</strong><br>
                <a target="_blank" href="http://www.centropecci.it/">sito web</a>
              </p>
              <p class="staff">
                <strong>Dryphoto arte contemporanea</strong><br>
                <a target="_blank" href="http://www.dryphoto.it/">sito web</a>
              </p>
              <p class="staff">
                <strong>Kinkaleri</strong><br>
                <a target="_blank" href="http://www.kinkaleri.it/">sito web</a>
              </p>              
            </div>
            <div id="sedi" class="progetto">
              <p class="sedi">
                <strong>Centro per l'arte contemporanea Luigi Pecci</strong><br>
                viale della Repubblica, 277<br>
                tel. 0574-5317
              </p>
              <p class="sedi">
                <strong>Dryphoto arte contemporanea</strong><br>
                via delle Segherie 33/a<br>
                tel. 0574-603186<br>
                <a href="mailto:info@dryphoto.it">info@dryphoto.it</a>
              </p>
              <p class="sedi">
                <strong>Spazio K - Kinkaleri</strong><br>
                via S. Chiara 38/2<br>
                tel. 0574-448212<br>
                <a href="mailto:info@kinkaleri.it">info@kinkaleri.it</a>
              </p>
              <p class="sedi">
                <strong>Schema Polis | Spazio d'arte Alberto Moretti</strong><br>
                via Borgo, 4 Carmignano (PO)<br>
                tel. 055-8750231<br>
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
