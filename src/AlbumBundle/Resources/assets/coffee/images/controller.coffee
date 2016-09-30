define [
    'marionette'
    'core/bus'
    'images/views/images'
    'backbone'
    'images/entities/repository'
    'paginator/app'
  ],
  (
    Marionette
    Bus
    ImagesCollectionView
    Backbone
  )->
    class ImagesController extends Marionette.Object
      initialize: ->
        Bus.on 'images:load', @loadImages
        Bus.on 'images:reset', @resetImages
        super

      resetImages: =>
        @collection = Bus.request 'images:repository:load', 0, 0, ->
        @showImagesView(0, 0, 0)

      loadImages: (titleId, page = 1) =>
        @collection = Bus.request 'images:repository:load', titleId, page, @onAfterImagesLoad

      onAfterImagesLoad: (titleId, page, total) =>
        Backbone.history.navigate 'album/' + titleId + '/page/' + page
        @showImagesView titleId, page, total

      showImagesView: (titleId, page, total)->
        Bus.trigger 'render:images:images', @getImagesView()
        Bus.trigger 'paginator:update', titleId, page, total

      getImagesView: ->
        new ImagesCollectionView
          collection: @collection

