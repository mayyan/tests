APP_COUPONSINC.signin = (function ($) {
	var def,
		STATUS_DONE                 = "sigin.STATUS_DONE",
		STATUS_CANCEL               = "sigin.STATUS_CANCEL",
		STATUS_FAIL_GETDIALOGHTML   = "sigin.STATUS_FAIL_GETDIALOGHTML",
		STATUS_FAIL_DOSIGNIN        = "sigin.STATUS_FAIL_DOSIGNIN";

	function getDialogHtml() {
		$.ajax({
			url: "modules/signin/signin.php",
			cache: false,
			data: {
				"action": "render"
			}
		})
		.done(handleGetDialogHtmlDone)
		.fail(function() {
			console.log(STATUS_FAIL_GETDIALOGHTML);
			def.reject(STATUS_FAIL_GETDIALOGHTML);
		});
	}

	function doSignin() {
		$.ajax({
			url: "modules/signin/signin.php",
			cache: false,
			data: {
				"action": "submit"
			}
		})
		.done(handleSignInDone)
		.fail(function() {
			console.log(STATUS_FAIL_DOSIGNIN);
			def.reject(STATUS_FAIL_DOSIGNIN);
		});
	}

	function cancel() {
		$(".flyout-inner").dialog("destroy");
		console.log(STATUS_CANCEL);
		def.reject(STATUS_CANCEL);
	}

	function onOpen() {
		var dialogBody = $(".mod-signin-flyout");

		$(".submit", dialogBody).click(doSignin);

		$(".cancel", dialogBody).click(cancel);
	}


	function handleGetDialogHtmlDone(html) {
		$(".flyout-inner")
			.html(html)
			.dialog({
				"modal": true,
				"open": onOpen
			});
	}

	function handleSignInDone() {
		$(".flyout-inner").dialog("destroy");

		APP_COUPONSINC.contextData.userState.loggedIn = true;

		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
	}

	
	function show() {
		var isLoggedIn = APP_COUPONSINC.contextData.userState.loggedIn;

		def = $.Deferred();

		if (isLoggedIn) {

			console.log(STATUS_DONE);
			def.resolve(STATUS_DONE);

		} else {

		   	getDialogHtml();
		}

	   return def.promise();
	}

	function onReady() {
		var moduleBody = $(".mod-signin");

		$(".signin", moduleBody).click(show);
	}

	return {
		show: show,
		onReady: onReady
	};

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.signin.onReady();
});