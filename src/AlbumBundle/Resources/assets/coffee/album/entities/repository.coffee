define [
    'core/bus'
    'album/entities/titles'
  ],
  (
    Bus,
    Titles
  ) ->
    Bus.reply 'album:repository:load', (handler) ->
      titles = new Titles()
      titles.fetch().done handler

      titles