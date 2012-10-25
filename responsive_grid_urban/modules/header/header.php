<?php
function renderHeader() {
    global $Config;
    $userState = $Config["UserState"];

    if ($userState != UserState_SignedIn) {
        $userHTML =<<<HTML
<ul class="tablist horizontal-list">
    <li class="tab"><a href="#" class="signin">Sign In</a></li>
    <li class="tab last"><a href="#" class="signup">Sign Up</a></li>
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
<div class="mod-header">
    <a title="Return to the homepage" class="company-logo" href="/">
        <img width="173" height="71" src="images/coupons-logo.png" alt="Coupons.com" />
    </a>


    <div class="navbar">
        <div class="tab-container">
            <ul class="tablist horizontal-list">
                <li class="tab first selected"><a href="/coupons/" id="tab-coupons" class="sprite-utils">Coupons</a></li>
                <li class="tab"><a href="http://www.coupons.com/couponweb/eoffers.aspx?pid=13306&amp;nid=10&amp;zid=iq37">Savings Card</a></li>
                <li class="tab"><a href="http://www.coupons.com/couponweb/localoffers.aspx?pid=13306&amp;nid=10&amp;zid=iq37">Local Deals</a></li>
                <li class="tab"><a href="/coupon-codes/">Coupon Codes</a></li>
            </ul>
            {$userHTML}
        </div>

        <div class="fblike">
            <fb:like href="http://www.facebook.com/couponscom" send="false" layout="button_count" width="450" show_faces="true"></fb:like>
        </div>
    </div>
</div>
HTML;

    return $html;

}