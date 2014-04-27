var app = app || {};

(function($){
  app.backendView = Backbone.View.extend({
    el: '#content-wrapper',
    template: _.template( $('#tpl-backend').html() ),
    initialize: function() {
      this.ctype = [
        {
          name: "artists",
          url: "api.php/artists"
        },
        {
          name: "news",
          url: "api.php/news"
        }
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
      var self = this;
      if ( typeof(model)=="undefined" ) {
        // CREATE
        var target = $('div.cnt[data-model="new"]');
        if ( $(target).hasClass("active") ) {
          target.removeClass("active").toggle();
        } else {
          target.addClass("active").toggle();
        }
        // display form
        subview = new app.addEditView();
        data = undefined;
        self.$el.find('div.cnt[data-model="new"]').html(subview.render(ctype, data));        
      } else {
        // UPDATE
        // hide active element and display selected
        var target = $('div.cnt[data-model="'+model+'"]');
        if ( $(target).hasClass("active") ) {
          $(target).removeClass("active").hide();
        } else {
          $('div.cnt.active').each(function(i, el) {
            $(el).removeClass("active").hide();
          });
          $('div.cnt[data-model="'+model+'"]').addClass("active").show();        
        }
        // if ctype==news get proper model id, i.e. 1, 2, ..
        if ( ctype=="news" ) {
          model = model.split(/:/)[1];
        }
        // load and display model data
        $.getJSON('api.php/'+ctype+'/'+model)
          .done(function(data) {
            if ( ctype=="news" ) {
              model = "post:"+model;
            }            
            subview = new app.addEditView();
            self.$el.find('div.cnt[data-model="'+model+'"]').append(subview.render(ctype, data));
          });
      }
    },
    submitForm: function(e) {
      e.preventDefault();
      model = $(e.target).attr('data-model');
      ctype = $(e.target).attr('data-ctype');
      var data = {};
      // switch between cases
      switch (ctype) {
        case "artists":
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
          break;
        case "news":
          data.data = moment().format();
          data.titolo = $(e.target).find('input[name="titolo"]').val();
          data.contenuto = $(e.target).find('textarea[name="contenuto"]').val();
          data.immagine = $(e.target).find('input[name="immagine"]').val();
          break;
      }
      // check if CREATE or UPDATE      
      if ( typeof(model)!=="undefined" ) {
        // UPDATE
        $.ajax({
          url: 'api.php/'+ctype+'/'+model,
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
        // CREATE
        $.post('api.php/'+ctype, JSON.stringify(data), function(data,textStatus,jqXHR) {
            alert('DB post.');
            console.log( 'POST response:' );
            console.dir( data );
            console.log( textStatus );
            console.dir( jqXHR );
            $('div.cnt[data-model="new"]').removeClass("active").hide();
          }
        );
      }
    }

  });
})(jQuery);
