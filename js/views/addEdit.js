var app = app || {};

(function($) {
  app.addEditView = Backbone.View.extend({
    render: function(ctype,data) {
      switch ( ctype ) {
        case "artisti":
          tpl = _.template($('#tpl-add-edit-artisti').html());
          this.$el.html( tpl({model: data}));
          return this.$el;
        case "news":
          break;
        default:
          console.log("switch->default");
      }
      // this.$el.html( this.template({ctype: ctype, items: data}) );
      // return this.$el;          
    }
  });
})(jQuery);