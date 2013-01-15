<?php
require_once(APPLICATION_PATH . "modules/leavebehind/leavebehind.php");
require_once(APPLICATION_PATH . "modules/couponcarrier/couponcarrier.php");
require_once(APPLICATION_PATH . "modules/categories/categories.php");
require_once(APPLICATION_PATH . "modules/printcontrol/printcontrol.php");

function renderStalker() {
    $modLeaveBehind  = renderLeaveBehind();
    $modCategories   = renderCategories();
    $modCarrier      = renderCouponCarrier();
    $modPrintControl = embedPrintControl();

    $html =<<<HTML
<div class="mod-stalker">

    {$modLeaveBehind}

    <div class="discovery-bar">
        <ul class="content">
            <li class="module">
                <div class="mod-sitenav">
                    <img height="29" src="images/coupons-logo.png" alt="Coupons.com" /><span class="triangle triangle-down">&nbsp;</span>
                </div>
            </li>
            <li class="module">
                {$modCategories}
            </li>
            <li class="module">
                <div class="mod-sortcontrol">
                    <div class="curr-sort">
                        <span>Most Recent</span><span class="triangle triangle-down">&nbsp;</span>
                    </div>
                </div>
            </li>
            <!--li class="module">
                <div class="mod-zipcode">
                    <div class="curr-zip">
                        <span>Zip</span><span class="triangle triangle-down">&nbsp;</span>
                    </div>
                </div>
            </li-->
            <li class="module">
                {$modCarrier}
            </li>

            {$modPrintControl}

        </ul>

        <div class="clearfix"></div>
    </div> <!-- .discovery-bar -->

</div> <!-- .stalker -->
HTML;

    return $html;
}

function embedPrintControl() {
    global $Config;

    $html = '';

    if ($Config["UserState"] != UserState_New) {
        $modPrintControl = renderPrintControl();
        
        $html =<<<HTML
<li class="module">
    {$modPrintControl}
</li>
HTML;
    }

    return $html;
}
?>
