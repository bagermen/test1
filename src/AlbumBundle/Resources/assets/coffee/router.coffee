define [
    'marionette'
  ],
  (
    Marionette
  )->
    class Router extends Marionette.AppRouter
      appRoutes:
        "albums": "albumsList"
        "album/:id": "showFirstPage"
        "album/:id/page/:page": "showPage"
        ".*": "moveToRoot"
