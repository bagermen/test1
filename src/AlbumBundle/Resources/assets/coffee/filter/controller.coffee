define [
    'marionette'
    'core/bus'
    'filter/views/filter'
    'backbone'
  ],
  (
    Marionette
    Bus
    FilterView
    Backbone
  )->
    class FilterController extends Marionette.Object
      initialize: ->
        Bus.on 'filter:search', @filterAlbums
        Bus.reply 'filter:search:value', @getFilterValue
        Bus.reply 'filter:view', @getFilterView
        super

      getFilterView: =>
        @options.filter = new FilterView() unless @getOption('filter')
        @getOption('filter')

      filterAlbums: ->
        Backbone.history.loadUrl 'albums' unless Backbone.history.navigate 'albums', trigger: true

      getFilterValue: =>
        val = @getFilterView().model.get 'id'
        parseInt (if !isNaN(parseInt(val)) then val else 0)
