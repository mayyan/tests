APP_COUPONSINC.signup = (function ($) {
	var def,
		STATUS_DONE                 = "sigup.STATUS_DONE",
		STATUS_CANCEL               = "sigup.STATUS_CANCEL",
		STATUS_FAIL_GETDIALOGHTML   = "sigup.STATUS_FAIL_GETDIALOGHTML",
		STATUS_FAIL_DOSIGNUP        = "sigup.STATUS_FAIL_DOSIGNUP",

		immediateRefresh = false;

	function getDialogHtml() {
		$.ajax({
			url: "modules/signup/signup.php",
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

	function doSignup() {
		$.ajax({
			url: "modules/signup/signup.php",
			cache: false,
			data: {
				"action": "submit"
			}
		})
		.done(handleSignUpDone)
		.fail(function() {
			console.log(STATUS_FAIL_DOSIGNUP);
			def.reject(STATUS_FAIL_DOSIGNUP);
		});
	}

	function cancel() {
		APP_COUPONSINC.dialog.close();
		console.log(STATUS_CANCEL);
		def.reject(STATUS_CANCEL);
	}

	function onOpen() {
		var dialogBody = $(".mod-signup-flyout");

		$(".submit", dialogBody).click(doSignup);

		$(".cancel", dialogBody).click(cancel);

		$(".signin", dialogBody).click(APP_COUPONSINC.signin.trx);
	}


	function handleGetDialogHtmlDone(html) {
		APP_COUPONSINC.dialog.open(html, {
			"open": onOpen
		});
	}

	function handleSignUpDone(resp) {
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
		
		def = def || APP_COUPONSINC.signin.getDeferred() || new $.Deferred();
	
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

