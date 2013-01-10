<?php
require_once(APPLICATION_PATH . "constants.php");
require_once(APPLICATION_PATH . "library.php");
require_once(APPLICATION_PATH . "modules/gallery/toprow.php");
require_once(APPLICATION_PATH . "modules/gallery/category.php");
require_once(APPLICATION_PATH . "modules/supersaver/supersaver.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/offeroftheweek/offeroftheweek.php");
require_once(APPLICATION_PATH . "modules/savingsclub/savingsclub.php");

// Preparing all data
$podJSON = file_get_contents(APPLICATION_PATH . "podCache.json");
$podCache = json_decode($podJSON, true);

//$podIdList = array_keys($podCache);
$podIdLists = segmentByCategory($podCache, $catid);

$categoryPodIdList = $podIdLists["category"];
$otherPodIdList    = injectItemIntoArray($podIdLists["other"], $Config["Gallery"]);


if (is_numeric($catid)) {
    $podIdList = $categoryPodIdList;
} else {
    $podIdList = $otherPodIdList;
}
$podIdListOnPage = array_slice($podIdList, $offset, GridSize);

$POD_TYPE_MAP = array(
    "0" => "coupon",
    "9" => "duet",
    "13" => "video",
    "15" => "cpc",
    "27" => "coupon"
);

$POD_CTA_MAP = array(
    "0" => "Clip Coupon",
    "9" => "Clip Coupon",
    "13" => "Click to Watch",
    "15" => "Click to Save",
    "27" => "Clip Coupon"
);

$POD_CTA2_MAP = array(
    "0" => "",
    "9" => "(Clip after signup)",
    "13" => "(Redeem after video)",
    "15" => "(Opens new window)",
    "27" => ""
);

$podTemplate =<<<HTML
<div class="pod {type}">
    <h3 class="premium-label">Savings Club</h3>

    <div class="hover">
        <div class="sprite-pod circle">
            <p class="click-text">{cta}</p>
            <p class="click-text-sec">{cta2}</p>
        </div>
    </div>
    <div class="left">
        <div class="pod-media">
            <div class="img">
                <img width="80" height="100" src="{imageUrl}" alt="{imageAlt}" class="pod-image">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
            <h4 class="summary">{summary}</h4>
            <h5 class="brand">{brand}</h5>
            <p class="details">{details}</p>
        </div>
    </div>
    <div class="clipped-container">
        <div class="clipped-view">

            <span class="box clip-box clip-action">
                <i>&#x2713;</i>Clipped
            </span>
            <span class="box clip-box unclip-action">
                <i>&#x2715;</i>Unclip
            </span>

            <span class="box share-box">
                <i>&#x21f6;</i>Share
                <div class="social-container">
                    <div class="social-message">
                        Share with your friends.
                    </div>
                    <div class="social-strip">
                        <div class="sprite-urban facebook"></div>
                        <div class="sprite-urban twitter"></div>
                        <div class="sprite-urban email"></div>
                    </div>
                </div>
            </span>

            <span class="box info">
                <i>&#x21f1;</i>Info
            </span>


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

function getPodCTA2String($podData) {
    global $POD_CTA2_MAP;
    return $POD_CTA2_MAP[$podData["type"]];
}

function renderPod($gridPosition) {
    global $podIdList;
    global $podCache;
    global $podTemplate;

    $html = '';

    if (is_numeric($podIdList[$gridPosition])) {
        // is a pod id
        $podIndex = $gridPosition;

        if ($podIndex < count($podIdList)) {
            $podId = $podIdList[$podIndex];
            $podData = $podCache[$podId];

            $podTypeCSSClass = getPodTypeCSSClass($podData);
            $podCTAString = getPodCTAString($podData);
            $podCTA2String = getPodCTA2String($podData);
            $podImageUrl = $podData["image"]["url"];

            $search = array('/{type}/', '/{cta}/', '/{cta2}/', '/{imageUrl}/', '/{imageAlt}/', '/{summary}/', '/{brand}/', '/{details}/');
            $replace = array(
                $podTypeCSSClass,
                $podCTAString,
                $podCTA2String,
                $podImageUrl,
                $podData["brand"],
                $podData["summary"],
                $podData["brand"],
                $podData["details"]);

            $html = preg_replace($search, $replace, $podTemplate);
        }
    } else {
        // is a module name
        $moduleName = $podIdList[$gridPosition];
        switch ($moduleName) {
        case "supersaver":
            $html = renderSuperSaver(ModuleSize_Grid);
            break;
        case "featuredtoday":
        case "featuredtoday2":
        case "featuredtoday3":
            $html = renderFeaturedToday(ModuleSize_Grid);
            break;
        case "savingsclub":
            $html = renderSavingsClub(ModuleSize_Grid);
            break;
        case "offeroftheweek":
            $html = renderOfferOfTheWeek(ModuleSize_Grid);
            break;
        default:
            //$html =  "Unknow module ($moduleName) injection to gallery.";
            break;
        }
    }

    return $html;
}

function renderPodRow($row) {
    global $offset;

    $html = <<<HTML
<div class="row">
HTML;

    for ($c = 0; $c < GridWidth; $c++) {

        $html .=<<<HTML
    <div class="column grid_1">
HTML;
        $html .= renderPod($offset + $row * GridWidth + $c);
        $html .=<<<HTML
    </div>
HTML;
    }
    $html .=<<<HTML
</div>
HTML;
    return $html;
}

function renderGalleryPage($isFirstPage) {
    global $Config;
    global $catid;

    $totalRowsOnPage = GridSize / GridWidth;

    $html =<<<HTML
<div class="page">
HTML;

    if ($isFirstPage) {
        if (is_numeric($catid)) {
            $html .= renderSegment($categoryPodIdList, $isFirstPage);
        } else {
            $html .= renderTopRowModules($Config["TopRow"], $isFirstPage);
        }
    } else {
        $html .= renderTopRowPods();
    }
    $html .=<<<HTML
    <div class="pods">
HTML;

    for ($row = 0; $row < $totalRowsOnPage; $row++) {
        $html .= renderPodRow($row);
    }

    $html .=<<<HTML
    </div> <!-- .pods -->
<div class="clearfix"></div>
</div> <!-- .page -->
HTML;

    return $html;
}

function renderGallery() {
    $html =<<<HTML
<div class="mod-gallery">
    <div class="pages">
HTML;

    $html .= renderGalleryPage(true);

    $html .=<<<HTML
    </div> <!-- .pages -->

    <div class="loading-indicator" style="display: none;">
        <img src="http://cdn.cpnscdn.com/static.coupons.com/Sites/img/bigblue/spinner.gif" width="32" height="32" />
    </div>

    <div class="more">
        <button class="primary">Show More Coupons</button>
    </div>

    <div data-popup="0" data-inhouse="0" class="mod-ads container-728x90">
        <iframe scrolling="no" frameborder="0" style="height:90px;width:728px" src="//couponbar.coupons.com/adblob.asp?AdSize=728x90&amp;pzn=13306iq3710&amp;req=1357805013855&amp;zip=95014&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1&amp;kvhouse=0&amp;kvss=0&amp;kvsc=0&amp;kvcb=0"></iframe>
    </div>

    <div class="tools">
        <div class="selectall">
            <input type="checkbox" class="selectall-chk" id="couponsinc-gallery-selectall">
            <label for="couponsinc-gallery-selectall">Clip All</label>
        </div>
        <a href="#top" class="goto-top inactive">Back to Top</a>
    </div>

</div> <!--mod-gallery -->
HTML;

    return $html;
}
?>