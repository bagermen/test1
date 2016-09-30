define [
    'backbone'
  ],
  (
    Backbone
  ) ->
    class FilterModel extends Backbone.Model
      defaults:
        id: ''