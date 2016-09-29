define [
    'backbone'
    'images/entities/image'
    'backbone.paginator'
  ],
  (
    Backbone
    ImageModel
  ) ->
    class ImagesCollection extends Backbone.PageableCollection
      model: ImageModel
      url: 'server'
      state:
        firstPage: 1

      queryParams:
        currentPage: 'page'
        pageSize: 'page_size'

      mode: 'server'

      parseState: (resp) ->
        totalRecords: resp.total
        currentPage: resp.page
        pageSize: resp.page_size

      parseRecords: (resp, options) ->
        resp.data