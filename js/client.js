Handlebars.registerHelper("foreach",function(arr,options) {
    if(options.inverse && !arr.length)
        return options.inverse(this);

    return arr.map(function(item,index) {
        item.$index = index;
        item.$first = index === 0;
        item.$last  = index === arr.length-1;
        return options.fn(item);
    }).join('');
});
Handlebars.registerHelper('times', function(n, block) {
    var accum = '';
    for(var i = 0; i < n; ++i)
        accum += block.fn(i);
    return accum;
});

$(document).ready(function(){
  var map = L.mapbox.map('map', 'brontoluke.hnlbg8n2')
    .setView([43.879, 11.096], 14);

  // init artisti section
  if ( $("#artisti-wrapper").val()=="" ) {
    // display first artist
    getArtist("banchelli");
  }

  $('a.artisti').on('click',function(e){
    e.preventDefault();
    source = $('div.artista.active').attr('id');
    target = $(e.target).attr('data-target');
    if ( source !== target ) {
      $('div.artista.active').removeClass('active').hide();
      // load artist
      getArtist(target);
    }
  });

  $.get('http://api.spreaker.com/user/7225701/episodes', function(data) {
    var results = data.response.pager.results;
    var IS_LIVE = 0;
    var live = "";
    var podcast = [];
    results.forEach(function(e) {
      if ( e.type == "LIVE" ) {
        live = e.episode_id;
        IS_LIVE = 1;
      } else {
        podcast.push(e.episodes_id);
      }
    });
    if ( IS_LIVE ) {
      var play_url = "http://api.spreaker.com/episode/"+live;
      $('div.spreaker').find('ul.podcast-list').hide();
      $('div.spreaker').find('div.live').html("live now");
      SP.Player.play(play_url);
    } else {
      $('div.spreaker').find('div.live').empty().hide();
      $('div.spreaker').find('ul.podcast-list').show();
      // list episodes
    }
  });

});

function getArtist(artist) {
  $.getJSON('api.php/artists/'+artist,function(data) {
    var nested = _.template( $("#template-artisti-nested").html() );
    var template = _.template( $("#template-artisti").html() );
    var html = template({data:data,nested:nested});
    $('#artisti-wrapper').empty().append(html);
    $('#carousel-'+data.username).carousel({
      interval: 4000
    })
  });
}


