var app = app || {};

(function($){
  app.backendView = Backbone.View.extend({
    el: '#content-wrapper',
    template: _.template( $('#tpl-backend').html() ),
    initialize: function() {
      this.ctype = [
        {
          name: "artisti",
          url: "api.php/artists"
        }
        // },
        // {
        //   name: "news",
        //   url: "api.php/news"
        // }
      ];     
      this.render();
    },
    events: {
      'click button.add': 'addEdit',
      'click button.edit': 'addEdit',
      'click button.remove': 'remove',
      'submit form.backend': 'submitForm'
    },
    render: function() {
      this.$el.append( this.template(this.ctype) );
      var self = this;
      _.each(this.ctype, function(type) {
        $.getJSON(type.url)
          .done(function(data) {
            subview = new app.ctypeView();    
            self.$el.find('#'+type.name).append(subview.render(type.name,data));
          });
      });
    },
    addEdit: function(e) {
      var ctype = $(e.target).attr('data-ctype');
      var model = $(e.target).attr('data-model');
      var target = $('div.cnt[data-model="'+model+'"]');
      if ( $(target).hasClass("active") ) {
        $(target).removeClass("active").hide();
      } else {
        $('div.cnt.active').each(function(i, el) {
          $(el).removeClass("active").hide();
        });
        $('div.cnt[data-model="'+model+'"]').addClass("active").show();        
      }
      var self = this;
      if ( typeof(model)=="undefined" ) {
        // CREATE
        subview = new app.addEditView();
        data = undefined;
        self.$el.find('div.cnt[data-model="new"]').append(subview.render(ctype, data));        
      } else {
        // UPDATE
        // load and display model data
        $.getJSON('api.php/artists/'+model)
          .done(function(data) {
            subview = new app.addEditView();
            self.$el.find('div.cnt[data-model="'+model+'"]').append(subview.render(ctype, data));
          });
      }
    },
    submitForm: function(e) {
      e.preventDefault();
      // check if CREATE or UPDATE
      model = $(e.target).attr('data-model');
      var data = {};
      data.username = $(e.target).find('input[name="username"]').val();
      data.nome = $(e.target).find('input[name="nome"]').val();
      data.immagini = [];
      _.each($(e.target).find('input.immagini'),function(item){
        data.immagini.push($(item).val());
      });
      data.didascalie = [];
      _.each($(e.target).find('textarea.didascalie'),function(item){
        data.didascalie.push($(item).val());
      });
      data.bio = $(e.target).find('textarea[name="bio"]').val();
      if ( typeof(model)!=="undefined" ) {
        // update
        $.ajax({
          url: 'api.php/artists/'+model,
          type: 'PUT',
          // contentType: 'application/json',
          // dataType: "json",
          data: JSON.stringify(data),
          success: function(data,textStatus,jqXHR) {
            alert('DB updated.');
            console.log( 'PUT response:' );
            console.dir( data );
            console.log( textStatus );
            console.dir( jqXHR );
            $('div.cnt[data-model="'+model+'"]').removeClass("active").hide();
          },
          error: function(jqXHR,textStatus,errorThrown) {
            alert("error: "+textStatus);
          }
        });
      } else {
        // create
        $.post('api.php/artists', JSON.stringify(data), function(data,textStatus,jqXHR) {
            alert('DB post.');
            console.log( 'POST response:' );
            console.dir( data );
            console.log( textStatus );
            console.dir( jqXHR );
          }
        );
      }
    }

  });
})(jQuery);
