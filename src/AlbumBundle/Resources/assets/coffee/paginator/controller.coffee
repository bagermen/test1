define [
    'marionette'
    'core/bus'
    'paginator/views/pager'
  ],
  (
    Marionette
    Bus
    PagerView
  )->
    class PaginatorController extends Marionette.Object
      initialize: ->
        Bus.on 'paginator:update', @updatePaginator
        super

      updatePaginator: (album, page, total) =>
        pager = @getPagerView()
        pager.updatePagerModel album, page, total
        Bus.trigger 'render:paginator:pager', pager

      getPagerView: ->
        new PagerView()