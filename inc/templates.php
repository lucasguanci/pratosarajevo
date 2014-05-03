<!-- artists template -->
<script type="text/template" id="template-artisti-nested">
  <div class="item <% if (i==1) { %> active <% } %>">
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
        <% for ( i=1; i<4; i++ ) { %>
          <% var immagine = "immagine_"+i; var didascalia = "didascalia_"+i; %>
          <%= nested({i: i, immagine: data[immagine], didascalia: data[didascalia]}) %>
        <% } %>
      </div>
    </div>
    <p>
      <%= data.bio %>
    </p>
  </div>
</script>
<!-- news template -->
<script type="text/template" id="tpl-news-home">
  <div id="<%= data.id %>" class="col-md-3 news">
    <h2><%= data.categoria %></h2>
    <% if ( data.target!="" ) { %>
      <a href="<%= data.target %>"><img src="<%= data.immagine %>" /></a>
    <% } else { %>
      <img src="<%= data.immagine %>" />
    <% } %>
    <p class="titolo">
      <% if ( data.target!="" ) { %>
        <a href="<%= data.target %>"><%= data.titolo %></a>
      <% } else { %>
        <%= data.titolo %>
      <% } %>
    </p>
    <p class="cnt"><%=data.contenuto%></p>
  </div>
</script>
<!-- archivio template -->
<script type="text/template" id="tpl-news-categories"></script>
<script type="text/template" id="tpl-news-index">
  <% _.each(news, function(item) { %>
    <li>
      <p class="data_pubblicazione"><%= item.data_pubblicazione %></p>
      <a class="sidebar news-index" data-target="<%=item.id%>">
        <%= item.titolo %>
      </a>
    </li>
  <% }) %>
</script>
<script type="text/template" id="tpl-news-dettaglio">
  <div id="<%= model.id %>" class="news-dettaglio">
    <p class="data_pubblicazione"><%= model.data_pubblicazione %></p>
    <h2><%= model.titolo %></h2>        
    <img src="<%=model.immagine%>">
    <p class="content">
      <% if ( typeof(model.contenuto_esteso)!=="undefined" ) { %>
        <%= model.contenuto_esteso %>
      <% } else { %> 
        <%= model.contenuto %>
      <% } %>
    </p>
    <p class="categoria">categoria: <%= model.categoria %></p>
  </div>
</script>
