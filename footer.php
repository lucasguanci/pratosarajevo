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
          <strong>Prato-Sarajevo art invasion</strong><br>
          <a href="mailto:info@prato-sarajevo.net">info@prato-sarajevo.net</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- /footer -->

  <!-- templates -->
  <script id="template-artisti--old" type="text/x-handlebars-template">
    <div id="{{username}}" class="artista active">
      <h2>{{nome}} {{cognome}}</h2>
      <div id="carousel-{{username}}" class="carousel slide artisti" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          {{#foreach immagini}}
            <div class="item {{#if $first}}active{{/if}}">
              <img src="{{url}}">
              <div class="carousel-caption">
                {{{didascalia}}}
              </div>
            </div>              
          {{/foreach}}
        </div>
      </div>
      <p>
        {{{bio}}}
      </p>
    </div>
  </script>

  <script type="text/template" id="template-artisti-nested">
    <div class="item <% if (i==0) { %> active <% } %>">
      <img src="<%= immagine %>">
      <div class="carousel-caption">
        <%= didascalia %>
      </div>
    </div>                          
  </script>
  
  <script id="template-artisti" type="text/template">
    <div id="<%= data.username %>" class="artista active">
      <h2><%= data.nome %></h2>
      <div id="carousel-<%=data.username%>" class="carousel slide artisti" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <% for ( i=0; i<3; i++ ) { %>
            <%= nested({i: i, immagine: data.immagini[i], didascalia: data.didascalie[i]}) %>
          <% } %>
        </div>
      </div>
      <p>
        <%= data.bio %>
      </p>
    </div>
  </script>

  <script type="text/template" id="tpl-news-home">
    <div id="<%= data.id %>" class="col-md-3 news">
      <h2><%= data.titolo%></h2>
      <img src="<%= data.immagine %>" />
      <p class="titolo"><%=data.titolo%></p>
      <p class="cnt"><%=data.contenuto%></p>
    </div>
  </script>

  <!-- /templates -->


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/lib/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/lib/bootstrap.min.js"></script>
  <!-- Less -->
  <script src="js/lib/less-1.7.0.js"></script>
  <!-- Mapbox -->
  <script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.2/mapbox.js'></script>
  <!-- Handlebars -->
  <script src="js/lib/handlebars.js"></script>
  <script src="js/lib/underscore.js"></script>
  <!-- PS -->
  <script type="text/javascript" src="http://static.spreaker.net/js/sdk_client.js"></script>
  <script src="js/client.js"></script>
</body>
</html>