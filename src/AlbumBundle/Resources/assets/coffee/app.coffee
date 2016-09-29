define [
    'controller'
    'router'
    'views/main'
    'marionette'
    'backbone'
    'core/bus'
  ],
  (
    MyController
    Router
    AppLayoutView
    Marionette
    Backbone
    Bus
  )->
#   Application class
    class App extends Marionette.Application
      region: '#renderData'
#     start history
      onStart: ->
        unless Backbone.History.started
          Backbone.history.start()

#     register controller, router and bus action
      onBeforeStart: ->
        Bus.reply 'app:show', @showAppView

        new Router
          controller: new MyController()

#     show main layout
      showAppView: =>
        @showView @getMainLayout()

#     get main layout
      getMainLayout: ->
        @options.main = new AppLayoutView() unless @getOption('main')
        @getOption('main')
