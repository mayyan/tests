<?php

function renderSortControl() {
	$html =<<<HTML
<li class="cssMenui0 mod-sortcontrol">
    <a><span>Most Recent</span></a>
    <ul>
        <li><a>Most recent</a></li>
        <li><a>Expiring soon</a></li>
        <li><a>Alphabetical by brand</a></li>
        <li><a>Highest value</a></li>
    </ul>
</li>
HTML;
	
		return $html;
}

?>