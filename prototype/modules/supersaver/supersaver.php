<?php

function renderSuperSaver($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-supersaver promo size-{$size}">

    <div class="top">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Join the Savings Club"></a>
        </div>
    </div>
    <div class="bottom">
        <h4 class="typeline">SAVE MORE</h4>
        <h5 class="headline">Sign up for Super Savers</h5>
        <button>Sign Up</button>
    </div>

</div>
HTML;
    } else if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-supersaver promo size-{$size}">
    <div class="left">

        <div class="img">
            <a href="#"><img src="images/food.png" alt="Join the Savings Club" class="image"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="typeline">SAVE MORE</h4>
        <h5 class="headline">Sign up for Super Savers</h5>
        <button>Sign Up</button>
    </div>

</div>
HTML;
    } else {
        $html = "Unknown supersaver size ($size)";
    }

    return $html;
}
?>
