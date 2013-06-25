<?php
$podTemplate =<<<HTML
<div data-gridy="" data-gridx="" data-podid="{podId}" class="pod {type}">

    <div class="media">
        <img class="left" width="80" height="100" alt="{imageAlt}" src="{imageUrl}">
        <div class="media-body">
            <h4 class="summary">{summary}</h4>
            <h5 class="brand">{brand}</h5>
            <p class="details">{details}</p>
        </div>
    </div>

    <div class="hover-view">
        <div class="oval">
            <p class="click-text">{cta}</p>
            <p class="click-text-sec">{cta2}</p>
        </div>
    </div>

    <div class="clipped-views">
        <div class="clipped-view">
            <div class="btn-group">
                <span class="btn btn-default btn-small"><i>&#x2713;</i>Clipped</span>
            </div>
        </div>

        <div class="clipped-hover-view btn-toolbar">
            <div class="btn-group">
                <button type="button" class="btn-unclip btn btn-default btn-small"><i>&#x2715;</i>Unclip</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown">
                    <i>&#x271b;</i>More <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="share-by-menu">
                        <a><i>&#x21f6;</i>Share</a>
                        <a tabindex="-1" href="#" class="sprite-pod share-by share-by-facebook">Facebook</a>
                        <a tabindex="-1" href="#" class="sprite-pod share-by share-by-twitter">Twitter</a>
                        <a tabindex="-1" href="#" class="sprite-pod share-by share-by-email">Email</a>
                    </li>
                    <li><a href="#"><i>&#x271b;</i> More in <strong>{catdesc}</strong></a></li>
                </ul>
            </div>
            <!--div class="btn-group"> 
                <button type="button" class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown">
                    <i>&#x271b;</i>More <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a><i>&#x21f6;</i>Share</a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Facebook</a></li>
                            <li><a tabindex="-1" href="#">Twitter</a></li>
                            <li><a tabindex="-1" href="#">Email</a></li>
                        </ul>
                    </li>
                    <li><a href="#">More in <strong>{catdesc}</strong></a></li>
                </ul>
            </div-->
        </div> <!-- .clipped-hover-view -->
    </div>

    <h3 class="sprite-pod badge hidden"></h3> </div>
HTML;

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

function renderPod($podData) {
    global $podTemplate;

    $podTypeCSSClass = getPodTypeCSSClass($podData);
    $podCTAString = getPodCTAString($podData);
    $podCTA2String = getPodCTA2String($podData);
    $podImageUrl = $podData["image"]["url"];

    $search = array('{type}', '{podId}', '{cta}', '{cta2}', '{imageUrl}', '{imageAlt}', '{summary}', '{brand}', '{details}', '{catdesc}');
    $replace = array(
        $podTypeCSSClass,
        $podData["podId"],
        $podCTAString,
        $podCTA2String,
        $podImageUrl,
        $podData["brand"],
        $podData["summary"],
        $podData["brand"],
        $podData["details"],
        $podData["catdesc"]);

    $html = str_replace($search, $replace, $podTemplate);

    return $html;
}
?>
