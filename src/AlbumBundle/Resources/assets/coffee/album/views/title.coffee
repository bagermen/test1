define [
    'marionette'
    'text!album/templates/title.html'
    'underscore'
  ],
  (
    Marionette
    Template
    underscore
  ) ->
    class TitleView extends Marionette.View
      tagName: 'li'
      template: underscore.template Template
      events:
        'click': 'selectTitle'

      selectTitle: (e) ->
        e.preventDefault()
        e.stopPropagation()
        @triggerMethod 'title:checked', @model