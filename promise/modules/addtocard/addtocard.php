<?php
$action = $_REQUEST["action"];

if ($action == "addPod") {
	$podId = $_REQUEST['podId'];
	echo "{$podId} is added";

} elseif ($action == "renderConfirm") {

	$html =<<<HTML
<div class="mod-addtocard-confirm">
	This offer is not available for your stores. 

	<button type=button class="addcards">Add Cards</button>
	<button type=button class="cancel">Cancel</button>
</div>
HTML;

	echo $html;
}
?>