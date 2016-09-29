define [
    'marionette'
    'paginator/entities/pager'
    'text!paginator/templates/pager.html'
    'underscore'

  ],
  (
    Marionette
    PagerModel
    Template
    underscore
  ) ->
    class PagerView extends Marionette.View
      tagName: 'div'
      className: "col-md-12"
      template: underscore.template Template
      model: new PagerModel(),
      modelEvents:
        change: "refreshView"
      refreshView: ->
        @render()

      updatePagerModel: (album, page = 1, total = 0) ->
        data =
          current: page
          total: total
          prev: ""
          next: ""

        url = 'album/' + album + '/page/'

        if album and page
          data.prev = url + (if page > 1 then page - 1 else 1)
          data.next = url + (page + (if page == total then 0 else 1))

        @model.set(data);