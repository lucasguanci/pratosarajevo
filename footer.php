  <!-- PS -->
  <section id ="ps">
    <div class="container">
      <div class="row">
        <!-- Spreaker -->
        <div class="col-md-4 ps">
          <h2>
            <a href="http://www.spreaker.com/user/mediaps2014" alt="?Ascolta il canale di Prato-Sarajevo ART INVASION su Spreaker">
              Spreaker
            </a>
          </h2>
          <div class="spreaker">
            <img src="images/logo-spreaker.png" alt="logo Spreaker.com">
            <p class="spreaker-intro">
              <a class="spreaker" href="spreaker.php">
                Radio Prato-Sarajevo ART INVASION
              </a><br>
              La diretta, i podcast, il programma completo delle trasmissioni.
              <br>
            </p>
            <ul class="podcast-list"></ul>
            <div class="live"></div>
            <div id="sp-root"></div>  
          </div>
<!--           <a href="http://www.spreaker.com/user/mediaps2014" alt="Ascolta il canale di Prato-Sarajevo ART INVASION su Spreaker">
            <img src="images/spreaker-ps.png">
          </a>
 -->        
        </div>
        <!-- Sarajevolution -->
        <div class="col-md-4 ps">
          <h2>Sarajevolution</h2>
          <iframe src="//player.vimeo.com/video/84881907?title=0&amp;byline=0&amp;portrait=0&amp;color=d95b44" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <!-- Mapbox -->
        <div class="col-md-4 ps">
          <h2>
            <a href="https://a.tiles.mapbox.com/v3/brontoluke.hnlbg8n2/page.html?secure=1#14/43.8765/11.0974" target="blank" title="Sedi del progetto">
              Sedi del progetto
            </a>
          </h2>
          <div class="map-wrapper">
<!--             <iframe width='100%' height='169px' frameBorder='0' src='http://a.tiles.mapbox.com/v3/brontoluke.hnlbg8n2/attribution,zoompan,zoomwheel,geocoder,share.html'></iframe>
 -->
            <div id="map"></div>
            <p class="map-link">
              <a href="https://a.tiles.mapbox.com/v3/brontoluke.hnlbg8n2/page.html?secure=1#14/43.8765/11.0974" target="blank" title="Sedi del progetto">
                apri la mappa
              </a>
            </p>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /PS -->
  <!-- footer -->
  <footer id="footer">
    <div class="container wrapper">
      <div class="row footer-nav">
        <div class="col-md-12 footer">
          <strong>Prato-Sarajevo ART INVASION</strong><br>
          Progetto di residenza per giovani artisti residenti in Toscana e Bosnia - Prato / aprile - giugno 2014<br>
          <a class="link" href="mailto:info@prato-sarajevo.net">info@prato-sarajevo.net</a>
        </div>
      </div>
      <div class="row hr">
        <div class="col-md-4 footer contatti">
          <p>
            <strong>Ufficio stampa</strong><br>
            Ivan Aiazzi<br>
            tel. 0574-531828<br>
            <a class="link" href="mailto:i.aiazzi@centropecci.it">i.aiazzi@centropecci.it</a>
          </p>
        </div>
        <div class="col-md-4 footer contatti">
          <p>   
            <br>       
            Serena Becagli<br>
            tel. 339-8754106<br>
            <a class="link" href="mailto:press@prato-sarajevo.net">press@prato-sarajevo.net</a>
          </p>
        </div>
        <div class="col-md-4 footer contatti">
          <p>   
            <br>                   
            Caterina Fanfani<br>
            tel. 0574-53573<br>
            <a class="link" href="mailto:ufficiostampa@provincia.prato.it">ufficiostampa@provincia.prato.it</a>
          </p>
        </div>
      </div>
      <div class="row hr">
        <div class="col-md-4 footer colophon">
          <p>
            Nell'ambito di<br>
            <strong>TOSCANAINCONTEMPORANEA 2013</strong> 
          </p>
          <p>
            Ente Promotore<br>
            <strong>REGIONE TOSCANA</strong><br>
            <strong>PROVINCIA DI PRATO</strong>
          </p>
        </div>
        <div class="col-md-4 footer colophon">
          <p>
            Realizzazione e cura<br>
            <strong>CENTRO PER L'ARTE CONTEMPORANEA LUIGI PECCI</strong>
          </p>
          <p>
            con<br>
            <strong>DRYPHOTO ARTE CONTEMPORANEA</a></strong>
            <strong>KINKALERI</strong>
          </p>
        </div>
        <div class="col-md-4 footer colophon">
          <p>
            In collaborazione con<br>
            <strong>COMUNE DI PRATO</strong><br>
            <strong>COMUNE DI CARMIGNANO</strong><br>
            <strong>SPAZIO D'ARTE ALBERTO MORETTI</strong>
          </p>
          <p>
            In collegamento con<br>
            <strong>ARS AEVI - MUSEO D'ARTE CONTEMPORANEA, SARAJEVO</strong>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- /footer -->

  <!-- templates -->
  <?php include_once 'inc/templates.php' ?>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/lib/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/lib/bootstrap.min.js"></script>
  <!-- Less -->
  <script src="js/lib/less-1.7.0.js"></script>
  <!-- Mapbox -->
  <script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js'></script>
  <!-- Templating engines -->
  <script src="js/lib/handlebars.js"></script>
  <script src="js/lib/underscore.js"></script>
  <!-- PS -->
  <script src="js/lib/moment.js"></script>
  <script src="js/lib/lang/it.js"></script>
  <script type="text/javascript" src="http://static.spreaker.net/js/sdk_client.js"></script>
  <script src="js/client.js"></script>
</body>
</html>