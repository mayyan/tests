<?php

function renderFeaturedToday($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-featuredtoday size-{$size}">

    <div class="img">
        <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Tostino's Savings Center" class="image"></a>
    </div>
    <div class="bd">
        <h4>FEATURED TODAY</h4>
        <h5>Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-featuredtoday size-{$size}">
    <div class="media">

        <div class="img">
            <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Tostino's Savings Center" class="image"></a>
        </div>
        <div class="bd">
            <h4>FEATURED TODAY</h4>
            <h5>Tostino's Savings Center</h5>
        </div>

    </div>
</div>
HTML;
    } else {
        $html = "Unknown featuredtoday size ($size)";
    }

    echo $html;
}
?>
