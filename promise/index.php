<?php

require_once("modules/gallery/gallery.php");

$modGallery = renderGallery();
$podCacheJSON = renderPodCacheAsJSON();

echo<<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>jQuery Promise</title>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.8.0/build/cssreset/cssreset-min.css&3.8.0/build/cssfonts/cssfonts-min.css">

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<div class="mod-signin">
		<button class="signin">Sign in</button>
	</div>

	<div class="mod-addcards">
		<button class="addcards">Add Cards</button>
	</div>

	<div class="mod-gallery">

		{$modGallery}

		</div>
	</div>

	<div class="flyout-inner"></div>
	
<script>
var APP_COUPONSINC = {};
APP_COUPONSINC.contextData = {
	"userState": {
		"loggedIn": false,
		"stores": []
	},
	"gallery": {
		"podCache" : {$podCacheJSON}
	}
};
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>

<script src="library/utils.js"></script>
<script src="library/classhelper.js"></script>
<script src="library/pod.js"></script>
<script src="library/pod_savetocard.js"></script>
<script src="modules/gallery/gallery.js"></script>

<script src="modules/signin/signin.js"></script>
<script src="modules/addcards/addcardsConfirm.js"></script>
<script src="modules/addcards/addcards.js"></script>
<script src="modules/addtocard/addtocard.js"></script>
</body>
</html>
HTML;

?>