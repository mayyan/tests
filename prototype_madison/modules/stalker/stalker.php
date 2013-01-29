<?php
require_once(APPLICATION_PATH . "modules/leavebehind/leavebehind.php");
require_once(APPLICATION_PATH . "modules/sitenav/sitenav.php");
require_once(APPLICATION_PATH . "modules/categories/categories.php");
require_once(APPLICATION_PATH . "modules/sortcontrol/sortcontrol.php");
require_once(APPLICATION_PATH . "modules/couponcarrier/couponcarrier.php");
require_once(APPLICATION_PATH . "modules/printcontrol/printcontrol.php");

function renderStalker() {
    global $configIndex;

    $modLeaveBehind  = renderLeaveBehind();
    $modSiteNav      = renderSiteNav();
    $modCategories   = renderCategories();
    $modSortControl  = renderSortControl();
    $modCarrier      = renderCouponCarrier();
    $modPrintControl = embedPrintControl();

    $html =<<<HTML
<div class="mod-stalker">

    {$modLeaveBehind}

    <div class="discovery-bar">
        <div class="content">

            <div class="logo-container">
                <a href="./?config={$configIndex}"><img height="50" width="55" class="logo animated" src="images/mini-coupons-logo.png" /></a>
            </div>

            <ul class="cssMenu">
                {$modSiteNav}


                {$modCategories}


                {$modSortControl}
            </ul>

            <div class="module">
                {$modCarrier}
            </div>

            <div class="module last">
                {$modPrintControl}
            </div>

            <div class="clearfix"></div>
        </div>
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
    {$modPrintControl}
HTML;
    }

    return $html;
}
?>
