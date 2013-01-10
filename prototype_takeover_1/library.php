<?php
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
