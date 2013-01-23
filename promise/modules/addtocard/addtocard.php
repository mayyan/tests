<?php
$action = $_REQUEST["action"];

if ($action == "addPod") {
	$podId = $_REQUEST['podId'];
	echo "{$podId} is added";

}
?>