<?php

$action = $_REQUEST['action'];

if ($action == "render") {

	echo renderAddCardsDialog();

} elseif ($action == "submit") {

	header('Content-type: application/json');
	echo json_encode($_REQUEST['cards']);

} elseif ($action == "renderConfirm") {

	echo renderAddCardsConfirmationDialog();

}

function renderAddCardsConfirmationDialog() {

	$podId = $_REQUEST['podId'];

	$html =<<<HTML
<div class="mod-addcards-confirm">
	Pod {$podId} is not available for your stores. 

	<button type=button class="addcards">Add Cards</button>
	<button type=button class="cancel">Cancel</button>
</div>
HTML;

	echo $html;
}

function renderAddCardsDialog() {

	$html =<<<HTML
<div class="mod-addcards-flyout">
	<form>
		<ul>
			<li><input type="checkbox" value="Safeway">Safeway</li>
			<li><input type="checkbox" value="Kroger">Kroger</li>
			<li><input type="checkbox" value="Meijer">Meijer</li>
		</ul>

		<button type="button" class="submit">Add</button>
		<button type="button" class="cancel">Cancel</button>
	</form>
</div>
HTML;
	
	return $html;
}

?>