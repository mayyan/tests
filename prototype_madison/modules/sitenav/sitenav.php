<?php

function renderSiteNav() {
	$html =<<<HTML
<li class="cssMenui0 mod-sitenav">
	<a class="cssMenu-title">
        <span>Coupons&nbsp;<strong class="triangle triangle-down"></strong></span>
    </a>

    <ul class="cssMenu-sub">
    	<li class="cssMenu-item"><a href="#">Coupons</a></li>
    	<li class="cssMenu-item"><a href="#">Save to Card</a></li>
    	<li class="cssMenu-item"><a href="#">Local</a></li>
    	<li class="cssMenu-item"><a href="#">Coupon Codes</a></li>
    	<li class="cssMenu-item"><a href="#">Blog</a></li>
        <!--li class="cssMenu-items">
            <a href="#" class="cssMenu-title"><span>Testing 3-level Menu&nbsp;<strong class="triangle triangle-left"></strong></span></span></a>

            <ul class="cssMenu-sub">
                <li class="cssMenu-items">
                    <a href="#" class="cssMenu-title"><span>A&nbsp;<strong class="triangle triangle-left"></strong></span></span></a>

                    <ul class="cssMenu-sub">
                        <li class="cssMenu-item"><a href="#">A1</a></li>
                        <li class="cssMenu-item"><a href="#">A2</a></li>
                    </ul>
                </li>

                <li class="cssMenu-items">
                    <a href="#" class="cssMenu-title"><span>B&nbsp;<strong class="triangle triangle-left"></strong></span></span></a>

                    <ul class="cssMenu-sub">
                        <li class="cssMenu-item"><a href="#">B1</a></li>
                        <li class="cssMenu-item"><a href="#">B2</a></li>
                    </ul>
                </li>
            </ul>
        </li-->
    </ul>
</li>
HTML;

	return $html;
}

?>