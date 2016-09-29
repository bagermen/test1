define [
    'marionette'
    'core/bus'
    'album/app'
    'images/app'
  ],
  (
    Marionette
    Bus
    Album
  )->
    class AppLayoutBehaviour extends Marionette.Behavior
      onRender: ->
        Bus.on 'render:album:titles', @renderTitles
        Bus.on 'render:images:images', @renderImages
        Bus.on 'render:paginator:pager', @renderPager

        Bus.trigger 'images:reset'

      renderTitles: (titles) =>
        @view.showChildView 'titles', titles

      renderImages: (images) =>
        @view.showChildView 'images', images

      renderPager: (pager) =>
        @view.showChildView 'paginate', pager