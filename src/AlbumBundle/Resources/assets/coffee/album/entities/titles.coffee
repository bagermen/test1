define [
    'backbone'
    'core/bus'
    'album/entities/title'
    'config'
  ],
  (
    Backbone
    Bus
    TitleModel
    Config
  ) ->
    class TitleCollection extends Backbone.Collection
      url: Config.albumsUrl
      model: TitleModel