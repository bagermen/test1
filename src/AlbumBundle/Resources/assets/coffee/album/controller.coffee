define [
    'marionette'
    'core/bus'
    'album/views/titles'
    'backbone'
    'album/entities/repository'
  ],
  (
    Marionette
    Bus
    TitlesCollectionView
    Backbone
  )->
    class AlbumController extends Marionette.Object
      initialize: ->
        Bus.on 'album:load', @loadAlbum
        Bus.on 'album:load:select', @loadSelectAlbum
        Bus.on 'album:select', @loadImages
        super

      loadSelectAlbum: (titleId) =>
        @titles = Bus.request 'album:repository:load', =>
          @showTitlesView()
          albums = @getOption('album')
          albums.onSelectTitle titleId, false

      loadAlbum: =>
        @titles = Bus.request 'album:repository:load', =>
          @showTitlesView()

      showTitlesView: ->
        Bus.trigger 'render:album:titles', @getTitlesView()

      getTitlesView: ->
        @options.album = new TitlesCollectionView collection: @titles unless @getOption('album')
        @getOption('album')

      loadImages: (titleId) ->
        Backbone.history.navigate 'album/' + titleId
        Bus.trigger 'images:load', titleId
