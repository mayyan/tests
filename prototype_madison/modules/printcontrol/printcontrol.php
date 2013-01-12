<?php

function renderPrintControl() {
    global $Config;
    $clippedCount = ($Config["UserState"] == UserState_New) ? 0 : 3;

    $html =<<<HTML
<div class="mod-printcontrol">
    <button type="button" class="cta-3d print-button">
        <span class="title sprite-icons">Print Coupons</span><span class="number">{$clippedCount}</span>
    </button>
</div>
HTML;

    return $html;
}
?>
