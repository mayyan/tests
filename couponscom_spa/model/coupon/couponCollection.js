define(['jquery', 'underscore', 'backbone','model/coupon/couponModel'],
       function ($, _, Backbone, Coupon){

        var Coupons=Backbone.Collection.extend({

          // Book is the model of the collection
          model: Coupon,

          //fetch data from books.json using Ajax 
          //and then dispatch customized event "fetchCompleted:Coupons"
          fetch:function(categoryId){
            var self=this;
            var tmpItem;
            //fetch the data using ajax
            var jqxhr = $.getJSON("data/category" + categoryId+".json")
                    .success(function(data, status, xhr) { 
                $.each(data, function(i,item){
                    //create book for each item and then insert into the collection
                    tmpItem=new Coupon({
                        podId:   item.podId, 
                        summary: item.summary, 
                        brand:   item.brand,
                        details: item.details,
                        imgUrl:  item.image.url
                    });
                    self.add(tmpItem);
                });
                //dispatch customized event
                self.trigger("fetchCompleted:Coupons");
              })
              .error(function() { alert("error"); })
              .complete(function() {
                    console.log("fetch complete + " + this);
              });
          }
  });

  return Coupons;
});


