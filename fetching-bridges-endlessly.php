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
          <ul class="banchelli">
            <li>
              <a class="sidebar fbe activeLink" data-target="fbe1">
                Fetching Bridges (endlessly)
              </a>
            </li>
          </ul>
        </div>
        <!-- /sidebar -->
        <!-- content secondary pages -->
        <div class="col-md-9 secondary">
          <div id="spreaker-wrapper">
            <div id="fbe1" class="spreaker">                
              <h2>Fetching Bridges (endlessly) #1</h2>
              <p class="spreaker">
                <strong>Francesca Banchelli</strong>, <em>Fetching Bridges (endlessly) #1</em>, azione tra via Pistoiese e Piazza San Marco
              </p>
              <iframe width="480" height="425" src="http://www.ustream.tv/embed/18185686?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>
              <br /><a href="http://www.ustream.tv" style="font-size: 12px; line-height: 20px; font-weight: normal; text-align: left;" target="_blank">Broadcast live streaming video on Ustream</a>
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
