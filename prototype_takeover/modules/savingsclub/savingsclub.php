<?php

function renderSavingsClub($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-savingsclub promo size-{$size}">
    <div class="top">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
        </div>
    </div>
    <div class="bottom">
        <h4 class="typeline">GET 1 YEAR FREE</h4>
        <h5 class="headline">Join the Savings Club</h5>
        <p class="text">Get bigger, better savings, first dibs on offers.</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div class="mod-savingsclub promo size-{$size}">
    <div class="left">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Join the Savings Club"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="typeline">GET 1 YEAR FREE</h4>
        <h5 class="headline">Join the Savings Club</h5>
        <p class="text">Get bigger, better savings, first dibs on offers.</p>
    </div>
</div>
HTML;
    } else {
        $html = "Unknown savingsclub size ($size)";
    }

    return $html;
}
?>
