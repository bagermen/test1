// Models
var PagerModel = Backbone.Model.extend({});

var ImageModel = Backbone.Model.extend({});
var ImagesCollection = Backbone.PageableCollection.extend({
    model: ImageModel,
    url: "server",
    state: {
        firstPage: 1
    },
    queryParams: {
        currentPage: "page",
        pageSize: "page_size"
    },
    mode: "server",

    parseState: function (resp) {
        return {
            totalRecords: resp.total,
            currentPage: resp.page,
            pageSize: resp.page_size
        };
    },

    // get the actual records
    parseRecords: function (resp, options) {
        return resp.data;
    }
});

var TitleModel = Backbone.Model.extend({});
var TitlesModel = Backbone.Collection.extend({
    url: '/api/albums',
    model: TitleModel
});

// Views
var PagerView = Marionette.ItemView.extend({
    tagName: 'div',
    className: "col-md-12",
    template: "#paginator-template",
    model: new PagerModel(),
    modelEvents: {
        change: "refreshView"
    },
    refreshView: function() {
        this.render();
    }
});

var ImageView = Marionette.ItemView.extend({
    tagName: 'div',
    template: "#image-template",
    events: {
        'click': 'selectTitle'
    }
});
var ImagesCollectionView = Marionette.CollectionView.extend({
    childView: ImageView,
    tagName: "div",
    className: "col-md-12 images",
    collectionEvents: {
        'pageable:state:change': 'stateChanged'
    },
    onImagesLoad: function(url) {
        var self = this;
        this.collection.fetch({url: url}).done(function() {
            self.triggerMethod('images:loaded');
        });
    },

    stateChanged: function() {
        this.triggerMethod('images:loaded');
    }
});

var TitleView = Marionette.ItemView.extend({
    tagName: 'li',
    template: "#title-template",
    events: {
        'click': 'selectTitle'
    },

    selectTitle: function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.triggerMethod('title:checked');
    }
});
var TitlesCollectionView = Marionette.CollectionView.extend({
        childView: TitleView,
        tagName: "ul",
        className: "list-unstyled",
        collection: new TitlesModel(),
        selectTitle: false,
        onRender: function() {
            var self = this;
            this.loaded = false;
            this.collection.fetch().done(function() {
                self.loaded = true;
                if (self.selectTitle !== false) {
                    self.onSelectTitle.call(self, self.selectTitle);
                }
                self.selectTitle = false;
            });
        },
        childEvents: {
            'title:checked': 'clickByTitle'
        },

        clickByTitle: function(title) {
            this.onSelectTitle(title.model.get('id'));

            if (this.getOption('current') != title) {
                Backbone.history.navigate('album/' + title.model.get('id'), {trigger: true});
            }
            this.options.current = title;
        },

        onSelectTitle: function(titleId) {
            var self = this;
            if (this.loaded) {
                this.children.forEach(function(child) {
                    if (child.model.get('id') == titleId) {
                        child.$el.addClass('selected');
                        self.triggerMethod('titles:checked', titleId);
                    } else {
                        child.$el.removeClass('selected');
                    }
                });
            } else {
                this.selectTitle = titleId;
            }
        },

        getSelectedTitle: function() {
            var selected = undefined;
            this.children.forEach(function(child) {
                if (child.$el.hasClass('selected')) {
                    selected = child.model;
                }
            });

            return selected;
        }
    }
);

// Main layout
var AppLayoutView = Marionette.LayoutView.extend({
    template: "#layout-view-template",

    regions: {
        titles: ".titles",
        images: ".images-ct",
        paginate: ".paginate"
    },


    childEvents: {
        'images:loaded': 'updatePager',
        'titles:checked': 'selectImage'
    },

    onRender: function() {
        var view = new PagerView();
        this.options.pager = view;
        view.model = this.updatePagerModel(view.model, 0, 1, 1);
        this.showChildView('paginate', this.getOption('pager'));
    },

    onMainTitlesLoad: function() {
        this.options.titles = new TitlesCollectionView();
        this.showChildView('titles', this.getOption('titles'));
    },

    onAlbumSelect: function(album, page) {
        if (!page) {
            page = 1;
        }
        this.options.currentAlbum = album;
        this.options.currentPage = page;
        this.getOption('titles').triggerMethod('select:title', album);
    },

    selectImage: function(view, album) {
        if (album == this.getOption('currentAlbum')) {
            this.buildImagesView(album, this.getOption('currentPage'))
        }
    },

    buildImagesView: function(album, page) {
        var url = 'api/albums/'+ album + '/images';
        var collection = new ImagesCollection([], {
            state: {
                currentPage: page
            }
        });

        if (this.getOption('titles').getSelectedTitle().get('id') == album && this.options.images) {
            this.getOption('images').collection.getPage(parseInt(page), {fetch: true, url: url});
        } else {
            this.options.images = new ImagesCollectionView({collection: collection});
            this.showChildView('images', this.getOption('images'));
        }
        this.getOption('images').triggerMethod('images:load', url);
    },

    updatePager: function(view) {
        this.updatePagerModel(
            this.getOption('pager').model,
            this.getOption('titles').getSelectedTitle().get('id'),
            view.collection.state.currentPage,
            view.collection.state.totalPages
        );
    },

    updatePagerModel: function(model, album, page, total) {
        var data = {
            current: page,
            total: total,
            prev: "",
            next: ""
        };
        var url = 'album/' + album + '/page/';

        if (album && page) {
            if (page > 1) {
                data.prev = url + (page - 1);
            } else {
                data.prev = url + 1;
            }
            data.next = url + (page + (page == total ? 0 : 1));
        }
        model.set(data);

        return model;
    }
});

// Controller
var MyController = Marionette.Controller.extend({
    initialize: function() {
        this.options.regionManager = new Marionette.RegionManager({
            regions: {
                main: '#renderData'
            }
        });

        var layout = new AppLayoutView();
        this.options.layout = layout;
        this.getOption('regionManager').get('main').show(layout);
        layout.triggerMethod('main:titles:load');
    },

    albumsList: function() {
        if (window.console && window.console.log) {
            console.log('fine');
        }
    },

    showFirstPage: function(album) {
        var layout = this.getOption('layout');
        layout.triggerMethod('album:select', album);
    },

    showPage: function(album, page) {
        var layout = this.getOption('layout');
        layout.triggerMethod('album:select', album, page);
    },

    moveToRoot: function() {
        Backbone.history.navigate('albums');
    }
});

// Router
var Router = Marionette.AppRouter.extend({
    appRoutes: {
        "albums": "albumsList",
        "album/:id": "showFirstPage",
        "album/:id/page/:page": "showPage",
        ".*": "moveToRoot"
    }
});

/**
 * Application
 * @type {Backbone.Marionette.Application}
 */
var app = new Marionette.Application();

app.on('start', function() {
    var router = new Router({
        controller: new MyController()
    });
    Backbone.history.start();
});

app.start();