var app = app || {};

(function($){
  app.backendView = Backbone.View.extend({
    el: '#content-wrapper',
    template: _.template( $('#tpl-backend').html() ),
    initialize: function() {
      this.ctype = [
        {
          name: "artists",
          url: "/artists"
        },
        {
          name: "news",
          url: "/news"
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
            console.log('type: '+type.name);
          });
      });
    },
    addEdit: function(e) {
      var ctype = $(e.target).attr('data-ctype');
      var model = $(e.target).attr('data-model');
      var self = this;
      if ( typeof(model)=="undefined" ) {
        // CREATE
        var target = $('div.cnt.'+ctype+'[data-model="new"]');
        if ( $(target).hasClass("active") ) {
          target.removeClass("active").toggle();
        } else {
          target.addClass("active").toggle();
        }
        // display form
        subview = new app.addEditView();
        data = undefined;
        self.$el.find('div.cnt.'+ctype+'[data-model="new"]').html(subview.render(ctype, data));
        // enable CKeditor
        self.$el.find('textarea').each(function(i,item) {
          var id = $(this).attr('name');
          CKEDITOR.replace(id);
        });
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
        // load and display model data
        $.getJSON('/'+ctype+'/'+model)
          .done(function(data) {
            subview = new app.addEditView();
            self.$el.find('div.cnt[data-model="'+model+'"]').empty().append(subview.render(ctype, data));
            // enable CKeditor
            self.$el.find('textarea').each(function(i,item) {
              var id = $(this).attr('name');
              CKEDITOR.replace(id);
            });
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
          data.data_pubblicazione = $(e.target).find('input[name="data_pubblicazione"]').val();
          data.titolo = $(e.target).find('input[name="titolo"]').val();
          data.contenuto = $(e.target).find('textarea[name="contenuto_'+ctype+'"]').val();
          data.testo_esteso = $(e.target).find('textarea[name="testo_esteso_'+ctype+'"]').val();
          data.immagine = $(e.target).find('input[name="immagine"]').val();
          data.target = $(e.target).find('input[name="target"]').val();
          var in_evidenza = $(e.target).find('input[name="in_evidenza"]').is(":checked");
          if ( in_evidenza ) {
            data.in_evidenza = 1;
          } else {
            data.in_evidenza = 0;
          }
          data.categoria = $(e.target).find("select[name='categoria']").find('option:selected').text();
          break;
      }
      // check if CREATE or UPDATE      
      if ( typeof(model)!=="undefined" ) {
        // UPDATE
        $.ajax({
          url: '/'+ctype+'/'+model,
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
        $.post('/'+ctype, JSON.stringify(data), function(data,textStatus,jqXHR) {
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
