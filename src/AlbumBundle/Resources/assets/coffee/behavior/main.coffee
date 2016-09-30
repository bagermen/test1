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
        Bus.on 'remove:paginator:pager', @removePager

        Bus.trigger 'images:reset'

      renderTitles: (titles) =>
        @view.showChildView 'titles', titles
        @view.showChildView 'filter', Bus.request 'filter:view'
        Bus.trigger 'images:reset'

      renderImages: (images) =>
        @view.showChildView 'images', images

      renderPager: (pager) =>
        @view.showChildView 'paginate', pager

      removePager: =>
          @view.getChildView('paginate')?.destroy()