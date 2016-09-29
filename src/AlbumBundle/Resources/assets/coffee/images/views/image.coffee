define [
    'marionette'
    'text!images/templates/image.html'
    'underscore'
  ],
  (
    Marionette
    Template
    underscore
  ) ->
    class ImageView extends Marionette.View
      tagName: 'div'
      template: underscore.template Template