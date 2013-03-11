<?php

$action = $_REQUEST['action'];

if ($action == "render") {

	echo renderSignupDialog();

} elseif ($action == "submit") {

	$userState = array("loggedIn" => true);

	echo header('Content-type: application/json');
	echo json_encode($userState);
	
}

function renderSignupDialog() {

	$html =<<<HTML
<div class="mod-signup-flyout">
	<button class="signin">Sign in</button>

	<form>
		Email: <input name="email">

		<button type="button" class="submit">Sign Up</button>
		<button type="button" class="cancel">Cancel</button>
	</form>
</div>
HTML;
	
	return $html;
}

?>