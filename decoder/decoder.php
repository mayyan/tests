<?php

require 'cookie.php';

$input = $_POST['input'];

$sessionInfoCookie = new CWeb_SessionInfoCookie();
$this->_sessionInfo = $sessionInfoCookie->toArray();
?>
