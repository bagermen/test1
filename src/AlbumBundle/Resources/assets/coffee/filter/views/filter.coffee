define [
    'marionette'
    'text!filter/templates/filter.html'
    'filter/entities/filter'
    'core/bus'
    'underscore'
  ],
  (
    Marionette
    Template
    FilterModel
    Bus
    underscore
  ) ->
    class FilterView extends Marionette.View
      tagName: 'div'
      className: "col-md-12"
      template: underscore.template Template
      model: new FilterModel(),
      modelEvents:
        change: "refreshView"
      triggers:
        'change input': 'filter:entered'
        'click button': 'filter:search'
      refreshView: ->
        @render()

      onFilterEntered: ->
        val = $(@el).find('input').val()
        @model.set('id', (if !isNaN(parseInt(val)) then val else 0))

      onFilterSearch: ->
        Bus.trigger 'filter:search'
