<?php

function renderTakeover() {
    $html =<<<HTML
<div class="mod-takeover initial">
    <div class="initial-content">
        <img src="images/pushdown.jpg" width="980" height="90">
    </div>

    <div class="pencil-content">
        <img src="images/pencil.jpg" width="980" height="31">
    </div>

    <div class="expanded-content" style="display:none">
        <img src="images/expanded.jpg" width="970" height="415">
    </div>
</div>
HTML;

    return $html;
}
?>
