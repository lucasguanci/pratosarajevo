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
                Contatti
              </a>
            </li>
          </ul>
        </div>
        <!-- /sidebar -->
        <!-- content secondary pages -->
        <div class="col-md-9 secondary">
          <div id="contatti-wrapper">
            <div id="info" class="contatti">
              <p class="contatti">
                <strong>Informazioni</strong><br>
                <a href="mailto:info@prato-sarajevo.net">info@prato-sarajevo.net</a>
              </p>
              <p class="contatti">
                <strong>Ufficio stampa</strong><br>
                Ivan Aiazzi<br>
                tel. 0574-531828<br>
                <a href="mailto:i.aiazzi@centropecci.it">i.aiazzi@centropecci.it</a><br><br>
                
                Serena Becagli<br>
                tel. 339-8754106<br>
                <a href="mailto:press@prato-sarajevo.net">press@prato-sarajevo.net</a><br><br>
                
                Caterina Fanfani<br>
                tel. 0574-53573<br>
                <a href="mailto:ufficiostampa@provincia.prato.it">ufficiostampa@provincia.prato.it</a>
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
