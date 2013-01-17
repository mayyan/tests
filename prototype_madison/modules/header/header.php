<?php
function renderHeader($showNav = true) {
    global $configIndex;
    $nav = ($showNav) ? renderNav() : "";

    $html =<<<HTML
<div class="mod-header">
    <a title="Return to the homepage" class="company-logo" href="./?config={$configIndex}">
        <img width="173" height="71" src="images/coupons-logo.png" alt="Coupons.com" />
    </a>

    {$nav}

</div>
HTML;

    return $html;

}

function renderNav() {
    global $Config;
    global $configIndex;

    $userState = $Config["UserState"];

    if ($userState != UserState_SignedIn) {
        $userHTML =<<<HTML
<ul class="tablist horizontal-list">
    <li class="tab"><a href="#" class="signin">Sign In</a></li>
    <li class="tab last"><button href="#" class="signup primary">Sign Up</button></li>
</ul>
HTML;
    } else {
        $userHTML =<<<HTML
<ul class="user-dropdown closed">
    <li class="first">Welcome, Jackie<span class="triangle triangle-down"></span></li>
    <li><a href="#">Account Setting</a></li>
    <li><a href="#">FAQ</a></li>
    <li><a href="#">Sign Out</a></li>
</ul>
HTML;
    }


    $html =<<<HTML
<div class="navbar">
    <div class="tab-container">
        <ul class="tablist horizontal-list">
            <li class="tab first selected"><a href="./?config={$configIndex}" id="tab-coupons" class="sprite-utils">Coupons</a></li>
            <li class="tab"><a href="http://www.coupons.com/couponweb/eoffers.aspx?pid=13306&nid=10&zid=iq37">Savings Card</a></li>
            <li class="tab"><a href="http://www.coupons.com/local-offers/">Local</a></li>
            <li class="tab"><a href="http://www.coupons.com/coupon-codes/">Coupon Codes</a></li>
            <li class="tab"><a href="http://blog.coupons.com/">Blog</a></li>
        </ul>
        {$userHTML}
    </div>

</div>
HTML;

    return $html;
}