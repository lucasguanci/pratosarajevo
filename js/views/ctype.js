var app = app || {};

(function($) {
  app.ctypeView = Backbone.View.extend({
    className: 'ctype-wrapper',
    template: _.template($('#tpl-show-ctype').html()),
    render: function(ctype, data) {
      this.$el.html( this.template({ctype: ctype, items: data}) );
      return this.$el;          
    }
  });
})(jQuery);