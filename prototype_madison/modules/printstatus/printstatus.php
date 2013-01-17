<?php

function renderPrintStatus() {
    $status = getStatus();
    $html =<<<HTML
<div class="mod-printstatus">
    <div class="top">
        <h1>Your Coupons Are Printing</h1>
        <p>We Thank You For Your Patience</p>
    </div>

    {$status}

    <div class="bottom">
        <img src="http://cdn.cpnscdn.com/print.coupons.com/CouponWeb/Themes/CM_BigBlue/_images/loading-bar-big.gif" width="437" height="26">
        <p class="information">This process may take a few moments</p>
    </div>
</div>
HTML;

    return $html;
}

function getStatus() {
    global $Config;
    $html = '';

    if ($Config["TakeOver"] == 1) {
        $html =<<<HTML
<div class="middle takeover">
    <p class="takeover-action">Brought to you by:</p>
    <img width="188" height="130" src="images/yoplait-188x130.png">
</div>
HTML;
    } else {
        $html =<<<HTML
<div class="middle">
    <p class="action">Sending coupons to your printer......</p>
</div>
HTML;
    }

    return $html;
}

function renderPostPrintStatus() {
    $html =<<<HTML
<div class="printed-hd">
    <div><span class="sprite-icons printed-msg">Your coupons printed successfully!</span></div>
</div>

<div class="mod-titlebar">

    <div class="inner">

        <h1>More Coupons for You</h1>

        <p>Boost your savings with these valuable coupons on our partners' websites.</p>

    </div>
    <div class="clearfix"></div>

</div>
HTML;

    return $html;
}
