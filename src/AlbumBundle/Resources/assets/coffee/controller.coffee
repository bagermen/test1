define [
    'views/main'
    'marionette'
    'backbone'
    'core/bus'
    'album/app'
    'images/app'
  ],
  (
    AppLayoutView
    Marionette
    Backbone
    Bus
  )->
    class MyController extends Marionette.Object
#      Reset to default url
      moveToRoot: ->
        Backbone.history.navigate 'albums', trigger: true
#     show layout
      albumsList: ->
        Bus.request 'app:show'
        Bus.trigger 'album:load'

      showPage: (album, page) ->
        Bus.request 'app:show'
        Bus.trigger 'album:load:select', parseInt(album), false
        Bus.trigger 'images:load', parseInt(album), parseInt(page)

      showFirstPage: (album) ->
          @showPage album, 1

