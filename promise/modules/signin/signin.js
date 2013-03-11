APP_COUPONSINC.signin = (function ($) {
	var def,
		STATUS_DONE                 = "sigin.STATUS_DONE",
		STATUS_CANCEL               = "sigin.STATUS_CANCEL",
		STATUS_FAIL_GETDIALOGHTML   = "sigin.STATUS_FAIL_GETDIALOGHTML",
		STATUS_FAIL_DOSIGNIN        = "sigin.STATUS_FAIL_DOSIGNIN",

		immediateRefresh = false;

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
		APP_COUPONSINC.dialog.close();
		console.log(STATUS_CANCEL);
		def.reject(STATUS_CANCEL);
	}

	function onOpen() {
		var dialogBody = $(".mod-signin-flyout");

		$(".submit", dialogBody).click(doSignin);

		$(".cancel", dialogBody).click(cancel);

		$(".signup", dialogBody).click(APP_COUPONSINC.signup.trx);
	}


	function handleGetDialogHtmlDone(html) {
		APP_COUPONSINC.dialog.open(html, {
			"open": onOpen
		});
	}

	function handleSignInDone(resp) {
		APP_COUPONSINC.dialog.close();

		APP_COUPONSINC.contextData.userState.loggedIn = resp.loggedIn;

		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
		
		APP_COUPONSINC.utils.setRefreshPending(true);
		if (immediateRefresh) {
			APP_COUPONSINC.utils.refreshPageIfNeeded();
		}
	}

	
	function trx() {
		var isLoggedIn = APP_COUPONSINC.contextData.userState.loggedIn;

		def = def || APP_COUPONSINC.signup.getDeferred() || new $.Deferred();
		
		if (arguments.length == 1 &&  arguments[0].type  && arguments[0].type === "click") {
			// is a direct click on Sign In button
			immediateRefresh = true;
		}

		if (isLoggedIn) {

			console.log(STATUS_DONE);
			def.resolve(STATUS_DONE);

		} else {

		   	getDialogHtml();
		}

	   return def.promise();
	}

	function getDeferred() {
		return def;
	}

	return {
		getDeferred: getDeferred,
		trx: trx
	};

}(jQuery));

