# describe script dependency

requirejs.config
  paths:
    backbone: '/assets/vendor/backbone/backbone'
    json2: '/assets/vendor/json2/json2'
    marionette: '/assets/vendor/backbone.marionette/lib/backbone.marionette'
    underscore: '/assets/vendor/underscore/underscore-min'
    jquery: '/assets/vendor/jquery/dist/jquery.min'
    'backbone.paginator': '/assets/vendor/backbone.paginator/lib/backbone.paginator.min'
    'backbone.radio': '/assets/vendor/backbone.radio/build/backbone.radio'
    bootstrap: '/assets/vendor/bootstrap/dist/js/bootstrap.min'
    text: '/assets/vendor/text/text'

  shim:
    bootstrap:
      deps: ['jquery']

require [
  'app'
], (App) ->
  new App().start()