APP_COUPONSINC.signinsignuplinks = (function ($) {


	function onReady() {
		var moduleBody = $(".mod-signinsignuplinks");

		$(".signin", moduleBody).click(APP_COUPONSINC.signin.trx);
		$(".signup", moduleBody).click(APP_COUPONSINC.signup.trx);
	}

	return {
		onReady: onReady
	};

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.signinsignuplinks.onReady();
});
