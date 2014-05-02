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
    <% if ( data.target!=null ) { %>
      <a href="<%= data.target %>"><img src="<%= data.immagine %>" /></a>
    <% } else { %>
      <img src="<%= data.immagine %>" />
    <% } %>
    <p class="titolo">
      <% if ( data.target!=null ) { %>
        <a href="<%= data.target %>"><%= data.titolo %></a>
      <% } else { %>
        <%= data.titolo %>
      <% } %>
    </p>
    <p class="cnt"><%=data.contenuto%></p>
  </div>
</script>
<!-- archivio template -->
<script type="text/template" id="tpl-archivio">
  <li class="archivio">
    <span class="data"><%=data.data%></span><br>
    <a class="archivio" href="#"><%= data.titolo%></a>
  </div>
</script>
