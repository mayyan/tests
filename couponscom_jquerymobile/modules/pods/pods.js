// Pod Model
var Pod = Backbone.Model.extend({
    defaults: {
        store: 'Unknown',
        desc: 'coupon code offer',
        code: 'unknown'
    }
});

// Model for A List of Pod
var PodCollection = Backbone.Collection.extend({
    model: Pod
});

// The View for a Pod
var PodView = Backbone.View.extend({
    // getClassName: function (index) {
    //     return "ui-block-" + String.fromCharCode("a".charCodeAt(0) + index % 3);
    // },

    tagName: 'div', 

    className: "pod",

    template: _.template( $('#podTemplate').html()),

    render: function(){
        this.$el.html( this.template(this.model.toJSON()));
        return this;  // returning this from render method..
    }
});

// View for all pods
var PodsView = Backbone.View.extend({
    tagName: 'div',

    className: "pods",
 
    render: function(){
        if (this.collection.length === 0) {
            this.$el.append("No offer");
        } else {
            this.collection.each(function(pod){
                var index = this.collection.indexOf(pod);
                pod.set("index", index);
                var podView = new PodView({ model: pod});
                this.$el.append(podView.render().el); // calling render method manually..
            }, this);
        }
        return this; // returning this for chaining..
    }
});

// Data
var podCollection_1 = new PodCollection([
    {
        store: "Macy's",
        desc: 'Save 20% Off Highest Priced Item',
        code: '0560'
    },
    {
        store: "Macy's",
        desc: "Save an Extra 20% Off at the Private VIP Sale",
        code: 'VIP'
    }
]);
var podCollection_2 = new PodCollection([
    {
        store: "H&M",
        desc: "Save 15% Off $100+",
        code: 'W901'
    },
    {
        store: "H&M",
        desc: 'Save 20% Off Highest Priced Item',
        code: '0560'
    },
    {
        store: "H&M",
        desc: "Save an Extra 20% Off at the Private VIP Sale",
        code: 'VIP'
    },
    {
        store: "H&M",
        desc: "Save 15% Off $100+",
        code: 'W901'
    }
]);
var podCollection_3 = new PodCollection([]); // empty



