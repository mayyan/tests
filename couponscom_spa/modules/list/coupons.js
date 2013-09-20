define(['jquery', 'underscore', 'backbone', 'text!modules/list/couponViewTemplate.html'],
       function ($, _, Backbone, couponViewTemplate) {
  'use strict';

  var CouponListView = Backbone.View.extend({
    
    template: _.template(couponViewTemplate),
    
    update:function(categoryId){
      //set callback of the event "fetchCompleted:Coupons" 
      this.collection.bind('fetchCompleted:Coupons',this.render,this);
      this.collection.fetch(categoryId);
    },

    render: function(){
      this.$el.empty();
      //compile template using the data fetched by collection
      this.$el.append(this.template({data:this.collection.toJSON()}));
      this.trigger("renderCompleted:Coupons",this);
      return this;
    }
  });
  
  return CouponListView;
});


