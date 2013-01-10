<?php
function renderCouponCarrier() {
    global $Config;
    $userState = $Config["UserState"];

    $html =<<<HTML

HTML;

    if ($userState == UserState_New) {
        $html .=<<<HTML
<div class="mod-couponcarrier is-new-user">
    <div class="welcome">
        <p>Welcome! Start saving with our free printable coupons.</p>
    </div>
HTML;
    } else {
        $html .=<<<HTML
<div class="mod-couponcarrier is-active-user">
    <div class="active-user">
        <div class="available">
            <h3><em class="value">$416.20</em> <span>Available Savings</span></h3>
        </div>
        <div class="cart">
            <div class="progress">
                <div class="bar">
                    <div class="savings-bar" style="width: 45.3px;">$1.30</div>
                </div>
            </div>
        </div>
    </div>


HTML;
    }
    $html .=<<<HTML
    <button type="button" class="btn-cta print-button">
        <span class="title sprite-icons">Print Coupons</span><span class="number">3</span>
    </button>

</div> <!-- .mod-couponcarrier -->
HTML;

    return $html;
}

?>