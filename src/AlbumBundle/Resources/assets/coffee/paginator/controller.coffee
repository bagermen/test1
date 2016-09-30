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
        if total > 1
          pager.updatePagerModel album, page, total
          Bus.trigger 'render:paginator:pager', pager
        else
          Bus.trigger 'remove:paginator:pager', pager unless pager.isDestroyed()

      getPagerView: ->
        unless @getOption('pager') and not @getOption('pager').isDestroyed()
          @options.pager = new PagerView()
        @getOption('pager')