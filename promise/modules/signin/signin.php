<?php

$action = $_REQUEST['action'];

if ($action == "render") {

	echo renderSigninDialog();

} elseif ($action == "submit") {

	$userState = array("loggedIn" => true);

	echo header('Content-type: application/json');
	echo json_encode($userState);
	
}

function renderSigninDialog() {

	$html =<<<HTML
<div class="mod-signin-flyout">
	<form>
		Email: <input name="email">

		<button type="button" class="submit">Sign In</button>
		<button type="button" class="cancel">Cancel</button>
	</form>
</div>
HTML;
	
	return $html;
}

?>