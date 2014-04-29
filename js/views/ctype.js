var app = app || {};

(function($) {
  app.ctypeView = Backbone.View.extend({
    className: 'ctype-wrapper',
    template: _.template($('#tpl-show-ctype').html()),
    render: function(ctype, data) {
      switch (ctype) {
        case "news":
          var models_id = [];
          _.each(data,function(model) {
            models_id.push(model.id);
          });
          data = models_id;
          break;
        case "artists":
        var models_id = [];
          _.each(data,function(model) {
            models_id.push(model.username);
          });
          data = models_id;
          break;
      }
      this.$el.html( this.template({ctype: ctype, items: data}) );
      return this.$el;          
    }
  });
})(jQuery);