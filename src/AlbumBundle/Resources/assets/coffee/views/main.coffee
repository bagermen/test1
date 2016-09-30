define [
    'marionette'
    'text!templates/main.html'
    'underscore'
    'behavior/main'
  ],
  (
    Marionette
    Template
    underscore
    AppLayoutBehaviour
  )->
    class AppLayoutView extends Marionette.View
      template: underscore.template Template
      className: "row album"

      regions:
        titles: ".titles"
        images: ".images-ct"
        paginate: ".paginate"
        filter: ".filter"

      behaviors: [AppLayoutBehaviour]
