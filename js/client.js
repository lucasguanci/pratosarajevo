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
  if ( $("div.news-dettaglio").length>0 ) {
    $.getJSON('/news', function(data) {        
      var archivio = new Archivio(data);
      archivio.displayIndex();
      modelId = getUrlVars()["modelId"];
      if ( typeof(modelId)!=="undefined" ) {
        var model = {};
        _.each(data, function(item) { 
          if ( item.id==modelId ) { 
            model = item;
          }
        })
        archivio.displayContent(model);
      } else {
        archivio.displayContent(data[0]);
      }
    });
  }

  // init Map
  var map = L.mapbox.map('map', 'brontoluke.hnlbg8n2')
    .setView([43.879, 11.096], 13);
  // Spreaker API
  // $.get('http://api.spreaker.com/user/7225701/episodes', function(data) {
  //   var results = data.response.pager.results;
  //   var IS_LIVE = 0;
  //   var live = "";
  //   var podcast = [];
  //   results.forEach(function(e) {
  //     if ( e.type == "LIVE" ) {
  //       live = e.episode_id;
  //       IS_LIVE = 1;
  //     } else {
  //       podcast.push(e.episodes_id);
  //     }
  //   });
  //   if ( IS_LIVE ) {
  //     var play_url = "http://api.spreaker.com/episode/"+live;
  //     $('div.spreaker').find('ul.podcast-list').hide();
  //     $('div.spreaker').find('div.live').html("live now");
  //     SP.Player.play(play_url);
  //   } else {
  //     $('div.spreaker').find('div.live').empty().hide();
  //     $('div.spreaker').find('ul.podcast-list').show();
  //     // list episodes
  //   }
  // });
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
      if ( parseInt(model.in_evidenza) ) {
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

// archivio news
function Archivio(news) {
  // news = [{news_1},{news_2},..]
  this.news = news || {};
  this.init = function() {
    this.displayIndex();
    var firstItem = $('ul.news-index>li')[0];
    $(firstItem).find('a').addClass('active');
    this.displayContent(this.news[0]);    
  }
  this.displayCategories = function() {};
  this.displayIndex = function() {
    var template = _.template( $('#tpl-news-index').html() );
    var cnt = template({news: this.news});
    $('ul.news-index').append(cnt);
    var self = this;
    $('ul.news-index>li a.news-index').each(function(i,item){
      $(this).on('click', function(e) {
        e.preventDefault();
        source = $('div.news-dettaglio').attr('id');
        target = $(e.target).attr('data-target');
        if ( source !== target ) {
          $('a[data-target="'+source+'"]').removeClass('active');
          $(e.target).addClass('active');
          var model = {};
          _.each(self.news, function(item) { 
            if ( item.id==target ) { 
              model = item;
            }
          })
          self.displayContent(model);
        }
      });
    });
  };
  this.displayContent = function(model) {
    var template = _.template( $('#tpl-news-dettaglio').html() );
    var cnt = template({model: model});
    $('div.news-dettaglio').attr("id",model.id).empty().append(cnt);
  };  
}

// getUrlVars
function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}