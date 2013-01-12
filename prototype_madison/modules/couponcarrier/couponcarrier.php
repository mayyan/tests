<?php
function renderCouponCarrier() {
    global $Config;
    $userState = $Config["UserState"];

    $html =<<<HTML

HTML;

    if ($userState == UserState_New) {
        $html .=<<<HTML
<div class="mod-couponcarrier is-new-user">

    <div class="new-user">
        <h1 class="welcome">
            <span class="headline">298 coupons available for you.</span>
            <span class="text">Just <em>Click,</em> <em>Print</em> and <em>Save.</em></span>
        </h1>
    </div>

    <div class="active-user">
        <div class="available">
            <h3><em class="value">$414.77</em> <span>Available Savings</span></h3>
        </div>
        <div class="cart">
            <div class="progress">
                <div class="bar" style="">
                    <div class="savings-bar clipped-none" style="width: 0px;">$0</div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- .mod-couponcarrier -->
HTML;
    } else {
        $html .=<<<HTML
<div class="mod-couponcarrier is-active-user">
    <div class="active-user">

        <div class="cart">
            <div class="progress">
                <div class="bar">
                    <div class="savings-bar" style="width: 45.3px;">$1.30</div>
                </div>
                <h3>Available <span class="value">$416.20</span></h3>
            </div>
        </div>
    </div>

</div> <!-- .mod-couponcarrier -->
HTML;
    }

    return $html;
}

?>