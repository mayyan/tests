<?php
$adsConfig = array(
    array(type=>"adblob", start => 2, width => 1, height => 2),
    array(type=>"adblob", start => 10, width => 1, height => 2),
    array(type=>"adblob", start => 15, width => 1, height => 2),
    array(type=>"adblob", start => 21, width => 2, height => 2),
    array(type=>"adblob", start => 28, width => 2, height => 2),
    array(type=>"adblob", start => 33, width => 3, height => 1),
    array(type=>"adblob", start => 36, width => 1, height => 1),
    array(type=>"adblob", start => 39, width => 2, height => 3),
);
//$adsConfig = array(
//    array(type=>"adblob", start => 2, width => 1, height => 2),
//    array(type=>"adblob", start => 12, width => 1, height => 2),
//    array(type=>"adblob", start => 27, width => 3, height => 1),
//);
function cutRows($adsConfig) {
    $gridWidth = 3;
    $gridHeight = 16; //10;

    $g = 0;
    $adIndex = 0;
    $rowIndex = 0;
    $rows = array();

    while($g < $gridWidth * $gridHeight) {
        $adAtRow = floor($adsConfig[$adIndex]["start"] / $gridWidth);
        $adAtCol = $adsConfig[$adIndex]["start"] % $gridWidth;
        //echo "adIndex=$adIndex, adAt($adAtCol, $adAtRow)\n";

        $gridRow = floor($g / $gridWidth);
        //$gridCol = $g % $gridWidth;
        //echo "g=$g; gridRow = $gridRow\n";

        if ($gridRow == $adAtRow) {
            //echo "has ad in this row\n";
            $beforeAd = $adAtCol;
            $adWidth = $adsConfig[$adIndex]["width"];
            $afterAd = $gridWidth - $beforeAd - $adWidth;

            $adProp = $adsConfig[$adIndex];
            //echo "($beforeAd, $adWidth, $afterAd)\n\n";
            $g += $gridWidth * $adsConfig[$adIndex]["height"];
            $adIndex++;
        } else {
            //echo "don't have ad in this row\n";
            $beforeAd = $gridWidth;
            $adWidth = 0;
            $afterAd = 0;
            $adProp = null;
            //echo "($beforeAd, $adWidth, $afterAd)\n\n";
            $g += $gridWidth;
        }

        $rows[$rowIndex] = array($beforeAd, $adWidth, $afterAd, $adProp);
        $rowIndex++;


    }

    //print_r($rows);
    /*$rows = array(
        array(2,1,0),
        array(3,0,0),
        array(1,1,1),
        array(0,1,2),
        array(0,2,1),
        array(1,2,0),
    );*/
    return $rows;
}

function getColumnCount($colspan) {
    switch ($colspan) {
    case 1:
        return 3;
    case 2:
        return 2;
    case 3:
        return 1;
    }
}

function getColSpanClass($colspan) {
    switch ($colspan) {
    case 1:
        return "grid_3";
    case 2:
        return "grid_6";
    case 3:
        return "grid_9";
    }
}

/**
 *  Assumption: Max 3 columns.
 *
 */
function selectTemplate1($row) {
    $gridWidth = 3;
    //print_r($row);

    if (!is_null($row[3])) {
        $adProp = $row[3];
        $adWidth = $adProp["width"];
        $adHeight = $adProp["height"];
    } else {
        $adWidth = 0;
        $adHeight = 0;
    }

    echo<<<HTML
<div class="row">
HTML;

    $colCount = getColumnCount($row[0]);
    for($w = 0; $w < $colCount; $w++) {

        $colSpan = getColSpanClass($row[0]);
        echo<<<HTML
    <div class="column {$colSpan}">
HTML;
        for ($h = 0; $h < $adHeight; $h++) {
            echo<<<HTML
        <div class="row">
HTML;
            for ($j = 0; $j < $row[0]; $j++) {
                echo<<<HTML
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
HTML;
            }
        echo<<<HTML
        </div>
HTML;
        }
        echo<<<HTML
    </div>
HTML;
    }

    $colSpan = getColSpanClass($row[1]);
    //echo ("row[1] = $row[1], colSpan=$colSpan\n");
    if ($row[1] > 0) {
        echo<<<HTML
    <div class="column {$colSpan}">
        <div class="pod ad{$adWidth}x{$adHeight}">ad</div>
    </div>
HTML;
    }


    $colSpan = getColSpanClass($row[2]);
    //echo ("row[2] = $row[2], colSpan=$colSpan\n");
    for($w = 0; $w < $row[2]; $w++) {
        echo<<<HTML
    <div class="column {$colSpan}">
HTML;
        for ($h = 0; $h < $adHeight; $h++) {
            echo<<<HTML
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
HTML;
        }
        echo<<<HTML
    </div>
HTML;
    }
    echo<<<HTML
</div>
HTML;
}
/**
 *  Assumption: Max 3 columns.
 *
 */
function selectTemplate($row, $rowIndex) {
    $gridWidth = 3;

    if (isset($row[3])) {
        $adProp = $row[3];
        $adWidth = $adProp["width"];
        $adHeight = $adProp["height"];
    }


    if ($row[1] == 0) { //beforeAds=3, adWidth == 0, after=0
        echo<<<HTML
<div class="row">
    <div class="column grid_9">
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
    </div>
</div>
HTML;
    } else if ($row[1] == 1) {
        if ($row[0] == 0) { //beforeAds=0, adWidth=1, afterAds=2
            echo<<<HTML
<div class="row">
    <div class="column grid_3"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
    <div class="column grid_6">
HTML;
        for($h = 0; $h < $adHeight; $h++) {
            echo<<<HTML
        <div class="row">
HTML;
            for($w = 0; $w < $row[2]; $w++) {
                echo<<<HTML
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
HTML;
            }
            echo<<<HTML
        </div>
HTML;
        }
        echo<<<HTML
    </div>
</div>
HTML;
        } else if ($row[0] == 1) {//before=1,adWidth=1,after=1
            echo<<<HTML
<div class="row">
HTML;
            for($w = 0; $w < $row[0]; $w++) {
                echo<<<HTML
    <div class="column grid_3">
HTML;
                for ($h = 0; $h < $adHeight; $h++) {
                    echo<<<HTML
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
HTML;
                }
                echo<<<HTML
    </div>
HTML;
            }
            echo<<<HTML
    <div class="column grid_3">
        <div class="row">
            <div class="column grid_3"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
        </div>
    </div>
HTML;
            for($w = 0; $w < $row[2]; $w++) {
                echo<<<HTML
    <div class="column grid_3">
HTML;
                for ($h = 0; $h < $adHeight; $h++) {
                    echo<<<HTML
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
HTML;
                }
                echo<<<HTML
    </div>
HTML;
            }
            echo<<<HTML
</div>
HTML;
        } else if ($row[0] == 2) {//before=2,adWidth=1,after=0
            echo<<<HTML
<div class="row">
    <div class="column grid_6">
HTML;
        for($h = 0; $h < $adHeight; $h++) {
            echo<<<HTML
        <div class="row">
HTML;
            for($w = 0; $w < $row[0]; $w++) {
                echo<<<HTML
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
HTML;
            }
            echo<<<HTML
        </div>
HTML;
        }
        echo<<<HTML
    </div>
    <div class="column grid_3"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
</div>
HTML;
        }
    } else if ($row[1] == 2) { //adWith = 2
        if ($row[0] == 0) {//before=0,adWidth=2,after=1
            echo<<<HTML
<div class="row">
    <div class="column grid_6"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
    <div class="column grid_3">
HTML;
            for ($w = 0; $w < $adHeight; $w++) {
                echo<<<HTML
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
HTML;
            }
            echo<<<HTML
    </div>
</div>
HTML;
        } else if ($row[0] == 1) {//before=1,adWidth=2,after=0
            echo<<<HTML
<div class="row">
    <div class="column grid_3">
HTML;
            for ($w = 0; $w < $adHeight; $w++) {
                echo<<<HTML
        <div class="row">
            <div class="column grid_3"><div class="pod coupon">coupon</div></div>
        </div>
HTML;
            }
            echo<<<HTML
    </div>
    <div class="column grid_6"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
</div>
HTML;
        }
    } else if ($row[1] == 3) { //adWith = 3
        echo<<<HTML
<div class="row">
    <div class="column grid_9">
        <div class="row">
            <div class="column grid_9"><div class="pod ad{$adWidth}x{$adHeight}">ad</div></div>
         </div>
    </div>
</div>
HTML;
    }
}

