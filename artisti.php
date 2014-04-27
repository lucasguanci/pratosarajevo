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
          <ul id="menu-artisti">
            <li><a class="sidebar artisti activeLink" data-target="banchelli" href="#">Francesca Banchelli</a></li>
            <li><a class="sidebar artisti" data-target="cmajcanin" href="#">Lana Cmajčanin</a></li>
            <li><a class="sidebar artisti" href="#" data-target="cunsolo">Gaetano Cunsolo</a></li>
            <li><a class="sidebar artisti" href="#" data-target="grosbois">Emma Grosbois</a></li>
            <li><a class="sidebar artisti" href="#" data-target="lako">Lori Lako</a></li>
            <li><a class="sidebar artisti" href="#" data-target="lapolla">Valentina Lapolla</a></li>
            <li><a class="sidebar artisti" href="#" data-target="laser-delpiero">Giacomo Laser e Giulia del Piero</a></li>
            <li><a class="sidebar artisti" href="#" data-target="pavlenko">Olga Pavlenko</a></li>
            <li><a class="sidebar artisti" href="#" data-target="stojcic">Bojan Stojčić</a></li>
            <li><a class="sidebar artisti" href="#" data-target="zanetti">Virginia Zanetti</a></li>
          </ul>
        </div>
        <!-- /sidebar -->
        <!-- content secondary pages -->
        <div class="col-md-9 secondary">
          <div id="artisti-wrapper"></div>
        </div>
        <!-- /content secondary pages -->
        <div class="clearfix visible-sm visible-xs"></div>
      </div>
    </div>
  </section>
  <!-- /content -->    
  <?php include 'footer.php'; ?>
