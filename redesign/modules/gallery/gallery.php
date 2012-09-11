<?php
const APPLICATION_PATH = "/Users/myan/Sites/tests/redesign/";

const GridWidth = 3;

$pageSize = empty($_GET["size"]) ? 21 : $_GET["size"];
$offset = empty($_GET["offset"]) ? 0 : $_GET["offset"];
$action = empty($_GET["action"]) ? "" : $_GET["action"];

// Preparing all data
$podJSON = file_get_contents(APPLICATION_PATH . "podCache.json");
$podCache = json_decode($podJSON, true);
$podIdList = array_keys($podCache);

$podIdListOnPage = array_slice($podIdList, $offset, $pageSize);

$POD_TYPE_MAP = array(
    "0" => "coupon",
    "9" => "duet",
    "13" => "video",
    "15" => "cpc",
    "27" => "coupon"
);

$POD_CTA_MAP = array(
    "0" => "Clip Coupon",
    "9" => "Sign up and Save",
    "13" => "Watch to Clip",
    "15" => "Click to Redeem",
    "27" => "Clip Coupon"
);

$podTemplate =<<<HTML
<div class="pod-shadow">
    <div class="pod {type}">
        <div class="hover">
            <p>{cta}</p>
        </div>
        <div class="media">
            <div class="img">
                <a href="#"><img width="80" height="100" src="{imageUrl}" alt="{imageAlt}" class="pod-image"></a>
            </div>
            <div class="bd">
                <h4 class="summary">{summary}</h4>
                <h5 class="brand">{brand}</h5>
                <p class="details">{details}</p>
            </div>
        </div>
    </div>
</div>
HTML;

function getPodTypeCSSClass($podData) {
    global $POD_TYPE_MAP;
    return $POD_TYPE_MAP[$podData["type"]];
}

function getPodCTAString($podData) {
    global $POD_CTA_MAP;
    return $POD_CTA_MAP[$podData["type"]];
}

function renderPod($podIndex) {
    global $podIdList;
    global $podCache;
    global $podTemplate;

    $podId = $podIdList[$podIndex];
    $podData = $podCache[$podId];

    $podTypeCSSClass = getPodTypeCSSClass($podData);
    $podCTAString = getPodCTAString($podData);
    $podImageUrl = $podData["image"]["url"];

    $search = array('/{type}/', '/{cta}/', '/{imageUrl}/', '/{imageAlt}/', '/{summary}/', '/{brand}/', '/{details}/');
    $replace = array(
        $podTypeCSSClass,
        $podCTAString,
        $podImageUrl,
        $podData["brand"],
        $podData["summary"],
        $podData["brand"],
        $podData["details"]);
    //var_dump($replace);
    echo preg_replace($search, $replace, $podTemplate);

}

function renderPodRow($row) {
    global $offset;

    echo <<<HTML
<div class="row">
HTML;

    for ($c = 0; $c < GridWidth; $c++) {

        echo <<<HTML
    <div class="column grid_1">
HTML;
        renderPod($offset + $row * GridWidth + $c);
        echo <<<HTML
    </div>
HTML;
    }
    echo <<<HTML
</div>
HTML;
}

function renderPage() {
    global $pageSize;

    $totalRowsOnPage = $pageSize / GridWidth;

    echo <<<HTML
<div class="page">
    <div class="row">
        <div class="column grid_1">
HTML;
        include("offeroftheweek.php");
        echo <<<HTML
        </div>

        <div class="column grid_1">
HTML;
        include("supersaver.php");
        echo <<<HTML
        </div>
            
        <div class="column grid_1">
            <div class="mrec">
                <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
            </div>
        </div>
    </div>

    <div class="pods">
HTML;

    for ($row = 0; $row < $totalRowsOnPage; $row++) {
        renderPodRow($row);
    }

    echo <<<HTML
    </div> <!-- .pods -->
    <div class="clearfix"></div>
</div> <!-- .page -->
HTML;
}

/**
 * Main
 */
if ($action == "loadPage") {
    renderPage();
} else {
    echo <<<HTML
<div class="mod-gallery">
    <div class="pages">
HTML;

    renderPage();

    echo <<<HTML
    </div> <!-- .pages -->

    <div class="loading-indicator" style="display: none;">
        <img src="http://cdn.cpnscdn.com/static.coupons.com/Sites/img/bigblue/spinner.gif" width="32" height="32" />
    </div>
    <div class="more">
        <button style="visibility: visible;">Show More Coupons</button>
    </div>

    <div class="tools">
        <div class="selectall">
            <input type="checkbox" id="couponsinc-gallery-selectall" class="selectall-chk">
            <label for="couponsinc-gallery-selectall">Select All</label>
        </div>
        <a class="goto-top inactive" href="#top"><span class="triangle triangle-top"></span>Back to top</a>
    </div>
</div> <!--mod-gallery -->
HTML;
}
?>