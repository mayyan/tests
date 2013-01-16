<?php

function renderPrintControl() {
    global $Config;

    $html = '';

    if ($Config["UserState"] != UserState_New) {

        $html =<<<HTML
<div class="mod-printcontrol">
    <button type="button" class="cta-3d print-button">
        <span class="title sprite-icons">Print Coupons</span><span class="number">0</span>
    </button>
</div>
HTML;
    }

    return $html;
}
?>
