<?php
$action = $_REQUEST["action"];

if ($action == "addPod") {
	sleep(5);

	$podId = $_REQUEST['podId'];
	echo "{$podId} is added";

}
?>