define [
    'marionette'
    'backbone'
  ],
  (
    Marionette
    Backbone
  )->
    class Bus extends Marionette.Object
      channelName: 'app'


    Backbone.Radio.channel('app')
