<?php

function renderSavingsClub($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid || $size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-savingsclub size-{$size}">
    <div class="shadow">
        <div class="inner">
            <div class="img">
                <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Join the Savings Club" class="image"></a>
            </div>
            <div class="bd">
                <h4 class="summary">GET 1 YEAR FREE</h4>
                <h5 class="brand">Join the Savings Club</h5>
                <p class="details">Get bigger, better savings, first dibs on offers.</p>
            </div>
        </div>
    </div>

</div>
HTML;
    } else {
        $html = "Unknown savingsclub size ($size)";
    }

    echo $html;
}
?>
