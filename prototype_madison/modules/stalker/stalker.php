<?php
require_once(APPLICATION_PATH . "modules/couponcarrier/couponcarrier.php");
require_once(APPLICATION_PATH . "modules/categories/categories.php");

function renderStalker() {
    $html =<<<HTML
<div class="mod-stalker">
    <div class="content">
HTML;

    $html .= renderCouponCarrier();
    $html .= renderCategories();

    $html .=<<<HTML
    </div>
</div> <!-- .stalker -->
HTML;

    return $html;
}
?>
