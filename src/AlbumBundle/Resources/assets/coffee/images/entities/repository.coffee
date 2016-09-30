define [
    'core/bus'
    'images/entities/images'
    'config'
  ],
  (
    Bus,
    ImagesCollection,
    Config
  ) ->
    Bus.reply 'images:repository:load', (titleId, page, handler) ->
      titles = new ImagesCollection [], state: { currentPage: page, pageSize: Config.pageSize }

      url = Config.imagesUrl.replace ':id', titleId

      if titleId == 0 and page == 0
        handler 0, 0, 0
      else
        titles.fetch(url: url).done () ->
          handler titleId, titles.state.currentPage, titles.state.totalPages

      titles