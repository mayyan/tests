<?php
require_once(APPLICATION_PATH . "modules/ads/mrec.php");
require_once(APPLICATION_PATH . "modules/supersaver/supersaver.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/offeroftheweek/offeroftheweek.php");
require_once(APPLICATION_PATH . "modules/savingsclub/savingsclub.php");

function renderTopRowModule($moduleName, $size) {
    $html = '';
    switch ($moduleName) {
    case "supersaver":
        $html = renderSuperSaver($size);
        break;
    case "featuredtoday":
        $html = renderFeaturedToday($size);
        break;
    case "savingsclub":
        $html = renderSavingsClub($size);
        break;
    case "offeroftheweek":
        $html = renderOfferOfTheWeek($size);
        break;
    default:
        $html = "Unknow module ($moduleName) in top row of gallery.";
        break;
    }

    return $html;
}

function renderTopRowModules($config, $isFirstPage) {
    $format = $config["format"];
    $modules = $config["modules"];

    $html = '';
    if ($format == ModuleSize_Super) {

        $html .=<<<HTML
<div class="row">
    <div class="column grid_1">
HTML;
        $html .= renderTopRowModule($modules[0], $format);
        $html .=<<<HTML
    </div>

    <div class="column grid_1">
HTML;
        $html .= renderTopRowModule($modules[1], $format);
        $html .=<<<HTML
    </div>

    <div class="column grid_1">
HTML;
        $html .= renderMREC($isFirstPage);
        $html .=<<<HTML
    </div>

</div> <!-- .row -->
HTML;
    } else if ($format == ModuleSize_Double) {

        $html .=<<<HTML
<div class="row">

    <div class="column grid_2">
HTML;

        $html .= renderTopRowModule($modules[0], $format);
        $html .=<<<HTML
    </div>

    <div class="column grid_1">
HTML;
        $html .= renderMREC($isFirstPage);
        $html .=<<<HTML
    </div>

</div> <!-- .row -->
HTML;
    } else if ($format == ModuleSize_ShortStack) {

        $html .=<<<HTML
<div class="row">

    <div class="column grid_2">
        <div class="row">
            <div class="column grid_2">
HTML;
        $html .= renderTopRowModule($modules[0], $format);
        $html .=<<<HTML
            </div>
        </div>

        <div class="row">
            <div class="column grid_2">
HTML;
        $html .= renderTopRowModule($modules[1], $format);
        $html .=<<<HTML
                </div>
            </div>
        </div>

        <div class="column grid_1">
HTML;
        $html .= renderMREC($isFirstPage);
        $html .=<<<HTML
    </div>
</div> <!-- .row -->
HTML;
    }

    return $html;
}

function renderTopRowPods($isFirstPage) {
    $html =<<<HTML
<div class="row">

    <div class="column grid_2">
        <div class="row">
            <div class="column grid_1">
HTML;
        $html .= renderPod(100);
        $html .=<<<HTML
            </div>

            <div class="column grid_1">
HTML;
        $html .= renderPod(101);
        $html .=<<<HTML
            </div>
        </div>

        <div class="row">
            <div class="column grid_1">
HTML;
        $html .= renderPod(102);
        $html .=<<<HTML
            </div>

            <div class="column grid_1">
HTML;
        $html .= renderPod(103);
        $html .=<<<HTML
            </div>
        </div>
    </div>

    <div class="column grid_1">
HTML;
        $html .= renderMREC($isFirstPage);
        $html .=<<<HTML
    </div>
</div> <!-- .row -->
HTML;

    return $html;
}
?>