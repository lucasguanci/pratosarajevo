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
  // init news
  if ( $("#news-wrapper").length>0 ) {
    displayNews();
  }
  // init section artisti
  if ( $("#artisti-wrapper").length>0 ) {
    // display first artist
    getArtist("banchelli");
    // events
    $('a.artisti').on('click',function(e){
      e.preventDefault();
      source = $('div.artista.active').attr('id');
      target = $(e.target).attr('data-target');
      if ( source !== target ) {
        $('div.artista.active').removeClass('active').hide();
        $('a[data-target="'+source+'"]').removeClass('activeLink');
        $(e.target).addClass('activeLink');
        // load artist
        getArtist(target);
      }
    });
  }
  // init section progetto
  if ( $("#progetto-wrapper").length>0 ) {
    // back to top
    $('a.to-top').on('click', function(e) {
      $('html, body').animate({ scrollTop: 0 }, 'fast');
    });
    // display content
    displayContent('progetto');
  }
  // init section archivio
  if ( $("#archivio-wrapper").length>0 ) {
    displayContent('archivio');
    initArchivio();
  }
  // init Map
  var map = L.mapbox.map('map', 'brontoluke.hnlbg8n2')
    .setView([43.879, 11.096], 14);
  // Spreaker API
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
  $.getJSON('/artists/'+artist,function(data) {
    var nested = _.template( $("#template-artisti-nested").html() );
    var template = _.template( $("#template-artisti").html() );
    var html = template({data:data,nested:nested});
    $('#artisti-wrapper').empty().append(html);
    $('#carousel-'+data.username).carousel({
      interval: 3000
    })
  });
}

function displayNews() {
  $.getJSON('/news', function(data) {
    newsInEvidenza = [];
    _.each(data, function(model) {
      if ( model.in_evidenza ) {
        newsInEvidenza.push(model.id);
      }
    });
    _.each(newsInEvidenza, function(post) {
      $.getJSON('/news/'+post, function(post_data) {
        var template = _.template( $('#tpl-news-home').html() );
        var post_cnt = template({data:post_data});
        $("#news-wrapper").append(post_cnt);
      });
    })
  });
}

function displayContent(type) {
  $('a.'+type).on('click',function(e){
    e.preventDefault();
    source = $('div.'+type+'.active').attr('id');
    target = $(e.target).attr('data-target');    
    if ( source !== target ) {
      $('#'+source).removeClass('active').hide();
      $('#'+target).addClass('active').show();
      $('a[data-target="'+source+'"]').removeClass('activeLink');
      $(e.target).addClass('activeLink');
    }
  });
}

function initArchivio() {
  // GET all news
  $.getJSON('/news', function(data) {
    _.each(data, function(post) {
      id = post.split(/:/)[1];
      $.getJSON('/news/'+id, function(post_data) {
        moment.lang('it');
        post_data.data = moment(post_data.data).format("dddd, D MMMM");
        var template = _.template( $('#tpl-archivio').html() );
        var cnt = template({data:post_data});
        $("#archivio-list").append(cnt);
      });
    })
  });
}
