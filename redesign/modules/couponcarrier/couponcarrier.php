<?php
function renderCouponCarrier() {
    global $Config;
    $userState = $Config["UserState"];

    $html =<<<HTML
<div class="mod-couponcarrier">
HTML;

    if ($userState == UserState_New) {
        $html .=<<<HTML
    <div class="welcome">
        <p>Welcome! Start saving with our free printable coupons.</p>
    </div>
HTML;
    } else {
        $html .=<<<HTML
    <div class="available">
        <h3><em class="value">$324.73</em> <span>Available Savings</span></h3>
    </div>
    <div class="cart">
        <div class="progress clipped-none">
            <div class="bar">
                <div class="savings-bar">$4.50</div>
            </div>
        </div>
    </div>
HTML;
    }
    $html .=<<<HTML
    <button class="btn-cta print-button" type="button">
        <span class="title">Print Coupons</span><span class="separator"></span><span class="number">3</span>
    </button>

</div> <!-- .mod-couponcarrier -->
HTML;

    echo $html;
}

?>