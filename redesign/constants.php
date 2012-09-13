<?php
const APPLICATION_PATH = "/Users/myan/Sites/tests/redesign/";

const GridWidth = 3;

const GridSize = 21;

const ModuleSize_Square = 1;
const ModuleSize_Big    = 2;
const ModuleSize_Long   = 3;
const ModuleSize_Grid   = 4;

const UserState_New       = 1;
const UserState_SignedOut = 2;
const UserState_SignedIn  = 3;

/**
 * Modules can be injected into Gallery are:
 *  - offeroftheweek
 *  - savingsclub
 *  - supersaver
 *  - featuredtoday
 */
/* Mock 1: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/1.jpg */
$Config = array(
    "UserState" => UserState_New,
    "TopRow" => array(
        "format" => 1, /*1: two horizontal squears; 2: one big rectangle; 3: two vertically stacked */
        "modules" => array("offeroftheweek", "savingsclub")
    ),
    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
        "supersaver" => 13,
        "featuredtoday" => 21
    )
);

/* Mock 2: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/2.jpg */
//$Config = array(
//    "TopRow" => array(
//        "format" => 2, /*1: two horizontal squears; 2: one big rectangle; 3: two vertically stacked */
//        "modules" => array("offeroftheweek")
//    ),
//    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
//        "savingsclub" => 13,
//        "supersaver" => 21,
//        "featuredtoday" => 22
//    )
//);

/* Mock 3: http://www.zurb.net/coupons/projects/interaction-design/implement/images/layouts/0910/3.jpg */
//$Config = array(
//    "TopRow" => array(
//        "format" => 3, /*1: two horizontal squears; 2: one big rectangle; 3: two vertically stacked */
//        "modules" => array("offeroftheweek", "savingsclub")
//    ),
//    "Gallery" => array( /* they are module names not used in TopRow, and their grid positions, starting from 1, the frist pod below TopRow */
//        "supersaver" => 13,
//        "featuredtoday" => 21
//    )
//);
?>