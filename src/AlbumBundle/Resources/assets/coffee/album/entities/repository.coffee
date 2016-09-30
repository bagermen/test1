define [
    'core/bus'
    'album/entities/titles'
  ],
  (
    Bus,
    Titles
  ) ->
    Bus.reply 'album:repository:load', (handler) ->
      filter = Bus.request 'filter:search:value'

      titles = new Titles()
      titles.fetch(data: filter: filter).done handler

      titles