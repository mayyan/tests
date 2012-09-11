<?php
$size = empty($_GET["size"]) ? 21 : $_GET["size"];

$podJSON = file_get_contents("podCache.json");
$podCache = json_decode($podJSON, true);
$podIdList = array_keys($podCache);
//var_dump($podArray);
//var_dump($podIdList);

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
    echo <<<HTML
<div class="row">
    <div class="column grid_1">
HTML;
    renderPod($row);
    echo <<<HTML
    </div>
    <div class="column grid_1">
HTML;
    renderPod($row+1);
    echo <<<HTML
    </div>
    <div class="column grid_1">
HTML;
    renderPod($row+2);
    echo <<<HTML
    </div>
</div>
HTML;
}

?>

<div class="mod-gallery">
    <div class="row">
        <div class="column grid_1">
            <div class="offeroftheweek">offer of the week</div>
        </div>
        <div class="column grid_1">
            <div class="supersaver">supersaver</div>
        </div>
        <div class="column grid_1">
            <div class="mrec">
                <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
            </div>
        </div>
    </div>

    <div class="pods">

<?php
for ($row = 0; $row < $size/3; $row++) {
    renderPodRow($row);
}
?>
    </div> <!-- .pods -->
    <div class="clearfix"></div>
    <button class="more">See more...</button>
    <a href="#top" class="goto-top">Go to top</a>
</div> <!--mod-gallery -->