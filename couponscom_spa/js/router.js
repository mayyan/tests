define(['jquery', 'underscore', 'backbone','modules/home/home',
            'model/coupon/couponCollection',
            'modules/list/coupons',            
            'jqm'], 
	function($, _, Backbone,HomeView,CouponCollection,CouponListView) {

    'use strict';
    var Router = Backbone.Router.extend({
    //define routes and mapping route to the function
        routes: {
        	'':    'showHome',           //home view
        	'home': 'showHome',         //home view as well
            'list/:categoryId' : 'showCoupons',
            '*actions': 'defaultAction' //default action,mapping "/#anything"       	
        },

	    defaultAction: function(actions){
	    	this.showHome();
	    },

	    showHome:function(actions){
	    	// will render home view and navigate to homeView
	    	var homeView=new HomeView();
	    	homeView.render();
	    	this.changePage(homeView);
	    },

        init:true,

        showCoupons:function(categoryId){
            //create a collection
            var couponList=new CouponCollection();
            //create coupon list view and pass couponList as the collection of the view
            var couponListView=new CouponListView({collection: couponList});
            //need to pass this as context 
            couponListView.bind('renderCompleted:Coupons',this.changePage,this);
            //update view
            couponListView.update(categoryId);
        },

        //1. changePage will insert view into DOM and then call changePage to enhance and transition
        //2. for the first page, jQuery mobile will present and enhance automatically
        //3. for the other page, we will call $.mobile.changePage() to enhance page and make transition
        //4. argument 'view' is passed from event trigger
        changePage:function (view) {
        	//add the attribute 'data-role="page" ' for each view's div
    		view.$el.attr('data-role', 'page');   
            //append to dom
        	$('body').append(view.$el);  

            if(!this.init){   
                $.mobile.changePage($(view.el), {changeHash:false});
            }else{   
                this.init = false;
            }            
    	}       

    });

    return Router;
});




