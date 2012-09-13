<?php

function renderSavingsClub($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid || $size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-savingsclub size-{$size}">
    <div class="img">
        <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Join the Savings Club"></a>
    </div>
    <div class="bd">
        <h4>GET 1 YEAR FREE</h4>
        <h5>Join the Savings Club</h5>
        <p>Get bigger, better savings, first dibs on offers.</p>
    </div>
</div>
HTML;
    } else {
        $html = "Unknown savingsclub size ($size)";
    }

    echo $html;
}
?>
