define [
    'marionette'
    'album/views/title'
    'core/bus'
  ],
  (
    Marionette
    TitleView
    Bus

  ) ->
    class TitlesCollectionView extends Marionette.CollectionView
      childView: TitleView
      tagName: "ul"
      className: "list-unstyled"

      childViewEvents:
        'title:checked': 'clickByTitle'

      clickByTitle: (title) ->
        @onSelectTitle title.get 'id'

      onSelectTitle: (titleId, trigger = true) ->
        @children.forEach (child) ->
          if child.model.get('id') == titleId
            child.$el.addClass 'selected'
            Bus.trigger 'album:select', titleId if trigger
          else
            child.$el.removeClass 'selected'
          return