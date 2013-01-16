<?php

function renderSiteNav() {
	$html =<<<HTML
<li class="cssMenui0 mod-sitenav">
	<a><span>Coupons</span></a>

    <ul>
    	<li><a href="#">Coupons</a></li>
    	<li><a href="#">Save to Card</a></li>
    	<li><a href="#">Local</a></li>
    	<li><a href="#">Coupon Codes</a></li>
    	<li><a href="#">Blog</a></li>
    </ul>
</li>
HTML;

	return $html;
}

?>