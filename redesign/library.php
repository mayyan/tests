<?php
function injectItemIntoArray($oldArray, $injection) {
    $newArray = array_slice ($oldArray, 0); // make a copy, don't change $oldArray

    foreach ($injection as $moduleName => $position) {
        // In Config, position is 1-based.
        array_splice($newArray, $position - 1, 0, $moduleName);
    }

    return $newArray;
}
?>
