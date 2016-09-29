define [
    'marionette'
    'images/views/image'
    'album/entities/titles'
    'core/bus'
  ],
  (
    Marionette
    ImageView

  ) ->
    class ImagesCollectionView extends Marionette.CollectionView
      childView: ImageView
      tagName: "div"
      className: "col-md-12 images"