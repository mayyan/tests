<?php

function renderFeaturedToday($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-featuredtoday promo size-{$size}">
    <div class="top">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Tostino's Savings Center"></a>
        </div>
    </div>
    <div class="bottom">
        <h4 class="typeline">FEATURED TODAY</h4>
        <h5 class="headline">Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div class="mod-featuredtoday promo size-{$size}">
    <div class="left">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Tostino's Savings Center"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="typeline">FEATURED TODAY</h4>
        <h5 class="headline">Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else {
        $html = "Unknown featuredtoday size ($size)";
    }

    return $html;
}
?>
