<?php

function renderSortControl() {
	$html =<<<HTML
<li class="cssMenui0 mod-sortcontrol">
    <a class="cssMenu-title"><span>Most Recent&nbsp;<strong class="triangle triangle-down"></strong></span></a>
    <ul class="cssMenu-sub">
        <li class="cssMenu-item"><a>Most recent</a></li>
        <li class="cssMenu-item"><a>Expiring soon</a></li>
        <li class="cssMenu-item"><a>Alphabetical by brand</a></li>
        <li class="cssMenu-item"><a>Highest value</a></li>
    </ul>
</li>
HTML;
	
		return $html;
}

?>