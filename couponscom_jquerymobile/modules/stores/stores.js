// Store Model
var Store = Backbone.Model.extend({
    defaults: {
        id: -1,
        name: 'Unknown',
        logoUrl: '#',
    }
});

// Model for A List of Store
var StoreCollection = Backbone.Collection.extend({
    model: Store
});

// The View for a Store
var StoreView = Backbone.View.extend({
    tagName: 'div',

    attributes: {
        "data-role": "collapsible",
        "data-theme": "b",
        "data-content-theme": "d",
        "data-inset": false
    },

    template: _.template( $('#storeTemplate').html()),

    render: function(){
        this.$el.html( this.template(this.model.toJSON()));
        return this;  // returning this from render method..
    }
});

// View for all pods
var StoresView = Backbone.View.extend({
    tagName: 'div',
    
    attributes: {
        "data-role": "collapsible-set",
        "data-content-theme": "c"
    },

    render: function(){
        this.collection.each(function(store){
            var storeView = new StoreView({ model: store });
            this.$el.append(storeView.render().el); // calling render method manually..
        }, this);
        return this; // returning this for chaining..
    }
});

// Data
var storeCollection = new StoreCollection([
    {
        id: 1,
        name: "Macy's",
        logoUrl: 'http://cdn.cpnscdn.com/static.coupons.com/CC/merchants/images/aff/in/small/macys_88x31_3.gif'
    },
    {
        id: 2,
        name: "Norstrom",
        logoUrl: "http://cdn.cpnscdn.com/static.coupons.com/CC/merchants/images/aff/in/small/nordstrom_88x31_3.gif"
    },
    {
        id: 3,
        name: "jspenney",
        logoUrl: "http://cdn.cpnscdn.com/static.coupons.com/CC/merchants/images/aff/in/small/jcpenney_88x31_5.gif"
    }
]);

