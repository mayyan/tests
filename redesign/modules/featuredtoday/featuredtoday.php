<?php

function renderFeaturedToday($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-featuredtoday size-{$size}">
    <div class="top">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Tostino's Savings Center"></a>
        </div>
    </div>
    <div class="bottom">
        <h4>FEATURED TODAY</h4>
        <h5>Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-featuredtoday size-{$size}">
    <div class="left">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Tostino's Savings Center"></a>
        </div>
    </div>
    <div class="right">
        <h4>FEATURED TODAY</h4>
        <h5>Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else {
        $html = "Unknown featuredtoday size ($size)";
    }

    echo $html;
}
?>
