<?php

function renderLeaveBehind() {
	global $Config;
	global $configIndex;

	$html = '';

	if ($Config['TakeOver'] == 1) {
	    $html .=<<<HTML
	<div class="mod-leavebehind">

	    <div class="frame">
	        <a href="brand.php?config={$configIndex}"><img src="images/pushdown.jpeg" width="980" height="90"></a>
	    </div>

	</div>
HTML;
	} 

    return $html;
}
?>
