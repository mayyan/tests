<?php
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

function renderCoupon($podData) {
    global $podTemplate;

    $podTypeCSSClass = getPodTypeCSSClass($podData);
    $podCTAString = getPodCTAString($podData);
    $podCTA2String = getPodCTA2String($podData);
    $podImageUrl = $podData["image"]["url"];

    $search = array('/{type}/', '/{podId}/', '/{cta}/', '/{cta2}/', '/{imageUrl}/', '/{imageAlt}/', '/{summary}/', '/{brand}/', '/{details}/');
    $replace = array(
        $podTypeCSSClass,
        $podData["podId"],
        $podCTAString,
        $podCTA2String,
        $podImageUrl,
        $podData["brand"],
        $podData["summary"],
        $podData["brand"],
        $podData["details"]);

    $html = preg_replace($search, $replace, $podTemplate);

    return $html;
}

function injectItemIntoArray($oldArray, $injection) {
    $newArray = array_slice ($oldArray, 0); // make a copy, don't change $oldArray

    foreach ($injection as $moduleName => $position) {
        // In Config, position is 1-based.
        array_splice($newArray, $position - 1, 0, $moduleName);
    }

    return $newArray;
}

function segmentByCategory($podCache, $catid) {
    $catPodIdList = array();
    $otherPodIdList = array();

    foreach ($podCache as $podId => $podData) {
        $catlevel1 = $podData["catlevel1"];
        if ($catlevel1 === $catid) {
            array_push($catPodIdList, $podId);
        } else {
            array_push($otherPodIdList, $podId);
        }
    }

    return array(
        "category" => $catPodIdList,
        "other"    => $otherPodIdList
    );
}
?>
