<?php

function renderSuperSaver($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-supersaver size-{$size}">

    <div class="img">
        <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Join the Savings Club" class="image"></a>
    </div>
    <div class="bd">
        <h4>SAVE MORE</h4>
        <h5>Sign up for Super Savers</h5>
        <button>Sign Up</button>
    </div>

</div>
HTML;
    } if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-supersaver size-{$size}">
    <div class="media">

        <div class="img">
            <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Join the Savings Club" class="image"></a>
        </div>
        <div class="bd">
            <h4>SAVE MORE</h4>
            <h5>Sign up for Super Savers</h5>
            <button>Sign Up</button>
        </div>

    </div>
</div>
HTML;
    } else {
        $html = "Unknown supersaver size ($size)";
    }

    echo $html;
}
?>
