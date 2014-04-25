var app = app || {};

(function($){
	Workspace = Backbone.Router.extend({
    routes: {
      '*path': 'backend'
    },
    start: function() {
      if ( Backbone.history.start() ) {
        console.log("History started successfully");
        return true;
      } else {
        console.log('can\'t start history');
        return false;
      }
    },
    backend: function() {
      var backend = new app.backendView();
      this.navigate('!/backend')
    }
  })
})(jQuery);
