<?php

function renderHero() {
    $html =<<<HTML
<div class="mod-hero">
    <div class="viewport">
        <button class="prev">Prev</button>
        <button class="next">Next</button>

        <ul class="panels">
            <li class="panel curr-panel">
                <img src="images/slide1.jpg">
            </li>
            <li class="panel">
                <img src="images/slide1.jpg">
            </li>
            <li class="panel">
                <img src="images/slide1.jpg">
            </li>
        </ul>
    </div>
</div>
HTML;

    return $html;
}
?>
