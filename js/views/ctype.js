var app = app || {};

(function($) {
  app.ctypeView = Backbone.View.extend({
    className: 'ctype-wrapper',
    template: _.template($('#tpl-show-ctype').html()),
    render: function(ctype, data) {
      switch (ctype) {
        case "news":
          var models = [];
          _.each(data,function(model) {
            models.push({id: model.id, titolo: model.titolo});
          });
          data = {models: models};
          break;
        case "artists":
          var models = [];
          _.each(data,function(model) {
            models.push({id: model.username});
          });
          data = {models: models};
          break;
      }
      this.$el.html( this.template({ctype: ctype, models: models}) );
      return this.$el;          
    }
  });
})(jQuery);