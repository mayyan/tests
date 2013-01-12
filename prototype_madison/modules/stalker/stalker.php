<?php
require_once(APPLICATION_PATH . "modules/couponcarrier/couponcarrier.php");
require_once(APPLICATION_PATH . "modules/categories/categories.php");
require_once(APPLICATION_PATH . "modules/printcontrol/printcontrol.php");

function renderStalker() {
    $modCategories   = renderCategories();
    $modCarrier      = renderCouponCarrier();
    $modPrintControl = renderPrintControl();

    $html =<<<HTML
<div class="mod-stalker">
    <ul class="content">
        <li class="module">
            <div class="mod-sitenav">
                <img height="29" src="images/coupons-logo.png" alt="Coupons.com" />
                <span class="triangle triangle-down"></span>
            </div>
        </li>
        <li class="module">
            {$modCategories}
        </li>
        <li class="module">
            <div class="mod-sortcontrol">
                <div class="curr-sort">
                    <span>Most Recent</span>
                    <span class="triangle triangle-down"></span>
                </div>
            </div>
        </li>
        <li class="module">
            <div class="mod-zipcode">
                <div class="curr-zip">
                    <span>Zip</span>
                    <span class="triangle triangle-down"></span>
                </div>
            </div>
        </li>
        <li class="module">
            {$modCarrier}
        </li>
        <li class="module">
            {$modPrintControl}
        </li>
    </ul>

    <div class="clearfix"></div>
</div> <!-- .stalker -->
HTML;

    return $html;
}
?>
