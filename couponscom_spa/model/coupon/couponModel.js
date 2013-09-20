define(function(){

	var Coupon = Backbone.Model.extend({
    //default attributes 
		defaults:{
			podId: '',
			summary:'',
			brand:'',
			details: '',
			imgUrl: ''
		}
	});

	return Coupon;
});

